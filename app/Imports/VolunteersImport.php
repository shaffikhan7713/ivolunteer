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

        if(!array_filter($row) || $row['title'] === '') {
            return null;
        } 

        $seoUri = $this->generateSeoURL(trim($row['title']));

        return new Volunteer([
            'title' => trim($row['title'] ?? ''),
            'seoUri' => $seoUri,            
            'shortDescription' => trim($row['shortDescription'] ?? ''),
            'summary' => trim($row['summary'] ?? ''),
            'email' => trim($row['email'] ?? ''),
            'phone' => trim($row['phone'] ?? ''),      
            'link' => trim($row['link'] ?? ''),            
            'location' => trim($row['location'] ?? ''),
            'age' => trim($row['age'] ?? ''),
            'forWho' => trim($row['forWho'] ?? ''),
            'timeCommitment' => trim($row['timeCommitment'] ?? ''),
            'collegeApplication' => trim($row['feedback'] ?? ''),
            // 'ratings' => trim($row['ratings'] ?? '',
            'criteria' => trim($row['criteria'] ?? ''),
            'whereLocation' => trim($row['whereLocation'] ?? ''),            
            'howToApply' => trim($row['howToApply'] ?? ''),
            'dateAndTime' => trim($row['dateAndTime'] ?? ''),                        
            'whatVolunteerDoes' => trim($row['whatVolunteerDoes'] ?? ''),
            'feedback' => trim($row['feedback'] ?? ''),
        ]);
    }

    function generateSeoURL($string, $wordLimit = 0){ 
        $separator = '-'; 
         
        if($wordLimit != 0){ 
            $wordArr = explode(' ', $string); 
            $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
        } 
     
        $quoteSeparator = preg_quote($separator, '#'); 
     
        $trans = array( 
            '&.+?;'                 => '', 
            '[^\w\d _-]'            => '', 
            '\s+'                   => $separator, 
            '('.$quoteSeparator.')+'=> $separator 
        ); 
     
        $string = strip_tags($string); 
        foreach ($trans as $key => $val){ 
            $string = preg_replace('#'.$key.'#iu', $val, $string); 
        } 
     
        $string = strtolower($string); 
     
        return trim(trim($string, $separator)); 
    }
}