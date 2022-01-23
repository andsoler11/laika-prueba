<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * Defaults function to return an API error
     * @param $array Array to return
     * @param $format [array,json]
     */
    public static function return_error($errorString, $statusCode, $userMessage="",  $array = "",$format="array")
    {

        $out["result"]       = "fail";
        $out["error"]        = $errorString;
        $out["user_message"] = $userMessage == "" ? $errorString : $userMessage;
        $out["payload"] = [];

        if ($array != "") {
            $out["payload"] = $array;
        }

        if($format == "json") {
            $out = json_encode($out);
        }
        # return result
        return response()->json($out, $statusCode);
    }


    /**
     * Defaults function to return an API result
     * @param $array Array to return
     * @param $format [array,json]
     */
    public static function return_result($statusCode, $array="", $userMessage="", $format="array")
    {
        $out["result"]  = "ok";
        $out["payload"] = $array;

        if($userMessage != "") {
            $out["message"] = $userMessage;
        }

        if($format == "json") {
            $out = json_encode($out, JSON_PRETTY_PRINT);
        }

        return response()->json($out, $statusCode);
    }
}
