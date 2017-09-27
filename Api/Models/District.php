<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
    *    The table associated with the model.
    *
    *    @var string
    */
    protected $table = 'district_tb';


    protected $primaryKey = 'district_id';

    /**
    *
    *   Set created_time and updated_time to false
    *
    *   @var bool
    */

    protected $fillable = [
        'names',
        'region_id',
        'status'
    ];

    public $timestamps = false;

    public function institution()
    {
        return $this->hasMany('Api\Models\Institution', 'district_id');
    }

    public function wards()
    {
        return $this->hasMany('Api\Models\Wards', 'district_id');
    }

    public function region()
    {
        return $this->belongsTo('Api\Models\Region', 'region_id');
    }

}
