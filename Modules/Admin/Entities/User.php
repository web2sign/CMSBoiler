<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $tables = 'users';
  protected $hidden = ['password'];
  protected $fillable = ['email','username','password'];


  public function groups() {
    return $this->belongsToMany(Group::class,'user_group','user_id','group_id');
  }

  public function meta() {
    return $this->hasMany(Usermeta::class,'user_id','id');
  }

  public function permits() {
    return $this->morphMany(Upermit::class,'permitable');
  }

  public function sessions(){
    return $this->hasMany(Usession::class,'user_id','id');
  }
} 
