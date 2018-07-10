<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Upermit extends Model
{
  protected $table = 'user_permits';
  protected $fillable = ['module','create','update','read','delete'];
  public $timestamps = false;

  //public $incrementing = false;

  public function permitable(){
    return $this->morphTo();
  }


}
