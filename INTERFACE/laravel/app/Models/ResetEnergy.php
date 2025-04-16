<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetEnergy extends Model
{
    use HasFactory;
    protected $table = "reset_energi";
    protected $fillable = ['status'];
}
