<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;
    protected $table = "zz_magazine";

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public static function getOptions()
    {
        $res = self::orderBy('page_date', 'DESC')->orderBy('page_no', 'DESC')->get();
        $selectOption = [];
        foreach ($res as $k=>$item)
        {
            $year = date('Y', strtotime($item->page_date));
            $selectOption[$item->magazine_id] = $year.'年'.$item->page_name;
        }

        return $selectOption;
    }

    public static function getMagazineName($magazine_id)
    {
        $magazine = self::where('magazine_id', $magazine_id)->first();
        $returnMsg = "";

        if(!empty($magazine))
        {
            $year = date('Y', strtotime($magazine->page_date));
            $returnMsg = $year.'年'.$magazine->page_name;
        }

        return $returnMsg;
    }


}
