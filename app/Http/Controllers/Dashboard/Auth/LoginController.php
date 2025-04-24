<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Dashboard\Admin\AdminAttributes;
use App\Models\Dashboard\Admin\AdminPortfolio;

class LoginController extends Controller
{
    public function index()
    {
        return view("dashboard.auth.login");
    }

    public function login(Request $request)
    {
        // Inputs
        $email    = $request->email;
        $password = $request->password;
        $responseMsg = 'خطأ في بيانات الدخول حاول مرة اخري';



        // Admin::where(["email" => $email, 'password' => $password])
        // Check Auth IF Successfully
        if (Auth::guard('admin')->attempt(["email" => $email, 'password' => $password], true)) {

            // Check IF Status Closed
            if (adminAuth('status') > 0) {

                // Admin Attr
                $staticWhere = ['admin_id' => adminId()]; // Where

                $adminAttr = AdminAttributes::where($staticWhere)->count();
                if ($adminAttr == 0) {
                    // Create New Row And Set admin_id = Auth Id
                    AdminAttributes::create($staticWhere);
                }

                // Admin Port
                $adminPort = AdminPortfolio::where($staticWhere)->count();
                if ($adminPort == 0) {
                    // Create New Row And Set admin_id = Auth Id
                    AdminPortfolio::create($staticWhere);
                }

                // Check Role If True And Exist In Database
                return redirect(adminUrl("home"));

            } else {
                return redirect()->back()->withErrors(['error_login' => 'This Account Is Closed !']);
            }
        }



        // Else Error Login Back WithError Message
        $request->session()->flash("error_login", $responseMsg);
        $request->session()->flash("email", $email);
        return back();
    }



    // Forgot Password View
    public function forgotPassword()
    {
        return view('dashboard.auth.forgot-password');
    }
}
