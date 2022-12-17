<?php

namespace App\Http\Traits;

use App\Models\Setting;

trait GlobalTrait {

    public function getAllSettings()
    {
        // Fetch all the settings from the 'settings' table.
        $settings = Setting::all()[0];
        return $settings;
    }

    public function getCurrentLang() {
        return app()->getLocale();
    }

    public function returnError($errNum, $msg) {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }

    public function returnSuccessMessage($errNum = "S000", $msg = "") {
        return response()->json([
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }

    public function returnData($key, $value, $msg = "") {
        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => $msg,
            $key => $value
        ]);
    }


}
