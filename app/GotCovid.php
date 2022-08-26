<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GotCovid extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'got_covid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'covid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
