<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'prodi', // BARU
        'metode_penelitian', // BARU
        'variabel_penelitian', // BARU
        'sumber_data', // BARU 
        'session_id', 
        'user_id',      // <--- WAJIB ADA (Penyebab Error 500 kemarin)
        'status', 
        'bab1_content', 
        'bab2_content', 
        'bab3_content', 
        'bab4_content', 
        'bab5_content', 
        'daftar_pustaka'
    ];
}