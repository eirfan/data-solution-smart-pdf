<?php

namespace App\Http\Controllers;

use App\Interfaces\FileServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    protected $fileService;
    public function __construct(FileServiceInterface $fileServiceInterface) {
        $this->fileService = $fileServiceInterface;
    }
    public function uploadFile(Request $request) {
        $validator = Validator::make($request->all() ,[
            "fileInput" => "required",
            'fileInput.*'=>'file|mimes:pdf,txt',
        ]);

        try{
            if($validator->fails()) {
                throw new Exception($validator->errors());
            }
            $file = $request->file("fileInput");
            // $this->fileService->uploadFile($file);
            $content = $this->fileService->extractFileContent($file);
            return view("documents\content\index",["content" => $content]);
            
        }catch(Exception $exception) {
            $this->errorResponse($exception->getMessage());
        }
    }
}
