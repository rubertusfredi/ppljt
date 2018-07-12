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


$sqlKejadian = "SELECT * FROM tb_laporan a left join tb_pegawai c on a.id_user=c.id_user , tb_detail_laporan b where a.id_laporan=b.id_laporan and b.id='".$_POST["id"]."' order by tgl_detail_created desc";
#echo $sqlKejadian;
$fgmembersite->sql($sqlKejadian);						
$resKejadian = $fgmembersite->getResult();	


#print_r($resKejadian[0]);
echo json_encode($resKejadian[0]);
#echo '{"id_laporan":"20180117083247807","id_user":"41","tgl_laporan":"2018-01-17","tgl_created":"2018-01-17 08:32:47","id_ka_shift":"48","perioda":"1","name":"Trisno Purwanto","email":"test@localhost","phone_number":"","username":"Trisno Purwanto","salt":"5d6de8a902","password":"gntiWuWu7k0rVQLSm1M985ZuF\/E1ZDZkZThhOTAy","confirmcode":"y","npp":"4626","foto":"","level_user":"2","login_hash":"PIK","cabang":"semarang","jabatan_id":"2","id":"37","tgl_detail_created":"2018-01-17 15:17:40","no_register":"GT.TEMBALANG20180117","waktu_1":"11:37:56","waktu_2":"00:00:00","waktu_3":"00:00:00","type_kejadian":"BAN","taruna_dari":"GT.TEMBALANG","jenis_kendaraan":"Truk 3\/4","nopol":"K-1908-DL","kilometer":"GT. TEMBALANG","ruas":"B\/B","uraian_kegiatan":"Truk 3\/4 kebanan, aman, penggantian","keterangan":"Lanjut jalan"}';

/*
print_r($resKejadian);
$return_arr = array();
foreach($resKejadian as $outputkejadian => $valkejadian)
{
	$return_arr["perioda"] = $valkejadian["perioda"];
}
echo json_encode($return_arr);
*/
/*
require_once("header.php");
require_once("topnav.php");
require_once("leftsidebar.php");
if (isset($_GET['mod']))
{
	$mod=$_GET['mod'];
}
else
{
	if($auth=='1')
	{
		$mod='content';
	}
	else if($auth=='2')
	{
		#$mod='dashboard';
		$mod='absensiPetugas';
	}
	else if($auth=='3')
	{		
		$mod='manager';
	}
	else if($auth=='4')
	{		
		$mod='manager';
	}
}
require_once("$mod.php");
require_once("footer.php");
*/ 