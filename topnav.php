<?php
$fgmembersite->select('tb_pegawai','*',null,'id_user="'.$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user'].'"','');
	$resPeg = $fgmembersite->getResult();
	if ($resPeg[0]['foto']<>"")
	{
		$imgsrc = $fgmembersite->sitename.$fgmembersite->media_img.$resPeg[0]['foto'];
	}
	else
	{
		$imgsrc = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
	}
	?>
<div class="wrapper">
<?php if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='1')
{
	$imgpic = $fgmembersite->assets.'dist/img/user-160x160.png';
	if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['foto']<>'')
	{
		$imgpic ='img/'.$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['foto'];
	}
	
	
	
	?>
	
	<header class="main-header">
		<nav class="navbar navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a href="<?php echo $fgmembersite->sitename; ?>" class="navbar-brand"><b>PPLJT</b>Jasamarga</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
 
				<div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <!-- Messages: style can be found in dropdown.less-->
		  <?php ?>
          <!-- User Account: style can be found in dropdown.less -->
		  <li><a href="<?php echo $fgmembersite->sitename."logout.php"; ?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-in"></i> KELUAR</a></li>
		  <?php ?>
 
        </ul>
      </div>

		</div>
      <!-- /.container-fluid -->
    </nav>
  </header>
<?php
}
else if ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='2')
{
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $fgmembersite->sitename; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>LJT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PPLJT</b>Jasamarga</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->                     
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->	
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span>
      </a>
   <!-------------------------------- M E N A M P I L K A N    J A M   S E B A G A I      P E N G I N G A T -------------------->
                                                        <b><h class="label label-primary">Waktu Sekarang</h></b><?php include"./class/waktu.php";?>																			
   <!-------------------------------- M E N A M P I L K A N    J A M   S E B A G A I      P E N G I N G A T -------------------->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

		
		
		
		
		<?php ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $imgsrc; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
			  
                <img src="<?php echo $imgsrc; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?>
				</p>
				<p>
				  <?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['login_hash']); ?>
				  -
				  <?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['npp']); ?> 
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
			  <?php ?>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $fgmembersite->sitename; ?>?mod=profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $fgmembersite->sitename."logout.php"; ?>" class="btn btn-default btn-flat"> Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

<?php
}
else if(($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='3')
or
($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='4')
)
{
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $fgmembersite->sitename; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>LJT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PPLJT</b>Jasamarga</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->                     
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->	
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span>
      </a>
   <!-------------------------------- M E N A M P I L K A N    J A M   S E B A G A I      P E N G I N G A T -------------------->
                                                        <b><h class="label label-primary">Waktu Sekarang</h></b><?php include"./class/waktu.php";?>																			
   <!-------------------------------- M E N A M P I L K A N    J A M   S E B A G A I      P E N G I N G A T -------------------->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
<!---------------------------------- Fitur Notifikasi dan Verifikasi laporan  --------------------------------------------------->
<!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-users"></i>
              <span class="label label-warning"><?php echo $fgmembersite->ValidasiAbsensi('0'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo $fgmembersite->ValidasiAbsensi('0'); ?> Data Absensi Diverifikasi </li>
              <!--  <li>
                <!-- inner menu: contains the actual data -->
                <!--<ul class="menu">
                  <!--<li><!-- start message -->
                   
                     <!-- <div class="pull-left">					  

                  <!-- end message -->

               <!-- </ul>
              <!-- </li> -->
              <li class="footer"><a href="?mod=absensiPetugas">Lihat Semua Absensi</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-newspaper-o"></i>
              <span class="label label-danger"><?php echo $fgmembersite->ValidasiLaporan('0'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo $fgmembersite->ValidasiLaporan('0'); ?> Laporan Kejadian Diverifikasi</li>
              <!--<li>
                <!-- inner menu: contains the actual data -->
                <!--<ul class="menu">
                  <li>
                    <a href="#">
                      <!--<i class="fa fa-wrench text-danger"></i> MOGOK MESIN -->
                   <!-- </a>
                  </li>
                </ul>
              </li>-->
              <li class="footer"><a href="?mod=dataKejadian">Lihat Semua Kejadian</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-safari"></i>
              <span class="label label-success"><?php echo $fgmembersite->ValidasiPosisi('0'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo $fgmembersite->ValidasiPosisi('0'); ?> Data Beat Petugas Diverifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <!-- <ul class="menu">
                   <li>
                    <a href="#">
                      <i class="fa fa-taxi text-green"></i>
                    </a>
                  </li>                
                  <!-- end task item -->
                   <!--<li>
                    <a href="#">
                      <i class="fa fa-taxi text-green"></i>
                    </a>
                  </li>                
                  <!-- end task item -->				  
                <!--</ul>-->
              </li>
              <li class="footer">
                <a href="?mod=checklistKashift">Lihat Semua Data Beat Petugas</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->


<!----------------------------------/ Akhir Fitur Notifikasi dan Verifikasi laporan  --------------------------------------------------->
		
		
		
		
		<?php ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $imgsrc; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
			  
                <img src="<?php echo $imgsrc; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?>
				</p>
				<p>
				  <?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['login_hash']); ?>
				  -
				  <?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['npp']); ?> 
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
			  <?php ?>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $fgmembersite->sitename; ?>?mod=profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $fgmembersite->sitename."logout.php"; ?>" class="btn btn-default btn-flat"> Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <?php
}
?>