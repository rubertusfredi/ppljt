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
$tgl1 = substr($_GET["reservation"],0,8);
#echo $tgl1; 2018-02-01 06:11:32
#echo "<br>";20180422180512144-20180422180512144
$tgl2 = substr($_GET["reservation"],19,24);
#echo $tgl2;
#echo "<br>";
if (isset($_GET["reservation"]) and $_GET["reservation"]<>"")
{
	
		$sqlKejadian = "SELECT * FROM tb_sub_detail_laporan WHERE petugas='RESCUE' and id_detail_laporan between '".$tgl1."' and '".$tgl2."' order by id_sub desc";
}
else
{
		$sqlKejadian = "SELECT * FROM tb_sub_detail_laporan WHERE petugas='RESCUE' order by id_detail_laporan desc";
}
		$fgmembersite->sql($sqlKejadian);						
		$resKejadian = $fgmembersite->getResult();
		$a = 1;
		 #$dataArray = array();
		foreach($resKejadian as $outputkejadian => $valkejadian)
		{
			
			$datestr = $valkejadian["id_detail_laporan"]);
			#echo $date->format('Y-m-d');
			#$dataArray[] = $valkejadian["id"];
   # $dataArray[] = $a;
   # $dataArray[] = $fgmembersite->namahari($datestr->format('l'));
			
			#$row_array['id'] = $valkejadian["id"];
			 $row_array['no'] = $a;

			 $row_array['id_detail_laporan'] = $valkejadian["id_detail_laporan"];
			 $row_array['petugas'] = $valkejadian["petugas"];
			 $row_array['waktu_sub_1'] = $valkejadian["waktu_sub_1"];
			 $row_array['waktu_sub_2'] = $valkejadian["waktu_sub_2"];
			 $row_array['waktu_sub_3'] = $valkejadian["waktu_sub_3"];
			 $row_array['Informasi_Detail'] = '				<button type="button" class="btn bg-yellow"  >
				<a href="index.php?mod=formKejadianView&id="'.$valkejadian["id_detail_laporan"].'"&st=edit" >
				<i class="fa fa-arrow-circle-right"></i>
				</a>
				</button>';
/*

			<td class='text-center'>
				<button type="button" class="btn bg-yellow"  >
				<a href="index.php?mod=formKejadianView&id="'.$valkejadian["id_detail_laporan"].'"&st=edit" >
				<i class="fa fa-arrow-circle-right"></i>
				</a>
				</button>
				
			</td>  

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