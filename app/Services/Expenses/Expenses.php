<?php

namespace App\Services\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    /** @use HasFactory<\Database\Factories\..\..\Services\Expenses\ExpensesFactory> */
    use HasFactory;

    protected $fillable = [
        "dateOfExpenses",
        "sourceOfExpenses",
        "descriptionOfExpenses",
        "amountOfExpenses",

    ];
}
