<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali_murid extends Model
{
   use HasFactory;

   protected $fillable = ['nama_wali', 'kontak'];

   public function siswas()
   {
       return $this->HasMany(siswa::class);
   }
}
