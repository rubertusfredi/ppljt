
<?php if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='1')
{
}
else if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='2')
{
?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $imgsrc; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <?php
		/*<li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
		*/ ?>

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="absenPetugas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=absenPetugas">
            <i class="fa fa-user"></i> <span>Data Absensi</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="checklist")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=checklist">
            <i class="fa fa-file-text"></i> <span>Checklist Kilometer</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="formKejadian")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=formKejadian">
            <i class="fa fa-file-text"></i> <span>Form Kejadian</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
	
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="timelinePetugas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=timelinePetugas">
            <i class="fa fa-laptop"></i> <span>Waktu dan Posisi</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>

        <li class="header">MENU ADMINISTRASI</li>
		
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="perjalanan")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=perjalanan">
            <i class="fa fa-car"></i> <span>Gangguan Perjalanan</span>
          </a>
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="manager")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=manager">
            <i class="fa fa-car"></i><span>Gangguan Kendaraan</span>
          </a>
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="gangguanKamtib")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=gangguanKamtib">
            <i class="fa fa-warning"></i> <span>Gangguan Kamtib</span>
          </a>
        </li>
         
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="respondTimes")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=respondTimes"> 
            <i class="glyphicon glyphicon-time"></i>
            <span>Respond Times Petugas</span>

          </a>
        </li> 
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="LaporanTelpon")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=LaporanTelpon"> 
            <i class="glyphicon glyphicon-earphone"></i>
            <span>Laporan Telpon Masuk</span>
          </a>
        </li> 	
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="dataKejadian")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataKejadian">
            <i class="glyphicon glyphicon-th-list"></i> <span>Data Kejadian & Kamtib</span>

          </a>
        </li>		

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="dataPenderekan")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataPenderekan">
            <i class="fa fa-car"></i> <span>Data Penderekan</span>
          </a>
        </li>	

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="lajurpenyelamat")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=lajurpenyelamat">
            <i class="fa fa-eraser"></i> <span>Lajur Penyelamat</span>
          </a>
        </li>		
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="fatalitas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=fatalitas">
            <i class="fa fa-car"></i> <span>Data TK & TF </span>
          </a>
        </li>		
        <li class="header">MONITORING</li>
		
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="air")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=air">
            <i class="fa fa-car"></i> <span>Ketinggian Air</span>
          </a>
        </li>		
		
		<?php ############################################################## ?>
		
        	
        
        
        
        			
        	
        
        </li>
        
          </ul>
        </li>        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php
}
else if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='3')
{
	?>

  <!-- ======================   MENU KASHIFT ========================= -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $imgsrc; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
	  <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>  

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="absensiPetugas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=absensiPetugas">
            <i class="fa fa-user"></i> <span>Data Absensi</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="checklistKashift")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=checklistKashift">
            <i class="fa fa-safari"></i><span>Kilometer Beat Petugas</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>	
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="timelinePetugas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=timelinePetugas">
            <i class="fa fa-laptop"></i> <span>Waktu dan Posisi</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="perjalanan")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=perjalanan">
            <i class="fa fa-car"></i> <span>Gangguan Perjalanan</span>
          </a>
        </li>			
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="manager")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=manager">
            <i class="fa fa-car"></i><span>Gangguan Kendaraan</span>
          </a>
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="gangguanKamtib")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=gangguanKamtib">
            <i class="fa fa-warning"></i> <span>Gangguan Kamtib</span>
          </a>
        </li>
         
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="respondTimes")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=respondTimes"> 
            <i class="glyphicon glyphicon-time"></i>
            <span>Respond Times Petugas</span>

          </a>
        </li> 
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="LaporanTelpon")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=LaporanTelpon"> 
            <i class="glyphicon glyphicon-earphone"></i>
            <span>Laporan Telpon Masuk</span>
          </a>
        </li> 	
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="dataKejadian")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataKejadian">
            <i class="glyphicon glyphicon-th-list"></i> <span>Data Kejadian & Kamtib</span>

          </a>
        </li>
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="dataPenderekan")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataPenderekan">
            <i class="fa fa-car"></i> <span>Data Penderekan</span>
          </a>
        </li>	

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="lajurpenyelamat")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=lajurpenyelamat">
            <i class="fa fa-eraser"></i> <span>Lajur Penyelamat</span>
          </a>
        </li>		
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="fatalitas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=fatalitas">
            <i class="fa fa-car"></i> <span>Data TK & TF </span>
          </a>
        </li>				
	
          </ul>
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
	  <?php /*
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>        
		<li class="treeview">
          <a href="<?php echo $fgmembersite->sitename; ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		<li class="treeview">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataKejadian">
            <i class="fa fa-automobile"></i> <span>Data Kejadian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
	
          </ul>
        </li>        
      </ul>
	  
	  */ ?>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php
}
else if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='4')
{
	?>

  <!-- ====================== MENU MANAGER  ========================= -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $imgsrc; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['name']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
	  <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li> 
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="absensiPetugas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=absensiPetugas">
            <i class="glyphicon glyphicon-user"></i><span>Absensi Petugas</span>

          </a>
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="pegawai")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=pegawai">
            <i class="glyphicon glyphicon-user"></i><span>Profil Petugas</span>

          </a>
        </li>		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="checklistKashift")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=checklistKashift">
            <i class="fa fa-safari"></i><span>Kilometer Beat Petugas</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="timelinePetugasLJT")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=timelinePetugasLJT">
            <i class="fa fa-laptop"></i> <span>Waktu dan Posisi</span>
            <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
			-->
          </a>          
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="perjalanan")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=perjalanan">
            <i class="fa fa-car"></i> <span>Gangguan Perjalanan</span>
          </a>
        </li>		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="manager")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=manager">
            <i class="fa fa-car"></i> <span>Gangguan Kendaraan</span>

          </a>
        </li>
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="gangguanKamtib")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=gangguanKamtib">
            <i class="fa fa-warning"></i> <span>Gangguan Kamtib</span>

          </a>
        </li>
         
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="respondTimes")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=respondTimes"> 
            <i class="glyphicon glyphicon-time"></i>
            <span>Respond Times Petugas</span>
          </a>
        </li> 
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="Datatelpon")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=Datatelpon"> 
            <i class="fa fa-fax"></i>
            <span>Data Telpon Masuk</span>
          </a>
        </li> 		
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="LaporanTelpon")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=LaporanTelpon"> 
            <i class="fa fa-file-text"></i>
            <span>Laporan Telpon Masuk</span>
          </a>
        </li> 			
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="dataKejadian")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataKejadian">
            <i class="glyphicon glyphicon-th-list"></i> <span>Data Kejadian & Kamtib</span>

          </a>
        </li>

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="dataPenderekan")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataPenderekan">
            <i class="fa fa-car"></i> <span>Data Penderekan</span>
          </a>
        </li>	

		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="lajurpenyelamat")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=lajurpenyelamat">
            <i class="fa fa-eraser"></i> <span>Lajur Penyelamat</span>
          </a>
        </li>			
		
		<li class="treeview menu <?php if (isset($_GET["mod"])and($_GET["mod"]=="fatalitas")){echo "active"; }?>">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=fatalitas">
            <i class="fa fa-car"></i> <span>Data TK & TF </span>
          </a>
        </li>	
	
          </ul>
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
	  <?php /*
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>        
		<li class="treeview">
          <a href="<?php echo $fgmembersite->sitename; ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		<li class="treeview">
          <a href="<?php echo $fgmembersite->sitename; ?>?mod=dataKejadian">
            <i class="fa fa-automobile"></i> <span>Data Kejadian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
	
          </ul>
        </li>        
      </ul>
	  
	  */ ?>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php
}

?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<?php if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='1')
{
	?>
	<div class="container">
    <!--container -->
	<?php
}
?>
	
