<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ExcelExport;
use App\Models\ImportedData;
use Illuminate\Support\Facades\DB;

//include PhpSpreadsheet library
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;	
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;	
use PhpOffice\PhpSpreadsheet\IOFactory;

class MultipleWorksheetController extends Controller
{
	//Data List for Multiple Worksheet Excel Export
    public function MultipleWorksheetDataList()
    {
		
		$computerdata = ExcelExport::all()->where('EItype', '=', 'computer');
		$mobiledata = ExcelExport::all()->where('EItype', '=', 'mobile');
		
		$data = array('computer' => $computerdata, 'mobile' => $mobiledata);

		return view('multiple-worksheet-export-data-list', compact('data'));
    }
	
	//Multiple Worksheet Imported Data List
    public function MultipleWorksheetImportedDataList()
    {
		
		$computerdata = ImportedData::all()->where('EItype', '=', 'computer');
		$mobiledata = ImportedData::all()->where('EItype', '=', 'mobile');
		
		$data = array('computer' => $computerdata, 'mobile' => $mobiledata);
		
		return view('multiple-worksheet-imported-data-list', compact('data'));
    }
	
    //Multiple Worksheet Excel Export
    public function MultipleWorksheetExcelExport(){
		
		$computerdata = ExcelExport::all()->where('EItype', '=', 'computer');
		$mobiledata = ExcelExport::all()->where('EItype', '=', 'mobile');
		
		$spreadsheet = new Spreadsheet();

		/*Page Setup
		Page Orientation(ORIENTATION_LANDSCAPE/ORIENTATION_PORTRAIT), 
		Paper Size(PAPERSIZE_A3,PAPERSIZE_A4,PAPERSIZE_A5,PAPERSIZE_LETTER,PAPERSIZE_LEGAL etc)*/
		$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
		
		/*Set Page Margins for a Worksheet*/
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.75);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.70);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.70);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.75);	
		
		/*Center a page horizontally/vertically*/
		$spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(false);
		$spreadsheet->getActiveSheet()->getPageSetup()->setVerticalCentered(true);

		/*Show/hide gridlines(true/false)*/
		$spreadsheet->getActiveSheet()->setShowGridlines(true);
		
		$spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);	
		
		/*====================Work Sheet Computer Accessories========================*/
		//Activate work sheet
		$spreadsheet->createSheet(0);
		$spreadsheet->setActiveSheetIndex(0);
		$spreadsheet->getActiveSheet(0);
		
		//work sheet name
		$spreadsheet->getActiveSheet()->setTitle('Computer Accessories');
		
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11); 
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		
		$spreadsheet -> getActiveSheet()->SetCellValue('A1', 'Multiple Worksheet Export');
		$spreadsheet -> getActiveSheet()->getStyle('A1')->getFont();
		$spreadsheet -> getActiveSheet()->getStyle('A1') -> applyFromArray(array('font' => array('size' => '15', 'bold' => true)), 'A1');
		$spreadsheet -> getActiveSheet()->getStyle('A1') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A1:F1');
		
		$spreadsheet -> getActiveSheet()->SetCellValue('A2', 'Computer Accessories');
		$spreadsheet -> getActiveSheet()->getStyle('A2')->getFont();
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:F2');
		
		/*Fill Color Change function for Cells*/
		$spreadsheet->getActiveSheet()->getStyle('A1:F3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d9e1ec');
		$spreadsheet->getActiveSheet()->getStyle('A4:F4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('9ab1d1');

		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()										
					->SetCellValue('A4', 'SL')							
					->SetCellValue('B4', 'Item Name')
					->SetCellValue('C4', 'Item Code')							
					->SetCellValue('D4', 'Date')							
					->SetCellValue('E4', 'Price')							
					->SetCellValue('F4', 'Quantity')
					->SetCellValue('J4', 'ItemNo');//This cell is hide for item id's
		
		/*Cell Visible True/False*/
		//This line is used for hide item id's
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setVisible(false);
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A4');	
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'B4');
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C4');
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'D4');
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E4');
		$spreadsheet -> getActiveSheet()->getStyle('F4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'F4');
		$spreadsheet -> getActiveSheet()->getStyle('J4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'F4');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('F4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('J4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('F4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('J4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('J') -> setWidth(20);
		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:A4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B4:B4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:C4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D4:D4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E4:E4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('F4:F4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('J4:J4') -> applyFromArray($styleThinBlackBorderOutline);
		
		$i=1; 
		$j=5;
		foreach($computerdata as $aRow){
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow['ItemName'])	
						->SetCellValue('C'.$j, $aRow['ItemCode'])																
						->SetCellValue('D'.$j, $aRow['Date'])																
						->SetCellValue('E'.$j, $aRow['Price'])															
						->SetCellValue('F'.$j, $aRow['Quantity'])
						->SetCellValue('J'.$j, $aRow['id']);//This cell is hide for item id's
					
			/*border color set for cells*/	
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('J' . $j . ':J' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		
			/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
			$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('D' . $j . ':D' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('E' . $j . ':E' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('F' . $j . ':F' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('J' . $j . ':J' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			
			/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('J' . $j . ':J' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
			/* Data Validation for Column E */
			$objValidation = $spreadsheet->getActiveSheet()->getCell('E' . $j)->getDataValidation();
			$objValidation->setType(DataValidation::TYPE_WHOLE);
			$objValidation->setErrorStyle(DataValidation::STYLE_STOP);
			$objValidation->setAllowBlank(true);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Only Number is permitted!');			
			
			/* Data Validation for Column F */
			$objValidation = $spreadsheet->getActiveSheet()->getCell('F' . $j)->getDataValidation();
			$objValidation->setType(DataValidation::TYPE_WHOLE);
			$objValidation->setErrorStyle(DataValidation::STYLE_STOP);
			$objValidation->setAllowBlank(true);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Only Number is permitted!');
		
			/*DateTime format for Cell D*/
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
			//$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss'); //DateTime Format	
		
			/*Number format for Cell E*/
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
			
			/*Number format for Cell F*/
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			/*Protected the Cell Range*/		
			$spreadsheet->getActiveSheet()->protectCells('J4:J'.$j, 'PHP'); 
			
			/*Unprotected the Cell Range*/
			$spreadsheet->getActiveSheet()->getStyle('A'.$j.':F'.$j)->getProtection()	
				->setLocked(Protection::PROTECTION_UNPROTECTED);
			
			$i++; $j++;
		}
		
		/*DateTime format for Cell D*/
		$spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
		//$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss'); //DateTime Format	

		/*Number format for Cell E*/
		$spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('#,##0'); 
		// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
		
		/*Number format for Cell F*/
		$spreadsheet->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$spreadsheet->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');	
		
		/*Protected the Cell Range*/
		$spreadsheet->getActiveSheet()->protectCells('A1:F4', 'PHP');	
		
		/*Unprotected the Cell Range*/
		$spreadsheet->getActiveSheet()->getStyle('A:F')->getProtection()
			->setLocked(Protection::PROTECTION_UNPROTECTED);
			
		/*Protection the Worksheet*/
		$spreadsheet->getActiveSheet()->getProtection()->setSheet(true); 

		/*====================End of Work Sheet Computer Accessories========================*/
		
		/*====================Work Sheet Mobile Accessories========================*/
		//Activate work sheet
		$spreadsheet->createSheet(1);
		$spreadsheet->setActiveSheetIndex(1);
		$spreadsheet->getActiveSheet(1);

		//work sheet name
		$spreadsheet->getActiveSheet()->setTitle('Mobile Accessories');
		
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11); 
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		
		$spreadsheet -> getActiveSheet()->SetCellValue('A1', 'Multiple Worksheet Export');
		$spreadsheet -> getActiveSheet()->getStyle('A1')->getFont();
		$spreadsheet -> getActiveSheet()->getStyle('A1') -> applyFromArray(array('font' => array('size' => '15', 'bold' => true)), 'A1');
		$spreadsheet -> getActiveSheet()->getStyle('A1') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A1:F1');
		
		$spreadsheet -> getActiveSheet()->SetCellValue('A2', 'Mobile Accessories');
		$spreadsheet -> getActiveSheet()->getStyle('A2')->getFont();
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:F2');
		
		/*Fill Color Change function for Cells*/
		$spreadsheet->getActiveSheet()->getStyle('A1:F3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d9e1ec');
		$spreadsheet->getActiveSheet()->getStyle('A4:F4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('9ab1d1');

		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()										
					->SetCellValue('A4', 'SL')							
					->SetCellValue('B4', 'Item Name')
					->SetCellValue('C4', 'Item Code')							
					->SetCellValue('D4', 'Date')							
					->SetCellValue('E4', 'Price')							
					->SetCellValue('F4', 'Quantity')
					->SetCellValue('J4', 'ItemNo');//This cell is hide for item id's
		
		/*Cell Visible True/False*/
		//This line is used for hide item id's
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setVisible(false);
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'A4');	
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'B4');
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'C4');
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'D4');
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'E4');
		$spreadsheet -> getActiveSheet()->getStyle('F4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'F4');
		$spreadsheet -> getActiveSheet()->getStyle('J4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'F4');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('F4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		$spreadsheet -> getActiveSheet()->getStyle('J4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('F4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('J4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('J') -> setWidth(20);
		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:A4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B4:B4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:C4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D4:D4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E4:E4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('F4:F4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('J4:J4') -> applyFromArray($styleThinBlackBorderOutline);
		
		$i=1; 
		$j=5;
		foreach($mobiledata as $aRow){
		
			/*Value Set for Cells*/
			$spreadsheet->getActiveSheet()
						->SetCellValue('A'.$j, $i)							
						->SetCellValue('B'.$j, $aRow['ItemName'])	
						->SetCellValue('C'.$j, $aRow['ItemCode'])																
						->SetCellValue('D'.$j, $aRow['Date'])																
						->SetCellValue('E'.$j, $aRow['Price'])															
						->SetCellValue('F'.$j, $aRow['Quantity'])
						->SetCellValue('J'.$j, $aRow['id']);//This cell is hide for item id's
					
			/*border color set for cells*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j) -> applyFromArray($styleThinBlackBorderOutline);
			$spreadsheet -> getActiveSheet() -> getStyle('J' . $j . ':J' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		
			/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
			$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('D' . $j . ':D' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
			$spreadsheet -> getActiveSheet()->getStyle('E' . $j . ':E' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('F' . $j . ':F' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			$spreadsheet -> getActiveSheet()->getStyle('J' . $j . ':J' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
			
			/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
			$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
			$spreadsheet -> getActiveSheet() -> getStyle('J' . $j . ':J' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
			/* Data Validation for Column E */
			$objValidation = $spreadsheet->getActiveSheet()->getCell('E' . $j)->getDataValidation();
			$objValidation->setType(DataValidation::TYPE_WHOLE);
			$objValidation->setErrorStyle(DataValidation::STYLE_STOP);
			$objValidation->setAllowBlank(true);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Only Number is permitted!');			
			
			/* Data Validation for Column F */
			$objValidation = $spreadsheet->getActiveSheet()->getCell('F' . $j)->getDataValidation();
			$objValidation->setType(DataValidation::TYPE_WHOLE);
			$objValidation->setErrorStyle(DataValidation::STYLE_STOP);
			$objValidation->setAllowBlank(true);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Only Number is permitted!');
		
			/*DateTime format for Cell D*/
			$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
			//$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss'); //DateTime Format	
		
			/*Number format for Cell E*/
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
			
			/*Number format for Cell F*/
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
			
			/*Protected the Cell Range*/			
			$spreadsheet->getActiveSheet()->protectCells('J4:J'.$j, 'PHP'); 
			
			/*Unprotected the Cell Range*/
			$spreadsheet->getActiveSheet()->getStyle('A'.$j.':F'.$j)->getProtection()	
				->setLocked(Protection::PROTECTION_UNPROTECTED); 		

			$i++; $j++;
		}
		
		/*DateTime format for Cell D*/
		$spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
		//$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss'); //DateTime Format	

		/*Number format for Cell E*/
		$spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('#,##0'); 
		//$spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
		
		/*Number format for Cell F*/
		$spreadsheet->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$spreadsheet->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');	
		
		/*Protected the Cell Range*/
		$spreadsheet->getActiveSheet()->protectCells('A1:F4', 'PHP');	
		
		/*Unprotected the Cell Range*/
		$spreadsheet->getActiveSheet()->getStyle('A:F')->getProtection()
			->setLocked(Protection::PROTECTION_UNPROTECTED);
		
		/*Protection the Worksheet*/
		$spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
		
		/*====================End of Work Sheet Mobile Accessories========================*/	
		
		//Activate work sheet
		$spreadsheet->setActiveSheetIndex(0);			
		
		$exportTime = date("Y-m-d-His", time());	
		$writer = new Xlsx($spreadsheet);
		$file = 'multiple-worksheet-export-'.$exportTime. '.xlsx'; //Save file name
		$writer->save(public_path('excel-export/' . $file));
		$ExportFile = public_path('excel-export/' . $file);

		return response()->download($ExportFile);		
	}
	
    //Excel Multiple Worksheet Import Demo List
    public function MultipleWorksheetImportDemoList()
    {
		return view('multiple-worksheet-excel-import');
    }
	
    //Multiple Worksheet Excel Import Demo 1
    public function MultipleWorksheetExcelImportDemo1()
    {
		return view('multiple-worksheet-excel-import-demo-1');
    }
	
    //Multiple Worksheet Excel Import Demo 2
    public function MultipleWorksheetExcelImportDemo2()
    {
		return view('multiple-worksheet-excel-import-demo-2');
    }
	
    //Multiple Worksheet Excel Import Demo 3
    public function MultipleWorksheetExcelImportDemo3()
    {
		return view('multiple-worksheet-excel-import-demo-3');
    }
	
    //Multiple Worksheet Excel Import Demo 4
    public function MultipleWorksheetExcelImportDemo4()
    {
		return view('multiple-worksheet-excel-import-demo-4');
    }
	
    //Multiple Worksheet Excel Import Demo 5
    public function MultipleWorksheetExcelImportDemo5()
    {
		return view('multiple-worksheet-excel-import-demo-5');
    }
	
    //Multiple Worksheet Excel Import Demo 6
    public function MultipleWorksheetExcelImportDemo6()
    {
		return view('multiple-worksheet-excel-import-demo-6');
    }
	
	public function MultipleWorksheetExcelImportServer(Request $request){
		
		$msgList = array();
		
		$FileName = public_path('excel-import/'.$request->FileName);
		
		// initiate the transaction
		DB::beginTransaction();
		
		try{
			
			/*=======================Start of Computer Accessories==============================*/
			/*Import File Load*/
			$spreadsheet_tab1 = IOFactory::load($FileName);

			/*Set Active Sheet Index*/
			$spreadsheet_tab1 -> setActiveSheetIndex(0);

			/*Row and Column starting Index*/
			$maxCell_tab1 = $spreadsheet_tab1 -> getActiveSheet() -> getHighestRowAndColumn();
			$DataList_tab1 = $spreadsheet_tab1 -> getActiveSheet() -> rangeToArray('A5:' . $maxCell_tab1['column'] . $maxCell_tab1['row']);
			
			//Foreach Loop
			foreach ($DataList_tab1 as $key => $row) {
				
				//Excel Column Index
				$ItemName = $row[1];
				$ItemCode = $row[2];
				$Date = date('Y-m-d',strtotime($row[3]));
				$Price = self::replaceComma($row[4]);
				$Quantity = self::replaceComma($row[5]);

				//Insert sql
				DB::table('imported_data')->insert([
					'ItemName' => $ItemName, 
					'ItemCode' => $ItemCode,
					'Date' => $Date,
					'Price' => $Price,
					'Quantity' => $Quantity,
					'EItype' => 'computer',
					'libType' => 'PhpSpreadsheet'
				]);				
			}
			
			/*=======================End of Computer Accessories==============================*/
			
			/*=======================Start of Mobile Accessories==============================*/
			/*Import File Load*/
			$spreadsheet_tab2 = IOFactory::load($FileName);

			/*Set Active Sheet Index*/
			$spreadsheet_tab2 -> setActiveSheetIndex(1);
			
			/*Row and Column starting Index*/
			$maxCell_tab2 = $spreadsheet_tab2 -> getActiveSheet() -> getHighestRowAndColumn();
			$DataList_tab2 = $spreadsheet_tab2 -> getActiveSheet() -> rangeToArray('A5:' . $maxCell_tab2['column'] . $maxCell_tab2['row']);

			//Foreach Loop
			foreach ($DataList_tab2 as $key => $row) {
				
				//Excel Column Index
				$ItemName = $row[1];
				$ItemCode = $row[2];
				$Date = date('Y-m-d',strtotime($row[3]));
				$Price = self::replaceComma($row[4]);
				$Quantity = self::replaceComma($row[5]);
				
				//Insert sql
				DB::table('imported_data')->insert([
					'ItemName' => $ItemName, 
					'ItemCode' => $ItemCode,
					'Date' => $Date,
					'Price' => $Price,
					'Quantity' => $Quantity,
					'EItype' => 'mobile',
					'libType' => 'PhpSpreadsheet'
				]);				
			}
			
			/*=======================End of Mobile Accessories==============================*/
		
			DB::commit();
		
			//Success Message
			$msgList["msgType"] = 'success';
			$msgList['msg'] = '<span class="done">The file uploaded successfully. </span>See the result: <a target="_blank" href="'.url('multiple-worksheet-imported-data-list').'">click here</a>';

		 }catch(\Exception $e){
			
			//Error Message
			$msgList["msgType"] = 'error';
			$msgList['msg'] = '<span class="red">'.$e -> getMessage().'</span>';
			
			DB::rollback();
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
}
