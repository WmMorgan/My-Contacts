<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    public $timestamps = false; //shusiz bitta 'time' bilan ishlashga o'rganib qolganman 😂cd

//    protected $casts = [
//        'price' => 'float'
//    ];

    protected $fillable = [
        'name',
        'user_id',
        'time'
    ];

}

