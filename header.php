<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="assets1/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets1/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/css/font-awesome.min.css"-->
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	
  <!-- Ionicons 
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/css/ionicons.min.css">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Daterange picker -->
  <!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/daterangepicker/daterangepicker.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/colorpicker/bootstrap-colorpicker.min.css">
  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/timepicker/bootstrap-timepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <!-- DataTables 
  <link rel="stylesheet" href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
  -->
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.jqueryui.min.css">

  <!-- Notify -->
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.buttons.css" rel="stylesheet">
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.nonblock.css" rel="stylesheet">
  
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.brighttheme.css" rel="stylesheet">
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.history.css" rel="stylesheet">
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.material.css" rel="stylesheet">
  <link href="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.mobile.css" rel="stylesheet">
  <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>

body {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-weight: 400;
  overflow-x: hidden;
  overflow-y: auto;
}
</style>
<?php if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='1')
{
	?>	
<body class="hold-transition skin-blue layout-top-nav">
<?php 
}
else if(($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='2')
or($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='3')
or($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='4'))
{
	?>	<body class="hold-transition skin-blue sidebar-mini">
	<?php
}
?>