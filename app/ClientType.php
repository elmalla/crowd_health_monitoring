<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_name',
    ];

    public function client(){
        return $this->hasOne(Client::class);
    }
}
