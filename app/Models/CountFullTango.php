<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountFullTango extends Model
{
    use HasFactory;


    public function getCountVocabulary($lever)
    {
        $count =  DB::table('vocabulary')
            ->select()
            ->count();

        return $count;
    }
}
