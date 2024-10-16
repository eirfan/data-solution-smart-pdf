<?php

namespace App\Http\Controllers\Api;

use App\Classes\ChatGPT;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatGPTController extends Controller
{
    public function askQuestion(Request $request) {
        $validator = Validator::make($request->all(),[
            "question" => "required",
        ]);
        try{
            if($validator->fails()) {
                throw new Exception($validator->errors());
            }
            $chatGPT = new ChatGPT();
            $answer = $chatGPT->ask($request->input("question"));
            return $this->succesfulResponseApi($answer);

        }catch(Exception $exception) {
            return $this->errorResponseApi($exception->getMessage());
        }
    }
}
