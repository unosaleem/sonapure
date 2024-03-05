<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{

    protected $table = 'cart';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','product_id','qty','psize_id','prod_type','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
