<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Utilities {

    public static function saveAwsImage($image, $fileExt = null) {
        if ($fileExt) {
            $file_ext = $fileExt;
        } else {
            $file_ext = $image->getClientOriginalExtension();
        }

        $extension = ($file_ext == 'png' || $file_ext == 'gif') ? $file_ext : 'jpg';
        $file = time() . rand(00000, 99999) . '.' . $extension;
        $file_path = $file;
        $full_image = Image::make($image)->stream();
        Storage::disk('uploads')->put($file_path, $full_image->__toString(), 'public');
        return $file;
    }

    public static function responseError($message = '', $statusCode = Response::HTTP_OK, $data = array()) {
        if (count($data) > 0) {
            $response = array(
                'status' => false,
                'status_code' => $statusCode,
                'message' => $message,
                'result' => (object) $data
            );
        } else {
            $response = array(
                'status' => false,
                'status_code' => $statusCode,
                'message' => $message,
                'result' => null
            );
        }
        return $response;
    }

    public static function generateRandomString($passwordLength) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $passwordLength; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }
    
    public static function generateRandomOtp($character) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $character; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
