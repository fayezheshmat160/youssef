<?php

namespace App\Helpers;


class Response
{
    /**
     * Methods Names
     * 1- success
     * 2- error
     * 3- info
     * 4- notfound
     * 5- warning
     */


    public function attributes(string $status, string $message, array $options)
    {

        // Prepare $options
        $responseStyle   = isset($options['style']) ? $options['style'] : 'box';
        $resetForm       = isset($options['reset']) ? $options['reset'] : false;
        $reload          = isset($options['reload']) ? $options['reload'] : false;
        $redirect        = isset($options['redirect']) ? $options['redirect'] : null;
        $redirectTimeOut = isset($options['time_out']) ? $options['time_out'] : 0;
        $jsonResponse    = isset($options['json']) ? false : true;

        

        if ($jsonResponse == true) {
            // Array For Set Options Attr After Prepare
            return response([
                'status' => $status,
                'message' => $message,
                // Response Style In Page [ box , alert ]
                'style' => $responseStyle,

                // Form Actions
                'reset' => $resetForm,

                // Page Actions
                'reload'   => $reload,
                'redirect' => $redirect,
                'time_out' => $redirectTimeOut,

                // Response Style ? Json Or Session
                'json' => $jsonResponse,
            ]);
        } else {
            return  request()->session()->flash($status, $message);
        }
    }

    // success
    public static function success(string $message, array $options = [])
    {
        return (new self)->attributes(__FUNCTION__, $message, $options);
    }

    // error
    public static function error(string $message, array $options = [])
    {
        return (new self)->attributes(__FUNCTION__, $message, $options);
    }

    // info
    public static function info(string $message, array $options = [])
    {
        return (new self)->attributes(__FUNCTION__, $message, $options);
    }

    // notfound
    public static function notfound(string $message, array $options = [])
    {
        return (new self)->attributes(__FUNCTION__, $message, $options);
    }

    // notfound
    public static function warning(string $message, array $options = [])
    {
        return (new self)->attributes(__FUNCTION__, $message, $options);
    }
}
