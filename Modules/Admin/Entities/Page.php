<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $table = 'pages';
  protected $fillable = ['parent_id','user_id','post_type','title','slug','description','keywords','content','status'];

  public function meta(){
    return $this->hasMany(Pagemeta::class,'page_id','id');
  }

  public function parent(){
    return $this->hasOne(Page::class,'id', 'parent_id');
  }

  public function children(){
    return $this->hasMany(Page::class,'parent_id','id');
  }
}
