<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas'];

    public function siswas()
    {
        return $this->HasMany(siswa::class);
    }
}
