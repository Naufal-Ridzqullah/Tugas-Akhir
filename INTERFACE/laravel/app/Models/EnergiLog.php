<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergiLog extends Model
{
    use HasFactory;

    protected $table = 'energi_logs';

    protected $fillable = [
        'tanggal',
        'kwh',
        'fuzzy',
    ];
}
