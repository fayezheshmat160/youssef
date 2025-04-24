<?php

namespace App\Helpers;

trait Role
{

    public function __construct()
    {
    }

    public static function check(array $roles,$method)
    {
        $roleName = [];
    
        foreach ($roles as $role => $val) {

            // Push Role Name
            if (!is_array($val)) {
                array_push($roleName, $val);
            } else {

                for ($i = 0; $i < count($val); $i++) {
                    
                }
            }
            if (!is_integer($role)) {
                array_push($roleName, $role);
            }

     
        }
        echo $method;
        //  dd($roleName);
    }
}
