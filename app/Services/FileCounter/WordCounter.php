<?php

namespace App\Services\FileCounter;

use App\Contracts\FileCounter\FileCounter;
use App\Helpers\File;
use App\Helpers\Task;


Class WordCounter implements  FileCounter
{

    public function counter($temp_file_path,$task)
    {
        $count=$task->count;
        $content = fopen(File::getFileLocalPath($temp_file_path),'r');
        while(!feof($content)){
            $line = fgets($content);
            !str_word_count($line) && strlen($line)>0?$count+=1:  $count += str_word_count($line);
        }

        Task::updateTaskCount($task,$count);

    }
}
