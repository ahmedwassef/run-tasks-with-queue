<?php

namespace App\Helpers;


 use App\Models\ProjectTask;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

/**
 * This is a helper class For task and job batches
 */
class Task
{

    /**
     * Update start dae if it null and change status to be active
     *
     * @param $task
     */
    public static function updateStartedTask($task)
    {
        if (!$task->started_at) {
            $task->fill(['started_at' => Carbon::now()])->save();
            $task->fill(['status' => ProjectTask::$ACTIVESTATUS])->save();
        }

    }

    /**
     * update task count
     *
     * @param $task
     * @param $count
     * @return mixed
     */
    public static function updateTaskCount($task, $count)
    {
        return $task->update(['count' => $count]);
    }


    /**
     *
     * @param $request
     * @param $project
     * @return mixed
     */
    public static function createTask($request, $project)
    {
        $file_path = File::uploader($request, 'file');

        return $task = ProjectTask::create([
            'project_id' => $project->id,
            'status' => ProjectTask::$PENDINGSTATUS,
            'type' => $request->task_type,
            'file_path' => $file_path,
            'count' => 0,
            'batch_id' => 0,
            'uuid' => \Str::uuid()->toString(),
            'file_size' => $request->file('file')->getSize(),
        ]);
    }


    /**
     *
     *
     * @param $task
     * @throws \Throwable
     */
    public static function batchTaskJobs($task)
    {
        // Read file content
        $content = file( File::getFilePublicPath($task->file_path));

        // Split file into smaller units and create job per each
        $jobs = File::createSmallFiles($task, $content);

        // Queueing a batch of jobs that each process a given number of lines from txt file
        $batch = Bus::batch($jobs)->finally(function (Batch $batch) use ($task) {
            // After executing  the  batch has Update task status
            if ($batch->failedJobs) {
                $task->fill(['status' => ProjectTask::$FAILEDSTATUS])->save();
            } else {
                $task->fill(['status' => ProjectTask::$SUCCESSTATUS])->save();
            }
        })->dispatch();

        // Update task with batch id
        $task->fill(['batch_id' => $batch->id])->save();
    }


}
