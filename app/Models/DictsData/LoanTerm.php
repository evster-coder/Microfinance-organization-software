<?php

namespace App\Models\DictsData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTerm extends Model
{
    use HasFactory;

    //отключение полей updated_at, created_at
    public $timestamps = false;


    protected $fillable = [
    	'daysAmount',
    ];
}