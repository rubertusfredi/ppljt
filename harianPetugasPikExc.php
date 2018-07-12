<?PHP
ini_set('display_errors', 1);
error_reporting(E_ALL && ~E_NOTICE);

require_once("class/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
$auth=$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user'];
$useridglob = $_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user'];

require_once 'class/PHPExcel.php';
$objPHPExcel = new PHPExcel();

if(isset($_GET['cari']))
{  		
	$q	="";
	if (isset($_GET['tgl'])and($_GET['tgl']<>""))
	{
		$q .="date(a.tgl_laporan) = '".$_GET['tgl']."'";
	}
	if (isset($_GET['perioda'])and($_GET['perioda']<>""))
	{
		if($q<>""){$q .= ' AND ';}
		$q .="a.perioda = '".$_GET['perioda']."'";
	}
	if($q<>""){$q = ' AND '.$q;}
	$sqlh = 'select * from tb_laporan a,tb_pegawai b where a.id_ka_shift=b.id_user  and a.id_user="'.$useridglob.'" '.$q;

}
else
{
	$sqlh = 'select * from tb_laporan a,tb_pegawai b where a.id_ka_shift=b.id_user and a.tgl_laporan="'.date("Y-m-d").'" and a.id_user="'.$useridglob.'"';
}




$fgmembersite->sql($sqlh);
$resh = $fgmembersite->getResult();
foreach($resh as $outputh)
{
	//Style
	$header_style = array(
		'font' => array(
			'bold'  => true,
			'name' => 'Tahoma',
			'color' => array('rgb' => '336699'),
			'size' => 12
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
	);
	
	$header_style2 = array(
		'font' => array(
			'bold'  => true,
			'name' => 'Tahoma',
			'color' => array('rgb' => '336699'),
			'size' => 14
		)
		
	);
	
	$center_style = array(
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
	);
	
	$styleHeaderTable = array(
		'font' => array(
			'bold'  => true,
			'name' => 'Verdana',
			'color' => array('rgb' => 'ffffff'),
			'size' => 8
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'wrap' => true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				#'color' => array('rgb' => '336699')
				'color' => array('rgb' => 'ffffff')
			)
		),
		'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					 'rgb' => '336699'
				)
			)
	);
	$styleBlank = array(		
		'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					 'rgb' => '999999'
				)
			)
	);
	$styleContentTable1 = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				#'color' => array('rgb' => '336699')
				'color' => array('rgb' => '336699')
			)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'wrap' => true
		),
	);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(5);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);	
	
	
	// Coloum table title
	$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PT. JASA MARGA ( PERSERO )')->mergeCells("A1:G1")->getStyle('A1')->applyFromArray($header_style2);	
	$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'C A B A N G    S E M A R A N G')->mergeCells("A2:G2")->getStyle('A2')->applyFromArray($header_style2);
	$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Lampiran 8.1')->mergeCells("L1:N1")->getStyle('L1')->applyFromArray($center_style);
	$objPHPExcel->getActiveSheet()->SetCellValue('L2', 'IK/PLL/01/02-SRG')->mergeCells("L2:N2")->getStyle('L2')->applyFromArray($center_style);

	$objPHPExcel->getActiveSheet()->SetCellValue('G4', 'LAPORAN HARIAN PETUGAS PIK')->mergeCells("G4:J4")->getStyle('G4')->applyFromArray($header_style);
	
	
	$objPHPExcel->getActiveSheet()->SetCellValue('L3', $outputh['tgl_laporan'])->mergeCells("L3:N3")->getStyle('L3')->applyFromArray($center_style);
	
	//Set Title
	$objPHPExcel->getActiveSheet()->setTitle($outputh['tgl_laporan']);
		
	$objPHPExcel->getActiveSheet()->SetCellValue('L4', 'PERIODE '.$outputh['perioda'].' / '.$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name'].' / '.$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['npp'].'')->mergeCells("L4:N4")->getStyle('L4')->applyFromArray($center_style);
	
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A7', 'NO')->mergeCells("A7:A8");
	$objPHPExcel->getActiveSheet()->SetCellValue('B7', 'INFO DITERIMA')->mergeCells("B7:C8");
	$objPHPExcel->getActiveSheet()->SetCellValue('D7', 'SUMBER INFORMASI')->mergeCells("D7:E8");
	$objPHPExcel->getActiveSheet()->SetCellValue('B8', ' DITERIMA')->mergeCells("B8:C8");
	$objPHPExcel->getActiveSheet()->SetCellValue('F7', 'JENIS KEJADIAN')->mergeCells("F7:G8");
	$objPHPExcel->getActiveSheet()->SetCellValue('H7', "KAMTIB")->mergeCells("H7:I8");
	$objPHPExcel->getActiveSheet()->SetCellValue('J7', "JENIS KENDARAAN")->mergeCells("J7:K8");
	$objPHPExcel->getActiveSheet()->SetCellValue('L7', 'NOPOL')->mergeCells("L7:L8");
	$objPHPExcel->getActiveSheet()->SetCellValue('M7', "KILOMETER")->mergeCells("M7:O8");
	$objPHPExcel->getActiveSheet()->SetCellValue('P7', 'CUACA')->mergeCells("P7:P8");
	$objPHPExcel->getActiveSheet()->SetCellValue('Q7', "KETERANGAN")->mergeCells("Q7:T8");
	
	for($rowstyle=7;$rowstyle<=8;$rowstyle++)
	{
		$lastColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
		$lastColumn++;
		for ($column = 'A'; $column != $lastColumn; $column++) {				
			$objPHPExcel->getActiveSheet()->getStyle($column.$rowstyle)->applyFromArray($styleHeaderTable);
		}
	}

	
	$row = 9;
	// LJT212
	$fgmembersite->select('tb_checklist_sarana','time(tgl) as t1,km_awal,km_akhir',null,'id_kendaraan="LJT212" and date(tgl)="'.$outputh['tgl_laporan'].'" and shift="'.$outputh['perioda'].'"','');
	$resLjt = $fgmembersite->getResult();					
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, '1');
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $resLjt[0]['t1']);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, '212');
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, "Observasi beat I dgn KM awal: ".$resLjt[0]['km_awal']." akhir: ".$resLjt[0]['km_akhir'])->mergeCells("F".$row.":K".$row);
	$tot = 0;
	if(($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']) >0) 
	{
		$tot=($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']);
	}	
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, 'Total : '.$tot )->mergeCells("L".$row.":N".$row);
	
	$row++;
	// LJT213
	$fgmembersite->select('tb_checklist_sarana','time(tgl) as t1,km_awal,km_akhir',null,'id_kendaraan="LJT213" and date(tgl)="'.$outputh['tgl_laporan'].'" and shift="'.$outputh['perioda'].'"','');
	$resLjt = $fgmembersite->getResult();					
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, '2');
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $resLjt[0]['t1']);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, '213');
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, "Observasi beat II dgn KM awal: ".$resLjt[0]['km_awal']." akhir: ".$resLjt[0]['km_akhir'])->mergeCells("F".$row.":K".$row);
	$tot = 0;
	if(($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']) >0) 
	{
		$tot=($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']);
	}	
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, 'Total : '.$tot )->mergeCells("L".$row.":N".$row);
	$row ++;
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, '')->mergeCells("A".$row.":N".$row)->getStyle('A'.$row)->applyFromArray($styleBlank);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(5);
	
	$row ++;
	$sqld = 'select * from tb_detail_laporan where id_laporan="'.$outputh['id_laporan'].'"';						
	$fgmembersite->sql($sqld);						
	$resd = $fgmembersite->getResult();			
	$a = 3;
	foreach($resd as $outputd)
	{
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $a++);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $outputd['waktu_1'])->mergeCells("B".$row.":C".$row);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $outputd['taruna_dari'])->mergeCells("D".$row.":E".$row);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $outputd['type_kejadian'])->mergeCells("F".$row.":G".$row);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $outputd['kamtib'])->mergeCells("H".$row.":I".$row);
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $outputd['jenis_kendaraan'])->mergeCells("J".$row.":K".$row);
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $outputd['nopol']);
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, $outputd['kilometer']);
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, $outputd['meter']);
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, $outputd['ruas']);
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, $outputd['cuaca']);
		$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, $outputd['keterangan'])->mergeCells("Q".$row.":T".$row);
		$row ++;
	}
	
	for($rowstyle=9;$rowstyle<=($row-1);$rowstyle++)
	{
		$lastColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
		$lastColumn++;
		for ($column = 'A'; $column != $lastColumn; $column++) {				
			$objPHPExcel->getActiveSheet()->getStyle($column.$rowstyle)->applyFromArray($styleContentTable1);
		}
	}
	$row ++;
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Mengetahui:')->mergeCells("A".$row.":E".$row);	
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, 'Semarang,');
	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, $outputh['tgl_laporan']);	
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($center_style);
	$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($center_style);	
	$row ++;
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'Ka.Shift Patroli' )->mergeCells("A".$row.":E".$row);	
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, 'Petugas PIK' )->mergeCells("L".$row.":N".$row);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($center_style);
	$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($center_style);
	$row = $row + 4;	
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$outputh['name'])->mergeCells("A".$row.":E".$row);	
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name'])->mergeCells("L".$row.":N".$row);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($center_style);
	$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($center_style);
	$row ++;
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $outputh['npp'] )->mergeCells("A".$row.":E".$row);	
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['npp'] )->mergeCells("L".$row.":N".$row);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($center_style);
	$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($center_style);
}
		
		
		
$objPHPExcel->getActiveSheet()
    ->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()
    ->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
	
		//Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		//Header
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		//Nama File
		header('Content-Disposition: attachment;filename="LaporanHarianPetugas'.date("Ymd").'.xlsx"');

		//Download
		$objWriter->save("php://output");

?>