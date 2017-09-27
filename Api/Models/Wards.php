<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    /**
    *    The table associated with the model.
    *
    *    @var string
    */
    protected $table = 'ward_tb';


    protected $primaryKey = 'ward_id';

    /**
    *
    *   Set created_time and updated_time to false
    *
    *   @var bool
    */

    protected $fillable = [
        'names',
        'district_id',
        'status'
    ];

    public $timestamps = false;

    public function institution()
    {
        return $this->hasMany('Api\Models\Institution', 'ward_id');
    }

    public function district()
    {
        return $this->belongsTo('Api\Models\District', 'district_id');
    }

}
