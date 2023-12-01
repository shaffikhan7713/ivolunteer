<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeoplesReview extends Model
{
    use HasFactory;
    protected $table = 'peoplesreview';

    protected $fillable = [
        'id',
        'name',
        'place',
        'description',
    ];
}