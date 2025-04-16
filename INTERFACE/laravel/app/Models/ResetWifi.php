<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetWifi extends Model
{
    use HasFactory;
    protected $table = "reset_wifi";
    protected $fillable = ['status'];
}
