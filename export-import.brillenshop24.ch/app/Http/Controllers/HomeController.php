<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	//Home Page
    public function index()
    {
		return view('home');
    }
	
	//Export List
    public function ExportList()
    {
		return view('export-list');
    }
	
	//Import List
    public function ImportList()
    {
		return view('import-list');
    }
}
