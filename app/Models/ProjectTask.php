<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;

class ProjectTask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'file_path',
        'file_size',
        'type',
        'status',
        'count',
        'project_id',
        'batch_id',
        'started_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'started_at' => 'datetime:Y-m-d h:i:s',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status_class','finished_at','progress'];

    /**
     *  TASK STATUS NAMES
     */
    public static $PENDINGSTATUS = "pending";
    public static $ACTIVESTATUS = "active";
    public static $FAILEDSTATUS = "failed";
    public static $SUCCESSTATUS = "success";

    /**
     *  TASK TYPE NAMES
     */
    public static $WORDTYPE = "Word";
    public static $LINETYPE = "Line";
    public static $CHARACTERTYPE = "Character";

    /**
     * @return string|null
     */
    public function getFinishedAtAttribute()
    {
        if (Bus::findBatch($this->batch_id)->finishedAt){
            return   Bus::findBatch($this->batch_id)->finishedAt->format('Y-m-d h:i:s');
        }
        return   null;
    }

    /**
     *
     *
     * @return int
     */
    public function getProgressAttribute()
    {
        return Bus::findBatch($this->batch_id)->progress();
    }

    /**
     * Determine   the task status Class
     *
     * @return bool
     */
    public function getStatusClassAttribute()
    {

        switch ($this->status) {
            case $this::$SUCCESSTATUS:
                $calss=  "bg-green-300";
                break;
            case $this::$FAILEDSTATUS:
                $calss=  "bg-red-300";
                break;
            default:
                $calss= "";

        } ;

        return $calss;
    }

    /**
     * get related parent project
     *
     * @return BelongsTo Relations
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


}
