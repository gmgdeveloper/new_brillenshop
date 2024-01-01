<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedData extends Model
{
    use HasFactory;
	
	protected $table = 'imported_data';
	
    protected $fillable = [
		'id', 
		'ItemName', 
		'ItemCode', 
		'Date', 
		'Price', 
		'Quantity', 
		'EItype', 
		'libType' 
    ];		
}
