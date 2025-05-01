<?php

// namespace App\Http\Controllers;

// use App\Models\Contact;
// use App\Models\Admin;
// use App\Notifications\NewContactMessage;
// use Illuminate\Http\Request;

// class ContactController extends Controller
// {
//     public function showForm()
//     {
//         return view('contact'); // صفحة التواصل
//     }

//     public function submitForm(Request $request)
//     {
//         $request->validate([
//             'name'    => 'required|string|max:255',
//             'email'   => 'required|email',
//             'message' => 'required|string|min:10',
//         ]);

//         $contact = Contact::create($request->only('name', 'email', 'message'));

//         // إرسال الإشعار إلى كل الأدمنز
//         $admins = \App\Models\Dashboard\Admin\Admin::all();
//         foreach ($admins as $admin) {
//             $admin->notify(new NewContactMessage($contact));
//         }

//         return back()->with('success', 'تم إرسال رسالتك بنجاح!');
//     }
// }

namespace App\Http\Controllers;

use App\Models\Ips;
use App\Helpers\Response;

use App\Models\Dashboard\Emails;
use App\Models\Dashboard\Mailbox;
use App\Models\Dashboard\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function showForm()
        {
            return view('home'); // صفحة التواصل
        }
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
