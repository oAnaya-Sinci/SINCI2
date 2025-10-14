<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Mail;
use Carbon\Carbon;
use Dompdf\Dompdf;

class ApiEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $template_path = 'email';
        $email = $request->email;
        $body = $request->body;
        $level = $request->level;
        $copy = explode(",", $request->copy);
        $date = User::where('email', $email)->value('admission_date');
        $admission_date = date_format(date_create($request->date_user), 'd-m-Y');
        $minimal_days = Setting::where('id', 1)->value('days');

        if($request->recordatorio == 0){
            if($level == 1){
                Mail::send($template_path, ['body' => $body, 'admission_date' => $admission_date, 'minimal_days' => $minimal_days], function($message) use ($template_path, $email) {
                    $message->to($email)->subject('SNL | '. explode('@', $email)[0] .' | Notificación por falta de registro en bitácora');
                    $message->from('snla@sinci.com','SNL | '. explode('@', $email)[0] .' | Notificación por falta de registro en bitácora');
                });
            }else{
                Mail::send($template_path, ['body' => $body, 'admission_date' => $admission_date, 'minimal_days' => $minimal_days], function($message) use ($template_path, $email, $copy) {
                    $message->to($email)->subject('SNL | '. explode('@', $email)[0] .' | Notificación por falta de registro en bitácora')->cc($copy);
                    $message->from('snla@sinci.com','SNL | '. explode('@', $email)[0] .' | Notificación por falta de registro en bitácora');
                });
            }

            return view('email', compact('body', 'admission_date', 'minimal_days'));

        } else if($request->recordatorio == 1){

            $template_path = 'email_recordatorio';

            Mail::send($template_path, ['body' => $body, 'minimal_days' => $minimal_days], function($message) use ($email) {
                $message->to($email)->subject('SNL | '. explode('@', $email)[0] .' | Recordatorio para registro en bitácora');
                $message->from('snla@sinci.com','SNL | '. explode('@', $email)[0] .' | Recordatorio para registro en bitácora');
            });

            return view('email_recordatorio', compact('body', 'minimal_days'));

        } else {

            $template_path = 'email_recordatorio_1';

            Mail::send($template_path, ['body' => $body, 'minimal_days' => $minimal_days], function($message) use ($email) {
                $message->to($email)->subject('Servicios y visitas a planta | '. explode('@', $email)[0] .' | Recordatorio para registro en bitácora');
                $message->from('snla@sinci.com','SNL | '. explode('@', $email)[0] .' | Recordatorio para registro en bitácora');
            });

            return view('email_recordatorio_1', compact('body', 'minimal_days'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /*
        * Function para generar los repotes correspondientes en PDF para coordinadoes y supervisores
     */

    public function generatePDF(Request $request){

        $htmlReport = $request[0];
        $nameReport = $request[1];
        $emailUser = $request[2];

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlReport);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $output = $dompdf->output();
        file_put_contents('reportsPDF/'.$nameReport.'.pdf', $output);

        $this->sendPDFInEmail($nameReport, $emailUser);

        return $request;
    }

    public function sendPDFInEmail($nameReport, $email){

        $template_path = 'email_report';
        $asunto = explode('- ', $nameReport);
        $body = $asunto[0].$asunto[1];

        // $email = 'oanaya@sinci.com';

        Mail::send($template_path, ['body' => $body], function($message) use ($email, $nameReport, $asunto) {
            $message->to($email)->subject('SNL | '. explode('@', $email)[0] .' | '.$asunto[0].$asunto[1] );
            $message->from('snla@sinci.com','SNL | '. explode('@', $email)[0] .' | '.$asunto[0].$asunto[1]);
            // $message->cc('oanaya@sinci.com');
            $message->attach('reportsPDF/'.$nameReport.'.pdf');
        });

        return view('email_report', compact('body'));
    }
}
