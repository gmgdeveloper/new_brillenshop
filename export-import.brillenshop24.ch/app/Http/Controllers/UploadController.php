<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{

	public function FileUpload(Request $request){
		

		
		// $destinationPath = 'public/excel-import';
		$destinationPath = public_path('excel-import');
		$dateTime = date("Y-m-d-His", time());
		
		$file = $request->file('FileName');

		//Display File Name
		// $FileName = $dateTime.'-'.$file->getClientOriginalName();
		$FileName = $file->getClientOriginalName();
		
		//get file extension
		$FileExt = $file->getClientOriginalExtension();
		
		//Convert uppercase to lowercase
		$Filetype = Str::lower($FileExt);
		
		//Display File Real Path
		$FileRealPath = $file->getRealPath();
		
		//Display File Size
		$FileSize = $file->getSize();
		
		//Display File Mime Type
		$FileMimeType = $file->getMimeType();
		
		if (file_exists(public_path('excel-import/'.$FileName))) {
			unlink(public_path('excel-import/'.$FileName));			
		}

		$msgList = array();
		
		//The file Check extension
		if (($Filetype == 'xlsx') || ($Filetype == 'xls') || ($Filetype == 'xltx') || ($Filetype == 'csv') || ($Filetype == 'CSV')) {
			if($file->move($destinationPath, $FileName)) {
				
				$msgList["msgType"] = 'success';
				$msgList['msg'] = 'The file '.$FileName.' has been uploaded';
				$msgList["FileName"] = $FileName;
				
			} else {
				$msgList["msgType"] = 'error';
				$msgList['msg'] = '<span class="red">Sorry, there was an error uploading your file.</span>';
				$msgList["FileName"] = '';
			}
		} else {
			$msgList["msgType"] = 'error';
			$msgList['msg'] = '<span class="red">Sorry, only excel/csv file are allowed.</span>';
			$msgList["FileName"] = '';
		}
		
		return response()->json($msgList);
	}
}
