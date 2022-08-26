<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BraceletTracker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'temperature', 'gps', 'gps_latitude', 'gps_longitude', 'heart_beat','oxygen_level','blood_pressure'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function braceletEmployees(){
        return $this->belongsTo(BraceletEmployees::class);
    }
}
