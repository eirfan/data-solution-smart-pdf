<?php 

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface FileServiceInterface {
    public function uploadFile($file);
    public function extractFileContent($file);
    public function getUploadedFile():Collection;

}