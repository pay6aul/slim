<?php

namespace Common\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{


  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'attachment_tb';

  /**
   * The primary key associated with the Model.
   *
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   *
   * Set created_time and updated_time to false
   *
   * @var bool
   */

  public $timestamps = false;

  /**
   * Get the user that owns the phone.
   */
   public function user()
   {
       return $this->belongsTo('Api\Models\User', 'user_id', 'user_id');
   }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'filepath',
    'attached_date',
    'user_id',
    'submission_type',
    'submission_id',
    'doc_type'
  ];

}
