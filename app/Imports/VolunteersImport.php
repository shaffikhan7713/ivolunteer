<?php

namespace App\Imports;

use App\Models\Volunteer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VolunteersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Volunteer([
            'title' => $row['title'],
            'catId' => $row['catId'],
            'summary' => $row['summary'],
            'shortDescription' => $row['shortDescription'],
            'email' => $row['email'],
            'age' => $row['age'],
            'criteria' => $row['criteria'],
            'whereLocation' => $row['whereLocation'],
            'howToApply' => $row['howToApply'],
            'dateAndTime' => $row['dateAndTime'],
            'timeCommitment' => $row['timeCommitment'],
            'phone' => $row['phone'],
            'whatVolunteerDoes' => $row['whatVolunteerDoes'],
            'link' => $row['link'],
            'feedback' => $row['feedback'],
        ]);
    }
}