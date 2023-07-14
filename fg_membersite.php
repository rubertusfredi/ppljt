<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");
require_once("class.upload.php");

class FGMembersite
{
	private $myQuery = "";// used for debugging process with SQL return
	
    var $admin_email;
    var $from_address;
    
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
	var $idtugas;
	var $id_checklist_sarana;
	var $jenis_kendaraan;
    
    var $error_message;
    
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'ljt.jasamarga.com';
		$this->assets = 'assets2/';
        $this->rand_key = '0iQx5oBk66oVZep';
		$this->media_img = 'media/image/';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
	function SetAssets($assets)
    {
        $this->assets = $assets;
    }
	function SetMediaImage($assets)
    {
        $this->media_img = $assets;
    }    
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }
	
	

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleError("Please provide the confirm code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
		#echo $_POST['username'];
		#echo $_POST['password'];
        if(empty($_POST['username']))
        {
			
            $this->HandleError("Kolom Username belum terisi!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Kolom Password belum terisi!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
			
            return false;
        }
        
       # $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    /*
	function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
	*/
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        $_SESSION['name_of_user']  =NULL;
		$_SESSION['email_of_user'] =NULL;
			
        unset($_SESSION[$sessionvar]);
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);

    	$salt = $user_rec['salt'];
        $hash = $this->checkhashSSHA($salt, $pwd);
        
        if($user_rec['password'] != $hash)
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysqli_connect_errno());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="nobody@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
		
        if(!$this->DBLogin())
        {			
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL($username);
		$nresult = mysqli_query($this->connection,"SELECT * FROM $this->tablename WHERE username = '$username'") or die('Query failed: '
      . mysqli_error($this->connection));		
        // check for result 
        $no_of_rows = mysqli_num_rows($nresult);				
        if ($no_of_rows > 0) 
		{
			
            $nresult = mysqli_fetch_array($nresult);
            $salt = $nresult['salt'];
            $encrypted_password = $nresult['password'];
            $hash = $this->checkhashSSHA($salt, $password);
			$qry = "Select * from $this->tablename where username='$username' and password='$hash' and confirmcode='y'";
			$result = mysqli_query($this->connection,$qry);
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				$this->HandleError("Error login. Username dan password tidak cocok ! ");
				return false;
			}
			
			$row = mysqli_fetch_assoc($result);
			#$row = mysql_fetch_array($result);
			#print_r($row);
			$_SESSION[$this->GetLoginSessionVar()]["user"] = $row;
			
			$this->cekAbsenUser();
			#$_SESSION['name_of_user']  = $row['name'];
			#$_SESSION['email_of_user'] = $row['email'];
			
			#print_r($_SESSION);
			#print_r ($_SESSION[$this->GetLoginSessionVar()]['user']);
			
			return true;
        }
		else
		{
			$this->HandleError("Error. Username dan Password Salah ");
			return false;
		}


        
    }

 public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysqli_query("Select name, email from $this->tablename where confirmcode='$confirmcode'",$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['name'] = $row['name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysqli_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);

        $hash = $this->hashSSHA($newpwd);

	$new_password = $hash["encrypted"];

	$salt = $hash["salt"];
        
        $qry = "Update $this->tablename Set password='".$new_password."', salt='".$salt."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysqli_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysqli_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "There was a request to reset your password at ".$this->sitename."\r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Your password is reset successfully. ".
        "Here is your updated login:\r\n".
        "username:".$user_rec['username']."\r\n".
        "password:$new_password\r\n".
        "\r\n".
        "Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
	
	
	
    
	
	
	function namahari($nama)
	{
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
	function cekShift($tgl,$shift)
	{
		
	}
	
	function getkmAwal($idtugas)
	{
		$sqlt = 'Select * from tb_tugas where id_tugas="'.$idtugas.'"';
		#echo $sqlt;
		$this->sql($sqlt);
		$rowst = $this->numRows();
		if ($rowst > 0)
		{
			$rest = $this->getResult();
			#print_r($rest);
			$_POST["tgl"] = $rest[0]["tgl_tugas"];
			$_POST["shift"] = $rest[0]["shift"];
			$sql = 'Select * from tb_checklist_sarana where id_tugas="'.$idtugas.'"';		
			#echo $sql ;
			$this->sql($sql);
			$rows = $this->numRows();
			if ($rows > 0)
			{
				$res = $this->getResult();
				foreach($res as $out)
				{	
					if ($out["id_kendaraan"]=="LJT212")
					{
						$_POST["kmAwal212"] = $out["km_awal"];
					}
					if ($out["id_kendaraan"]=="LJT213")
					{
						$_POST["kmAwal213"] = $out["km_awal"];
					}
				}
			}
			else
			{
				$this->error_message = "Data tidak ditemukan";
				return false;
			}
		}
		else
		{
			$this->error_message = "Data tidak ditemukan";
			return false;
		}
	}
	
	function deleteChecklist()
	{
		$sql = 'Select * from tb_checklist_sarana where id_checklist_sarana="'.$_POST["id"].'"';		
		#echo $sql ;
		$this->sql($sql);
		$rows = $this->numRows();
		if ($rows > 0)
		{
			if ($this->delete("tb_checklist_sarana","id_checklist_sarana='".$_POST["id"]."'"))
			{
				#print_r($this->getSql());
				#$this->delete("tbl_tugas_detail","id_tugas='".$_POST["id"]."'");
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function getkmAkhir($idtugas)
	{
		$sqlt = 'Select * from tb_tugas where id_tugas="'.$idtugas.'"';
		#echo $sqlt;
		$this->sql($sqlt);
		$rowst = $this->numRows();
		if ($rowst > 0)
		{
			$rest = $this->getResult();
			#print_r($rest);
			$_POST["tgl"] = $rest[0]["tgl_tugas"];
			$_POST["shift"] = $rest[0]["shift"];
			$sql = 'Select * from tb_checklist_sarana where id_tugas="'.$idtugas.'"';		
			#echo $sql ;
			$this->sql($sql);
			$rows = $this->numRows();
			if ($rows > 0)
			{
				$res = $this->getResult();
				foreach($res as $out)
				{	
					if ($out["id_kendaraan"]=="LJT212")
					{
						$_POST["kmAkhir212"] = $out["km_akhir"];
					}
					if ($out["id_kendaraan"]=="LJT213")
					{
						$_POST["kmAkhir213"] = $out["km_akhir"];
					}
				}
			}
			else
			{
				$this->error_message = "Data tidak ditemukan";
				return false;
			}
		}
		else
		{
			$this->error_message = "Data tidak ditemukan";
			return false;
		}
	}
	
	function kmAwal()
	{
		#echo "<pre>";
		#print_r($_SESSION[$this->GetLoginSessionVar()]);
		#echo "</pre>";
		#echo $_SESSION[$this->GetLoginSessionVar()]["user"]["id_user"];

		if (isset($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift']) and (!empty($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'])))
		{	
			if(!isset($_POST['submitKmAwal']))
			{
			   return false;
			}
			
			#echo "<pre>";
			#print_r($_POST);
			#echo "</pre>";
			$formvars = array();
			
			
			if(!empty($_POST[$this->GetSpamTrapInputName()]) )
			{
				//The proper error is not given intentionally
				$this->HandleError("Automated submission prevention: case 2 failed");
				return false;
			}
			
			$validator = new FormValidator();
			$validator->addValidation("kmAwal212","req","input Kilometer Awal LJT212");
			$validator->addValidation("kmAwal213","req","input Kilometer Awal LJT213");

			
			if(!$validator->ValidateForm())
			{
				$error='';
				$error_hash = $validator->GetErrors();
				$error = $error_hash;
				$this->HandleErrorInput($error);
				return false;
			}
			
			if((isset($_POST['st']))and($_POST['st']=="edit"))
			{ 
				$id_tugas = $_POST['id_tugas'];
				$tgl = $_POST['tgl'];
				$shift = $_POST['shift'];
			}
			else
			{
				$id_tugas = $_SESSION[$this->GetLoginSessionVar()]["absen"]['id_tugas'];
				$tgl = $_SESSION[$this->GetLoginSessionVar()]["absen"]['tgl_tugas'];
				$shift = $_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'];
			}
			
			
			if ($_POST["kmAwal212"]<>"")
			{
				$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$shift.'" and date(tgl)="'.$tgl.'" and jenis_sarana="LJT212"';
				
				$this->sql($sqlCek2);
				
				$rowsCek2 = $this->numRows();	
				
				if ($rowsCek2==0)
				{			
					$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
					$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tgl,'shift'=>$shift,'jenis_sarana'=>'LJT212','id_kendaraan'=>'LJT212','km_awal'=>$_POST["kmAwal212"],'id_tugas'=>$id_tugas));
					//$_POST = array();			
				}
				else
				{
					$res = $this->getResult();						
					$id_checklist_sarana = $res[0]["id_checklist_sarana"];
					
					$this->update('tb_checklist_sarana',array('km_awal'=>$_POST["kmAwal212"]),'id_checklist_sarana="'.$id_checklist_sarana.'"');
					//print_r($this->getSql());
					$this->getResult();
				}
			}
			
			if ($_POST["kmAwal213"]<>"")
			{
				$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$shift.'" and date(tgl)="'.$tgl.'" and jenis_sarana="LJT213"';
				
				$this->sql($sqlCek2);
				
				$rowsCek2 = $this->numRows();	
				
				if ($rowsCek2==0)
				{			
					$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
					$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tgl,'shift'=>$shift,'jenis_sarana'=>'LJT213','id_kendaraan'=>'LJT213','km_awal'=>$_POST["kmAwal213"],'id_tugas'=>$id_tugas));
					//$_POST = array();			
				}
				else
				{
					$res = $this->getResult();						
					$id_checklist_sarana = $res[0]["id_checklist_sarana"];
					
					$this->update('tb_checklist_sarana',array('km_awal'=>$_POST["kmAwal213"]),'id_checklist_sarana="'.$id_checklist_sarana.'"');
					//print_r($this->getSql());
					$this->getResult();
				}
			}
			
			return true;
		}
		else
		{
			$this->error_message = "Hari ini anda belum absen, Silakan anda isi data absensi terlebih dahulu !";
			return false;
			
		}
	}
	
	function kmAkhir()
	{
		if (isset($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift']) and (!empty($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'])))
		{
			if(!isset($_POST['submitKmAkhir']))
			{
			   return false;
			}
			
			#echo "<pre>";
			#print_r($_POST);
			#echo "</pre>";
			$formvars = array();
			
			
			if(!empty($_POST[$this->GetSpamTrapInputName()]) )
			{
				//The proper error is not given intentionally
				$this->HandleError("Automated submission prevention: case 2 failed");
				return false;
			}
			
			$validator = new FormValidator();
			$validator->addValidation("kmAkhir212","req","input Kilometer Akhir LJT212");
			$validator->addValidation("kmAkhir213","req","input Kilometer Akhir LJT213");

			
			if(!$validator->ValidateForm())
			{
				$error='';
				$error_hash = $validator->GetErrors();
				$error = $error_hash;
				$this->HandleErrorInput($error);
				return false;
			}
			
			if((isset($_POST['st']))and($_POST['st']=="edit"))
			{ 
				$id_tugas = $_POST['id_tugas'];
				$tgl = $_POST['tgl'];
				$shift = $_POST['shift'];
			}
			else
			{
				$id_tugas = $_SESSION[$this->GetLoginSessionVar()]["absen"]['id_tugas'];
				$tgl = $_SESSION[$this->GetLoginSessionVar()]["absen"]['tgl_tugas'];
				$shift = $_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'];
			}
			
			##########################################	
			if ($_POST["kmAkhir212"]<>"")
			{
				$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$shift.'" and date(tgl)="'.$tgl.'" and jenis_sarana="LJT212"';
				
				$this->sql($sqlCek2);
				
				$rowsCek2 = $this->numRows();	
				
				if ($rowsCek2 > 0)
				{
					$res = $this->getResult();						
					$id_checklist_sarana = $res[0]["id_checklist_sarana"];
					
					$this->update('tb_checklist_sarana',array('km_akhir'=>$_POST["kmAkhir212"]),'id_checklist_sarana="'.$id_checklist_sarana.'"');
					//print_r($this->getSql());
					$this->getResult();
				}
				else
				{			
					$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
					$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tgl,'shift'=>$shift,'jenis_sarana'=>'LJT212','id_kendaraan'=>'LJT212','km_akhir'=>$_POST["kmAkhir212"],'id_tugas'=>$id_tugas));
					//$_POST = array();			
				}
			}
			
			if ($_POST["kmAkhir213"]<>"")
			{
				$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$shift.'" and date(tgl)="'.$tgl.'" and jenis_sarana="LJT213"';
				
				$this->sql($sqlCek2);
				
				$rowsCek2 = $this->numRows();	
				
				if ($rowsCek2 > 0)
				{
					$res = $this->getResult();						
					$id_checklist_sarana = $res[0]["id_checklist_sarana"];
					
					$this->update('tb_checklist_sarana',array('km_akhir'=>$_POST["kmAkhir213"]),'id_checklist_sarana="'.$id_checklist_sarana.'"');
					//print_r($this->getSql());
					$this->getResult();
				}
				else
				{			
					$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
					$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tgl,'shift'=>$shift,'jenis_sarana'=>'LJT213','id_kendaraan'=>'LJT213','km_akhir'=>$_POST["kmAkhir213"],'id_tugas'=>$id_tugas));
					//$_POST = array();			
				}
			}
			
			return true;
		}
		else
		{
			$this->error_message = "Hari ini anda belum absen, Silakan anda isi data absensi terlebih dahulu !";
			return false;
			
		}
	}
	
	function deleteAbsenPetugas()
	{
		$sql = 'Select * from tb_tugas where id_tugas="'.$_POST["id"].'"';		
		#echo $sql ;
		$this->sql($sql);
		$rows = $this->numRows();
		if ($rows > 0)
		{
			if ($this->delete("tb_tugas","id_tugas='".$_POST["id"]."'"))
			{
				#print_r($this->getSql());
				$this->delete("tbl_tugas_detail","id_tugas='".$_POST["id"]."'");
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function dataAbsensi($id)
    {
		$sql = 'Select * from tb_tugas where id_tugas="'.$id.'"';		
		#echo $sql ;
		$this->sql($sql);
		$rows = $this->numRows();
		if ($rows > 0)
		{
			$res = $this->getResult();
			#print_r($res);
			
			
			$_POST["tgl_laporan"] = $res[0]["tgl_tugas"];
			$_POST["shift"] = $res[0]["shift"];
			
			$_POST["ka_shift"] = $res[0]["id_ka_shift"];
			$_POST['pik'] = $res[0]["id_pik"];
			
			$_POST['pik_2'] = $res[0]["pik_assistant"];
			
			$petugas1 = "";
			$petugas2 = "";
			$petugas3 = "";
			$petugas4 = "";
			$petugas5 = "";
			$petugas6 = "";
			$petugas7 = "";
			
			$sqldetail = 'Select * from tbl_tugas_detail where id_tugas="'.$id.'"';		
			#echo $sqldetail ;
			$this->sql($sqldetail);
			$rowsDetail = $this->numRows();
			if ($rowsDetail > 0)
			{
				$resDetail = $this->getResult();
				foreach ($resDetail as $key => $value)
				{
					#echo $value["id_kendaraan"];
					if ($value["petugas"]=="1")
					{
						$petugas1=$value["id_user"];
						#if ($petugas1=="") { $petugas1=$value["id_user"];}
						#else{ $petugas2=$value["id_user"];}
					}
					if ($value["petugas"]=="2"){ $petugas2=$value["id_user"]; }
					if ($value["petugas"]=="3"){ $petugas3=$value["id_user"]; }
					if ($value["petugas"]=="4"){ $petugas4=$value["id_user"]; }
					if ($value["petugas"]=="5"){ $petugas5=$value["id_user"]; }
					if ($value["petugas"]=="6"){ $petugas6=$value["id_user"]; }
					if ($value["petugas"]=="7"){ $petugas7=$value["id_user"]; }
					
					if ($value["petugas"]=="8"){ $petugas8=$value["id_user"]; }
					if ($value["petugas"]=="9"){ $petugas9=$value["id_user"]; }
					if ($value["petugas"]=="10"){ $petugas10=$value["id_user"]; }
					/*
					else if ($value["bagian_tugas"]=="LJT213")
					{
						if ($petugas3=="") { $petugas3=$value["id_user"];}
						else{ $petugas4=$value["id_user"];}
					}
					else if ($value["bagian_tugas"]=="Ambulance")
					{
						if ($petugas5=="") { $petugas5=$value["id_user"];}						
					}
					else if ($value["bagian_tugas"]=="Rescue")
					{
						if ($petugas6=="") { $petugas6=$value["id_user"];}						
					}
					else if ($value["bagian_tugas"]=="Driver Ambulance")
					{
						if ($petugas7=="") { $petugas7=$value["id_user"];}						
					}
					*/
					#$this->insert('tb_detail_checklist_sarana',array('id_checklist_sarana'=>$_POST['sarana'],'id_sarana'=>$key,'volume_awal'=>$_POST['volume_awal'][$key],'kondisi_awal'=>$_POST["kondisi"][$key],'tindaklanjut'=>$_POST["tindaklanjut"][$key],'keterangan'=>$_POST["keterangan"][$key]));				
				}
				$_POST['petugas1'] = $petugas1;
				$_POST['petugas2'] = $petugas2;
				$_POST['petugas3'] = $petugas3;
				$_POST['petugas4'] = $petugas4;
				$_POST['petugas5'] = $petugas5;
				$_POST['petugas6'] = $petugas6;
				$_POST['petugas7'] = $petugas7;
				$_POST['petugas8'] = $petugas8;
				$_POST['petugas9'] = $petugas9;
				$_POST['petugas10'] = $petugas10;				
			}
			
			
			/*
			$_POST['petugas3'] = $res[0]["luka_berat"];
			$_POST['33lr'] = $res[0]["luka_ringan"];
			$_POST['33mg'] = $res[0]["meninggal"];
			$_POST['sarana'] = $res[0]["sarana"];
			
			$_POST['materi'] = $res[0]["materi_rupiah"];
			$_POST['jenis_kendaraan1'] = $res[0]["jenis_kendaraan1"];
			$_POST['jenis_kendaraan2'] = $res[0]["jenis_kendaraan2"];
			$_POST['jenis_kendaraan3'] = $res[0]["jenis_kendaraan3"];
			$_POST['jenis_kendaraan4'] = $res[0]["jenis_kendaraan4"];
			$_POST['jenis_kendaraan5'] = $res[0]["jenis_kendaraan5"];
			
			$_POST['nopol1'] = $res[0]["nopol1"];
			$_POST['nopol2'] = $res[0]["nopol2"];
			$_POST['nopol3'] = $res[0]["nopol3"];
			$_POST['nopol4'] = $res[0]["nopol4"];
			$_POST['nopol5'] = $res[0]["nopol5"];
			
			$_POST['km'] = $res[0]["kilometer"];
			$_POST['meter'] = $res[0]["meter"];
			$_POST['seksi'] = $res[0]["ruas"];
			$_POST['keterangan'] = $res[0]["keterangan"];
			*/
			#print_r($_POST);
			return true;
		}
		else
		{
			return false;
		}
			

		#echo $rows;
		
	}
	
	function AbsenPetugasPIKV2()
    {
		
			
        if(!isset($_POST['absensi']))
        {
           return false;
        }
        
		#echo "<pre>";
		#print_r($_POST);
		#echo "</pre>";
        $formvars = array();
		
        
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("shift","req","Pilih Shift Anda");
        $validator->addValidation("ka_shift","req","Pilih KA Shift");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
			$error = $error_hash;
            $this->HandleErrorInput($error);
            return false;
        }
		
		##########################################
		#$tgl = date("Y-m-d H:i:s");		
		#$this->cekShift($tgl,$_POST["shift"]);
		#date('Y-m-d', strtotime('-6 days', strtotime( variabel_tgl_awal )));
		
		/*
		$tgl = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
		$jam = $tgl->format('H');
		$jam1 = $tgl->format('H a');
		#echo $jam1;
		$tglCek = $tgl->format('Y-m-d');
		if ($_POST["shift"]=="3")
		{
			if ($jam < 6) 
			{
			  # echo "Ada";
			   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
			}
			else
			{
				#echo "masih kurang";
			}
		}
		*/
		#echo $tglCek;
		#$id_tugas = date("YmdHis").mt_rand(100,999);
		
		if((isset($_POST['st']))and($_POST['st']=="edit"))
		{
			$id_tugas = $_POST['id'];
			$this->update('tb_tugas',array('id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['pik'],'pik_assistant'=>$_POST['pik_2']),'id_tugas="'.$id_tugas.'"');
			
			#print_r($this->getSql());			
			$this->getResult();	
			
			$this->delete("tbl_tugas_detail","id_tugas='".$id_tugas."'");
		}
		else
		{
			$tgl = DateTime::createFromFormat('Y-m-d', $_POST['tgl_laporan']);		
			
			/*
			$sqlCek = 'Select * from tb_tugas where date(tgl_tugas)="'.$tgl->format('Y-m-d').'" and shift="'.$_POST["shift"].'" and id_pik="'.$_POST['pik'].'"';		
			#echo $sqlCek ;
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows > 0)
			{
				$res = $this->getResult();						
				$id_tugas = $res[0]["id_tugas"];
				#echo $id_tugas;
				
				$this->update('tb_tugas',array('id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['pik'],'pik_assistant'=>$_POST['pik_2']),'date(tgl_tugas)="'.$tgl->format('Y-m-d').'" AND shift='.$_POST['shift']);
				
				//print_r($this->getSql());
				#$this->getResult();
				#echo "update";
				$this->getResult();
				
				
				$this->delete("tbl_tugas_detail","id_tugas='".$id_tugas."'");
			}
			else
			{ */
				
				$id_tugas = date("YmdHis").mt_rand(100,999);
				$this->insert('tb_tugas',array('id_tugas'=>$id_tugas,'id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['pik'],'tgl_tugas'=>$tgl->format('Y-m-d'),'shift'=>$_POST['shift'],'pik_assistant'=>$_POST['pik_2']));
				
				$sessionvar = $this->GetLoginSessionVar();
				$_SESSION[$this->GetLoginSessionVar()]["absen"]['id_tugas'] = $id_tugas;
				$_SESSION[$this->GetLoginSessionVar()]["absen"]['tgl_tugas'] = $tgl->format('Y-m-d');
				$_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'] = $_POST['shift'];
				$_SESSION[$this->GetLoginSessionVar()]["absen"]['pik'] = $_POST['pik'];

				#echo "insert";
			
			#}
		}
		
		
		if (($_POST['petugas1']<>"")and(!empty($_POST['petugas1'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="LJT212"';
			$this->sql($sqlCek);
			#print_r($this->getSql());
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas1'],'id_kendaraan'=>'LJT212','bagian_tugas'=>'LJT212','petugas'=>'1')); 
				#print_r($this->getSql());
			}
		}
		if (($_POST['petugas2']<>"")and(!empty($_POST['petugas2'])))
		{
			
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="LJT212"';
			$this->sql($sqlCek);
			#print_r($this->getSql());
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas2'],'id_kendaraan'=>'LJT212','bagian_tugas'=>'LJT212','petugas'=>'2')); 
				#print_r($this->getSql());
			}
		}
		
		if (($_POST['petugas3']<>"")and(!empty($_POST['petugas3'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="LJT213"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas3'],'id_kendaraan'=>'LJT213','bagian_tugas'=>'LJT213','petugas'=>'3')); 
			}
		}
		if (($_POST['petugas4']<>"")and(!empty($_POST['petugas4'])))
		{
			
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="LJT213"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas4'],'id_kendaraan'=>'LJT213','bagian_tugas'=>'LJT213','petugas'=>'4')); 
			}
		}
		
		if (($_POST['petugas5']<>"")and(!empty($_POST['petugas5'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="Ambulance"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas5'],'id_kendaraan'=>'Ambulance','bagian_tugas'=>'Ambulance','petugas'=>'5')); 
			}
		}
		if (($_POST['petugas7']<>"")and(!empty($_POST['petugas7'])))
		{
			
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="Ambulance"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas7'],'id_kendaraan'=>'Ambulance','bagian_tugas'=>'Driver Ambulance','petugas'=>'7')); 
			}
		}
		
		if (($_POST['petugas6']<>"")and(!empty($_POST['petugas6'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="Rescue"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 1)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas6'],'id_kendaraan'=>'Rescue','bagian_tugas'=>'Rescue','petugas'=>'6'));
				$this->getResult();
			}
		}
		
		if (($_POST['petugas6']<>"")and(!empty($_POST['petugas8'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="PJR"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 1)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas8'],'id_kendaraan'=>'PJR','bagian_tugas'=>'PJR','petugas'=>'8'));
				$this->getResult();
			}
		}
		
		if (($_POST['petugas6']<>"")and(!empty($_POST['petugas9'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="Gajah"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas9'],'id_kendaraan'=>'Gajah','bagian_tugas'=>'Gajah','petugas'=>'9'));
				$this->getResult();
			}
		}
		
		if (($_POST['petugas6']<>"")and(!empty($_POST['petugas10'])))
		{
			$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$id_tugas.'" and id_kendaraan="Gajah"';
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows < 2)
			{
				$this->insert('tbl_tugas_detail',array('id_tugas'=>$id_tugas,'id_user'=>$_POST['petugas10'],'id_kendaraan'=>'Gajah','bagian_tugas'=>'Gajah','petugas'=>'10'));
				$this->getResult();
			}
		}
		
		
		
		##########################################	
		/*
		$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$_POST['shift'].'" and date(tgl)="'.$tglCek.'" and jenis_sarana="pik"';
		
		$this->sql($sqlCek2);
		
		$rowsCek2 = $this->numRows();	
		
		if ($rowsCek2>0)
		{			
			$resCek2 = $this->getResult();			
			$this->id_checklist_sarana  = $resCek2[0]["id_checklist_sarana"];			
		}
		else
		{			
			$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
			$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>date("Y-m-d H:i:s"),'shift'=>$_POST['shift'],'jenis_sarana'=>'pik','id_tugas'=>$id_tugas));
			//$_POST = array();
			
		}
		
		*/
		return true;
		
    }
	
	function AbsenPetugasPIK()
    {
        if(!isset($_POST['absensi']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("shift","req","Pilih Shift Anda");
        $validator->addValidation("ka_shift","req","Pilih KA Shift");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
			$error = $error_hash;
            $this->HandleErrorInput($error);
            return false;
        }
		
		##########################################
		#$tgl = date("Y-m-d H:i:s");		
		#$this->cekShift($tgl,$_POST["shift"]);
		#date('Y-m-d', strtotime('-6 days', strtotime( variabel_tgl_awal )));
		
		$tgl = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
		$jam = $tgl->format('H');
		$jam1 = $tgl->format('H a');
		#echo $jam1;
		$tglCek = $tgl->format('Y-m-d');
		if ($_POST["shift"]=="3")
		{
			if ($jam < 6) 
			{
			  # echo "Ada";
			   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
			}
			else
			{
				#echo "masih kurang";
			}
		}
		#echo $tglCek;
		#$id_tugas = date("YmdHis").mt_rand(100,999);
		
		$sqlCek = 'Select * from tb_tugas where date(tgl_tugas)="'.$tglCek.'" and shift="'.$_POST["shift"].'"';		
		
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();						
			$id_tugas = $res[0]["id_tugas"];
			
			$this->update('tb_tugas',array('id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['id_user']),'date(tgl_tugas)="'.$tglCek.'" AND shift='.$_POST['shift']);
			//print_r($this->getSql());
			$this->getResult();
		}
		else
		{
			$id_tugas = date("YmdHis").mt_rand(100,999);
			$this->insert('tb_tugas',array('id_tugas'=>$id_tugas,'id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['id_user'],'tgl_tugas'=>date("Y-m-d H:i:s"),'shift'=>$_POST['shift']));
		}
		
		##########################################	
		
		$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$_POST['shift'].'" and date(tgl)="'.$tglCek.'" and jenis_sarana="pik"';
		
		$this->sql($sqlCek2);
		
		$rowsCek2 = $this->numRows();	
		
		if ($rowsCek2>0)
		{			
			$resCek2 = $this->getResult();			
			$this->id_checklist_sarana  = $resCek2[0]["id_checklist_sarana"];			
		}
		else
		{			
			$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
			$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>date("Y-m-d H:i:s"),'shift'=>$_POST['shift'],'jenis_sarana'=>'pik','id_tugas'=>$id_tugas));
			//$_POST = array();
			
		}
		return true;
		
    }
	
	function AbsenVerifikasi($type)
    {
	    $sqlCek = 'Select count(id_tugas) as jml from tb_tugas where verifi="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}	
	
	function ChecklistPIK()
    {
		if(!isset($_POST['checklist']))
        {
           return false;
        }
		
		$formvars = array();
        
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {            
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
		
		if($_POST['checklist']=='1')
        {
			
			foreach ($_POST["kondisi"] as $key => $value)
			{
				$this->insert('tb_detail_checklist_sarana',array('id_checklist_sarana'=>$_POST['sarana'],'id_sarana'=>$key,'volume_awal'=>$_POST['volume_awal'][$key],'kondisi_awal'=>$_POST["kondisi"][$key],'tindaklanjut'=>$_POST["tindaklanjut"][$key],'keterangan'=>$_POST["keterangan"][$key]));				
			}
			
			$input = array('status'=>'2');	
			if(isset($_POST['km']))
			{
				$input = $input + array('km_awal'=>$_POST['km']);
			}
			
			$this->update('tb_checklist_sarana',$input,'id_checklist_sarana="'.$_POST['sarana'].'"');
			
		}
		else if($_POST['checklist']=='2')
        {
			foreach ($_POST["kondisi"] as $key => $value)
			{
				$this->update('tb_detail_checklist_sarana',array('volume_akhir'=>$_POST['volume_akhir'][$key],'kondisi_akhir'=>$_POST["kondisi"][$key],'tindaklanjut_akhir'=>$_POST["tindaklanjut"][$key],'keterangan_akhir'=>$_POST["keterangan"][$key]),'id="'.$key.'"');
			}			
			$input = array('status'=>'3');	
			if(isset($_POST['km']))
			{
				$input = $input + array('km_akhir'=>$_POST['km']);
			}
			
			$this->update('tb_checklist_sarana',$input,'id_checklist_sarana="'.$_POST['sarana'].'"');
		}
		else
		{
			return false;
		}
		$_POST = array();
		return true;
		
		/*
		foreach ($_POST as $key => $value)
		{
			echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";						
		}
		*/
	}
	
	function cekAbsenUser()
    { 
		
		$sessionvar = $this->GetLoginSessionVar();
		
		#echo "<pre>";
		#print_r($_SESSION);
		#echo "</pre>";
		

		
		#echo "<pre>";
		#print_r($_SESSION[$sessionvar]);
		#echo "</pre>";
	
		/*
		if (isset($_SESSION[$this->GetLoginSessionVar()]["absen"]))
		{
			echo "ada";
			return true;
		}
		else
		{
			echo "tidak ada ";
			return false;
		}
		*/
		#echo "Level user : ".$_SESSION[$sessionvar]["user"]["level_user"]."<br>";
		$tgl =date("Y-m-d");
		/*
		$h = date("H");
		$m = date("m");
		echo "<br> Jam : ".$h;
		echo "<br> minute : ".$m;
		
		if (($h >=6)and ($h <=13))
		{
			$shift = 1;
		}
		else if (($h >= 14)and ($h <= 21))
		{			
			$shift = 2;
		}
		else if (($h >= 22)and ($h < 24))
		{
			$shift = 3;
		}
		else if ($h <=5)
		{
			$shift = 3;
			#$tgl = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
			$dt = new DateTime($tgl);
			$dt->modify('-1 day');
			$tgl  = $dt->format('Y-m-d');
		}
		*/
		$sqlKaShfit = "select * from tb_tugas where tgl_tugas='".$tgl."'";
		if ($_SESSION[$sessionvar]["user"]["level_user"]=="2")
		{
			$sqlKaShfit = $sqlKaShfit ." and id_pik='".$_SESSION[$sessionvar]["user"]["id_user"]."'";
		}
		#echo $sqlKaShfit;
		$this->sql($sqlKaShfit);
		$rowsKaShfit = $this->numRows();		
		if ($rowsKaShfit>0)
		{
			$res = $this->getResult();						
			$id_tugas_absen = $res[0]["id_tugas"];
			#echo "id tugas di cek absen ".$id_tugas_absen;
			#echo "sudah absen";
			
			$sessionvar = $this->GetLoginSessionVar();
			$_SESSION[$this->GetLoginSessionVar()]["absen"]= $res[0];
			#$_SESSION[$this->GetLoginSessionVar()]["absen"]['tgl_tugas'] = $res[0]["tgl_tugas"];
			#$_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'] = $res[0]["id_tugas"];
			#$_SESSION[$this->GetLoginSessionVar()]["absen"]['pik'] = $res[0]["id_tugas"];
				
			return true;
		}
		else
		{
			#$this->error_message = "Hari ini anda belum absen, Silakan anda isi data absensi terlebih dahulu !";
			#echo $this->error_message
			echo "belum absen";
			return false;
		}
		
	}
	
	function posisiPetugas()
    {
		if (isset($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift']) and (!empty($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'])))
		{			
			if(!isset($_POST['submitted']))
			{
			   return false;
			}
			
			#print_r($_POST);
			$formvars = array();
			
			if(!empty($_POST[$this->GetSpamTrapInputName()]) )
			{
				//The proper error is not given intentionally
				$this->HandleError("Automated submission prevention: case 2 failed");
				return false;
			}
			
			$validator = new FormValidator();
			#$validator->addValidation("tgl","req","Pilih Tanggal");
			#$validator->addValidation("shift","req","Pilih Perioda");
			$validator->addValidation("petugas","req","Pilih petugas layanan");
			$validator->addValidation("waktu","req","Inputkan waktu");
			$validator->addValidation("kilometer","req","Inputkan kilometer dari posisi petugas layanan");
			$validator->addValidation("10_2","req","10_2 masih kosong");

			
			if(!$validator->ValidateForm())
			{
				$error='';
				$error_hash = $validator->GetErrors();
				$error = $error_hash;
				$this->HandleErrorInput($error);
				
				return false;
			}
			
			#$tgl = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
			#$jam = $tgl->format('H');
			#$jam1 = $tgl->format('H a');
			#echo $jam1;
			#$tglCek = $tgl->format('Y-m-d');
			/*
			$tglCek = date("Y-m-d");
			
			if ($_POST["waktu"] == "06:00-07:00") { $shift = 1; } 
			if ($_POST["waktu"] == "07:00-08:00") { $shift = 1; } 
			if ($_POST["waktu"] == "08:00-09:00") { $shift = 1; } 
			if ($_POST["waktu"] == "09:00-10:00") { $shift = 1; } 
			if ($_POST["waktu"] == "10:00-11:00") { $shift = 1; } 
			if ($_POST["waktu"] == "11:00-12:00") { $shift = 1; } 
			if ($_POST["waktu"] == "12:00-13:00") { $shift = 1; } 
			if ($_POST["waktu"] == "13:00-14:00") { $shift = 1; } 
			if ($_POST["waktu"] == "14:00-15:00") { $shift = 2; } 
			if ($_POST["waktu"] == "15:00-16:00") { $shift = 2; } 
			if ($_POST["waktu"] == "16:00-17:00") { $shift = 2; } 
			if ($_POST["waktu"] == "17:00-18:00") { $shift = 2; } 
			if ($_POST["waktu"] == "18:00-19:00") { $shift = 2; } 
			if ($_POST["waktu"] == "19:00-20:00") { $shift = 2; } 
			if ($_POST["waktu"] == "20:00-21:00") { $shift = 2; } 
			if ($_POST["waktu"] == "21:00-22:00") { $shift = 2; } 
			if ($_POST["waktu"] == "22:00-23:00") { $shift = 3; } 
			if ($_POST["waktu"] == "23:00-00:00") { $shift = 3; } 
			if ($_POST["waktu"] == "00:00-01:00") { $shift = 4; } 
			if ($_POST["waktu"] == "01:00-02:00") { $shift = 4; } 
			if ($_POST["waktu"] == "02:00-03:00") { $shift = 4; }
			if ($_POST["waktu"] == "03:00-04:00") { $shift = 4; }
			if ($_POST["waktu"] == "04:00-05:00") { $shift = 4; }
			if ($_POST["waktu"] == "05:00-06:00") { $shift = 4; }
			
			
			if ($shift == 4)
			{
				#if ($jam < 6) 
				#{
				  # echo "Ada";
				   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
				   $shift = 3;
				#}
				#else
				#{
					#echo "masih kurang";
				#}
				
			}
			
			#echo 'Select * from tb_tugas where date(tgl_tugas)="'.$tglCek.'" and shift="'.$shift .'"';
			$sqlCek = 'Select * from tb_tugas where date(tgl_tugas)="'.$tglCek.'" and shift="'.$shift .'"';		
			
			
			$this->sql($sqlCek);
			$rows = $this->numRows();		
			if ($rows>0)
			{
				
				$res = $this->getResult();						
				*/
				$id_tugas = $_SESSION[$this->GetLoginSessionVar()]["absen"]['id_tugas'];
				
				#echo $id_tugas;
				#$this->update('tb_tugas',array('id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['id_user']),'date(tgl_tugas)="'.$tglCek.'" AND shift='.$_POST['shift']);
				//print_r($this->getSql());
				#$this->getResult();
				
				if((isset($_POST['st']))and($_POST['st']=="edit"))
				{
					#$id_tugas = $_POST['id'];
					$this->update('tb_petugas_posisi',array('petugas'=>$_POST['petugas'],'waktu'=>$_POST['waktu'],'kilometer'=>$_POST['kilometer']),'id="'.$id.'"');
					
					#print_r($this->getSql());			
					$this->getResult();	
					
					#$this->delete("tbl_tugas_detail","id_tugas='".$id_tugas."'");
				}
				else
				{
					$input = array('id_tugas'=>$_SESSION[$this->GetLoginSessionVar()]["absen"]['id_tugas'],'petugas'=>$_POST['petugas'],'waktu'=>$_POST['waktu'],'kilometer'=>$_POST['kilometer'],'10_2'=>$_POST['10_2'],'respon'=>$_POST['respon'],'keterangan'=>$_POST['keterangan']);
					if ($this->insert('tb_petugas_posisi',$input))
					{
						$_POST = array();
						return true;
					}
					else
					{
						$this->error_message = "Maaf database error";				
						return false;
					}
				}
			
			/*
			}
			else
			{
				#$id_tugas = date("YmdHis").mt_rand(100,999);
				#$this->insert('tb_tugas',array('id_tugas'=>$id_tugas,'tgl_tugas'=>date("Y-m-d H:i:s"),'shift'=>$_POST['shift']));
				$this->error_message = "Maaf anda tidak terdaftar di absensi pada perioda yang anda pilih";
				#echo $this->error_message;
				return false;
			}
			*/
			
			
		}
		else
		{
			$this->error_message = "Hari ini anda belum absen, Silakan anda isi data absensi terlebih dahulu !";
			return false;
			
		}
	}
	
	function posisiPetugasId($id)
    {
		$sql = 'Select * from tb_petugas_posisi where id="'.$id.'"';		
		#echo $sql ;
		$this->sql($sql);
		$rows = $this->numRows();
		if ($rows > 0)
		{
			$res = $this->getResult();
			#print_r($res);
			
			
			$_POST["petugas"] = $res[0]["petugas"];
			$_POST["waktu"] = $res[0]["waktu"];
			
			$_POST["kilometer"] = $res[0]["kilometer"];
			$_POST['10_2'] = $res[0]["10_2"];
			
			$_POST['keterangan'] = $res[0]["keterangan"];
			
			
			
			#print_r($_POST);
			return true;
		}
		else
		{
			return false;
		}
			

		#echo $rows;
		
	}
	
	function deletetimelinePetugas()
	{
		$sql = 'Select * from tb_petugas_posisi where id="'.$_POST["id"].'"';		
		#echo $sql ;
		$this->sql($sql);
		$rows = $this->numRows();
		if ($rows > 0)
		{
			if ($this->delete("tb_petugas_posisi","id='".$_POST["id"]."'"))
			{
				#print_r($this->getSql());
				#$this->delete("tbl_tugas_detail","id_tugas='".$_POST["id"]."'");
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}




	
	function laporanKegiatan()
    {
		if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("tgl","req","Pilih Tanggal");
        $validator->addValidation("shift","req","Pilih Perioda");
		$validator->addValidation("keterangan","req","Kegiatan belum terisi");
        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
			$error = $error_hash;
            $this->HandleErrorInput($error);
			
            return false;
        }
		
		/*
		$sqlCek = 'Select * from tb_tugas where date(tgl_tugas)="'.$_POST['tgl'].'" and shift="'.$_POST["shift"].'"';		
		
		
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();						
			$id_tugas = $res[0]["id_tugas"];
			
			#$this->update('tb_tugas',array('id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['id_user']),'date(tgl_tugas)="'.$tglCek.'" AND shift='.$_POST['shift']);
			//print_r($this->getSql());
			#$this->getResult();
		}
		else
		{
			$id_tugas = date("YmdHis").mt_rand(100,999);
			$this->insert('tb_tugas',array('id_tugas'=>$id_tugas,'tgl_tugas'=>date("Y-m-d H:i:s"),'shift'=>$_POST['shift']));
		}*/
		
		$input = array('tgl_created'=>date("Y-m-d H:i:s"),'tgl_laporan_kegiatan'=>$_POST['tgl'],'id_user'=>$_SESSION[$this->GetLoginSessionVar()]['user']['id_user'],'perioda'=>$_POST['shift'],'kegiatan'=>$_POST['keterangan'],'petugas'=>$_SESSION[$this->GetLoginSessionVar()]['user']['login_hash']);
		$this->insert('tb_laporan_kegiatan',$input);
		
		$_POST = array();
		return true;
		
	}
	
	
	function ChecklistAwal()
    { 
		$id_checklist_sarana = date("YmdHis").mt_rand(100,999);		
		
		$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$id_checklist_sarana,'tgl'=>date("Y-m-d H:i:s"),'id_kendaraan'=>$_POST['id_kendaraan'],'km_awal'=>$_POST['km']));
		
		$this->update('tb_tugas',array('id_checklist_sarana'=>$id_checklist_sarana),'id_tugas='.$_POST['idtugas']);
		
		foreach ($_POST["kondisi"] as $key => $value)
		{
			$this->insert('tb_detail_checklist_sarana',array('id_checklist_sarana'=>$id_checklist_sarana,'id_sarana'=>$key,'kondisi_awal'=>$_POST["kondisi"][$key],'keterangan'=>$_POST["keterangan"][$key]));
			#print "The name is ".$keya." and email is ".$_POST["kondisi"][$keya].", thank you<br>";
		}
		$_POST = array();
		return true;
		/*
		foreach ($_POST as $key => $value)
		{
			#$this->insert('tb_detail_checklist_sarana',array('id_checklist_sarana'=>$id_checklist_sarana,'id_sarana'=>$key,'kondisi_awal'=>$_POST["kondisi"][$key]));
			
			echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
			/*
			if (is_array($key))
			{
				count($key);
			}
			
		}
		/*echo "Adadfdf";
		foreach ($_POST["kondisi"] as $keya => $n)
		{
			print "The name is ".$keya." and email is ".$_POST["kondisi"][$keya].", thank you<br>";
		}
		if (is_array($_POST["kondisi"]))
		{
			echo "ada".count($_POST["kondisi"]);
		}*/
		
	}
	
	function typeKejadian($type)
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
	
	function typeKamtib($type)
    {
		$sqlCek = 'Select count(kamtib) as jml from tb_detail_laporan where kamtib="'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}

	function TingkatFatalitas($type) 
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'"
		and meninggal >=1	
		and luka_berat >=1		
		and MONTH (tgl_detail_created)= MONTH (CURRENT_DATE ())
		and YEAR  (tgl_detail_created)= YEAR  (CURRENT_DATE ()) ';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
	
	function TingkatKecelakaan($type) 
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'"
		and meninggal >=1	
		and luka_berat >=1		
		and MONTH (tgl_detail_created)= MONTH (CURRENT_DATE ())
		and YEAR  (tgl_detail_created)= YEAR  (CURRENT_DATE ()) ';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}

	function typeGangguanPerjalanan($type) 
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'"
		and luka_berat =0
		and luka_ringan =0
		and meninggal =0
		and materi_rupiah =0
		and MONTH (tgl_detail_created)= MONTH (CURRENT_DATE ())
		and YEAR  (tgl_detail_created)= YEAR  (CURRENT_DATE ()) ';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
	


	function typeKecelakaanMateri($type) 
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'" 
		and luka_berat =0
		and luka_ringan =0
		and meninggal =0
		and materi_rupiah >= 1
		and MONTH (tgl_detail_created)= MONTH (CURRENT_DATE ())
		and YEAR  (tgl_detail_created)= YEAR  (CURRENT_DATE ()) ';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}

	function typeKecelakaanKorban($type) 
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'" 
		and luka_berat >= 0
		and luka_ringan >= 1
		and meninggal = 0
		and materi_rupiah = 0
		and MONTH (tgl_detail_created)= MONTH (CURRENT_DATE ())
		and YEAR  (tgl_detail_created)= YEAR  (CURRENT_DATE ()) ';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}

	function typeKorbanMeninggalDuania($type) 
    {
		$sqlCek = 'Select count(type_kejadian) as jml from tb_detail_laporan where type_kejadian="'.$type.'" 
		and luka_berat >= 0
		and luka_ringan >= 0
		and meninggal >= 1
		and materi_rupiah >= 0
		and MONTH (tgl_detail_created)= MONTH (CURRENT_DATE ())
		and YEAR  (tgl_detail_created)= YEAR  (CURRENT_DATE ()) ';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}


	
	function respond($type)
    {
		$sqlCek = 'Select count(taruna_dari) as jml from tb_detail_laporan where taruna_dari="'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
	

	function LaporTelpon($type)
    {
		$sqlCek = 'Select count(keperluan) as jml from tb_detail_laporan where keperluan="'.$type.'" and taruna_dari like "TELPON%"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
    # Fungsi menghitung jumlah telepon masuk berdasarkan keperluan ;
	function JumlahLaporTelpon($type)
    {
		$sqlCek = 'Select count(taruna_dari) as jml from tb_detail_laporan where keperluan like "'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}	

    # Fungsi menghitung prosentase telepon masuk ;
	function ProsentaseTelpon($type)
    {
		$sqlCek = 'Select round ((count(taruna_dari)/(Select count(*) FROM tb_detail_laporan))*100,2) as jml from tb_detail_laporan where keperluan like "'.$type.'" and taruna_dari like "TELPON%"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();	
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
	
	function respondTerlibat($type)
    {
		$sqlCek = 'Select count(petugas) as jml from tb_sub_detail_laporan where petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}

	function respondTerlibatSelisih($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}	
	
	
	function respondTerlibatSelisihRata($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60/3);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}	

	function respondTerlibatSelisihJan($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180101000000000" and id_detail_laporan <="20180131990000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}	
	
	function respondTerlibatSelisihFeb($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180201000000000" and id_detail_laporan <="20180231000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}	
	


	function respondTerlibatSelisihMar($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180301000000000" and id_detail_laporan <="20180331990000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}	



	function respondTerlibatSelisihApr($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180401000000000" and id_detail_laporan <="20180431990000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}		

	function respondTerlibatSelisihMei($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180501000000000" and id_detail_laporan <="20180531000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}

	function respondTerlibatSelisihJun($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180601000000000" and id_detail_laporan <="20180631000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}

	function respondTerlibatSelisihJul($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180701000000000" and id_detail_laporan <="20180731000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}

	function respondTerlibatSelisihAgs($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180801000000000" and id_detail_laporan <="20180831000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}

	function respondTerlibatSelisihSep($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20180901000000000" and id_detail_laporan <="20180931000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}
	
	function respondTerlibatSelisihOkt($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20181001000000000" and id_detail_laporan <="20181031000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}	

	function respondTerlibatSelisihNov($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20181101000000000" and id_detail_laporan <="20181131000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}

	function respondTerlibatSelisihDes($type)
    {
		$sqlCek = 'Select * from tb_sub_detail_laporan where id_detail_laporan >= "20181201000000000" and id_detail_laporan <="20181231000000000" and petugas="'.$type.'"';
		#echo $sqlCek;
		$this->sql($sqlCek);
		
		$rows = $this->numRows();	
		if ($rows>0)
		{
			$res = $this->getResult();

			#$fgmembersite->sql($sqlh);
			#$resh = $fgmembersite->getResult();					
			#$a=1;
			#$time = '21:30:10';
			#$seconds = strtotime("1970-01-01 $time");
			#echo $seconds;
			
			$a=1;
			$tots = 0;
			#echo "<table width='100%' border=1>";
			foreach($res as $outputh)
			{
				#echo "<tr><td>".$outputh["waktu_sub_1"]."<td><td>".$outputh["waktu_sub_2"]."<td>";
				$awal  = date_create('2017-01-20 '.$outputh["waktu_sub_1"]);
				$akhir = date_create('2017-01-20 '.$outputh["waktu_sub_2"]); // waktu sekarang, pukul 06:13
				//00:00:00
				if(substr($outputh["waktu_sub_2"],0,2)=="00")
				{
					$h = substr($outputh["waktu_sub_2"],0,2);
					$i = substr($outputh["waktu_sub_2"],3,2);
					$s = substr($outputh["waktu_sub_2"],6,2);
					
					$akhir = date_create("2017-01-20 24:".$i.":".$s); // waktu sekarang, pukul 06:13
					#echo "24:".$i.":".$s;
				}
				
				if ($awal > $akhir )
				{
					#echo "<td>0:0:0<td>";
					$s = 0;
				}
				else
				{
					$diff  = date_diff( $akhir, $awal );
					#echo "<td>".$diff->h.":".$diff->i.":".$diff->s."<td>";
					$s = ($diff->h * 3600)+($diff->i * 60)+($diff->s);
					
				}
				$tots = $tots + $s;
				#echo "<td>".$s."<td>";
				#echo "<td>".$a."<td>";
				#echo "</tr>";
				$a++;
				
			}
			#echo "</table>";
			$pembagi =  $this->respondTerlibat($type);
			#echo $tots;
			#echo "<br>";
			#echo "<br>";
			
			$avg = $tots / $pembagi;
			#echo "<br>";
			#echo "Pembagi".$pembagi;
			#echo "<br>";
			
			#echo $avg;
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			#echo "<br>";
			$h = floor($avg / 3600);
			$mi = floor($avg % 3600);
			#echo $mi;
			#echo "<br>";
			$m = floor($mi / 60);
			$s = $mi % 60;
			
			/*
			$m = floor($avg / 60);
			if ($m >= 60 )
			{
				$h = floor($m / 60);
				$m = floor($h % 60);
				$s = $m % 60;
			}
			else
			{
				$h = floor($m / 60);
				$s = $avg % 60;
			}
			*/
			#echo $h.":".$m.":".$s;
			#echo "<br>";
			#echo "<br>";
			if (strlen($h)<2){$h = "0".$h;}
			if (strlen($m)<2){$m = "0".$m;}
			if (strlen($i)<2){$i = "0".$i;}
			#$datetime = DateTime::createFromFormat('H:i:s',$h.':'.$m.':'.$s);
			#$datetime = mktime($h, $m, $s, 0, 0, 0);
			return $h.":".$m.":".$s;
			#return date("h:i:s",$datetime);
			#$jml = $res[0]["jml"];
			
			#echo $jml;
			
			/*
			$awal  = date_create('2017-01-20 01:05:25');
			$akhir = date_create(); // waktu sekarang, pukul 06:13
			$diff  = date_diff( $akhir, $awal );
			echo $diff->h; // Hasil: 5
			*/

		}
		else
		{
			$jml =0 ;
		}
		#return $jml;
	}

	# Valiasi Absensi
	function ValidasiAbsensi($type)
    {
		$sqlCek = 'Select count(valid) as jml from tbl_tugas_detail where valid="'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}	
	
	# Valiasi Laporan
	function ValidasiLaporan($type)
    {
		$sqlCek = 'Select count(valid) as jml from tb_detail_laporan where valid="'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}	

	# Valiasi Posisi
	function ValidasiPosisi($type)
    {
		$sqlCek = 'Select count(valid) as jml from tb_petugas_posisi where valid="'.$type.'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$jml = $res[0]["jml"];
		}
		else
		{
			$jml =0 ;
		}
		return $jml;
	}
	
	function selisihTime($time1,$time2)
	{
		#$time1 = "10:00:00";
		#$time2 = "10:25:00";
		$time1 = DateTime::createFromFormat('H:i:s', $time1);
		$time2 = DateTime::createFromFormat('H:i:s', $time2);
		$diff = date_diff($time1, $time2);
		#echo $diff->format('%h:%i:%s') . ' jam, ';
		#echo $diff->i . ' menit, ';
		#echo $diff->s . ' detik, ';
		
		$temptime = $diff->h.":".$diff->i.":".$diff->s;
		#echo $temptime ;
		return $temptime;
		
	}
	
	function resetTimer()
    {
		$_POST['waktu1'] = "00:00:00";
		$_POST['waktu2'] = "00:00:00";
		$_POST['waktu3'] = "00:00:00";
		$_POST['waktu4'] = "00:00:00";		
		
		$_POST['t1'] = "00:00:00";
		$_POST['t2'] = "00:00:00";
		$_POST['t3'] = "00:00:00";		
		
		/*
		$_POST['waktu1_ljt212'] = "00:00:00";
		$_POST['waktu2_ljt212'] = "00:00:00";
		$_POST['waktu3_ljt212'] = "00:00:00";
		$_POST['waktu4_ljt212'] = "00:00:00";
		
		$_POST['waktu1_ljt213'] = "00:00:00";
		$_POST['waktu2_ljt213'] = "00:00:00";
		$_POST['waktu3_ljt213'] = "00:00:00";
		$_POST['waktu4_ljt213'] = "00:00:00";
		
		$_POST['waktu1_amb'] = "00:00:00";
		$_POST['waktu2_amb'] = "00:00:00";
		$_POST['waktu3_amb'] = "00:00:00";
		
		$_POST['waktu1_res'] = "00:00:00";
		$_POST['waktu2_res'] = "00:00:00";
		$_POST['waktu3_res'] = "00:00:00";
		
		$_POST['waktu1_der'] = "00:00:00";
		$_POST['waktu2_der'] = "00:00:00";
		$_POST['waktu3_der'] = "00:00:00";
		
		$_POST['waktu1_pjr'] = "00:00:00";
		$_POST['waktu2_pjr'] = "00:00:00";
		$_POST['waktu3_pjr'] = "00:00:00";
		*/
	}
	
	function EditdataKejadian($id)
    {
		$sql = 'Select * from tb_detail_laporan where id="'.$id.'"';		
		$this->sql($sql);
		$rows = $this->numRows();
		if ($rows > 0)
		{
			$res = $this->getResult();
						
			$this->resetTimer();
				
			$_POST['waktu1'] = $res[0]["waktu_1"];
					
			
			$_POST["taruna_dari"] = $res[0]["taruna_dari"];
			$_POST["jenis_kejadian"] = $res[0]["type_kejadian"];
			$_POST["kamtib"] = $res[0]["kamtib"];
			$_POST['waktu'] = $res[0]["waktu_info_diterima"];
			$_POST['keperluan'] = $res[0]["keperluan"];
			$_POST['cuaca'] = $res[0]["cuaca"];
			
			$_POST['jenis_kendaraan'] = $res[0]["jenis_kendaraan"];
			$_POST['nopol'] = $res[0]["nopol"];
			$_POST['33lb'] = $res[0]["luka_berat"];
			$_POST['33lr'] = $res[0]["luka_ringan"];
			$_POST['33mg'] = $res[0]["meninggal"];
			$_POST['sarana'] = $res[0]["sarana"];
			
			
			$_POST['materi'] = $res[0]["materi_rupiah"];
			$_POST['jenis_kendaraan1'] = $res[0]["jenis_kendaraan1"];
			$_POST['jenis_kendaraan2'] = $res[0]["jenis_kendaraan2"];
			$_POST['jenis_kendaraan3'] = $res[0]["jenis_kendaraan3"];
			$_POST['jenis_kendaraan4'] = $res[0]["jenis_kendaraan4"];
			$_POST['jenis_kendaraan5'] = $res[0]["jenis_kendaraan5"];
			
			$_POST['nopol1'] = $res[0]["nopol1"];
			$_POST['nopol2'] = $res[0]["nopol2"];
			$_POST['nopol3'] = $res[0]["nopol3"];
			$_POST['nopol4'] = $res[0]["nopol4"];
			$_POST['nopol5'] = $res[0]["nopol5"];
			
			$_POST['km'] = $res[0]["kilometer"];
			$_POST['meter'] = $res[0]["meter"];
			$_POST['seksi'] = $res[0]["ruas"];
			$_POST['keterangan'] = $res[0]["keterangan"];
			
			$sqlsub = 'Select * from tb_sub_detail_laporan where id_detail_laporan="'.$id.'"';		
			#echo $sqlsub;
			$this->sql($sqlsub);
			$rowssub = $this->numRows();
			if ($rowssub > 0)
			{
				$ressub = $this->getResult();
				$a = 0;
				foreach($ressub as $outputd)
				{
					#echo $outputd['waktu_sub_1'];
					$_POST['petugas'][$a] = $outputd['petugas'];
					$_POST['t1table'][$a] = $outputd['waktu_sub_1'];
					echo $_POST['t1'][$a];
					$_POST['t2table'][$a] = $outputd['waktu_sub_2'];
					$_POST['t3table'][$a] = $outputd['waktu_sub_3'];
					
					$a++;
				}
			}
			
			
		}
			

		#echo $rows;
	}
	
	function LaporanPIKV2()
    {
		#echo "<pre>";
		#print_r($_SESSION[$this->GetLoginSessionVar()]);
		#echo "</pre>";
		
		if (isset($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift']) and (!empty($_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'])))
		{
			$this->error_message = "";
			if(!isset($_POST['submitted']))
			{
			   return false;
			}
			
			$formvars = array();
			
			if(!empty($_POST[$this->GetSpamTrapInputName()]) )
			{
				//The proper error is not given intentionally
				$this->HandleError("Automated submission prevention: case 2 failed");
				return false;
			}
		   
			#echo "<pre>";
			#print_r($_POST);
			#echo "</pre>";
			 
			 
			$validator = new FormValidator();
			$validator->addValidation("taruna_dari","req","Inputan Sumber Info belum diinputkan");
			#$validator->addValidation("jenis_kejadian","req","Jenis Kejadian belum diinputkan");
			#$validator->addValidation("keterangan","req","Kegiatan belum terisi");
			
			#if ($_POST["jenis_kejadian"]=="KANTIB")
			#{
			#	$validator->addValidation("kamtib","req","Form Inputan KAMTIB belum terisi");
			#}
			
			if(!$validator->ValidateForm())
			{
				$error='';
				$error_hash = $validator->GetErrors();
				$error = $error_hash;
				$this->HandleErrorInput($error);
				
				return false;
			}
			
			
			#$tglCek = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
			#$jam = $tgl->format('H');
			#$jam1 = $tgl->format('H a');
			#$t=time();
			#echo $t;
			$tgl =date("Y-m-d");
			$h = date("H");
			$m = date("m");
			#echo "<br> Jam : ".$h;
			#echo "<br> minute : ".$m;
			
			if (($h >=6)and ($h <=13))
			{
				$shift = 1;
			}
			else if (($h >= 14)and ($h <= 21))
			{			
				$shift = 2;
			}
			else if (($h >= 22)and ($h < 24))
			{
				$shift = 3;
			}
			else if ($h <=5)
			{
				$shift = 3;
				#$tgl = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
				$dt = new DateTime($tgl);
				$dt->modify('-1 day');
				$tgl  = $dt->format('Y-m-d');
			}
			#echo "<br> Shift : ".$shift;
			#echo "<br> Tgl : ".$tgl;
			#$tglCek = $tgl->format('Y-m-d');
			
			/*
			if ($_POST["shift"]=="3")
			{
				if ($jam < 6) 
				{
				  # echo "Ada";
				   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
				}
				else
				{
					#echo "masih kurang";
				}
			}
			*/
			
			
			$tgl = $_SESSION[$this->GetLoginSessionVar()]["absen"]['tgl_tugas'];
			$shift = $_SESSION[$this->GetLoginSessionVar()]["absen"]['shift'];
			
			$sqlKaShfit = "select * from tb_tugas where tgl_tugas='".$tgl."' and shift='".$shift."'";
			#echo $sqlKaShfit;
			$this->sql($sqlKaShfit);
			$rowsKaShfit = $this->numRows();		
			if (($rowsKaShfit>0)or(isset($_POST['st'])))
			{
				$resKaShift = $this->getResult();
				#echo "<pre>";
				#print_r($resKaShift);
				#echo "</pre>";
				
				$id_ka_shift = $resKaShift[0]["id_ka_shift"];
				
				if(!isset($_POST['st']))
				{
					$sqlCek = 'Select * from tb_laporan where tgl_laporan="'.$tgl.'" and perioda="'.$shift.'" and id_user="'.$_POST['id_user'].'"';
				
					$this->sql($sqlCek);
					$rows = $this->numRows();		
					if ($rows>0)
					{
						$res = $this->getResult();			
						$id_laporan = $res[0]["id_laporan"];
					}
					else
					{
						$id_laporan = date("YmdHis").mt_rand(100,999);
						$this->insert('tb_laporan',array('id_laporan'=>$id_laporan,'id_user'=>$_POST['id_user'],'tgl_laporan'=>$tgl,'tgl_created'=>date("Y-m-d H:i:s"),'id_ka_shift'=>$id_ka_shift ,'perioda'=>$shift));
					}
				}
				
				$noregister = date("YmdHis");
				
				$input = array();
				
				if(!isset($_POST['st']))
				{ 
					$input = array('id_laporan'=>$id_laporan,'tgl_detail_created'=>date("Y-m-d H:i:s"),'no_register'=>$_POST['taruna_dari'].$noregister);
				}
				
				$input = $input + array('waktu_1'=>$_POST['waktu1']);
				/*$input = $input + array('waktu_2'=>$_POST['waktu2']);
				$input = $input + array('waktu_3'=>$_POST['waktu3']);
				$input = $input + array('waktu_4'=>$_POST['waktu4']);
				*/
				/*
				if ($_POST['taruna_dari']=="LJT212")
				{
					$input = $input + array('waktu_1'=>$_POST['waktu1_ljt212']);
					$input = $input + array('waktu_2'=>$_POST['waktu2_ljt212']);
					$input = $input + array('waktu_3'=>$_POST['waktu3_ljt212']);
					
					$input = $input + array('waktu_4'=>$this->selisihTime($_POST['waktu1_ljt212'],$_POST['waktu2_ljt212']));
				}
				
				if ($_POST['taruna_dari']=="LJT213")
				{
					$input = $input + array('waktu_1'=>$_POST['waktu1_ljt213']);
					$input = $input + array('waktu_2'=>$_POST['waktu2_ljt213']);
					$input = $input + array('waktu_3'=>$_POST['waktu3_ljt213']);
					$input = $input + array('waktu_4'=>$this->selisihTime($_POST['waktu1_ljt213'],$_POST['waktu2_ljt213']));
				}
				
				if ($_POST['taruna_dari']=="AMBULANCE")
				{				
					$input = $input + array('waktu_1'=>$_POST['waktu1_amb']);
					$input = $input + array('waktu_2'=>$_POST['waktu2_amb']);
					$input = $input + array('waktu_3'=>$this->selisihTime($_POST['waktu1_amb'],$_POST['waktu2_amb']));
						
				}
				
				if ($_POST['taruna_dari']=="RESCUE")
				{
					$input = $input + array('waktu_1'=>$_POST['waktu1_res']);
					$input = $input + array('waktu_2'=>$_POST['waktu2_res']);
					$input = $input + array('waktu_3'=>$this->selisihTime($_POST['waktu1_res'],$_POST['waktu2_res']));
				}
				
				if ($_POST['taruna_dari']=="DEREK")
				{
					$input = $input + array('waktu_1'=>$_POST['waktu1_der']);
					$input = $input + array('waktu_2'=>$_POST['waktu2_der']);
					$input = $input + array('waktu_3'=>$this->selisihTime($_POST['waktu1_der'],$_POST['waktu2_der']));								
				}
				
				if ($_POST['taruna_dari']=="PJR")
				{
					$input = $input + array('waktu_1'=>$_POST['waktu1_pjr']);
					$input = $input + array('waktu_2'=>$_POST['waktu2_pjr']);
					$input = $input + array('waktu_3'=>$this->selisihTime($_POST['waktu1_pjr'],$_POST['waktu2_pjr']));							
				}
				
				if ($_POST['type_kejadian']=="KANTIB")
				{
					$input = $input + array('kamtib'=>$_POST['kamtib']);											
				}
				*/
				
				if (($_POST['taruna_dari']=="TELPON PENGGUNA JALAN")or($_POST['taruna_dari']=="TELPON RADIO RASIKA")or($_POST['taruna_dari']=="TELPON RADIO IDOLA")or($_POST['taruna_dari']=="TELPON RADIO RRI")or($_POST['taruna_dari']=="TELPON RADIO ELSINTA"))
				{
					$input = $input + array('waktu_info_diterima'=>$_POST['waktu'],'keperluan'=>$_POST['keperluan']);											
				}
				$id_detail = date("YmdHis").mt_rand(100,999);
				$input = $input + array(
				
				'taruna_dari'=>$_POST['taruna_dari'],
				'type_kejadian'=>$_POST['jenis_kejadian'],
				'kamtib'=>$_POST['kamtib'],
				
				'jenis_kendaraan'=>$_POST['jenis_kendaraan'],
				'nopol'=>$_POST['nopol'],
				'cuaca'=>$_POST['cuaca'],
				
				'luka_berat'=>$_POST['33lb'],
				'luka_ringan'=>$_POST['33lr'],
				'meninggal'=>$_POST['33mg'],
				'sarana'=>$_POST['sarana'],
				'materi_rupiah'=>$_POST['materi'],
				
				
				'jenis_kendaraan1'=>$_POST['jenis_kendaraan1'],
				'nopol1'=>$_POST['nopol1'],
				'jenis_kendaraan2'=>$_POST['jenis_kendaraan2'],
				'nopol2'=>$_POST['nopol2'],
				'jenis_kendaraan3'=>$_POST['jenis_kendaraan3'],
				'nopol3'=>$_POST['nopol3'],
				'jenis_kendaraan4'=>$_POST['jenis_kendaraan4'],
				'nopol4'=>$_POST['nopol4'],
				'jenis_kendaraan5'=>$_POST['jenis_kendaraan5'],
				'nopol5'=>$_POST['nopol5'],
				'kilometer'=>$_POST['km'],
				'meter'=>$_POST['meter'],	
				'ruas'=>$_POST['seksi'],
				'keterangan'=>$_POST['keterangan']);		
				

				
				if(isset($_POST['st']))
				{
					$this->delete("tb_sub_detail_laporan","id_detail_laporan='".$_POST["id"]."'");
					## Input database sub detail when insert new
					foreach( $_POST["petugas"] as $key => $n ) {
						#print "The name is ".$n." and email is ".$key.", ".$_POST["t1"][$key]."thank you\n";
						$inputsub = array(
							'id_detail_laporan'=>$_POST["id"],
							'petugas'=>$_POST["petugas"][$key],
							'waktu_sub_1'=>$_POST["t1table"][$key],
							'waktu_sub_2'=>$_POST["t2table"][$key],
							'waktu_sub_3'=>$_POST["t3table"][$key]
						);
						$this->insert('tb_sub_detail_laporan',$inputsub);
					}
					
					if ($this->update('tb_detail_laporan',$input,'id='.$_POST['id']))
					{
						$this->getResult();
						return true;
					}
				}
				else
				{
					## Input database sub detail when insert new
					foreach( $_POST["petugas"] as $key => $n ) {
						print "Petugas".$n." and email is ".$key.", ".$_POST["t1"][$key]."Berhasil";
						$inputsub = array(
							'id_detail_laporan'=>$id_detail,
							'petugas'=>$_POST["petugas"][$key],
							'waktu_sub_1'=>$_POST["t1table"][$key],
							'waktu_sub_2'=>$_POST["t2table"][$key],
							'waktu_sub_3'=>$_POST["t3table"][$key]
						);
						$this->insert('tb_sub_detail_laporan',$inputsub);
					}
					$input = $input + array('id' => $id_detail);
					if($this->insert('tb_detail_laporan',$input))
					{
						$this->getResult();
						return true;
					}
				}
				
				return false;
			}
			else
			{
				$this->error_message = "Hari ini anda belum absen, Silakan anda isi data absensi terlebih dahulu !";
				return false;
			}
		}
		else
		{
			$this->error_message = "Hari ini anda belum absen, Silakan anda isi data absensi terlebih dahulu !";
			return false;
		}
		
	}
	
	
	
	function LaporanPIK()
    { 
		$sqlCek = 'Select * from tb_laporan where tgl_laporan="'.$_POST["tgl_laporan"].'" and perioda="'.$_POST["perioda"].'" and id_user="'.$_POST['id_user'].'"';
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$id_laporan = $res[0]["id_laporan"];
		}
		else
		{
			$id_laporan = date("YmdHis").mt_rand(100,999);
			$this->insert('tb_laporan',array('id_laporan'=>$id_laporan,'id_user'=>$_POST['id_user'],'tgl_laporan'=>$_POST['tgl_laporan'],'tgl_created'=>date("Y-m-d H:i:s"),'id_ka_shift'=>$_POST['ka_shift'],'perioda'=>$_POST['perioda']));
		}
		$noregister = date("YmdHis");
		$input = array('id_laporan'=>$id_laporan,'tgl_detail_created'=>date("Y-m-d H:i:s"),'no_register'=>$_POST['taruna_dari'].$noregister,'waktu_1'=>$_POST['waktu_1']);
		
		if (!empty($_POST['waktu_2'])or($_POST['waktu_2']<>"")or($_POST['waktu_2']<>"00:00:00"))
		{			
			$input = $input+array('waktu_2'=>$_POST['waktu_2']);
		}
		if (!empty($_POST['waktu_3'])or($_POST['waktu_3']<>"")or($_POST['waktu_3']<>"00:00:00"))
		{
			
			$input = $input+array('waktu_3'=>$_POST['waktu_3']);
		}		
		$input = $input + array('taruna_dari'=>$_POST['taruna_dari'],'type_kejadian'=>$_POST['type_kejadian'],'jenis_kendaraan'=>$_POST['jenis_kendaraan'],'nopol'=>$_POST['nopol'],'kilometer'=>$_POST['kilometer'],'ruas'=>$_POST['ruas'],'uraian_kegiatan'=>$_POST['uraian_kegiatan'],'keterangan'=>$_POST['keterangan']);		
		
		$this->insert('tb_detail_laporan',$input);
		
		/*
		foreach ($_POST as $key => $value)
		{			
			echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";						
		}
		*/
		return true;
	}
	
	function AbsenPetugas()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateInput())
        {
            return false;
        }
		
		if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("shift","req","Inputkan shift Anda");
        $validator->addValidation("kendaraan","req","Pilih kendaraan yang digunakan");
		
		
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
			$error = $error_hash;
			#print_r($error_hash);
			#if (isset($error['shift'])){echo $error['shift'];}
           /*
		   foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
			*/
            $this->HandleErrorInput($error);
            return false;
        }   
		
		$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'media/image');
		$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);
		
		$tgl = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
		$jam = $tgl->format('H');
		$jam1 = $tgl->format('H a');
		#echo $jam1;
		$tglCek = $tgl->format('Y-m-d');
		if ($_POST["shift"]=="3")
		{
			if ($jam < 6) 
			{			  
			   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
			}
			else
			{
				#echo "masih kurang";
			}
		}
				
		$sqlCek = 'Select * from tb_tugas where date(tgl_tugas)="'.$tglCek.'" and shift="'.$_POST["shift"].'"';		
		$this->sql($sqlCek);
		$rows = $this->numRows();		
		if ($rows>0)
		{
			$res = $this->getResult();			
			$idtugas = $res[0]["id_tugas"];
			$this->idtugas = $idtugas;
			
			//Cek di tabel detail apa sudah terisi atau belum jika sudah terisi oleh petugas di cancel
			$sqlCek2 = 'Select * from tb_tugas a, tbl_tugas_detail b where a.id_tugas=b.id_tugas and b.id_kendaraan="'.$_POST['kendaraan'].'" and date(a.tgl_tugas)="'.$tglCek.'" and a.shift="'.$_POST["shift"].'"';		
			$this->sql($sqlCek2);
			$rows2 = $this->numRows();		
			if ($rows2>0)
			{
				$error['kendaraan'] = "Kendaraan sudah digunakan";
				$this->HandleErrorInput($error);
				return false;
			}
				#$this->update('tb_tugas',array('id_ka_shift'=>$_POST['ka_shift'],'id_pik'=>$_POST['id_user']),'tgl_tugas="'.$_POST['tgl_tugas'].'" AND shift='.$_POST['shift']);
		}
		else
		{
			$idtugas = date("YmdHis").mt_rand(100,999);
			$this->idtugas = $idtugas;
			$this->insert('tb_tugas',array('id_tugas'=>$idtugas,'tgl_tugas'=>date("Y-m-d H:i:s"),'shift'=>$_POST['shift']));
		}
		
		
		$img1 = $_POST['petugas1'].date("Y-m-d H:i:s");
		$handle = new Upload($_FILES['user_image_petugas1']);		
		if ($handle->uploaded) 
		{
			$handle->file_new_name_body = $img1;
			$handle->image_resize            = true;
			#$handle->image_ratio_y           = true;
			#$handle->image_ratio_x           = true;
			$handle->image_x                 = 640;
			$handle->image_y                 = 640;	
			$handle->image_ratio_crop = true;	
			$handle->Process($dir_dest);
			if ($handle->processed) 
			{
			} 
			else 
			{
				$error['user_image_petugas1'] = '  <b>File not uploaded on the server</b><br />'.$handle->error;				
			}			
			$handle-> Clean();
		} 
		else 
		{
			$error['user_image_petugas1'] = '  <b>File not uploaded on the server</b><br />'.$handle->error;	
		}
		
		$this->insert('tbl_tugas_detail',array('id_tugas'=>$idtugas,'id_user'=>$_POST['petugas1'],'foto'=>$handle->file_dst_name,'id_kendaraan'=>$_POST['kendaraan'],'bagian_tugas'=>$_POST['kendaraan'])); 
		$this->update('tb_pegawai',array('foto'=>$handle->file_dst_name),'id_user='.$_POST['petugas1']);		
		#$this->insert('tbl_absensi',array('npp_no'=>$_POST['petugas1'],'waktu_absensi'=>date("Y-m-d H:i:s"),'foto'=>$handle->file_dst_name,'shift'=>$_POST['shift']));  
		
		$img2 = $_POST['petugas2'].date("Y-m-d H:i:s");
		$handle = new Upload($_FILES['user_image_petugas2']);		
		if ($handle->uploaded) 
		{
			$handle->file_new_name_body = $img2;
			$handle->image_resize            = true;
			#$handle->image_ratio_y           = true;
			#$handle->image_ratio_x           = true;
			$handle->image_x                 = 640;
			$handle->image_y                 = 640;	
			$handle->image_ratio_crop = true;
			$handle->Process($dir_dest);
			if ($handle->processed) 
			{
			} 
			else 
			{
				$error['user_image_petugas1'] = '  <b>File not uploaded on the server</b><br />'.$handle->error;				
			}			
			$handle-> Clean();
		} 
		else 
		{
			$error['user_image_petugas1'] = '  <b>File not uploaded on the server</b><br />'.$handle->error;	
		}		
		$this->insert('tbl_tugas_detail',array('id_tugas'=>$idtugas,'id_user'=>$_POST['petugas2'],'foto'=>$handle->file_dst_name,'id_kendaraan'=>$_POST['kendaraan'],'bagian_tugas'=>$_POST['kendaraan']));
		$this->update('tb_pegawai',array('foto'=>$handle->file_dst_name),'id_user='.$_POST['petugas2']);
		#$this->insert('tbl_absensi',array('npp_no'=>$_POST['petugas2'],'waktu_absensi'=>date("Y-m-d H:i:s"),'foto'=>$handle->file_dst_name,'shift'=>$_POST['shift']));  // Insert Petugas 2
		$res = $this->getResult();  
		#print_r($res);
		
		
		// Cek tabel checklist
		
		$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$_POST['shift'].'" and date(tgl)="'.$tglCek.'" and jenis_sarana="'.$_POST['kendaraan'].'" and id_kendaraan="'.$_POST['kendaraan'].'"';

		#echo "satu".$_POST['kendaraan'];

		$this->sql($sqlCek2);

		$rowsCek2 = $this->numRows();	

		if ($rowsCek2>0)
		{			
			$resCek2 = $this->getResult();			
			$this->id_checklist_sarana  = $resCek2[0]["id_checklist_sarana"];
			$this->jenis_kendaraan = $_POST['kendaraan'];
			#echo "class".$_POST['kendaraan'];			
		}
		else
		{			
			$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
			$this->jenis_kendaraan = $_POST['kendaraan'];
			#echo "class".$_POST['kendaraan'];
			$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tgl->format('Y-m-d H:i:s'),'id_kendaraan'=>$_POST['kendaraan'],'shift'=>$_POST['shift'],'jenis_sarana'=>$_POST['kendaraan'],'id_tugas'=>$idtugas));
			#print_r($this->getSql());
			$this->getResult();
			
			//$_POST = array();
			
			#$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$id_checklist_sarana,'tgl'=>date("Y-m-d H:i:s"),'id_kendaraan'=>$_POST['id_kendaraan'],'km_awal'=>$_POST['km']));
			
		}
		
		#echo $this->id_checklist_sarana;

		return true;

       /* $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
		*/
    }
	
	function updateProfile()
	{
		
		if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
		
		$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'media/image');
		$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);
		if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("name","req","Inputkan Nama Anda");
        $validator->addValidation("email","req","Pilih kendaraan yang digunakan");
		
		
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
			$error = $error_hash;
			#print_r($error_hash);
			#if (isset($error['shift'])){echo $error['shift'];}
           /*
		   foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
			*/
            $this->HandleErrorInput($error);
            return false;
        }   
		
		$img1 = $_POST['id_user'].date("Y-m-d H:i:s");
		$handle = new Upload($_FILES['user_image_petugas1']);		
		if ($handle->uploaded) 
		{
			$handle->file_new_name_body = $img1;
			$handle->image_resize            = true;
			#$handle->image_ratio_y           = true;
			#$handle->image_ratio_x           = true;
			$handle->image_x                 = 640;
			$handle->image_y                 = 640;	
			$handle->image_ratio_crop = true;
			$handle->Process($dir_dest);
			$namefile = "";
			if ($handle->processed) 
			{
				$namefile = $handle->file_dst_name;
			} 
			else 
			{
				$error['user_image_petugas1'] = '  <b>File not uploaded on the server</b><br />'.$handle->error;				
			}			
			$handle-> Clean();
		} 
		else 
		{
			$error['user_image_petugas1'] = '  <b>File not uploaded on the server</b><br />'.$handle->error;	
		}
		#echo $handle->file_dst_name;
		#echo $namefile;
		if(!$this->update('tb_pegawai',array('name'=>$_POST['name'],'email'=>$_POST['email'],'foto'=>$namefile),'id_user="'.$_POST['id_user'].'"'))
        {			
            return false;			
        }		
		return true;
	}
	
	function ValidateInput()
    {
        //This is a hidden input field. Humans won't fill this field.
		//print_r($_POST[$this->GetSpamTrapInputName()]);
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("shift","req","Pilih Shift Anda");
        $validator->addValidation("kendaraan","req","Pilih kendaraan yang digunakan");
        $validator->addValidation("petugas1","req","Nama Petugas Satu belum dipilih");
		$validator->addValidation("petugas2","req","Nama Petugas Dua belum dipilih");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
			$error = $error_hash;
			#print_r($error_hash);
			#if (isset($error['shift'])){echo $error['shift'];}
           /*
		   foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
			*/
            $this->HandleErrorInput($error);
            return false;
        }        
        return true;
    }
	
	function HandleErrorInput($err)
    {
        $this->error_message = $err;
		return $err;
    }
	
	 function GetErrorMessageInput()
    {
        if(empty($this->error_message))
        {
            return '';
        }
		#print_r($this->error_message);
        $errormsg = $this->error_message;
        return $errormsg;
    }    
	
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("name","req","Please fill in Name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
  
        $validator->addValidation("password","req","Please fill in Password");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['name'] = $this->Sanitize($_POST['name']);
		$formvars['username'] = $this->Sanitize($_POST['username']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
   
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['name']);
        
        $mailer->Subject = "Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
		
		echo $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
		$this->sitename;
		
        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';

        $urldir ='';
        $pos = strrpos($_SERVER['REQUEST_URI'],'/');
        if(false !==$pos)
        {
            $urldir = substr($_SERVER['REQUEST_URI'],0,$pos);
        }

        $scriptFolder .= $_SERVER['HTTP_HOST'].$urldir;

        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable())
        {
            return false;
        }
        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
	if(!$this->IsFieldUnique($formvars,'username'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        } 
              
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select username from $this->tablename where $fieldname='".$field_val."'";
        $result = mysqli_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    	
    
    function Ensuretable()
    {
        $result = mysqli_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
       
    	$qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
		"salt VARCHAR( 50 ) NOT NULL ,".
                "password VARCHAR( 80 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
	
                
        if(!mysqli_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    }
    
    function InsertIntoDB(&$formvars)
    {
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);

        $formvars['confirmcode'] = $confirmcode;

	$hash = $this->hashSSHA($formvars['password']);

	$encrypted_password = $hash["encrypted"];
        
 

	$salt = $hash["salt"];
        
      

 
        $insert_query = 'insert into '.$this->tablename.'(
		name,
		email,
		username,	
		password,
		salt,
		confirmcode
		)
		values
		(
		"' . $this->SanitizeForSQL($formvars['name']) . '",
		"' . $this->SanitizeForSQL($formvars['email']) . '",
		"' . $this->SanitizeForSQL($formvars['username']) . '",
		"' . $encrypted_password . '",
		"' . $salt . '",
		"' . $confirmcode . '"
		)';  

 
        if(!mysqli_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
        return true;
    }
    function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
		
        if( function_exists( "mysqli_real_escape_string" ) )
        {
              $ret_str = mysqli_real_escape_string($this->connection, $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
		
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
	
	function DBLogin()
    {

        $this->connection = mysqli_connect($this->db_host,$this->username,$this->pwd,$this->database);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");			
            //return false;
        }
       /*
	   if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
			echo "SELECT * FROM ";
            //return false;
        }
		*/
       # if(!mysqli_query("SET NAMES 'UTF8'",$this->connection))
		    #if(!mysqli_query("SET CHARACTER SET utf8",$this->connection))
		if (!mysqli_set_charset($this->connection, "utf8")) 
        {
            $this->HandleDBError('Error setting utf8 encoding');			
            //return false;
			
        }		
        return true;
    }

	// Function to make connection to database
	public function connect(){
		if(!$this->con){
			$this->myconn = new mysqli($this->db_host,$this->username,$this->pwd,$this->database);  // mysql_connect() with variables defined at the start of Database class
            if($this->myconn->connect_errno > 0){
                array_push($this->result,$this->myconn->connect_error);
                return false; // Problem selecting database return FALSE
            }else{
                $this->con = true;
                return true; // Connection has been made return TRUE
            } 
        }else{  
            return true; // Connection has already been made return TRUE 
        }  	
	}
	
	// Function to disconnect from the database
    public function disconnect(){
    	// If there is a connection to the database
    	if($this->con){
    		// We have found a connection, try to close it
    		if($this->myconn->close()){
    			// We have successfully closed the connection, set the connection variable to false
    			$this->con = false;
				// Return true tjat we have closed the connection
				return true;
			}else{
				// We could not close the connection, return false
				return false;
			}
		}
    }
	
	public function sql($sql){
		$this->connect();
		$query = $this->myconn->query($sql);
        $this->myQuery = $sql; // Pass back the SQL
		if($query){
			// If the query returns >= 1 assign the number of rows to numResults
			$this->numResults = $query->num_rows;
			// Loop through the query results by the number of rows returned
			for($i = 0; $i < $this->numResults; $i++){
				$r = $query->fetch_array();
               	$key = array_keys($r);
               	for($x = 0; $x < count($key); $x++){
               		// Sanitizes keys so only alphavalues are allowed
                   	if(!is_int($key[$x])){
                   		if($query->num_rows >= 1){
                   			$this->result[$i][$key[$x]] = $r[$key[$x]];
						}else{
							$this->result = null;
						}
					}
				}
			}
			
			return true; // Query was successful
		}else{
			array_push($this->result,$this->myconn->error);
			return false; // No rows where returned
		}
	}
	
	// Function to SELECT from the database
	public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
	{
		$this->connect();
		// Create query from the variables passed to the function
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($join != null){
			$q .= ' JOIN '.$join;
		}
        if($where != null){
        	$q .= ' WHERE '.$where;
		}
        if($order != null){
            $q .= ' ORDER BY '.$order;
		}
        if($limit != null){
            $q .= ' LIMIT '.$limit;
        }
        // echo $table;
        $this->myQuery = $q; // Pass back the SQL
		
		// Check to see if the table exists
        if($this->tableExists($table)){
        	// The table exists, run the query
        	$query = $this->myconn->query($q);    
			if($query){
				// If the query returns >= 1 assign the number of rows to numResults
				$this->numResults = $query->num_rows;
				// Loop through the query results by the number of rows returned
				for($i = 0; $i < $this->numResults; $i++){
					$r = $query->fetch_array();
                	$key = array_keys($r);
                	for($x = 0; $x < count($key); $x++){
                		// Sanitizes keys so only alphavalues are allowed
                    	if(!is_int($key[$x])){
                    		if($query->num_rows >= 1){
                    			$this->result[$i][$key[$x]] = $r[$key[$x]];
							}else{
								$this->result[$i][$key[$x]] = null;
							}
						}
					}
				}
				return true; // Query was successful
			}else{
				array_push($this->result,$this->myconn->error);
				return false; // No rows where returned
			}
      	}else{
      		return false; // Table does not exist
    	}
    }
	
	// Function to insert into the database
    public function insert($table,$params=array()){
    	// Check to see if the table exists
		
    	 if($this->tableExists($table)){
    	 	$sql='INSERT INTO `'.$table.'` (`'.implode('`, `',array_keys($params)).'`) VALUES ("' . implode('", "', $params) . '")';			
            $this->myQuery = $sql; // Pass back the SQL
            // Make the query to insert to the database
            if($ins = $this->myconn->query($sql)){
            	array_push($this->result,$this->myconn->insert_id);
                return true; // The data has been inserted
            }else{
            	array_push($this->result,$this->myconn->error);
                return false; // The data has not been inserted
            }
        }else{
        	return false; // Table does not exist			
        }
    }
	
	//Function to delete table or row(s) from database
    public function delete($table,$where = null){
    	// Check to see if table exists
    	 if($this->tableExists($table)){
    	 	// The table exists check to see if we are deleting rows or table
    	 	if($where == null){
                $delete = 'DROP TABLE '.$table; // Create query to delete table
            }else{
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; // Create query to delete rows
            }
            // Submit query to database
            if($del = $this->myconn->query($delete)){
            	array_push($this->result,$this->myconn->affected_rows);
                $this->myQuery = $delete; // Pass back the SQL
                return true; // The query exectued correctly
            }else{
            	array_push($this->result,$this->myconn->error);
               	return false; // The query did not execute correctly
            }
        }else{
            return false; // The table does not exist
        }
    }
	
	// Function to update row in database
    public function update($table,$params=array(),$where){
		$this->connect();
    	// Check to see if table exists
    	if($this->tableExists($table)){
    		// Create Array to hold all the columns to update
            $args=array();
			foreach($params as $field=>$value){
				// Seperate each column out with it's corresponding value
				$args[]=$field.'="'.$value.'"';
			}
			// Create the query
			$sql='UPDATE '.$table.' SET '.implode(',',$args).' WHERE '.$where;
			// Make query to database
            $this->myQuery = $sql; // Pass back the SQL
            if($query = $this->myconn->query($sql)){
            	array_push($this->result,$this->myconn->affected_rows);
            	return true; // Update has been successful
            }else{
            	array_push($this->result,$this->myconn->error);
                return false; // Update has not been successful
            }
        }else{
            return false; // The table does not exist
        }
    }
	
	// Private function to check if table exists for use with queries
	private function tableExists($table){
		$this->connect();
		#$this->DBLogin();
		
		#echo '|||SHOW TABLES FROM '.$this->database.' LIKE "'.$table.'"';
		$tablesInDb = $this->myconn->query('SHOW TABLES FROM '.$this->database.' LIKE "'.$table.'"');
		#$tablesInDb = mysql_query($this->connection,'SHOW TABLES FROM '.$this->database.' LIKE "'.$table.'"');
		#print_r($tablesInDb);
		#echo "Test";
        if($tablesInDb)
		{
			#echo "Test";
        	if($tablesInDb->num_rows == 1){
                return true; // The table exists
            }else{
            	array_push($this->result,$table." does not exist in this database");
                return false; // The table does not exist
            }
        }
		#echo "Test";
    }
	
	// Public function to return the data to the user
    public function getResult(){
        $val = $this->result;
		
        $this->result = array();
		#print_r($val);
        return $val;
    }

    //Pass the SQL back for debugging
    public function getSql(){
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }

    //Pass the number of rows back
    public function numRows(){
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    // Escape your string
    public function escapeString($data){
        return $this->myconn->real_escape_string($data);
    }
	
}
?>
