<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    protected $fillable = [
        'user_id',
    	'street',
    	'no_outside',
    	'colony',
    	'zip',
    	'city',
        'country',
        'latitude',
        'longitude'
    ];

    protected $appends = ['full_address'];

    public function getFullAddressAttribute()
    {
    	return "$this->street $this->no_outside $this->colony $this->city $this->country $this->zip";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
