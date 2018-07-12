<?php
ini_set('display_errors', 1);
error_reporting(E_ALL && ~E_NOTICE);

require_once("class/membersite_config.php");
if((isset($_POST['mod']))and($_POST['mod']=="absenPetugas"))
{ 
	if($fgmembersite->deleteAbsenPetugas())
	{
		echo "True#Data berhasil di hapus";		
	}
	else
	{
		echo "False#Data gagal di hapus, silakan coba kembali";
	}

}

if((isset($_POST['mod']))and($_POST['mod']=="checklist"))
{ 
	if($fgmembersite->deleteChecklist())
	{
		echo "True#Data berhasil di hapus";		
	}
	else
	{
		echo "False#Data gagal di hapus, silakan coba kembali";
	}

}

if((isset($_POST['mod']))and($_POST['mod']=="timelinePetugas"))
{ 
	if($fgmembersite->deletetimelinePetugas())
	{
		echo "True#Data berhasil di hapus";		
	}
	else
	{
		echo "False#Data telah di hapus, silakan refresh halaman kembali";
	}

}




?>

