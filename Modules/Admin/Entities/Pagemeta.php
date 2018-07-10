<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Pagemeta extends Model
{
  protected $table = 'pagemeta';
  protected $fillable = ['metakey','metavalue'];
}
