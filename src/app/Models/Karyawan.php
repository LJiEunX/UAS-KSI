<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\Divisi;
use App\Models\GajiLog;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'nik', 'jabatan', 'email', 'alamat', 'gaji', 'divisi_id'];

    public function setGajiAttribute($value)
    {
        $this->attributes['gaji'] = Crypt::encryptString($value);
    }
    
    public function divisi()
{
    return $this->belongsTo(Divisi::class);
}

public function gajiLogs()
{
    return $this->hasMany(GajiLog::class);
}

    public function getGajiAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
