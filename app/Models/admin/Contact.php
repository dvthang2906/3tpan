<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';

    public function showContact()
    {
        $dataContact = DB::table($this->table)
            ->select()
            ->orderBy('created_at', 'DESC')
            ->get();

        return $dataContact;
    }


    public function updateStatus($id, $status)
    {
        DB::table($this->table)
            ->where('id', $id)
            ->update(['status' => $status]);
    }

    public function deleteContactById($id)
    {
        DB::table($this->table)
            ->where('id', $id)
            ->delete();
    }
}
