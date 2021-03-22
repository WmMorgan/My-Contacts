<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmail extends Model
{
    use HasFactory;

    protected $table = 'email';
    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'email',
        'user_id'
    ];

}

