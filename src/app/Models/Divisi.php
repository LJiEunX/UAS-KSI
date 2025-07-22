<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Karyawan;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_divisi', 'kode_divisi'];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}