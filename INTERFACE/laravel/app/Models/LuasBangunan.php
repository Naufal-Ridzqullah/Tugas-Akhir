<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuasBangunan extends Model
{
    use HasFactory;

    protected $table = 'luas_bangunan';
    protected $fillable = ['luas'];
}

