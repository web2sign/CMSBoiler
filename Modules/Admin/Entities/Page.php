<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $table = 'pages';
    protected $fillable = ['title','slug','description','keywords','content'];
}
