<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'request_date', 'withdrawal_date', 'employee_name', 'status'
    ];

    public function items()
    {
        return $this->hasMany(RequestItem::class);
    }
}
