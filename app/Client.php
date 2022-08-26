<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country', 'city', 'employee_total', 'phone', 'email', 'logo', 'website', 'clienttype_id',
    ];

    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'clienttype_id', 'id');
    }

    public function clientSupervisor()
    {
        return $this->hasMany(ClientSupervisor::class, 'client_id', 'id');
    }

    public function clientEmployees()
    {
        return $this->hasMany(ClientEmployees::class, 'client_id', 'id');
    }
}
