<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    /**
    *    The table associated with the model.
    *
    *    @var string
    */
    protected $table = 'states_tb';


    protected $primaryKey = 'states_id';

    protected $fillable = [
        'names',
        'status'
    ];

    public $timestamps = false;

    public function country()
    {
        return $this->hasMany('Api\Models\Country', 'states_id');
    }

    public function region()
    {
        return $this->hasMany('Api\Models\Region', 'states_id');
    }

}
