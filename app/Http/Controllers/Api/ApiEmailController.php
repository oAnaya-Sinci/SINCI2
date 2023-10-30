<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

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
        
        if($level == 1){
            Mail::send($template_path, ['body' => $body], function($message) use ($template_path, $email) {
                $message->to($email)->subject('Notificación de bitácoras');
                $message->from('snla@sinci.com','Notificación de bitácoras');
            });
        }else{
            Mail::send($template_path, ['body' => $body], function($message) use ($template_path, $email, $copy) {
                $message->to($email)->subject('Notificación de bitácoras')->cc($copy);
                $message->from('snla@sinci.com','Notificación de bitácoras');
            }); 
        }

        return view('email', compact('body'));
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
}
