<?php 

namespace App\Interfaces;

interface FileServiceInterface {
    public function uploadFile($file);
    public function extractFileContent($file);

}