<?php 

namespace App\Services;
use App\Classes\PdfParser;
use App\Interfaces\FileServiceInterface;

class FileService implements FileServiceInterface {
    public function uploadFile($file){
        ## BOC : Implement the logic to upload file here


        ## EOC
    }
    public function extractFileContent($file) {
        $parser = new PdfParser();
        $content =  $parser->parseContent($file);
        if(!$content) {
            throw new \Exception("File cannot be extracted");
        }
        $text = $content->getText();
        return $text;
    }
}