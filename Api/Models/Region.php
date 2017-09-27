<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
    *    The table associated with the model.
    *
    *    @var string
    */
    protected $table = 'region_tb';


    protected $primaryKey = 'region_id';

    /**
    *
    *   Set created_time and updated_time to false
    *
    *   @var bool
    */

    protected $fillable = [
        'names',
        'country_id',
        'states_id',
        'vmap_id',
        'status'
    ];

    public $timestamps = false;

    public function institution()
    {
        return $this->hasMany('Api\Models\Institution', 'region_id');
    }

    public function district()
    {
        return $this->hasMany('Api\Models\District', 'region_id');
    }

    public function states()
    {
        return $this->belongsTo('Api\Models\States', 'states_id');
    }

    public function country()
    {
        return $this->belongsTo('Api\Models\Country', 'country_id');
    }

}
