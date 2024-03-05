<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalPayResLogModel extends Model
{

    protected $table = 'final_pay_response_log';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','json_data','mflag','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
