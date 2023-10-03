<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'country',
        'state',
        'zipcode',
        'city',
        'street_name',
        'street_type',
        'house_number',
        'building_number',
        'floor_number',
        'apartment_number',
        'phone',
        'email',
        'is_default'
    ];

    public function user()
    {
        # user_id alapján kihez tartozik a cím
        return $this->belongsTo(User::class);
    }
}
