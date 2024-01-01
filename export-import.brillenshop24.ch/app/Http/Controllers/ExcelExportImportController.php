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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

class ExcelExportImportController extends Controller
{

	public function ExcelExportPage()
	{
		return view('excel-export-page');
	}
	public function ExcelImportedData()
	{
	
		return view('excel-import-page');
	}

	//Data List for Excel Export
    public function ExcelExportDataList()
    {
		$data = Product::all();
		// ->where('EItype', '=', 'excel');

		return view('excel-export-data-list', compact('data'));
    }
	//Data List for Excel Export
    public function ExcelExportDataUsers()
    {
		// dd('ok');
		$data = User::all();
		return view('excel-export-data-users', compact('data'));
    }
	
	//Excel Imported Data List
    public function ExcelImportedDataList()
    {
		$data = Product::all();
		// ->where('EItype', '=', 'excel');

		return view('excel-imported-data-list', compact('data'));
    }
		//Excel Imported Data List
		public function ExcelImportedDataUsers()
		{
		
			$data = User::all();
			return view('excel-import-data-users', compact('data'));
		}
		
	
    //Excel Export
    public function ExcelExportData(){
		
		
		$data = Product::all();
		// ->where('EItype', '=', 'excel');
		
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
		
		//Activate work sheet
		$spreadsheet->createSheet(0);
		$spreadsheet->setActiveSheetIndex(0);
		$spreadsheet->getActiveSheet(0);
		
		//work sheet name
		$spreadsheet->getActiveSheet()->setTitle('Excel Export Data');
		
		/*Default Font Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		
		/*Default Font Size Set*/
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11);
		
		/*Border color*/
		$styleThinBlackBorderOutline = array('borders' => array('outline'=> array('borderStyle' => Border::BORDER_THIN, 'color' => array('argb' => '5a5a5a'))));
		$spreadsheet->getActiveSheet()->SetCellValue('A2', 'Excel Export Data');
		$spreadsheet->getActiveSheet()->getStyle('A2')->getFont();
		
		/*Font Size for Cells*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> applyFromArray(array('font' => array('size' => '14', 'bold' => true)), 'A2');
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A2') -> getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*merge Cell*/
		$spreadsheet -> getActiveSheet() -> mergeCells('A2:F2');
			
		/*Fill Color Change function for Cells*/
		$spreadsheet->getActiveSheet()->getStyle('A1:F3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d9e1ec');
		$spreadsheet->getActiveSheet()->getStyle('A4:F4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('9ab1d4');

		/*Value Set for Cells*/
		$spreadsheet -> getActiveSheet()										
					->SetCellValue('A4', 'SL')							
					->SetCellValue('B4', 'Title')
					->SetCellValue('C4', 'Description Summary')							
					->SetCellValue('D4', 'Price')							
					->SetCellValue('E4', 'Base Price')							
					->SetCellValue('F4', 'Discount Price')
					->SetCellValue('G4', ' Quantity')
					->SetCellValue('H4', ' Size')
					->SetCellValue('I4', ' Condition')
					->SetCellValue('J4', ' Status')
					->SetCellValue('K4', ' Is Featured')
					->SetCellValue('L4', ' Cat ID')
					->SetCellValue('M4', ' SubCat ID')
					->SetCellValue('N4', ' ChildCat ID')
					->SetCellValue('O4', ' Barnd ID')
					->SetCellValue('P4', ' SKU')
					->SetCellValue('Q4', ' Weight')
					->SetCellValue('R4', ' Lenght')
					->SetCellValue('S4', ' Height')
					->SetCellValue('T4', ' Width')
					->SetCellValue('U4', ' Is Physical')
					->SetCellValue('V4', ' Warehouse')
					->SetCellValue('W4', ' Template')
					->SetCellValue('X4', ' Backorder')
					->SetCellValue('Y4', ' Discount Option')
					->SetCellValue('Z4', ' SPH')
					->SetCellValue('AA4', ' DIA')
					->SetCellValue('AB4', ' CYL')
					->SetCellValue('AC4', ' AXIS')
					->SetCellValue('AD4', ' RAD')
					->SetCellValue('AE4', ' COLOR')
					->SetCellValue('AF4', ' ADD')
					->SetCellValue('AG4', ' UPC')
					->SetCellValue('AH4', ' VTO')
					->SetCellValue('AI4', ' VTO Url')
					->SetCellValue('AJ4', ' Lens Option')
					->SetCellValue('AK4', ' Gender Man')
					->SetCellValue('AL4', ' Gender Woman')
					->SetCellValue('AM4', ' B2B Option')
					->SetCellValue('AN4', ' Ek Price')
					->SetCellValue('AO4', ' Discount')
					->SetCellValue('AP4', ' Photo');




							
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
		$spreadsheet -> getActiveSheet()->getStyle('G4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'G4');
		$spreadsheet -> getActiveSheet()->getStyle('H4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'H4');
		$spreadsheet -> getActiveSheet()->getStyle('I4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'I4');
		$spreadsheet -> getActiveSheet()->getStyle('J4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'J4');
		$spreadsheet -> getActiveSheet()->getStyle('K4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'K4');
		$spreadsheet -> getActiveSheet()->getStyle('L4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'L4');
		$spreadsheet -> getActiveSheet()->getStyle('M4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'M4');
		$spreadsheet -> getActiveSheet()->getStyle('N4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'N4');
		$spreadsheet -> getActiveSheet()->getStyle('O4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'O4');
		$spreadsheet -> getActiveSheet()->getStyle('P4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'P4');
		$spreadsheet -> getActiveSheet()->getStyle('Q4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'Q4');
		$spreadsheet -> getActiveSheet()->getStyle('R4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'R4');
		$spreadsheet -> getActiveSheet()->getStyle('S4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'S4');
		$spreadsheet -> getActiveSheet()->getStyle('T4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'T4');
		$spreadsheet -> getActiveSheet()->getStyle('U4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'U4');
		$spreadsheet -> getActiveSheet()->getStyle('V4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'V4');
		$spreadsheet -> getActiveSheet()->getStyle('W4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'W4');
		$spreadsheet -> getActiveSheet()->getStyle('X4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'X4');
		$spreadsheet -> getActiveSheet()->getStyle('Y4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'Y4');
		$spreadsheet -> getActiveSheet()->getStyle('Z4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'Z4');
		$spreadsheet -> getActiveSheet()->getStyle('AA4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AA4');
		$spreadsheet -> getActiveSheet()->getStyle('AB4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AB4');
		$spreadsheet -> getActiveSheet()->getStyle('AC4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AC4');
		$spreadsheet -> getActiveSheet()->getStyle('AD4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AD4');
		$spreadsheet -> getActiveSheet()->getStyle('AE4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AE4');
		$spreadsheet -> getActiveSheet()->getStyle('AF4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AF4');
		$spreadsheet -> getActiveSheet()->getStyle('AG4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AG4');
		$spreadsheet -> getActiveSheet()->getStyle('AH4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AH4');
		$spreadsheet -> getActiveSheet()->getStyle('AI4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AI4');
		$spreadsheet -> getActiveSheet()->getStyle('AJ4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AJ4');
		$spreadsheet -> getActiveSheet()->getStyle('AK4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AK4');
		$spreadsheet -> getActiveSheet()->getStyle('AL4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AL4');
		$spreadsheet -> getActiveSheet()->getStyle('AM4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AM4');
		$spreadsheet -> getActiveSheet()->getStyle('AN4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AN4');
		$spreadsheet -> getActiveSheet()->getStyle('AO4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AO4');
		$spreadsheet -> getActiveSheet()->getStyle('AP4') -> applyFromArray(array('font' => array('size' => '12', 'bold' => true)), 'AP4');
	
		
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('D4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('E4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('F4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('G4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('H4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('I4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('J4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('K4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('L4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('M4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('N4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('O4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('P4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('Q4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('R4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('S4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('T4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('V4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('W4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('X4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('Y4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('Z4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AA4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AB4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AC4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AD4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AE4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AF4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AG4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AH4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AI4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AJ4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AK4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AL4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AM4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AN4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AO4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AP4') -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
	

		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('F4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('G4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('H4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('I4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('J4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('K4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('L4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('M4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('N4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('O4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('P4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('Q4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('R4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('S4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('T4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('U4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('V4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('W4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('X4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('Y4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('Z4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AA4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AB4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AC4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AD4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AE4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AF4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AG4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AH4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AI4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AJ4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AK4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AL4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AM4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AN4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AO4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AP4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		
		/*Width for Cells*/
		$spreadsheet -> getActiveSheet() -> getColumnDimension('A') -> setWidth(5);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('C') -> setWidth(35);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('D') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('E') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('F') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('G') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('H') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('I') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('J') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('K') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('L') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('M') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('N') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('O') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('P') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('Q') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('R') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('S') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('T') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('U') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('V') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('W') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('X') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('Y') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('Z') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AA') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AB') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AC') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AD') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AE') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AF') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AG') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AH') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AI') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AJ') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AK') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AL') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AM') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AN') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AO') -> setWidth(10);
		$spreadsheet -> getActiveSheet() -> getColumnDimension('AP') -> setWidth(10);

		
		/*Wrap text*/
		$spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
		
		/*border color set for cells*/
		$spreadsheet -> getActiveSheet() -> getStyle('A4:A4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B4:B4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C4:C4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D4:D4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E4:E4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('F4:F4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('G4:G4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('H4:H4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('I4:I4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('J4:J4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('K4:K4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('L4:L4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('M4:M4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('N4:N4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('O4:O4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('P4:P4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('Q4:Q4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('R4:R4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('S4:S4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('T4:T4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('U4:U4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('V4:V4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('W4:W4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('X4:X4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('Y4:Y4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('Z4:Z4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AA4:AA4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AB4:AB4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AC4:AC4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AD4:AD4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AE4:AE4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AF4:AF4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AG4:AG4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AH4:AH4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AI4:AI4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AJ4:AJ4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AK4:AK4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AL4:AL4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AM4:AM4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AN4:AN4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AO4:AO4') -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AP4:AP4') -> applyFromArray($styleThinBlackBorderOutline);

		// $spreadsheet -> getActiveSheet() -> getStyle('JJ4:JJ4') -> applyFromArray($styleThinBlackBorderOutline);

		$i= 1;
		$j= 5;

		foreach($data as $aRow){
			//Value Set for Cells
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
					
		/*border color set for cells*/	
		$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('G' . $j . ':G' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('H' . $j . ':H' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('I' . $j . ':I' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('J' . $j . ':J' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('K' . $j . ':K' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('L' . $j . ':L' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('M' . $j . ':M' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('N' . $j . ':N' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('O' . $j . ':O' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('P' . $j . ':P' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('Q' . $j . ':Q' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('R' . $j . ':R' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('S' . $j . ':S' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('T' . $j . ':T' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('U' . $j . ':U' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('V' . $j . ':V' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('W' . $j . ':W' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('X' . $j . ':X' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('Y' . $j . ':Y' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('Z' . $j . ':Z' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AA' . $j . ':AA' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AB' . $j . ':AB' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AC' . $j . ':AC' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AD' . $j . ':AD' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AE' . $j . ':AE' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AF' . $j . ':AF' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AG' . $j . ':AG' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AH' . $j . ':AH' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AI' . $j . ':AI' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AJ' . $j . ':AJ' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AK' . $j . ':AK' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AL' . $j . ':AL' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AM' . $j . ':AM' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AN' . $j . ':AN' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AO' . $j . ':AO' . $j) -> applyFromArray($styleThinBlackBorderOutline);
		$spreadsheet -> getActiveSheet() -> getStyle('AP' . $j . ':AP' . $j) -> applyFromArray($styleThinBlackBorderOutline);
	
		/*Text Alignment Horizontal(HORIZONTAL_LEFT,HORIZONTAL_CENTER,HORIZONTAL_RIGHT)*/
		$spreadsheet -> getActiveSheet()->getStyle('A' . $j . ':A' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$spreadsheet -> getActiveSheet()->getStyle('B' . $j . ':B' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('C' . $j . ':C' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('D' . $j . ':D' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('E' . $j . ':E' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('F' . $j . ':F' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('G' . $j . ':G' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('H' . $j . ':H' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('I' . $j . ':I' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('J' . $j . ':J' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('K' . $j . ':K' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('L' . $j . ':L' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('M' . $j . ':M' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('N' . $j . ':N' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('O' . $j . ':O' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('P' . $j . ':P' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('Q' . $j . ':Q' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('R' . $j . ':R' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('S' . $j . ':S' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('T' . $j . ':T' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('U' . $j . ':U' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('V' . $j . ':V' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('W' . $j . ':W' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('X' . $j . ':X' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('Y' . $j . ':Y' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('Z' . $j . ':Z' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AA' . $j . ':AA' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AB' . $j . ':AB' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AC' . $j . ':AC' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AD' . $j . ':AD' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AE' . $j . ':AE' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AF' . $j . ':AF' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AG' . $j . ':AG' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AH' . $j . ':AH' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AI' . $j . ':AI' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AJ' . $j . ':AJ' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AK' . $j . ':AK' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AL' . $j . ':AL' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AM' . $j . ':AM' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AN' . $j . ':AN' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AO' . $j . ':AO' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
		$spreadsheet -> getActiveSheet()->getStyle('AP' . $j . ':AP' . $j) -> getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

		
		/*Text Alignment Vertical(VERTICAL_TOP,VERTICAL_CENTER,VERTICAL_BOTTOM)*/
		$spreadsheet -> getActiveSheet() -> getStyle('A' . $j . ':A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('B' . $j . ':B' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('C' . $j . ':C' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('D' . $j . ':D' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('E' . $j . ':E' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('F' . $j . ':F' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('G' . $j . ':G' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('H' . $j . ':H' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('I' . $j . ':I' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('J' . $j . ':J' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('K' . $j . ':K' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('L' . $j . ':L' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('M' . $j . ':M' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('N' . $j . ':N' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('O' . $j . ':O' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('P' . $j . ':P' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('Q' . $j . ':Q' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('R' . $j . ':R' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('S' . $j . ':S' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('T' . $j . ':T' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('U' . $j . ':U' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('V' . $j . ':V' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('W' . $j . ':W' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('X' . $j . ':X' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('Y' . $j . ':Y' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('Z' . $j . ':Z' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AA' . $j . ':AA' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AB' . $j . ':AB' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AC' . $j . ':AC' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AD' . $j . ':AD' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AE' . $j . ':AE' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AF' . $j . ':AF' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AG' . $j . ':AG' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AH' . $j . ':AH' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AI' . $j . ':AI' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AJ' . $j . ':AJ' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AK' . $j . ':AK' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AL' . $j . ':AL' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AM' . $j . ':AM' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AN' . $j . ':AN' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AO' . $j . ':AO' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
		$spreadsheet -> getActiveSheet() -> getStyle('AP' . $j . ':AP' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		/* Data Validation for Column E */
		// $objValidation = $spreadsheet->getActiveSheet()->getCell('E' . $j)->getDataValidation();
		// $objValidation->setType(DataValidation::TYPE_WHOLE);
		// $objValidation->setErrorStyle(DataValidation::STYLE_STOP);
		// $objValidation->setAllowBlank(true);
		// $objValidation->setShowInputMessage(true);
		// $objValidation->setShowErrorMessage(true);
		// $objValidation->setErrorTitle('Input error');
		// $objValidation->setError('Only Number is permitted!');			
		
		/* Data Validation for Column F */
		// $objValidation = $spreadsheet->getActiveSheet()->getCell('F' . $j)->getDataValidation();
		// $objValidation->setType(DataValidation::TYPE_WHOLE);
		// $objValidation->setErrorStyle(DataValidation::STYLE_STOP);
		// $objValidation->setAllowBlank(true);
		// $objValidation->setShowInputMessage(true);
		// $objValidation->setShowErrorMessage(true);
		// $objValidation->setErrorTitle('Input error');
		// $objValidation->setError('Only Number is permitted!');
	
		/*DateTime format for Cell D*/
		// $spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
		//$spreadsheet->getActiveSheet()->getStyle('D'.$j)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss'); //DateTime Format	
	
		/*Number format for Cell E*/
		// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
		// $spreadsheet->getActiveSheet()->getStyle('E'.$j)->getNumberFormat()->setFormatCode('#,##0.00'); 
		
		/*Number format for Cell F*/
		// $spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		// $spreadsheet->getActiveSheet()->getStyle('F'.$j)->getNumberFormat()->setFormatCode('#,##0'); 
		  
		/*Protected the Cell Range*/			
		$spreadsheet->getActiveSheet()->protectCells('J4:J'.$j, 'PHP'); 
		
		/*Unprotected the Cell Range*/
		$spreadsheet->getActiveSheet()->getStyle('A'.$j.':F'.$j)->getProtection()	
			->setLocked(Protection::PROTECTION_UNPROTECTED);
			
			$i++; $j++;
		}
		
		/*DateTime format for Cell D*/
		// $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('yyyy-mm-dd'); //Date Format
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
		
		$exportTime = date("Y-m-d-His", time());	
		$writer = new Xlsx($spreadsheet);
		$file = 'excel-export-data-'.$exportTime. '.xlsx'; //Save file name
		$writer->save(public_path('excel-export/' . $file));
		$ExportFile = public_path('excel-export/' . $file);

		return response()->download($ExportFile);		
	}

    //Excel Import Demo List
    public function ExcelImportDemoList()
    {
		return view('excel-import-demo-list');
    }
	
    //Excel Import Demo 1
    public function ExcelImportDemo1()
    {
		return view('excel-import-demo-4');
    }
	
    //Excel Import Demo 2
    public function ExcelImportDemo2()
    {
		return view('excel-import-demo-2');
    }
	
    //Excel Import Demo 3
    public function ExcelImportDemo3()
    {
		return view('excel-import-demo-3');
    }
	
    //Excel Import Demo 4
    public function ExcelImportDemo4()
    {
		return view('excel-import-demo-4');
    }
	
    //Excel Import Demo 5
    public function ExcelImportDemo5()
    {
		return view('excel-import-demo-5');
    }
	
    //Excel Import Demo 6
    public function ExcelImportDemo6()
    {
		return view('excel-import-demo-6');
    }
	
	public function ExcelImportServer(Request $request){
		
		dd('ok here ');
		$msgList = array();
		
		$FileName = public_path('excel-import/'.$request->FileName);
		
		/*Import File Load*/
		$spreadsheet = IOFactory::load($FileName);

		/*Set Active Sheet Index*/
		$spreadsheet -> setActiveSheetIndex(0);
		
		/*Row and Column starting Index*/
		$maxCell = $spreadsheet -> getActiveSheet() -> getHighestRowAndColumn();
		$DataList = $spreadsheet -> getActiveSheet() -> rangeToArray('A5:' . $maxCell['column'] . $maxCell['row']);

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
					// $base_price = $row[4] . '.00';
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
			
				//Success Message
				$msgList["msgType"] = 'success';
				$msgList['msg'] = '<span class="done">The file uploaded successfully. </span>See the result: <a target="_blank" href="'.url('excel-imported-data-list').'">click here</a>';

			 }catch(\Exception $e){
				
				//Error Message
				$msgList["msgType"] = 'error';
				$msgList['msg'] = '<span class="red">'.$e -> getMessage().'</span>';
				
				DB::rollback();
			}
		}else{
			
			//Error Message
			$msgList["msgType"] = 'error';
			$msgList['msg'] = '<span class="red">There are no data in your Excel File. Please enter data in your Excel File.</span>';
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
