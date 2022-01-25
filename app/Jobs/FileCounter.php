<?php

namespace App\Jobs;

use App\Helpers\Task;
use App\Models\ProjectTask;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FileCounter implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tempFilePath;
    protected $task;

    /**
     * Create a new job instance.
     * ReadFileLines constructor.
     *
     * @param $tempFilePath
     * @param $task
     */
    public function __construct($tempFilePath ,$task)
    {
        $this->tempFilePath=$tempFilePath;
        $this->task=$task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(2);

        // Update task with active status and start date
        Task::updateStartedTask($this->task);

        // bind counter service
        $class = app("App\Services\FileCounter\\".$this->task->type.'Counter');
        $class->counter($this->tempFilePath,$this->task);

    }
}
