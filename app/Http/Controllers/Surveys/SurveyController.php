<?php

namespace App\Http\Controllers\Surveys;

use App\Http\Controllers\Controller;

use App\Models\Surveys as ModelsSurveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Mail;
use App\Models\Surveys;
use App\Models\surveysClients;
use ErrorException;

class SurveyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(){

    date_default_timezone_set('America/Mexico_City');

    $surveys = $this->getSurveys(1, date('Y-m-d'), date('Y-m-d'));
    $surveysGenerated = Surveys::select('nombre_encuesta', 'id_encuesta')->get()->pluck('nombre_encuesta', 'id_encuesta')->toArray();

    return view("surveys/index", compact('surveys', 'surveysGenerated'));
  }

  public function obtainSurveys(Request $request){

    $dataFilter = json_decode($request['dataFilters']);

    $surveys = $this->getSurveys($dataFilter->status, $dataFilter->date_init, $dataFilter->date_end);

    return json_encode($surveys);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {

    $existSurvey = DB::table('clientes_encuestas')->where('llave_encuesta', $request[0])->exists();

    if ($existSurvey)
      return ['response' => false, 'Message' => "Debido a que ya existe una encuesta para el codigo de proyecto", 'codigo' => $request[6]];

    // $request[2] - Este campo obtiene el nombre de el vendedor que se debe de guardar porterior en la base de datos

    $survey = surveysClients::create([
      'llave_encuesta' => $request[0],
      'orden_compra_cliente' => $request[0],
      'nombre_cliente' => $request[1],
      'codigo_proyecto_cliente' => $request[6],
      'descripcion_proyecto_cliente' => $request[8],
      'correo_cliente' => $request[3],
      'correo_copia' => $request[4],
      'correo_copia_oculta' => $request[5],
      'id_encuesta' => $request[7],
    ]);

    $survey->save();

    // Send emails
    $this->sendEmailWithSurveyKey($request[3], $request[0]);

    if($request[4] != "")
        $this->sendEmailNewSurvey([$request[4], $request[5]], $request[0]);

    return ['response' => true, 'Message' => "Información guardada exitosamente"];
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * Obtain the data of the surveys
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function getSurveys($status, $date_init, $date_end){

    $dateSearch = " AND CE.created_timestamp BETWEEN '". $date_init ." 00:00:00' AND '". $date_end ." 23:59:59'";

    if($status == 0)
      $dateSearch = " AND CE.updated_timestamp BETWEEN '". $date_init ." 00:00:00' AND '". $date_end ." 23:59:59'";

    $dataSurvey = DB::select(DB::raw(
        "SELECT
              CE.nombre_cliente, CE.codigo_proyecto_cliente, CE.orden_compra_cliente, CE.descripcion_proyecto_cliente, CE.correo_cliente, CE.correo_copia, CE.correo_copia_oculta, CE.estatus_encuesta, CE.created_timestamp AS survey_created,
              E.nombre_encuesta, E.descripcion,
              CEC.id_llave_encuesta, CEC.created_timestamp AS survey_answered
          FROM clientes_encuestas CE
          INNER JOIN encuesta E ON CE.id_encuesta = E.id_encuesta
          LEFT  JOIN clientes_encuestas_contestadas CEC ON CE.llave_encuesta = CEC.id_llave_encuesta

          WHERE CE.estatus_encuesta = ". $status . $dateSearch . " ORDER BY CE.created_timestamp DESC;"
        ));

    return $dataSurvey;
  }

  public function sendEmailWithSurveyKey($email, $keySurvey){

    $template_path = 'surveys/emailKeySurvey';
    $asunto = "Encuesta de satisfacción al cliente";
    $body = "Llave para contestación de encuesta: " . $keySurvey;

    $email = explode(',', $email);

    Mail::send($template_path, ['body' => $body], function ($message) use ($email, $asunto) {
      $message->to($email)->subject($asunto)->from('snla@sinci.com', $asunto);
    });
  }

  // function to send email
  public function sendEmailNewSurvey($emails){

    $email = $emails[0];
    $email = explode(',', $email);

    $emailCC = $emails[1];

    if($emailCC != "")
        $emailCC = explode(',', $emailCC);

    $template_path = 'surveys/emailNewSurvey';
    $asunto = "Encuesta de satisfacción al cliente";
    $body = "Con esta plantilla solo se avisa de la contestacion de la encuesta";

    if ($emailCC != null) {
      Mail::send($template_path, ['body' => $body], function ($message) use ($email, $emailCC, $asunto) {
        $message->to($email)->cc($emailCC)->subject($asunto)->from('snla@sinci.com', $asunto);
      });
    } else {
      Mail::send($template_path, ['body' => $body], function ($message) use ($email, $asunto) {
        $message->to($email)->subject($asunto)->from('snla@sinci.com', $asunto);
      });
    }
  }

  public function obtainPDFSurvey(Request $request){

    $idSurvey = $request->input('idSurvey');
    $sendEmail = $request->input('sendEmail');

    $plantillaHTML_header = '<!DOCTYPE html>
        <html lang="en">
        <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>Reporte ' . $idSurvey . '</title>
        </head>

        <body style="width: 100%; opacity: 100;">

           <div style="text-align: center;">
              <div class="col-md-6">
                 <div class="header" style="display: flex; margin-bottom: 0.5rem;">
                    <!-- <img src="https://websas.sinci.com/assets/img/logo_sinci.png" alt="" width="100" height="100" style="margin: 0 1rem 0 0;"> -->
                    <div class="dataClient" style="display: flex; flex-direction: column; gap: 0.5rem;">';

    $plantillaHTML_middle = '</div></div><hr><div class="dataSurvey">';

    $plantillaHTML_end = '</div></div></div></body></html>';

    $survey = DB::select(DB::raw("SELECT datos_cliente_encuesta, respuestas_encuesta FROM clientes_encuestas_contestadas WHERE id_llave_encuesta = '" . $idSurvey . "'"));

    $templateSurvey = $plantillaHTML_header . $survey[0]->datos_cliente_encuesta . $plantillaHTML_middle . $survey[0]->respuestas_encuesta . $plantillaHTML_end;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($templateSurvey);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    if ($sendEmail == 'true') {
      $output = $dompdf->output();
      file_put_contents('reportsPDF/' . $idSurvey . '.pdf', $output);

      $emails = $this->sendEmailSurveyAnsweredClient($idSurvey);
      $emails = $this->sendEmailSurveyAnswered($idSurvey);
    } else {
      // Output the generated PDF to Browser
      $dompdf->stream($idSurvey.".pdf");
    }

    return $emails;
  }

  public function sendEmailSurveyAnsweredClient($idSurvey){

    $emails = DB::select(DB::raw("SELECT correo_cliente, llave_encuesta FROM clientes_encuestas WHERE llave_encuesta = '" . $idSurvey . "'"));

    $email = $emails[0]->correo_cliente;

    $email = explode(',', $email);

    $template_path = 'surveys/emailSurveyAnswered';
    $asunto = "Encuesta de satisfacción al cliente";
    $body = "Gracias por sus respuestas, sinci agradece que nos tomara como opción para sus necesidades y quedamos atentos a cualquier duda, demanda o solicitud futura";

    Mail::send($template_path, ['body' => $body], function ($message) use ($email, $asunto, $idSurvey) {
      $message->to($email)->subject($asunto)->from('snla@sinci.com', $asunto)->attach('reportsPDF/'.$idSurvey.'.pdf');;
    });
  }

  public function sendEmailSurveyAnswered($idSurvey){

    $emails = DB::select(DB::raw("SELECT correo_copia, correo_copia_oculta, llave_encuesta FROM clientes_encuestas WHERE llave_encuesta = '" . $idSurvey . "'"));

    if($emails[0]->correo_copia == null)
        return $emails;

    $email = $emails[0]->correo_copia;
    $email = explode(',', $email);

    $emailCC = $emails[0]->correo_copia_oculta;

    if($emailCC != "")
        $emailCC = explode(',', $emailCC);

    $template_path = 'surveys/emailSurveyAnswered';
    $asunto = "Encuesta de satisfacción al cliente";
    $body = "Gracias por sus respuestas, sinci agradece que nos tomara como opción para sus necesidades y quedamos atentos a cualquier duda, demanda o solicitud futura";

    if ($emailCC != null) {
      Mail::send($template_path, ['body' => $body], function ($message) use ($email, $emailCC, $asunto, $idSurvey) {
        $message->to($email)->subject($asunto)->from('snla@sinci.com', $asunto)->cc($emailCC)->attach('reportsPDF/'.$idSurvey.'.pdf');;
      });
    } else {
      Mail::send($template_path, ['body' => $body], function ($message) use ($email, $asunto, $idSurvey) {
        $message->to($email)->subject($asunto)->from('snla@sinci.com', $asunto)->attach('reportsPDF/'.$idSurvey.'.pdf');;
      });
    }

    return $emails;
  }
}
