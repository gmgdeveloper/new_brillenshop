<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ExcelExport;

use App\Models\ImportedData;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductImage;
use App\Models\ProductReview;



use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

//include PhpSpreadsheet library
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;	
use PhpOffice\PhpSpreadsheet\IOFactory;

class CSVExportImportController extends Controller
{
	//Data List for CSV Export
    public function CSVExportDataListAll()
    {
	
	
		return view('csv-export-data-list-all');
    }

	//Data List for CSV Export
    public function CSVExportDataList()
    {
		$data = Product::all();
		// ->where('EItype', '=', 'csv');

		return view('csv-export-data-list', compact('data'));
    }
	
	//CSV Imported Data List
    public function CSVImportedDataList()
    {
		$data = Product::all();
		// ->where('EItype', '=', 'csv');

		return view('csv-imported-data-list', compact('data'));
    }
	
    //CSV Export
    public function CSVExportData(){
		
		$data = Product::all();
		// ->where('EItype', '=', 'csv');
		
		$spreadsheet = new Spreadsheet();
		
		/*Value Set for Cells*/
		$spreadsheet->getActiveSheet()				
					->SetCellValue('A1', 'SL')							
					->SetCellValue('B1', 'Title')
					->SetCellValue('C1', 'Description Summary')							
					->SetCellValue('D1', 'Price')							
					->SetCellValue('E1', 'Base Price')							
					->SetCellValue('F1', 'Discount Price')
					->SetCellValue('G1', ' Quantity')
					->SetCellValue('H1', ' Size')
					->SetCellValue('I1', ' Condition')
					->SetCellValue('J1', ' Status')
					->SetCellValue('K1', ' Is Featured')
					->SetCellValue('L1', ' Cat ID')
					->SetCellValue('M1', ' SubCat ID')
					->SetCellValue('N1', ' ChildCat ID')
					->SetCellValue('O1', ' Barnd ID')
					->SetCellValue('P1', ' SKU')
					->SetCellValue('Q1', ' Weight')
					->SetCellValue('R1', ' Lenght')
					->SetCellValue('S1', ' Height')
					->SetCellValue('T1', ' Width')
					->SetCellValue('U1', ' Is Physical')
					->SetCellValue('V1', ' Warehouse')
					->SetCellValue('W1', ' Template')
					->SetCellValue('X1', ' Backorder')
					->SetCellValue('Y1', ' Discount Option')
					->SetCellValue('Z1', ' SPH')
					->SetCellValue('AA1', ' DIA')
					->SetCellValue('AB1', ' CYL')
					->SetCellValue('AC1', ' AXIS')
					->SetCellValue('AD1', ' RAD')
					->SetCellValue('AE1', ' COLOR')
					->SetCellValue('AF1', ' ADD')
					->SetCellValue('AG1', ' UPC')
					->SetCellValue('AH1', ' VTO')
					->SetCellValue('AI1', ' VTO Url')
					->SetCellValue('AJ1', ' Lens Option')
					->SetCellValue('AK1', ' Gender Man')
					->SetCellValue('AL1', ' Gender Woman')
					->SetCellValue('AM1', ' B2B Option')
					->SetCellValue('AN1', ' Ek Price')
					->SetCellValue('AO1', ' Discount')
					->SetCellValue('AP1', ' Photo');
				
		$i=1; 
		$j=2;
		foreach($data as $aRow){
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow['title'])	
						->SetCellValue('C'.$j, $aRow['description'])																
						->SetCellValue('D'.$j, $aRow['price'])																
						->SetCellValue('E'.$j, $aRow['base_price'])															
						->SetCellValue('F'.$j, $aRow['discount_price'])
						->SetCellValue('G'.$j, $aRow['stock'])
						->SetCellValue('H'.$j, $aRow['size'])
						->SetCellValue('I'.$j, $aRow['condition'])	
						->SetCellValue('J'.$j, $aRow['status'])	
						->SetCellValue('K'.$j, $aRow['is_featured'])	
						->SetCellValue('L'.$j, $aRow['cat_id'])	
						->SetCellValue('M'.$j, $aRow['subcat_id'])	
						->SetCellValue('N'.$j, $aRow['childcat_id'])	
						->SetCellValue('O'.$j, $aRow['brand_id'])	
						->SetCellValue('P'.$j, $aRow['SKU'])	
						->SetCellValue('Q'.$j, $aRow['weight'])	
						->SetCellValue('R'.$j, $aRow['length'])	
						->SetCellValue('S'.$j, $aRow['heigth'])	
						->SetCellValue('T'.$j, $aRow['width'])	
						->SetCellValue('U'.$j, $aRow['is_physical'])	
						->SetCellValue('V'.$j, $aRow['warehouse'])	
						->SetCellValue('W'.$j, $aRow['template'])	
						->SetCellValue('X'.$j, $aRow['backorder'])	
						->SetCellValue('Y'.$j, $aRow['discount_option'])	
						->SetCellValue('Z'.$j, $aRow['SPH'])	
						->SetCellValue('AA'.$j, $aRow['DIA'])	
						->SetCellValue('AB'.$j, $aRow['CYL'])	
						->SetCellValue('AC'.$j, $aRow['AXIS'])	
						->SetCellValue('AD'.$j, $aRow['RAD'])	
						->SetCellValue('AE'.$j, $aRow['colors'])	
						->SetCellValue('AF'.$j, $aRow['ADD'])	
						->SetCellValue('AG'.$j, $aRow['UPC'])	
						->SetCellValue('AH'.$j, $aRow['VTO'])	
						->SetCellValue('AI'.$j, $aRow['VTO_url'])	
						->SetCellValue('AJ'.$j, $aRow['lens_option'])	
						->SetCellValue('AK'.$j, $aRow['gender_man'])	
						->SetCellValue('AL'.$j, $aRow['gender_woman'])	
						->SetCellValue('AM'.$j, $aRow['b2b_option'])	
						->SetCellValue('AN'.$j, $aRow['ek_price'])	
						->SetCellValue('AO'.$j, $aRow['discount'])	
						->SetCellValue('AP'.$j, $aRow['photo']);
			
			/*Number format for Cell E*/
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			//$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
			
			/*Number format for Cell F*/
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0');
			
			$i++; $j++;
		}
		
		$exportTime = date("Y-m-d-His", time());
		$writer = new Csv($spreadsheet);
		$file = 'csv-export-data-'.$exportTime. '.csv'; //Save file name
		$writer->setUseBOM(true);
		$writer->save(public_path('excel-export/' . $file));
		$ExportFile = public_path('excel-export/' . $file);

		return response()->download($ExportFile);		
	}

    //CSV Import Demo List
    public function CSVImportDemoList()
    {
		return view('csv-import-demo-list');
    }
	
    //CSV Import Demo 1
    public function CSVImportDemo1()
    {
		return view('csv-import-demo-1');
    }
	
    //CSV Import Demo 2
    public function CSVImportDemo2()
    {
		return view('csv-import-demo-2');
    }
	
    //CSV Import Demo 3
    public function CSVImportDemo3()
    {
		return view('csv-import-demo-3');
    }
	
    //CSV Import Demo 4
    public function CSVImportDemo4()
    {
		return view('csv-import-demo-4');
    }
	
    //CSV Import Demo 5
    public function CSVImportDemo5()
    {
		return view('csv-import-demo-5');
    }
	
    //CSV Import Demo 6
    public function CSVImportDemo6()
    {
		return view('csv-import-demo-6');
    }
	
	public function CSVImportServer(Request $request){
		
		$msgList = array();
		
		$FileName = public_path('excel-import/'.$request->FileName);
	
		
		/*Import File Load*/
		$spreadsheet = IOFactory::load($FileName);

		/*Set Active Sheet Index*/
		$spreadsheet -> setActiveSheetIndex(0);
		
		/*Row and Column starting Index*/
		$maxCell = $spreadsheet -> getActiveSheet() -> getHighestRowAndColumn();
		$DataList = $spreadsheet -> getActiveSheet() -> rangeToArray('A2:' . $maxCell['column'] . $maxCell['row']);

		$Rows = collect($DataList);
		
		/*Row count*/
		// $TotalRow = count($DataList);
		$TotalRow = $Rows->count();

		if($TotalRow>0){
			
			// initiate the transaction
			DB::beginTransaction();
			
			try{
				
				//Foreach Loop
				foreach ($DataList as $key => $row) {
					// dd($row);
					
					//Excel Column Index
					$title = $row[1];
					// $slug = $row[1];
					$slug = Str::slug($row['1']).'-'.Str::random(6);
					$description = $row[2];
					$summary = $row[2];
					$price = $row[3];
					// $base_price = $row[4];
					if (empty($row[4])) {
						$base_price = 0.00;
					} else {
						$base_price = $row[4];
					}
					if (empty($row[5])) {
						$discounted_price = 0.00;
					} else {
						$discounted_price = $row[5];
					}
					if (empty($row[6])) {
						$stock = null;
					} else {
						$stock = $row[6];
					}
					$size = $row[7];
					$condition = $row[8];
					$status = $row[9];
					$is_featured = $row[10];
					$cat_id = $row[11];
					if ($row[12] === "NULL") {
						$subcat_id = NULL;
					} else {
						$subcat_id = $row[12];
					}
					if ($row[13] === "NULL") {
						$child_cat_id = NULL;
					} else {
						$child_cat_id = $row[13];
					}
					
					$brand_id = $row[14];
					$SKU = $row[15];
					if (empty($row[16])) {
						$weight = null;
					} else {
						$weight = $row[16];
					}
					if (empty($row[17])) {
						$length = null;
					} else {
						$length = $row[17];
					}
					if (empty($row[18])) {
						$height = null;
					} else {
						$height = $row[18];
					}
					if (empty($row[19])) {
						$width = null;
					} else {
						$width = $row[19];
					}
					$is_physical = $row[20];
					if (empty($row[21])) {
						$warehouse = 0;
					} else {
						$warehouse = $row[21];
					}
					
					$categoryID = $row[11];
					$main_category = Category::find($categoryID)->title;

					if (empty($row[22])) {
						$template = $main_category;
					} else {
						$template = $row[22];
					}
					$backorder = $row[23];
					if (empty($row[24])) {
						$discount_option = 1;
					} else {
						$discount_option = $row[24];
					}
					if (empty($row[25])) {
						$SPH = null;
					} else {
						$SPH = $row[25];
					}



					if (empty($row[26])) {
						$DIA = null;
					} else {
						$DIA = $row[26];
					}
					if (empty($row[27])) {
						$CYL = null;
					} else {
						$CYL = $row[27];
					}
					$CYL = $row[27];
					$AXIS = $row[28];
					$RAD = $row[29];
					$colors = $row[30];
					$ADD = $row[31];
					$UPC = $row[32];
					$VTO = $row[33];
					$VTO_url = $row[34];
					if (empty($row[35])) {
						$lens_option = 0;
					} else {
						$lens_option = $row[35];
					}
					if (empty($row[36])) {
						$gender_man = 0;
					} else {
						$gender_man = $row[36];
					}
					if (empty($row[37])) {
						$gender_woman = 0;
					} else {
						$gender_woman = $row[37];
					}
					if (empty($row[38])) {
						$b2b_option = 0;
					} else {
						$b2b_option = $row[38];
					}
					$ek_price = $row[39];
					if (empty($row[40])) {
						$discount = 0;
					} else {
						$discount = $row[40];
					}
					if (empty($row[41])) {
						$photo = ''; 
					} else {
						$photo = $row[41];
					}


					//Insert sql
					DB::table('products')->insert([
						'title' => $title, 
						'slug' => $slug,
						'description' => $description,
						'summary' => $summary,
						'price' => $price,
						'base_price' => $base_price,
						'discounted_price' => $discounted_price,
						'stock' => $stock,
						'size' => $size,
						'condition' => $condition,
						'status' => $status,
						'is_featured' => $is_featured,
						'cat_id' => $cat_id,
						'subcat_id' => $subcat_id,
						'child_cat_id' => $child_cat_id,
						'brand_id' => $brand_id,
						'SKU' => $SKU,
						'weight' => $weight,
						'length' => $length,
						'height' => $height,
						'width' => $width,
						'is_physical' => $is_physical,
						'warehouse' => $warehouse,
						'template' => $template,
						'backorder' => $backorder,
						'discount_option' => $discount_option,
						'SPH' => $SPH,
						'DIA' => $DIA,
						'CYL' => $CYL,
						'AXIS' => $AXIS,
						'RAD' => $RAD,
						'colors' => $colors,
						'ADD' => $ADD,
						'UPC' => $UPC,
						'VTO' => $VTO,
						'VTO_url' => $VTO_url,
						'lens_option' => $lens_option,
						'gender_man' => $gender_man,
						'gender_woman' => $gender_woman,
						'b2b_option' => $b2b_option,
						'ek_price' => $ek_price,
						'discount' => $discount,
						'photo' => $photo,
						
					]);				
				}
				
				DB::commit();
			
				/*Success Message*/
				$msgList["msgType"] = 'success';
				$msgList['msg'] = '<span class="done">The file uploaded successfully. </span>See the result: <a target="_blank" href="'.url('csv-imported-data-list').'">click here</a>';

			 }catch(\Exception $e){
				
				//Error Message
				$msgList["msgType"] = 'error';
				$msgList['msg'] = '<span class="red">'.$e -> getMessage().'</span>';
				
				DB::rollback();
			}
		}else{
			
			/*Error Message*/
			$msgList["msgType"] = 'error';
			$msgList['msg'] = '<span class="red">There are no data in your CSV File. Please enter data in your CSV File.</span>';
		}
		
		return response()->json($msgList);
	}

	//Comma Replace Function
	public function replaceComma($value) {

		if ($value != '0'){
			return (is_null($value) || empty($value) ? "NULL" : str_replace(',', '', $value));
		}else{
			return $value;
		}
	}



		public function CSVExportDataListUsers()
		{
			$data = User::all();
			return view('csv-export-data-users', compact('data'));
		}


		 //CSV Export
		public function CSVExportUsers()
		{
		
			$data = User::all();
			
			$spreadsheet = new Spreadsheet();
			
			/*Value Set for Cells*/
				$spreadsheet -> getActiveSheet()										
					->SetCellValue('A1', 'SL')						
					->SetCellValue('B1', 'First name')
					->SetCellValue('C1', 'Last name')							
					->SetCellValue('D1', 'Full name')							
					->SetCellValue('E1', 'Campany name')							
					->SetCellValue('F1', 'Email')							
					->SetCellValue('G1', 'Password')
					->SetCellValue('H1', 'Status')
					->SetCellValue('I1', 'Phone')
					->SetCellValue('J1', 'Address1')
					->SetCellValue('K1', 'Postcode')
					->SetCellValue('L1', 'City')
					->SetCellValue('M1', 'Country Id');
					
			$i=1; 
			$j=2;
			foreach($data as $aRow){
				/*Value Set for Cells*/
						$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow->first_name)	
						->SetCellValue('C'.$j, $aRow->last_name)																
						->SetCellValue('D'.$j, $aRow->name)																
						->SetCellValue('E'.$j, $aRow->company_name)																
						->SetCellValue('F'.$j, $aRow->email)
						->SetCellValue('F'.$j, $aRow->email)
						->SetCellValue('G'.$j, $aRow->password)
						->SetCellValue('H'.$j, $aRow->status)
						->SetCellValue('I'.$j, $aRow->phone)
						->SetCellValue('J'.$j, $aRow->address1)
						->SetCellValue('K'.$j, $aRow->post_code)
						->SetCellValue('L'.$j, $aRow->city)
						->SetCellValue('M'.$j, $aRow->country);//This cell is hide for item id's
					
				// /*Number format for Cell E*/
				// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
				// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
				
				/*Number format for Cell F*/
				// $spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				// $spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0');
				
				$i++; $j++;
			}
			
			$exportTime = date("Y-m-d-His", time());
			$writer = new Csv($spreadsheet);
			$file = 'csv-export-data-'.$exportTime. '.csv'; //Save file name
			$writer->setUseBOM(true);
			$writer->save(public_path('excel-export/' . $file));
			$ExportFile = public_path('excel-export/' . $file);
	
			return response()->download($ExportFile);		
		}
	
		public function CSVImportedData()
		{
	
			return view('csv-import-data-list');
		}
		
}
