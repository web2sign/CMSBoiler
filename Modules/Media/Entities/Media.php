<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['file_type','name','path','description'];
}
