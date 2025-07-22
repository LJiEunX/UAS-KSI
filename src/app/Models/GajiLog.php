<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Karyawan;

class GajiLog extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'bulan', 'gaji_dibayar', 'catatan'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function setGajiDibayarAttribute($value)
    {
        $this->attributes['gaji_dibayar'] = Crypt::encryptString($value);
    }

    public function getGajiDibayarAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}