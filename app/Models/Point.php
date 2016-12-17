<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Category;

class Point extends Model
{
    //
    protected $table = 'points';

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function getFullNameAttribute()
    {
        return $this->category->name . ' - ' .$this->point_value . ' points' ;
    }

}
