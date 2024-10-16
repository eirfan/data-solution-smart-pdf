<?php

namespace App\Http\Controllers;

use App\Events\StoreFileEvent;
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
    public function uploadAndExtractFile(Request $request) {
        $validator = Validator::make($request->all() ,[
            "fileInput" => "required",
            'fileInput.*'=>'file|mimes:pdf,txt',
        ]);

        try{
            if($validator->fails()) {
                throw new Exception($validator->errors());
            }
            $file = $request->file("fileInput");
            ## BOC: Can combine S3 and laravel queue to handle the store of the file
            $this->fileService->uploadFile($file);
            ## EOC
            $content = $this->fileService->extractFileContent($file);
            return view("documents\content\index",["content" => $content]);
            
        }catch(Exception $exception) {
            return redirect()->back()->withErrors(["errors"=>$exception->getMessage()]);
            // $this->errorResponse($exception->getMessage());
        }
    }
    public function getUploadedFiles() {
        $files = $this->fileService->getUploadedFile();
        return view("admins.documents.index",["files"=>$files]);
    }
}
