<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{

    protected $table = 'wishlist';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','prod_id','prod_type','psize_id','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
