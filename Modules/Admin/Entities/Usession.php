<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Usession extends Model
{
  protected $table = 'user_sessions';
  protected $fillable = ['session_type','session_key','ip','expired_at'];

  public function user() {
    return $this->belongsTo(User::class,'user_id', 'id');
  }
}