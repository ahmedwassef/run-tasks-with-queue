<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable =['name','uuid'];

    protected $appends = ['is_running'];

    public function getIsRunningAttribute()
    {

        return $this->runningTasks()?'Yes':'No';

    }

    public function runningTasks()
    {
        return $this->hasMany(ProjectTask::class)->where('status',  ProjectTask::$ACTIVESTATUS )->count();
    }

    public function taskWords()
    {
        return $this->hasMany(ProjectTask::class)->where('type',ProjectTask::$WORDTYPE)->orderBy('id', 'desc') ;
    }

    public function taskLines()
    {
        return $this->hasMany(ProjectTask::class)->where('type',ProjectTask::$LINETYPE)->orderBy('id', 'desc') ;
    }

    public function taskCharacters()
    {
        return ($this->hasMany(ProjectTask::class)->where('type',ProjectTask::$CHARACTERTYPE)->orderBy('id', 'desc'))  ;
    }
}
