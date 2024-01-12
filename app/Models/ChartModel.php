<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartModel extends Model
{
    use HasFactory;
    protected $table = 'testbyK';
    protected $fillable = ['id', 'form_code','form_date']; 
}
