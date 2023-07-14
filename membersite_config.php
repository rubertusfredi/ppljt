<?PHP
date_default_timezone_set('Asia/Jakarta');
require_once("./class/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('http://119.2.50.118:8101/ppljt/');
//$fgmembersite->SetWebsiteName('http://192.168.25.101/ppljt/');
//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('psitana@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'',
                      /*database name*/'ljt',
                      /*table name*/'tb_pegawai');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('Dzziza3Nqma6yVK');

?>
