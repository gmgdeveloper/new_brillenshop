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

class CSVExportImportUserController extends Controller
{

 

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


    public function CSVImportServer(Request $request)
    {

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
					
					//Excel Column Index
                    $first_name = $row[1];
					$last_name  = $row[2];
					$name  = $row[3];
                    $company_name = $row[4];
                    $email =  $row[5];
                    $password =  $row[6];
                    $status =  $row[7];
                    $phone =  $row[8];
                    $address1 =  $row[9];
                    $post_code =  $row[10];
                    $city =  $row[11];
                    $country =  $row[12];
					
					//Insert sql
					DB::table('users')->insert([
						'first_name' => $first_name, 
						'last_name' => $last_name,
						'name' => $name,
						'company_name' => $company_name,
						'email' => $email,
						'password' => $password,
						'status' => $status,
						'phone' => $phone,
						'city' => $city,
						'country' => $country,
						'address1' => $address1,
						'post_code' => $post_code,
                        'created_at' =>  date("Y-m-d H:i:s")
					]);				
				}
				
				DB::commit();
			
				/*Success Message*/
				$msgList["msgType"] = 'success';
				$msgList['msg'] = '<span class="done">The file uploaded successfully. </span>See the result: <a target="_blank" href="'.url('csv-export-data-users').'">click here</a>';

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



}