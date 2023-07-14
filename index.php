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
		$mod='absenPetugas';
	}
	else if($auth=='3')
	{		
		$mod='manager';
	}
	else if($auth=='4')
	{		
		$mod='manager';
	}
	else if($auth=='55')
	{		
		$mod='barang';
	}	
}
require_once("$mod.php");
require_once("footer.php");
