<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class alphabet extends Model
{
    use HasFactory;

    public function getAllalphabet() {
        $alphabet = DB::select('SELECT * FROM alphabet');

        return $alphabet;
    }
}
