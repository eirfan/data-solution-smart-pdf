<?php 

namespace App\Services;
use App\Classes\PdfParser;
use App\Interfaces\FileServiceInterface;
use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceInterface {
    CONST FILE_PATH = "files/";
    public function uploadFile($file){
        ## BOC : Implement the logic to upload file here
            $name = $file->getClientOriginalName();
            $type = $file->getClientOriginalExtension();
            $path = $file->store(self::FILE_PATH.$type,"public");
            return File::create([
                'name' => $name,
                "url" => Storage::url($path),
            ]);

        ## EOC
    }
    public function extractFileContent($file) {

        switch($file->getClientOriginalExtension()) {
            case "pdf":
                $parser = new PdfParser();
                $content =  $parser->parseContent($file->getPathname());
                $text = $content->getText();
                break;

            case "txt":
                $text = file_get_contents($file->getRealPath());
                break;

        }
        return $text;
    }

    public function getUploadedFile(): Collection {
        $query = File::select(
            "url",
            "name",
            "created_at",
            "id",
        )->orderByDesc("created_at");
        $file = $query->get();
        return $file;
    }
}