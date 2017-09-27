<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
    *    The table associated with the model.
    *
    *    @var string
    */
    protected $table = 'country_tb';


    protected $primaryKey = 'country_id';

    protected $fillable = [
        'names',
        'states_id',
        'status'
    ];

    public $timestamps = false;

    public function states()
    {
        return $this->belongsTo('Api\Models\States', 'states_id');
    }

    public function region()
    {
        return $this->hasMany('Api\Models\Region', 'country_id');
    }

}
