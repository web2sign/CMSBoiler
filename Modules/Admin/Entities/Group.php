<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $table = 'groups';
  protected $fillable = ['name','description'];

  public function permits() {
    return $this->morphMany(Upermit::class,'permitable');
  }
}
