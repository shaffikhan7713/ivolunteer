<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterItems extends Model
{
    use HasFactory;
    protected $table = 'filteritems';

    protected $fillable = [
        'id',
        'name',
        'value',
        'status',
    ];
}