<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;
     protected $fillable = [
        'start_date', 'end_date', 'min_hrs', 'max_hrs', 'total_assigned_hrs'
    ];
}
