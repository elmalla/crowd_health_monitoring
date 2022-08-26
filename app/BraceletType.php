<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BraceletType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_name',
    ];

    public function braceletInfo(){
        return $this->belongsTo(BraceletInfo::class);
    }
}
