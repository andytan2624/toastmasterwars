<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    protected $table = 'categories';

    public function latestPoint() {
        return $this->hasOne('App\Models\Point')->latest()
            ->orderBy('id', 'desc');
    }

    public function points() {
        return $this->hasMany('App\Models\Point');
    }
}
