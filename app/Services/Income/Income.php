<?php

namespace App\Services\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;
    protected $fillable = [
        "date",
        "source",
        "description",
        "amount",

    ];
}
