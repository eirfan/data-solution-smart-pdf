<?php 

namespace App\Trait;

trait ResponseTrait {
   
    public function errorResponse($errors) {
        return redirect()->back()->withErrors(["errors"=>$errors]);
    }

    public function errorResponseApi($errors) {
        return response()->json([
            "status" => "fail",
            "data" => $errors,
        ]);
    }
    public function succesfulResponseApi($data) {
        return response()->json([
            "status" => "success",
            "data" => $data,
        ]);
    }
}