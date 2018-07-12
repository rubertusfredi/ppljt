<?php
include "../config/conn.php"; 
session_start();
if(empty($_SESSION)){
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LAPORAN LJT-JASAMARGA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../assets/AdminLTE/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/AdminLTE/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- Icon Jasamarga -->  
  <link rel="shortcut icon" type="image/x-icon" href="../images/jasa.marga.icon.png">  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!---------------- Logo --------------------------------->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="../images/jasa.marga.icon.png" class="img-circle" alt="User Image"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PPLJT</b>Jasamarga</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/AdminLTE/dist/img/avatar6.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assets/AdminLTE/dist/img/avatar6.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['username']; ?> - <?php echo $_SESSION['level_user']; ?>
                  <small><?php echo date("Y-m-d");?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../assets/AdminLTE/dist/img/avatar6.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo $_SESSION['username']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
               <!------------------------------- Start Sidebar-------------------->
           <?php include('sidebar.php');?>
          <!-------------------------------- /. End Sidebar ------------------>	     
    </section>
    <!---------------------------------- /.sidebar   ------------------------------------------------------------>
  </aside>

  <!----------------------------- Content Wrapper. Contains page content ------------------------------------------------->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan 
        <small>Harian Petugas PIK</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Harian Petugas PIK</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                  <!------------ Awal kolom --------------->	
      <!-- Tampil tanggal  -->

      <p class="help-block">Hari ini   <?php include"../config/waktu.php";?></p>
	  
	  
	      <div class="box box-warning">
          <div class="box-header with-border">


		  
          <h3 class="box-title">laporan Harian Petugas PIK</h3>

	      <div class="row">
        <div class="col-md-3">
		   <form role="form">
			  <!-- Tanggal -->
              <div class="form-group">
                <label>Tanggal</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker2" value="<?php echo date("d-m-Y");?>" disabled >
                </div>
              </div>	  
		</div>
		      <!-- Shift -->	
		<div class="col-md-3">
			  <div class="form-group ">
                <label>Pilih Perioda</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">PERIODA I</option>
                  <option>PERIODA II</option>
                  <option>PERIODA III</option>
                </select>
              </div>
		</div>
	</div>

		<h3 class="box-title">Taruna Dari</h3>
          <div class="box-body">
                <!-- radio -->
                
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="ljt210" value="option1" checked>
                      LJT 210
					  &nbsp;
                    </label>
                    <label>
                      <input type="radio" name="optionsRadios" id="ljt212" value="option2">
                      LJT 212
					  &nbsp;
                    </label>
					
                    <label>
                      <input type="radio" name="optionsRadios" id="ljt213" value="option3" >
                      LJT 213
					  &nbsp;
                    </label>
					
                    <label>
                      <input type="radio" name="optionsRadios" id="derek" value="option3" >
                      DEREK
					  &nbsp;
                    </label>
					
                    <label>
                      <input type="radio" name="optionsRadios" id="rescue" value="option3" >
                      RESCUE
					  &nbsp;
                    </label>
					
                    <label>
                      <input type="radio" name="optionsRadios" id="ambulance" value="option3" >
                      AMBULANCE
					  &nbsp;
                    </label>
					
                    <label>
                      <input type="radio" name="optionsRadios" id="pjr" value="option3" >
                      PJR
					  &nbsp;
                    </label>
                    <label>
                      <input type="radio" name="optionsRadios" id="manyaran" value="option3" >
                      GT. Manyaran
					  &nbsp;
                    </label>
                    <label>
                      <input type="radio" name="optionsRadios" id="tembalang" value="option3" >
                      GT. Tembalang
					  &nbsp;
                    </label>
                    <label>
                      <input type="radio" name="optionsRadios" id="gayamsari" value="option3" >
                      GT. Gayamsari
					  &nbsp;
                    </label>
                    <label>
                      <input type="radio" name="optionsRadios" id="muktiharjo" value="option3" >
                      GT. Muktiharjo
					  &nbsp;
                    </label>
                    <label>
                      <input type="radio" name="optionsRadios" id="telpon" value="option3" >
                      Telphon
					  &nbsp;
                    </label>					
                  </div>
                	  
		  

		<h3 class="box-title">Pukul</h3>

              <div class="bootstrap-timepicker">
			   <div class="col-md-3">
                <div class="form-group">
                  <label>T 1:&nbsp; Waktu Taruna</label>
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" >
                    <div class="input-group-addon">
                      <input type="checkbox" class="minimal" checked>
                    </div>
                  </div>
                </div>
              </div>	  

			   <div class="col-md-3">
                <div class="form-group">
                  <label>T 2:&nbsp; Sampai Lokasi</label>
                  <div class="input-group">                  
                    <input type="time" class="form-control">
                    <div class="input-group-addon">
					  <input type="checkbox" class="minimal">
                    </div>
                  </div>
                </div>
              </div>				  

			   <div class="col-md-3">
                <div class="form-group">
                  <label>T 3:&nbsp; Selesai</label>
                  <div class="input-group">
                    <input type="time" class="form-control " ">
                    <div class="input-group-addon">
                      <input type="checkbox" class="minimal">
                    </div>
                  </div>
                </div>
              </div>				  
			 </div>
              </div>
			<div class="box-header with-border"> 
              <h3 class="box-title">Kendaraan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
				<div class="col-md-3">
                <div class="form-group">
                  <label>Jenis Kendaraan</label>
                  <input type="text" class="form-control" placeholder="Jenis Kendaraan ...">
                </div>
				</div>
				<div class="col-md-3">				
                <div class="form-group">
                  <label>Nomor Polisi</label>
                  <input type="text" class="form-control" placeholder="Nomor Polisi ..." >
                </div>
                </div>				
			 </div>	
			<div class="box-header with-border"> 
              <h3 class="box-title">Lokasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
				<div class="col-md-3">
                <div class="form-group">
                  <label>Di Kilometer</label>
                  <input type="text" class="form-control" placeholder="KM ...">
                </div>
				</div>
				<div class="col-md-3">				
                <div class="form-group">
                  <label>Ruas</label>
                  <input type="text" class="form-control" placeholder="A/B/C ..." >
                </div>
                </div>				
			 </div>	
			<div class="box-header with-border"> 
              <h3 class="box-title">Isi Taruna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
				<div class="col-md-12">
                <div class="form-group">
				<label>Uraian Kegiatan</label>
                  <textarea class="form-control" rows="6" placeholder="Uraian Kegiatan ..."></textarea>
                </div>
                <div class="form-group">
				<label>Keterangan</label>
                  <textarea class="form-control" rows="3" placeholder="Keterangan ..."></textarea>
                </div>				
				</div>
			
			 </div>				 
              </form>				
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
		  
		   <div class="box-footer">
               <button type="submit2" class="btn btn-primary">BUAT LAPORAN</button>
           </div>			
        </div>	
		</div	
                  <!------------ Awal kolom --------------->	
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pencarian Laporan </h3>
		  
    <div class="row">
        <div class="col-md-3">
			  <!-- Tanggal -->
              <div class="form-group">
                <label>Pilih Tanggal</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>

              </div>	  
		</div>
		      <!-- Shift -->	
		<div class="col-md-3">
			  <div class="form-group ">
                <label>Pilih Perioda</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">PERIODE I</option>
                  <option>PERIODE II</option>
                  <option>PERIODE III</option>
                </select>
              </div>
		</div>
					   <!-- Tombol Cari -->	
			<div class="form-group ">
				  <label>Tekan Tombol !</label>
				<div class="input-group ">
               <button type="submit1" class="btn btn-primary pull-left">CARI LAPORAN</button>
		       </div>
	        </div> 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
             <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Laporan Harian Petugas PIK</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
		 <?php include("../kpm/Lap. L. Nopember 2017.htm"); ?>
		 
		<!------------------ tombol print/export EXCEL dan export PDF ------------------------->
		<div>
        <a class="btn btn-app">
                <i class="fa fa-print">
        </i> Print <span href ="../../ATBC6 SHIFT3.htm" class="badge bg-purple">Print</span>
              </a>       
        <a class="btn btn-app" href="javascript:void(0);" onclick=laporan('laporanhtp');> 
                <i class="fa fa-file-o"  ></i> Export <span class="badge bg-red">PDF</span>
              </a> 
              <button class="btn btn-app" id="xlsexport"> 
                <i class="fa fa-file-excel-o" ></i> Export <span class="badge bg-green">XLS</span>
              </button>			  
      </div>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer -->
              </div> 
		  



      </div>

            </div>
	<!--/.Akhir BOX -->
	<!--/.Awal BOX -->

	<!--/.Akhir BOX -->	
	
	
      <!-- Info boxes -->   
      <!-- /.row -->

      
      <!-- /.row -->

      <!-- Main row -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017 <a href="#">PPLJT Jasamarga</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/AdminLTE//bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../assets/AdminLTE//bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../assets/AdminLTE//plugins/input-mask/jquery.inputmask.js"></script>
<script src="../assets/AdminLTE//plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../assets/AdminLTE//plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../assets/AdminLTE//bower_components/moment/min/moment.min.js"></script>
<script src="../assets/AdminLTE//bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../assets/AdminLTE//bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../assets/AdminLTE//bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../assets/AdminLTE//plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/AdminLTE//bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../assets/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../assets/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/AdminLTE//dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/AdminLTE//dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
