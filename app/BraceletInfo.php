<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BraceletInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'braceletserial_no','bracelettype_id','color', 'price'
    ];

    public function braceletType(){
        return $this->belongsTo(BraceletType::class,'bracelettype_id');
    }

    public function braceletEmployees(){
        return $this->belongsTo(BraceletEmployees::class);
    }
}
