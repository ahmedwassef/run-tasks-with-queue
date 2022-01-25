<?php


namespace App\Contracts\FileCounter;


interface FileCounter
{
    /**
     * @param $temp_file_path
     * @param $task
     * @return mixed
     */
  public function counter($temp_file_path,$task);
}
