<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'payment_method',
        'shipping_method',
        'payment_firstname',
        'payment_lastname',
        'payment_phone',
        'payment_email',
        'payment_company,',
        'payment_country',
        'payment_state',
        'payment_zipcode',
        'payment_city',
        'payment_street_name',
        'payment_street_type',
        'payment_house_number',
        'payment_building_number',
        'payment_floor_number',
        'payment_apartment_number',
        'shipping_firstname',
        'shipping_lastname',
        'shipping_phone',
        'shipping_email',
        'shipping_company',
        'shipping_country',
        'shipping_state',
        'shipping_zipcode,',
        'shipping_city',
        'shipping_street_name',
        'shipping_street_type',
        'shipping_house_number',
        'shipping_building_number',
        'shipping_floor_number',
        'shipping_apartment_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
