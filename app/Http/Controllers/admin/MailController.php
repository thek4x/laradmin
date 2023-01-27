<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emails;
use Mail;
use App\Mail\singleMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MailController extends Controller {

       public function __construct() {
        $this->middleware(['auth:admin', 'permission:mail.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:mail.store'], ['only' => ['store']]);
    }
    
    
    public function ebulten(){
        $ebultens = DB::table('ebulten')->get();
        return view('admin.mail.ebulten',compact('ebultens'));
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $grouped = Emails::distinct('group')->pluck('group');
        $sended = Emails::all();
        return view('admin.mail.index', compact('grouped','sended'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        $mail = $request->
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required'
        ]);

        $mailData = [
            'email' => $request->email,
            'cc' => $request->cc,
            'subject' => $request->subject,
            'content' => $request->content,
            'group' => $request->group,
        ];
        $email = new Emails;
        $email->email = $request->email;
        $email->cc = $request->cc;
        $email->subject = $request->subject;
        $email->content = $request->content;
        $email->group = $request->group;
        $email->save();
        $admin = Auth::guard('admin')->user();

        try {
            $mail = Mail::to($request->email)->send(new singleMail($mailData));
            $email->work = 1;
            $email->updated_at = NOW();
            $email->save();
            $db_notif['admin'] = ['type' => 'mail.create', 'message' => $admin->username . ' ' . $request->email . ' e mail attı', 'ip' => $request->ip()];
            Notification::send($admin, new genelNotify($db_notif));
            $response = ['type' => 'success', 'title' => 'Mail Gönderme', 'message' => 'Mail başarıyla Gönderildi'];
        } catch (Exception $ex) {
            $email->work = 0;
            $email->updated_at = NOW();
            $email->failure_msg = $ex->getMessage();
            $email->save();
            $db_notif['admin'] = ['type' => 'mail.create', 'message' => $admin->username . ' ' . $request->email . ' e mail attı başarısız gönderildi sebebp: ' . $ex->getMessage(), 'ip' => $request->ip()];
            Notification::send($admin, new genelNotify($db_notif));
            $response = ['type' => 'error', 'title' => 'Mail Gönderme', 'message' => 'Hata :' . $ex->getMessage()];
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
