<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
        use HasFactory;

        protected $guarded = ['id'];

        public function kelas()
        {
            return $this->belongsTo(kelas::class);
        }

        public function wali_murid()
        {
            return $this->belongsTo(wali_murid::class);
        }

}
