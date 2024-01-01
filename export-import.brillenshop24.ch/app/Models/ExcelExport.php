<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelExport extends Model
{
    use HasFactory;
	
	protected $table = 'excelexport';
	
    protected $fillable = [
		'id', 
		'ItemName', 
		'ItemCode', 
		'Date', 
		'Price', 
		'Quantity', 
		'EItype'
    ];
}
