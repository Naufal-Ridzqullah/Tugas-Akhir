<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{
    //
    use HasFactory;
    protected $table = "esp32data";
    protected $fillable = ["Voltage", "Current", "Power", "Energy", "Frequency", "PowerFactor"];
}
