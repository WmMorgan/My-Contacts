<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    use HasFactory;

    protected $table = 'phone';
    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'number',
        'user_id'
    ];


}

