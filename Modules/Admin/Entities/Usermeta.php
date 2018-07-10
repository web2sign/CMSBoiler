<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
  protected $table = 'usermeta';
  protected $fillable = ['metakey','metavalue'];
  public $timestamps = false;
}
