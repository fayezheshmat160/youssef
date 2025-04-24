<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard\Languages;
use Illuminate\Support\Facades\Auth;

class DashBoardLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */



    private function locale()
    {
        return app()->getLocale();
    }

    private function fav_language()
    {
        $lang = new Languages();

        // Set Default
        $fav_language = $this->locale();

        // Fetch Fav Language From Admin Data
        $row = DB::table($lang->table)->where('id', adminAuth('language'))->first(["language_code"]);

        /**
         * Check IF This Admin Have Fav Language IF Not Have Set Default Lang ( en )
         */
        if (!empty($row)) {
            $fav_language = $row->language_code;
        }

        return $fav_language;
    }


    public function handle(Request $request, Closure $next)
    {

       
            app()->setLocale($this->fav_language());
        

        return $next($request);
    }
}
