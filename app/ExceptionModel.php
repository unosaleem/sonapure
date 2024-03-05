<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExceptionModel extends Model
{

    protected $table = 'exception';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title','msg','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
