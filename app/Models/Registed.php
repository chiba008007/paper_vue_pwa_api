<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user_renew_pages;

class Registed extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'mail',
        'tel',
        'post',
        'pref',
        'address',
        'status',
    ];

    public function userRenewPages()
    {
        return $this->hasMany(user_renew_pages::class);
    }
}
