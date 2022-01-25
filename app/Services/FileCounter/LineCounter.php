<?php

namespace App\Services\FileCounter;

use App\Contracts\FileCounter\FileCounter;
use App\Helpers\File;
use App\Helpers\Task;


Class LineCounter implements  FileCounter
{

    public function counter($temp_file_path,$task)
    {
        $count=$task->count;
        $content = fopen(File::getFileLocalPath($temp_file_path),'r');
        while(!feof($content)){
            fgets($content);
            $count += 1;
        }
        Task::updateTaskCount($task,$count);
    }
}
