<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactContent extends Model
{
    use HasFactory;
    protected $table = 'contactcontent';

    protected $fillable = [
        'id',
        'address',
        'email',
        'phone',
    ];
}