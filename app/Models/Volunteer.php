<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'catId',
        'summary',
        'shortDescription',
        'email',
        'age',
        'criteria',
        'whereLocation',
        'howToApply',
        'dateAndTime',
        'timeCommitment',
        'phone',
        'whatVolunteerDoes',
        'link',
        'feedback',
    ];
}