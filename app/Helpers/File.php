<?php

namespace App\Helpers;


use App\Jobs\FileCounter;

/**
* This is a helper class to provide File upload and get
*/
class File
{

    /**
     *
     *
     * @var int
     */
    protected static $chunk = 1000;


    /**
     *
     *
     * @var string
     */
    protected static $path_temp = 'tmp';


    /**
     * Upload and save file in public storage
     * @param $request
     * @param $file_name
     * @return mixed
     */
   	public static function uploader($request, $file_name)
    {
        $path = \Storage::disk('public')->putFile('files', $request->file($file_name));
        return $path;
    }

    /**
     * @param $chunk
     * @param $file_path_temp
     */
    public static function uploaderToTemporaryDirectory($chunk, $file_path_temp)
    {
        \Storage::disk('local')->put($file_path_temp, $chunk);
    }

    /**
     * @param $task
     * @param $data
     * @return array
     */
   	public static function createSmallFiles($task,$data)
    {
        $chunks =  array_chunk($data, File::$chunk) ;
        $jobs = [];

        foreach ($chunks as $key => $chunk) {
            $file_path_temp =File::$path_temp .'/'. $task->id . '/' . $key . '.txt';
            File::uploaderToTemporaryDirectory($chunk,$file_path_temp);
            $jobs[] = new FileCounter($file_path_temp, $task,(int) config('settings.sleep_seconds'));
        }

        return $jobs;
    }


    /**
     * Return full path of file
     * @param $filename
     * @return string
     */
    public static function getFile($filename)
    {
        $base_url = url('/');
        return $base_url.'/storage/'.$filename;
    }


    /**
     * @param $filename
     * @return mixed
     */
    public static function getFilePublicPath($filename)
    {
        return \Storage::disk('public')->path($filename);

    }

    /**
     * @param $filename
     * @return mixed
     */
    public static function getFileLocalPath($filename)
    {
        return \Storage::disk('local')->path($filename);
    }




}
