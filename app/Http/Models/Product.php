<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'cost_price',
        'sale_price',
        'type',
        'components'
    ];

    protected $casts = [
        'components' => 'array',
    ];

}
