<?PHP
ini_set('display_errors', 1);
error_reporting(E_ALL && ~E_NOTICE);

require_once("class/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

$return_arr = array();
#$row_array = array();
#$rowtemp ="";
#echo $_GET["reservation"];
#echo "<br>";
$tgl1 = substr($_GET["reservation"],0,10);
#echo $tgl1;
#echo "<br>";
$tgl2 = substr($_GET["reservation"],13,10);
#echo $tgl2;
#echo "<br>";
if (isset($_GET["reservation"]) and $_GET["reservation"]<>"")
{
	
		$sqlKejadian = "SELECT * FROM tb_laporan a left join tb_pegawai c on a.id_user=c.id_user , tb_detail_laporan b where a.id_laporan=b.id_laporan and kamtib='DEMO' and tgl_detail_created between '".$tgl1."' and '".$tgl2."' order by tgl_detail_created desc";
}
else
{
		$sqlKejadian = "SELECT * FROM tb_laporan a left join tb_pegawai c on a.id_user=c.id_user , tb_detail_laporan b where a.id_laporan=b.id_laporan and kamtib='DEMO' order by tgl_detail_created desc";
}
		$fgmembersite->sql($sqlKejadian);						
		$resKejadian = $fgmembersite->getResult();
		$a = 1;
		 #$dataArray = array();
		foreach($resKejadian as $outputkejadian => $valkejadian)
		{
			
			$datestr = DateTime::createFromFormat('Y-m-d H:i:s', $valkejadian["tgl_detail_created"]);
			#echo $date->format('Y-m-d');
			#$dataArray[] = $valkejadian["id"];
   # $dataArray[] = $a;
   # $dataArray[] = $fgmembersite->namahari($datestr->format('l'));
			
			#$row_array['id'] = $valkejadian["id"];
			 $row_array['no'] = $a;
			 $row_array['hari'] = $fgmembersite->namahari($datestr->format('l'));
			 $row_array['tanggal'] = $datestr->format('Y-m-d');
			 $row_array['Shift'] = $valkejadian["perioda"];
			 $row_array['PIK'] = $valkejadian["name"]."(".$valkejadian["npp"].")";
			 $row_array['Kejadian'] = $valkejadian["type_kejadian"];
			 $row_array['Kamtib'] = $valkejadian["kamtib"];
			 $row_array['T1'] = $valkejadian["waktu_1"];
			 $row_array['T2'] = $valkejadian["waktu_2"];
			 $row_array['T3'] = $valkejadian["waktu_3"];
			 $row_array['T4'] = $valkejadian["waktu_4"];
			 $row_array['Taruna_Dari'] = $valkejadian["taruna_dari"];
			 $row_array['DETAIL'] = '<button type="button" class="btn bg-maroon  btn-flat" id="'.$valkejadian["id"].'" ><i class="fa fa-outdent"></i></button>';
/*
$row_array[] = $valkejadian["id"];
$row_array[] = $a;
$row_array[] = $fgmembersite->namahari($datestr->format('l'));
$row_array[] = $datestr->format('Y-m-d');
$row_array[] = $valkejadian["perioda"];
$row_array[] = $valkejadian["name"]."(".$valkejadian["npp"].")";
$row_array[] = $valkejadian["type_kejadian"];
$row_array[] = $valkejadian["kamtib"];
$row_array[] = $valkejadian["waktu_1"];
$row_array[] = $valkejadian["waktu_2"];
$row_array[] = $valkejadian["waktu_3"];
$row_array[] = $valkejadian["waktu_4"];
$row_array[] = $valkejadian["taruna_dari"];
		*/	 
			#$row_array = $valkejadian["id"].",".$a.",".$fgmembersite->namahari($datestr->format('l'));
		#$return_arr[] = $row_array;
		#$rowtemp = $rowtemp.",".$row_array;
			array_push($return_arr,$row_array);
			$a++;
		}
		#print_r($return_arr);
		$dataarray['data'] = $return_arr;
echo json_encode($dataarray);		
		//$output['aaData'][] = $row;
		#echo json_encode($return_arr);
		
		#echo "<pre>";
		#echo json_encode($row_array);
		//print_r($row_array);
		#echo "</pre>";
	
	#{"data": [[1,2,3,4,5,6,7,8,9,10,11,"maroon",13],[1,2,3,4,5,6,7,8,9,10,11,"maroon",13],[1,2,3,4,5,6,7,8,9,10,11,"maroon",13],[1,2,3,4,5,6,7,8,9,10,11,"maroon",13]]}
	
	#{"data":[{"id":"44","no":1833,"hari":"Kamis","tanggal":"2018-02-01","Shift":"1","Kejadian":"Trisno Purwanto(4624)","Kamtib":"BAN","T1":null,"T2":"12:00:03","T3":"12:00:03","T4":"00:00:00","Taruna_Dari":"00:00:00","DETAIL":"LJT213"},
	#{"id":"44","no":1833,"hari":"Kamis","tanggal":"2018-02-01","Shift":"1","Kejadian":"Trisno Purwanto(4624)","Kamtib":"BAN","T1":null,"T2":"12:00:03","T3":"12:00:03","T4":"00:00:00","Taruna_Dari":"00:00:00","DETAIL":"LJT213"}]} 
	?>