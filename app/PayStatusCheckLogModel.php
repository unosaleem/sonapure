<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayStatusCheckLogModel extends Model
{

    protected $table = 'pay_status_check_log';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','rp_id','json_data','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
