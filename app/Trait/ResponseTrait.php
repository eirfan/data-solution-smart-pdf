<?php 

namespace App\Trait;

trait ResponseTrait {
   
    public function errorResponse($errors) {
        return redirect()->withErrors($errors);
    }
}