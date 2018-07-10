
<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Ucode extends Model
{
  protected $table = 'user_codes';
  protected $fillable = ['code','status'];
}
