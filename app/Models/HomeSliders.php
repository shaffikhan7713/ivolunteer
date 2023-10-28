<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSliders extends Model
{
    use HasFactory;
    protected $table = 'homesliders';

    protected $fillable = [
        'id',
        'name',
        'image',
        'status',
    ];
}