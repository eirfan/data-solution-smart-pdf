<?php

namespace App\Listeners;

use App\Interfaces\FileServiceInterface;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class StoreFileListener implements ShouldQueue
{
    use InteractsWithQueue;
    public $fileService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(FileServiceInterface $fileServiceInterface)
    {
        $this->fileService = $fileServiceInterface;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try{
            $file = $event->file;
            if(!isset($file)) {
                throw new Exception("No file found");
            }
            $this->fileService->uploadFile($file);
        }catch(Exception $exception) {
            Log::error("Error :".$exception->getMessage());
        }
    }
}
