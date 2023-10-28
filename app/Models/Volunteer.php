<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'seoUri',
        'catId',
        'summary',
        'shortDescription',
        'email',
        'criteria',
        'whereLocation',
        'howToApply',
        'dateAndTime',
        'phone',
        'whatVolunteerDoes',
        'link',
        'feedback',
        'location',
        'age',
        'forWho',
        'timeCommitment',
        'collegeApplication',
        'ratings',
    ];
}