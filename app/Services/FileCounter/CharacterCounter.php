<?php

namespace App\Services\FileCounter;

use App\Contracts\FileCounter\FileCounter;
use App\Helpers\File;
use App\Helpers\Task;


Class CharacterCounter implements  FileCounter
{

    public function counter($temp_file_path,$task)
    {
        $count=$task->count;
        $content = fopen(File::getFileLocalPath($temp_file_path),'r');
        while(!feof($content)){
            $line = fgets($content);
            $count += strlen((str_replace('\r\n','',$line)));
        }
        Task::updateTaskCount($task,$count);
    }
}
