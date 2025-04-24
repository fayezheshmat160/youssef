<?php

namespace App\Http\Controllers;

use App\Models\Ips;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\Dashboard\Emails;
use App\Models\Dashboard\Mailbox;
use App\Models\Dashboard\Settings;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    public function index(Settings $settings)
    {
        $ip = request()->ip();

        // Get from db
        $ipRow = Ips::where('ip', $ip)->first('status');

        if ($ipRow != null) {
            if ($ipRow->status == '0') {
                return abort(403);
            }
        }
        return view('main.contact', [
            'contact' => DB::table($settings->table)->first(['email', 'phone'])
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required|min:2|max:65',
            'email' => 'required|max:255|email',
            'subject'  => 'required|min:10|max:255',
            'message'  => 'required|min:25|max:10000',
        ]);

        // Form Inputs
        $email   = $request->email;
        $name    = $request->name;
        $subject = $request->subject;
        $message = $request->message;



        // Check IF This Mail Exist In Emails Tabel in DB
        $rowEmail = Emails::updateOrCreate(['email' => $email], ['email' => $email]);

        // Insert Message
        $insert = Mailbox::create([
            'from' => $rowEmail->id,
            'name' => $name,
            'subject' => $subject,
            'message' => $message,
            'unix_time' => time()
        ]);

        $rowEmail = Ips::updateOrCreate(['ip' => request()->ip()], [
            'ip' => request()->ip(),
            'mail_id' => $insert->id,
        ]);



        return Response::success('Your Message Has Been Sent Successfully !', [
            'style' => 'toastr',
            'reset' => true
        ]);
    }
}
