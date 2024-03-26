<?php

namespace App\Http\Controllers\Surveys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $surveys = $this->getSurveys();
         $surveysGenerated = DB::select(DB::raw("SELECT id_encuesta, nombre_encuesta FROM encuesta ORDER BY nombre_encuesta;"));

        return view("surveys/index", compact('surveys', 'surveysGenerated'));
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
    public function store(Request $request)
    {
      $queryInsert = "INSERT INTO clientes_encuestas(llave_encuesta, orden_compra_cliente, nombre_cliente, codigo_proyecto_cliente, descripcion_proyecto_cliente, correo_cliente, correo_copia, correo_copia_oculta, id_encuesta) ";
      $queryInsert .= "VALUES('" . $request[0] ."','". $request[0] ."','". $request[1] ."','". $request[2] ."','". $request[3] ."','". $request[4] . "','". $request[5] . "','". $request[6] . "','". $request[7] . "')";

      DB::insert( DB::raw( $queryInsert ));

      return true;
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
    public function getSurveys()
    {
        $dataSurvey = DB::select(DB::raw('
            SELECT 
                CE.nombre_cliente, CE.codigo_proyecto_cliente, CE.orden_compra_cliente, CE.descripcion_proyecto_cliente, CE.correo_cliente, CE.correo_copia, CE.correo_copia_oculta, CE.estatus_encuesta, CE.created_timestamp AS survey_created,
                E.nombre_encuesta, E.descripcion,
                CEC.id_llave_encuesta, CEC.created_timestamp AS survey_answered
            FROM clientes_encuestas CE
            INNER JOIN encuesta E ON CE.id_encuesta = E.id_encuesta
            LEFT  JOIN clientes_encuestas_contestadas CEC ON CE.llave_encuesta = CEC.id_llave_encuesta

            ORDER BY CE.created_timestamp DESC;
        '));

        return $dataSurvey;
    } 

    public function obtainPDFSurvey(Request $request){

      $idSurvey = $request->input('idSurvey');

        $plantillaHTML_header = '<!DOCTYPE html>
        <html lang="en">
        <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>Reporte '. $idSurvey .'</title>
        </head>
        
        <body style="width: 100%; opacity: 100;">
        
           <div style="text-align: center;">
              <div class="col-md-6">
      
                 <div class="header" style="display: flex; margin-bottom: 0.5rem;">
                    <!-- <img src="https://websas.sinci.com/assets/img/logo_sinci.png" alt="" width="100" height="100" style="margin: 0 1rem 0 0;"> -->
                    <div class="dataClient" style="display: flex; flex-direction: column; gap: 0.5rem;">';
        
                     $plantillaHTML_middle = '</div>
                 </div>
        
                 <hr>
        
                 <div class="dataSurvey">';
        
                  $plantillaHTML_end = '</div>
        
              </div>
           </div>
        
        </body>
        
        </html>';

        $survey = DB::select(DB::raw( "SELECT datos_cliente_encuesta, respuestas_encuesta FROM clientes_encuestas_contestadas WHERE id_llave_encuesta = '" . $idSurvey . "'" ));

        $templateSurvey = $plantillaHTML_header . $survey[0]->datos_cliente_encuesta . $plantillaHTML_middle . $survey[0]->respuestas_encuesta . $plantillaHTML_end;

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($templateSurvey);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        // $output = $dompdf->output();
        // file_put_contents('reportsPDF/'.$idSurvey.'.pdf', $output);

        return $templateSurvey;
    }
}
