<title>PPLJT | Detail Informasi</title>
<?PHP


if(isset($_POST['submitted']))
{  
   if($fgmembersite->LaporanPIKV2())
   {   
	   $fgmembersite->SafeDisplay(null);
	   header("location:index.php?mod=formKejadian");
		?>
	   <script>
		$(function(){
			$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Berhasil !',
			  text: 'Data Kejadian berhasil di simpan',
			  type: 'success'
		   });
		   $("#formKejadian")[0].reset();
		   
		});
		</script>
		<?php
		
   }
   else
   {
	   
	   #echo "ada";
	   $error = $fgmembersite->GetErrorMessageInput();
	   #if (isset($error)
		if ((!empty($error))or((isset($fgmembersite->error_message))and (!empty($fgmembersite->error_message)) ))
		{
			?>
	   <script>
		$(function(){
			
		   new PNotify({
			  title: 'Error!',
			  text: '<?php 
			  if (isset($error['taruna_dari'])){echo $error['taruna_dari'].", "; }
			  //if (isset($error['jenis_kejadian'])){echo $error['jenis_kejadian'].", "; }
			  //if (isset($error['kamtib'])){echo $error['kamtib'].", "; }
			  if (isset($fgmembersite->error_message)){ echo $fgmembersite->error_message;}
			   ?>',
			  type: 'error'
		   });
		  
		   
		});
		</script>
		<?php
		}
   }
   
}
if((isset($_GET['st'])) and ($_GET['st']=="edit"))
{ 
	$fgmembersite->EditdataKejadian($_GET['id']);	
}
else
{
	if(!isset($_POST['submitted']))
	{
		$fgmembersite->resetTimer();
	}
}
?>
<?php
$moduleTitle = "Detail Informasi";
$moduleDesc = " Laporan Harian Petugas";
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small><?php echo $moduleDesc; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li> 
	
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">Detail Laporan Kejadian Tiap Shift Berdasarkan ID Laporan</a></li>

		</ul>
		
		<div class="tab-content">
			<!---------- tab 1 pilih kendaraan -------------->			
			<div class="tab-pane active" id="tab_1">
				<!-- Horizontal Form 
				<div class="box box-info">
					<div class="box-header with-border">-->

       
              <a class="btn btn-app bg-red">
                <i class="fa fa-mail-reply-all" onclick="goBack()" ></i>Kembali
              </a>                   
				<div>
					<!-- form start -->
					<form class="form-horizontal" id="formKejadian" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET['mod']; ?>' method='post' accept-charset='UTF-8'>
<?php
if((isset($_GET['st'])) and ($_GET['st']=="edit"))
{ 
	?>
	<input type='hidden' name='st'  value='edit'/>
	<input type='hidden' name='id'  value='<?php echo $_GET["id"]; ?>'/>
	<?php
}
?>					
					<input type='hidden' name='submitted'  value='1'/>
					<input type='hidden' name='id_user' value='<?php echo $_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user']; ?>'/>
					
					<div><span class='error'><?php $error = $fgmembersite->GetErrorMessageInput(); ?></span></div>
					
					<div class="box-body">
					

					<!---------------------------- Sumber informasi dari tabel tb_sumber_info gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->
						    							
							<div class="col-sm-10 col-sm-offset-2">
								<h4 ><span class="label label-success">SUMBER INFORMASI</span></h4>
							</div>
							
						<div class="form-group <?php if (isset($error['taruna_dari'])){echo 'has-error';} ?>">
							<label for="taruna_dari" class="col-sm-2 control-label">TARUNA DARI</label>
							<div class="col-sm-4">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<select class="form-control" id="taruna_dari" name="taruna_dari" disabled>
	<option value="">--</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="201") {echo "selected"; } ?> value="201" value="201">201</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="203") {echo "selected"; } ?> value="203">203</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="204") {echo "selected"; } ?> value="204">204</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="241") {echo "selected"; } ?> value="241">241</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="223") {echo "selected"; } ?> value="223">223</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="130A") {echo "selected"; } ?> value="130A">130A</option>										
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT210") {echo "selected"; } ?> value="LJT210" >LJT210</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT212") {echo "selected"; } ?> value="LJT212">LJT212</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT213") {echo "selected"; } ?> value="LJT213">LJT213</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="DEREK") {echo "selected"; } ?> value="DEREK">DEREK</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="RESCUE") {echo "selected"; } ?> value="RESCUE">RESCUE</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="AMBULANCE") {echo "selected"; } ?> value="AMBULANCE">AMBULANCE</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="PJR") {echo "selected"; } ?> value="PJR">PJR</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.MANYARAN") {echo "selected"; } ?> value="GT.MANYARAN">GT.MANYARAN</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.TEMBALANG") {echo "selected"; } ?> value="GT.TEMBALANG">GT.TEMBALANG</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.GAYAMSARI") {echo "selected"; } ?> value="GT.GAYAMSARI">GT.GAYAMSARI</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.MUKTIHARJO") {echo "selected"; } ?> value="GT.MUKTIHARJO">GT.MUKTIHARJO</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="WARGA") {echo "selected"; } ?> value="WARGA">WARGA</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="PANTAUAN CCTV") {echo "selected"; } ?> value="PANTAUAN CCTV">PANTAUAN CCTV</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON PENGGUNA JALAN") {echo "selected"; } ?> value="TELPON PENGGUNA JALAN">TELPON PENGGUNA JALAN</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO RASIKA") {echo "selected"; } ?> value="TELPON RADIO RASIKA">TELPON RADIO RASIKA</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO IDOLA") {echo "selected"; } ?> value="TELPON RADIO IDOLA">TELPON RADIO IDOLA</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO RRI") {echo "selected"; } ?> value="TELPON RADIO RRI">TELPON RADIO RRI</option>
	<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO ELSINTA") {echo "selected"; } ?> value="TELPON RADIO ELSINTA">TELPON RADIO ELSINTA</option>
	
									</select>							
								</div>
								<?php if (isset($error['taruna_dari'])){echo '<i><small><span class="help-block">'.$error['taruna_dari'].'</span></small></i>';} ?>
							</div>
						</div>	
<!---------------------------- Jenis Kejadian dari tabel tb_jenis_kejadian gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->
						<div class="form-group <?php if (isset($error['jenis_kejadian'])){echo 'has-error';} ?>">
							<label for="jenis_kejadian" class="col-sm-2 control-label">JENIS KEJADIAN</label>
							<div class="col-sm-5">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-th-list"></i>
									</div>
									<select class="form-control" id="jenis_kejadian" name="jenis_kejadian" disabled>
	<option value="">--</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="3-3") {echo "selected"; } ?> value="3-3">3-3 / KECELAKAAN</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="MOGOK MESIN") {echo "selected"; } ?> value="MOGOK MESIN">MOGOK MESIN / RADIATOR / SELANG</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="BBM") {echo "selected"; } ?> value="BBM">BBM / BENSIN / SOLAR</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="RODA") {echo "selected"; } ?> value="RODA">RODA / KOPLING / UNDERSTAIL</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="BAN") {echo "selected"; } ?> value="BAN">BAN BOCOR</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="MUATAN TIDAK TERTIB") {echo "selected"; } ?> value="MUATAN TIDAK TERTIB">MUATAN TIDAK TERTIB</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="KEBAKARAN MOBIL") {echo "selected"; } ?> value="KEBAKARAN MOBIL">KEBAKARAN MOBIL</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="TARIK MENARIK") {echo "selected"; } ?> value="TARIK MENARIK">TARIK MENARIK</option>
	<option <?php if($fgmembersite->SafeDisplay('jenis_kejadian')=="LAIN2") {echo "selected"; } ?> value="LAIN2">LAIN2</option>
									</select>
								</div>
								<?php if (isset($error['jenis_kejadian'])){echo '<i><small><span class="help-block">'.$error['jenis_kejadian'].'</span></small></i>';} ?>
							</div>							
						</div>	
<!---------------------------- KAMTIB dari tabel tb_kamtib gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->
						<div class="form-group <?php if (isset($error['kamtib'])){echo 'has-error';} ?>">							
							<label for="kamtib" class="col-sm-2 control-label">KAMTIB</label>
							<div class="col-sm-5">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-check-square"></i>
									</div>
									<select class="form-control" id="kamtib" name="kamtib" disabled>
<option value="">--</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="4-4") {echo "selected"; } ?> value="4-4">4-4 / ORANG GILA</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="JALAN BERLUBANG") {echo "selected"; } ?> value="JALAN BERLUBANG">JALAN BERLUBANG</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="SUPORTER BOLA") {echo "selected"; } ?> value="SUPORTER BOLA">SUPORTER BOLA</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="ORANG MABUK") {echo "selected"; } ?> value="ORANG MABUK">ORANG MABUK</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="PEJALAN KAKI") {echo "selected"; } ?> value="PEJALAN KAKI">PEJALAN KAKI</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="RODA DUA") {echo "selected"; } ?> value="RODA DUA">RODA DUA / KANCIL / SEPEDA</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="PENYEBRANG") {echo "selected"; } ?> value="PENYEBRANG">PENYEBRANG</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="DEMO") {echo "selected"; } ?> value="DEMO">DEMO</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="KEBAKARAN ILALANG") {echo "selected"; } ?> value="KEBAKARAN ILALANG">KEBAKARAN ILALANG</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="TERNAK") {echo "selected"; } ?> value="TERNAK">TERNAK</option>
<option <?php if($fgmembersite->SafeDisplay('kamtib')=="LAIN2") {echo "selected"; } ?> value="LAIN2">LAIN2</option>
									</select>
								</div>
								<?php if (isset($error['kamtib'])){echo '<i><small><span class="help-block">'.$error['kamtib'].'</span></small></i>';} ?>
							</div>
						</div>
                <hr/>

<!---------------------------- KETERANGAN KENDAAAN FORM INPUT TEK AJA GAN, JENIS KENDARAAN DAN NOMOR POLISI ---------------------------->
				
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
								<h4 ><span class="label label-success  ">KETERANGAN KENDARAAN</span></h4>
							</div>
						</div>
						<div class="form-group <?php if (isset($error['jenis_kendaraan'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan" class="col-sm-2 control-label">Jenis Kendaraan</label>

							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan" value="<?php echo $fgmembersite->SafeDisplay('jenis_kendaraan'); ?>" disabled>						
								</div>
								<?php if (isset($error['jenis_kendaraan'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan'].'</span></small></i>';} ?>
							</div>
						<div class="form-group <?php if (isset($error['nopol'])){echo 'has-error';} ?>">
							<label for="nopol" class="col-sm-2 control-label">No Polisi</label>

							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa  fa-cc-paypal"></i>
									</div>
									<input type="text" class="form-control" name="nopol" value="<?php echo $fgmembersite->SafeDisplay('nopol'); ?>" disabled>						
								</div>
								<?php if (isset($error['nopol'])){echo '<i><small><span class="help-block">'.$error['nopol'].'</span></small></i>';} ?>
							</div>
						</div>								
						</div>
						
					<!------------------ KOLOM KILOMETER BUATKAN INPUT TEPISAH TIGA KOLOM GAN, DIBUATKAN SCRIP GABUNG SATU KOLOM TABEL ------------------->
                    
<!---------------------------- KILOMETER dari tabel tb_km gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->				
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
								<h4 ><span class="label label-default ">KILOMETER</span></h4>
							</div>
						</div>					
						<div class="form-group <?php if (isset($error['km'])){echo 'has-error';} ?>">
							<label for="km" class="col-sm-2 control-label">KM</label>

							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</div>
                                    <select class="form-control" id="km" name="km" disabled>
                                        <option value="">--</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Manyaran") {echo "selected"; } ?> value="GT.Manyaran">GT.Manyaran</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Tembalang") {echo "selected"; } ?> value="GT.Tembalang">GT.Tembalang</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Gayamsari") {echo "selected"; } ?> value="GT.Gayamsari">GT.Gayamsari</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Muktiharjo") {echo "selected"; } ?> value="GT.Muktiharjo">GT.Muktiharjo</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="00") {echo "selected"; } ?> value="00">00</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="01") {echo "selected"; } ?> value="01">01</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="02") {echo "selected"; } ?> value="02">02</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="03") {echo "selected"; } ?> value="03">03</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="04") {echo "selected"; } ?> value="04">04</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="05") {echo "selected"; } ?> value="05">05</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="06") {echo "selected"; } ?> value="06">06</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="07") {echo "selected"; } ?> value="07">07</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="08") {echo "selected"; } ?> value="08">08</option>	
										<option <?php if($fgmembersite->SafeDisplay('km')=="09") {echo "selected"; } ?> value="09">09</option>	
										<option <?php if($fgmembersite->SafeDisplay('km')=="10") {echo "selected"; } ?> value="10">10</option>	
										<option <?php if($fgmembersite->SafeDisplay('km')=="11") {echo "selected"; } ?> value="11">11</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="12") {echo "selected"; } ?> value="12">12</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="13") {echo "selected"; } ?> value="13">13</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="14") {echo "selected"; } ?> value="14">14</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="15") {echo "selected"; } ?> value="15">15</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="16") {echo "selected"; } ?> value="16">16</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="17") {echo "selected"; } ?> value="17">17</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="18") {echo "selected"; } ?> value="18">18</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="19") {echo "selected"; } ?> value="19">19</option>													
									</select>				
								</div>
								<?php if (isset($error['km'])){echo '<i><small><span class="help-block">'.$error['km'].'</span></small></i>';} ?>
							</div>	
							
<!---------------------------- METER + dari tabel tb_km gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->								
							
						<label for="meter" class="col-sm-2 control-label">METER +</label>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-plus-square"></i>
									</div>
                                    <select class="form-control" id="meter" name="meter" disabled>
<option value="">--</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+000") {echo "selected"; } ?>  value="+000">+000</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+050") {echo "selected"; } ?>  value="+050">+050</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+100") {echo "selected"; } ?>  value="+100">+100</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+150") {echo "selected"; } ?>  value="+150">+150</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+200") {echo "selected"; } ?>  value="+200">+200</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+250") {echo "selected"; } ?>  value="+250">+250</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+300") {echo "selected"; } ?>  value="+300">+300</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+350") {echo "selected"; } ?>  value="+350">+350</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+400") {echo "selected"; } ?>  value="+400">+400</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+450") {echo "selected"; } ?>  value="+450">+450</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+500") {echo "selected"; } ?>  value="+500">+500</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+550") {echo "selected"; } ?>  value="+550">+550</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+600") {echo "selected"; } ?>  value="+600">+600</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+650") {echo "selected"; } ?>  value="+650">+650</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+700") {echo "selected"; } ?>  value="+700">+700</option>
<option <?php if($fgmembersite->SafeDisplay('meter')=="+750") {echo "selected"; } ?>  value="+750">+750</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+800") {echo "selected"; } ?>  value="+800">+800</option>	
<option <?php if($fgmembersite->SafeDisplay('meter')=="+850") {echo "selected"; } ?>  value="+850">+850</option>										
<option <?php if($fgmembersite->SafeDisplay('meter')=="+900") {echo "selected"; } ?>  value="+900">+900</option>											
<option <?php if($fgmembersite->SafeDisplay('meter')=="+950") {echo "selected"; } ?>  value="+950">+950</option>										
									</select>				
								</div>
								<?php if (isset($error['meter'])){echo '<i><small><span class="help-block">'.$error['meter'].'</span></small></i>';} ?>
							</div>

<!---------------------------- SEKSI AMBIL dari tabel tb_km_seksi gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->	
							
							<label for="seksi" class="col-sm-2 control-label">SEKSI</label>	
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-road"></i>
									</div>
                                    <select class="form-control" id="seksi" name="seksi" disabled>
                                        <option value="">--</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="A/A") {echo "selected"; } ?>  value="A/A">A/A</option>										
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="A/B") {echo "selected"; } ?> value="A/B">A/B</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="A/C") {echo "selected"; } ?> value="A/C">A/C</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="B/A") {echo "selected"; } ?> value="B/A">B/A</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="B/B") {echo "selected"; } ?> value="B/B">B/B</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="B/C") {echo "selected"; } ?> value="B/C">B/C</option>										
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="C/A") {echo "selected"; } ?> value="C/A">C/A</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="C/B") {echo "selected"; } ?> value="C/B">C/B</option>										
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="C/C") {echo "selected"; } ?> value="C/C">C/C</option>												
									</select>				
								</div>
								<?php if (isset($error['seksi'])){echo '<i><small><span class="help-block">'.$error['seksi'].'</span></small></i>';} ?>
							</div>								
						</div>
						
						<hr/>
						<div id="tlp-area">
					<!------------------ SUMBER INFORMASI INI JUGA AMBIL DARI DATABASE AJA GAN ------------------->	
<!---------------------------- WAKTU range antar jam ambil dari tabel tb_waktu gan, dan di menu manager ditambahkan CRUD tabelnya ---------------------------->						
						<div class="row">							
							<div class="col-sm-2 col-sm-offset-2">
								<h4 ><span class="label label-success">RENTANG WAKTU</span></h4>
							</div>
							<div class="col-sm-2 col-sm-offset-2">
								<h4 ><span class="label label-danger ">KEPERLUAN TELPON</span></h4>
							</div>						
						</div>	
					
						<div class="form-group <?php if (isset($error['waktu'])){echo 'has-error';} ?>">
							<label for="waktu" class="col-sm-2 control-label">TELPON DITERIMA</label>

							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="glyphicon glyphicon-time"></i>
									</div>
									<select class="form-control" id="waktu" name="waktu" disabled >
<option value="">--</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="06:00-07:00") {echo "selected"; } ?> value="06:00-07:00">06:00-07:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="07:00-08:00") {echo "selected"; } ?> value="07:00-08:00">07:00-08:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="08:00-09:00") {echo "selected"; } ?> value="08:00-09:00">08:00-09:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="09:00-10:00") {echo "selected"; } ?> value="09:00-10:00">09:00-10:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="10:00-11:00") {echo "selected"; } ?> value="10:00-11:00">10:00-11:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="11:00-12:00") {echo "selected"; } ?> value="11:00-12:00">11:00-12:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="12:00-13:00") {echo "selected"; } ?> value="12:00-13:00">12:00-13:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="13:00-14:00") {echo "selected"; } ?> value="13:00-14:00">13:00-14:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="14:00-15:00") {echo "selected"; } ?> value="14:00-15:00">14:00-15:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="15:00-16:00") {echo "selected"; } ?> value="15:00-16:00">15:00-16:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="16:00-17:00") {echo "selected"; } ?> value="16:00-17:00">16:00-17:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="17:00-18:00") {echo "selected"; } ?> value="17:00-18:00">17:00-18:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="18:00-19:00") {echo "selected"; } ?> value="18:00-19:00">18:00-19:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="19:00-20:00") {echo "selected"; } ?> value="19:00-20:00">19:00-20:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="20:00-21:00") {echo "selected"; } ?> value="20:00-21:00">20:00-21:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="21:00-22:00") {echo "selected"; } ?> value="21:00-22:00">21:00-22:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="22:00-23:00") {echo "selected"; } ?> value="22:00-23:00">22:00-23:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="23:00-00:00") {echo "selected"; } ?> value="23:00-00:00">23:00-00:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="00:00-01:00") {echo "selected"; } ?> value="00:00-01:00">00:00-01:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="01:00-02:00") {echo "selected"; } ?> value="01:00-02:00">01:00-02:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="02:00-03:00") {echo "selected"; } ?> value="02:00-03:00">02:00-03:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="03:00-04:00") {echo "selected"; } ?> value="03:00-04:00">03:00-04:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="04:00-05:00") {echo "selected"; } ?> value="04:00-05:00">04:00-05:00</option>
<option <?php if($fgmembersite->SafeDisplay('waktu')=="05:00-06:00") {echo "selected"; } ?> value="05:00-06:00">05:00-06:00</option>										
									</select>							
								</div>
								<?php if (isset($error['waktu'])){echo '<i><small><span class="help-block">'.$error['waktu'].'</span></small></i>';} ?>
							</div>
							
							<label for="keperluan" class="col-sm-2 control-label">KEPERLUAN TELPON</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-list-alt"></i>
									</div>
									<select class="form-control" id="keperluan" name="keperluan" disabled>
<option value="">--</option>
<option <?php if($fgmembersite->SafeDisplay('keperluan')=="MEMBERI INFORMASI") {echo "selected"; } ?> value="MEMBERI INFORMASI">MEMBERI INFORMASI</option>
<option <?php if($fgmembersite->SafeDisplay('keperluan')=="MINTA BANTUAN") {echo "selected"; } ?> value="MINTA BANTUAN">MINTA BANTUAN</option>
<option <?php if($fgmembersite->SafeDisplay('keperluan')=="MINTA INFORMASI") {echo "selected"; } ?> value="MINTA INFORMASI">MINTA INFORMASI</option>
<option <?php if($fgmembersite->SafeDisplay('keperluan')=="PENGADUAN / KELUHAN") {echo "selected"; } ?> value="PENGADUAN / KELUHAN">PENGADUAN / KELUHAN</option>
<option <?php if($fgmembersite->SafeDisplay('keperluan')=="SUMBANG SARAN") {echo "selected"; } ?> value="SUMBANG SARAN">SUMBANG SARAN</option>
<option <?php if($fgmembersite->SafeDisplay('keperluan')=="LAIN-LAIN") {echo "selected"; } ?> value="LAIN-LAIN">LAIN-LAIN</option>							
									</select>				
								</div>
								<?php if (isset($error['keperluan'])){echo '<i><small><span class="help-block">'.$error['keperluan'].'</span></small></i>';} ?>
							</div>
						</div>
						
												<hr/>
												</div>
												<div id="non-tlp-area">
					<!------------------  Judul WAKTU 1, WAKTU 2, WAKTU 3 DAN RESPOND TIMES ------------------->						
						<div class="row">							
							<div class="col-sm-3 col-sm-offset-2">
								<h4 ><span class="label label-success">INFO DITERIMA (T1)</span></h4>
							</div>
					<!------------------
							<div class="col-sm-2 col-sm-offset-2">
								<h4 ><span class="label label-success">TIBA DI LOKASI (T2)</span></h4>
							</div>	
							<div class="col-sm-2 col-sm-offset-2">
								<h4 ><span class="label label-success">SELESAI (T3)</span></h4>
							</div>
					------------------->		
						</div>							

					
					<!------------------  Fungsi WAKTU 1, WAKTU 2, WAKTU 3 DAN RESPOND TIMES ------------------->						
						<div class="form-group <?php if (isset($error['waktu1'])){echo 'has-error';} ?>">
						
							<label for="waktu1" class="col-sm-2 control-label "></label>
							<div class="col-sm-3 ">
								<div class="input-group bootstrap-timepicker ">
									<div class="input-group-addon ">
										<i class="glyphicon glyphicon-time"></i>
									</div>
									<input type="text" class="form-control timepicker " id="waktu1" name="waktu1" value="<?php echo $fgmembersite->SafeDisplay('waktu1'); ?>" disabled >
                                <div></div>									
								</div>
								<?php if (isset($error['waktu1'])){echo '<i><small><span class="help-block">'.$error['waktu1'].'</span></small></i>';} ?>
							</div>
							
						</div>	
						<hr/>
						</div>
						
<!-- Button trigger modal -->
<div class="row">
<div class="col-lg-12">
<h4 ><span class="label label-success">Keterangan Petugas Terlibat</span></h4>

<!--
<button type="button" id="showdata" class="btn btn-success" >
	<i class="fa fa-plus"></i> show data
</button>
-->
</div>
</div>
<br>
<div class="row">
<div class="box-body">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div id="buattest"></div>
<div class="table-responsive">
<table id="table-petugas-tambahan" class="table table-bordered table-striped">
<thead>
	<tr>
		<th style="width: 10px">No</th>
		<th>Petugas Terlibat</th>
		<th >Info Diterima (T1)</th>
		<th >Tiba Di Lokasi (T2)</th>
		<th >Respond Times (T3)</th>

		
		
	</tr>
</thead>
                <tbody>
				<?php
				#echo "<pre>";
		#print_r($_POST);
		#echo "</pre>";
		
				if (isset($_POST["petugas"]))
				{
					$a = 1;
					foreach( $_POST["petugas"] as $key => $n ) 
					{
						?>
						<tr>
	<td><?php echo $a; ?></td>
	<td align="center"><input type='hidden' readonly='true' name='petugas[]' value='<?php echo $_POST["petugas"][$key]; ?>' ><?php echo $_POST["petugas"][$key]; ?></td>
	<td align="center"><input type='hidden' readonly='true' name='t1table[]' value='<?php echo $_POST["t1table"][$key]; ?>' ><?php echo $_POST["t1table"][$key]; ?></td>	
	<td align="center"><input type='hidden' readonly='true' name='t2table[]' value='<?php echo $_POST["t2table"][$key]; ?>' ><?php echo $_POST["t2table"][$key]; ?></td>
	<td align="center"><input type='hidden' readonly='true' name='t3table[]' value='<?php echo $_POST["t3table"][$key]; ?>' ><?php echo $_POST["t3table"][$key]; ?></td>
	
</tr>
<?php
$a++;
						/*
						print "The name is ".$n." and email is ".$key.", ".$_POST["t1"][$key]."thank you\n";
						$inputsub = array(
							'id_detail_laporan'=>$id_detail,
							'petugas'=>$_POST["petugas"][$key],
							'waktu_sub_1'=>$_POST["t1"][$key],
							'waktu_sub_2'=>$_POST["t2"][$key],
							'waktu_sub_3'=>$_POST["t3"][$key]
						);
						$this->insert('tb_sub_detail_laporan',$inputsub);
						*/
					}
				}
				?>
				<!--
<tr>
	<td>1.</td>
	<td align="center">LJT 212</td>
	<td align="center">00:00:00</td>	
	<td align="center">00:00:00</td>
	<td align="center">00:00:00</td>
	<td align="center"><input type='text' name="test[56]" value='test aja'></td>
<td>
	<button type="button" class="btn bg-maroon  btn-flat"><i class="fa fa-trash"></i></button>
</td>
</tr>
-->
</tbody>
</table>
</div>
</div>

<script>
  $(function () {
    
    var table = $('#table-petugas-tambahan').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
	  'responsive': true,
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 1 },
			{ "orderable": true, "targets": 2 },
			{ "orderable": true, "targets": 3 }
		],
		"columns": [
           /*
		   {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
			*/
            { "data": "no" },
            { "data": "petugas" },
            { "data": "t1" },
            { "data": "t2" },
			{ "data": "t3" },			
			{ "data": "btn" }
        ],
    });


// Delete from table use row
$('#table-petugas-tambahan tbody').on( 'click', 'button', function () 
{	
	var row = table.row( $(this).parents('tr') );	
	row.remove().draw( false );
});

	
	$( "#tlp-area" ).hide();
	//timeKejadianForm
	$( "#timeKejadianForm" ).submit(function( event ) 
	{
		//alert($('#taruna_dari_modal').find(':selected').data('value'));
		//alert( "Handler for .submit() called." );
		event.preventDefault();
		no = table.data().count();
		//alert(no);
		//table.row.add( $('<tr><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>') ).draw();
		table.row.add( {
        "no":       (no + 1),
        "petugas":   "<input type='hidden' readonly='true' name='petugas[]' value='"+$( "#taruna_dari_modal" ).val()+"' >"+$( "#taruna_dari_modal" ).val(),
        "t1": "<input type='hidden' readonly='true' name='t1table[]' value='"+$( "#t1" ).val()+"' >"+$( "#t1" ).val(),
        "t2": "<input type='hidden' readonly='true' name='t2table[]' value='"+$( "#t2" ).val()+"' >"+$( "#t2" ).val(),
        "t3": "<input type='hidden' readonly='true' name='t3table[]' value='"+$( "#t3" ).val()+"' >"+$( "#t3" ).val(),
        "btn": "<button type='button' class='btn bg-maroon  btn-flat'><i class='fa fa-trash'></i></button>"
		} ).draw();
	
		$('#exampleModal').modal('toggle');
	
	});
	
	/*
	$('#table-petugas-tambahan tbody').on( 'click', 'tr', function () {
    var rowData = table.row( this ).data();
	alert(rowData["petugas"]);
	var cellData = table.cell( this ).data();
	alert(cellData);
});
*/
/*
	$( "#showdata" ).click(function() 
	{
		var data = table.rows().data();
 
alert( 'The table has '+data.length+' records' );

var testData = table.data().toArray();
alert("ada data " + testData[2]);
$('#buattest').html(testData.toString);
//var rows = table.rows( 0 ).data();
 
//alert( 'Pupil name in the first row is: '+ rows[0].petugas() );

		var data = table.$('input, select').serialize();
		alert(data);
		table.rows().every( function () {
    var data = this.data();
	alert(data);
    // ... do something with data(), or this.node(), etc
} );
	//	alert("Ada");
		//var data = table.rows().data();
	 
		 /*
		 foreach (DataRow dr in table.Rows)
		{
		   string col1 =  dr["col1"].ToString();
		   string col2 = dr["col2"].ToString();
		}
		*/
		//alert( 'The table has '+data.Rows[0][0]);
		//alert( 'The table has '+data.length+' records' );
	//});
	
	$( "#taruna_dari" ).change(function() 
	{
		val = $(this).val();	
		if (val == "TELPON PENGGUNA JALAN")
		{
			$( "#non-tlp-area" ).hide();
			$( "#tlp-area" ).show();
		}
		else
		{
			$( "#non-tlp-area" ).show();
			$( "#tlp-area" ).hide();
		}
		
	});
	
  });
</script>
<script>
$(function()
{
	
})
</script>
<style>
#table-petugas-tambahan{
    background-color:#eee;
}
</style>
						
					<?php 
				?>						
						<hr/>
					<!------------------ SUMBER INFORMASI INI JUGA AMBIL DARI DATABASE AJA GAN ------------------->						
						<div class="row">							

							<div class="col-sm-2 col-sm-offset-2">
								<h4 ><span class="label label-danger ">JUMLAH KORBAN</span></h4>
							</div>
							<div class="col-sm-2 col-sm-offset-2">
								<h4 ><span class="label label-warning ">KERUGIAN</span></h4>
							</div>							
						</div>	
					
						<div class="form-group <?php if (isset($error['33lb'])){echo 'has-error';} ?>">

							
							<label for="33lb" class="col-sm-2 control-label">3-3 LUKA BERAT</label>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-ambulance"></i>
									</div>
									<input type="text" class="form-control" name="33lb" value="<?php echo $fgmembersite->SafeDisplay('33lb'); ?>" disabled>						
								</div>
								<?php if (isset($error['33lb'])){echo '<i><small><span class="help-block">'.$error['33lb'].'</span></small></i>';} ?>
							</div>
					
			
							<label for="sarana" class="col-sm-2 control-label">SARANA</label>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-birthday-cake"></i>
									</div>
									<input type="text" class="form-control" name="sarana" value="<?php echo $fgmembersite->SafeDisplay('sarana'); ?>" disabled>						
								</div>
								<?php if (isset($error['sarana'])){echo '<i><small><span class="help-block">'.$error['sarana'].'</span></small></i>';} ?>
							</div>
					
							
						</div>
						
						<div class="form-group <?php if (isset($error['33lr'])){echo 'has-error';} ?>">


							<label for="33lr" class="col-sm-2 control-label">3-3 LUKA RINGAN</label>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-ambulance"></i>
									</div>
									<input type="text" class="form-control" name="33lr" value="<?php echo $fgmembersite->SafeDisplay('33lr'); ?>" disabled>						
								</div>
								<?php if (isset($error['33lr'])){echo '<i><small><span class="help-block">'.$error['33lr'].'</span></small></i>';} ?>
							</div>
							<label for="materi" class="col-sm-2 control-label">MATERI Rp</label>
							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-money"></i>
									</div>
									<input type="text" class="form-control" name="materi" value="<?php echo $fgmembersite->SafeDisplay('materi'); ?>" disabled>						
								</div>
								<?php if (isset($error['materi'])){echo '<i><small><span class="help-block">'.$error['materi'].'</span></small></i>';} ?>
							</div>							
						</div>
						
						
						<div class="form-group <?php if (isset($error['33mg'])){echo 'has-error';} ?>">

							<label for="33mg" class="col-sm-2 control-label">3-3 MENINGGAL</label>

							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-ambulance"></i>
									</div>
									<input type="text" class="form-control" name="33mg" value="<?php echo $fgmembersite->SafeDisplay('33mg'); ?>" disabled>						
								</div>
								<?php if (isset($error['33mg'])){echo '<i><small><span class="help-block">'.$error['33mg'].'</span></small></i>';} ?>
							</div>						
						</div>		
						<hr/>
					<!------------------ KENDARAAN TERLIBAT DAN NOMOR POLISI 1 SAMPAI 5 KENDARAAN ------------------->							
						<div class="row">
						
							<div class="col-sm-3 col-sm-offset-3">
								<h4 ><span class="label label-success  ">KENDARAAN TERLIBAT </span></h4>
							</div>
							
							<div class="col-sm-3 col-sm-offset-3">
								<h4 ><span class="label label-success  ">NOMOR POLISI</span></h4>
							</div>							
						</div>
					<!------------------ KENDARAAN TERLIBAT 1 DAN NOMOR POLISI 1 ------------------->							
						<div class="form-group <?php if (isset($error['jenis_kendaraan1'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan1" class="col-sm-3 control-label">JENIS KENDARAAN 1</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan1" value="<?php echo $fgmembersite->SafeDisplay('jenis_kendaraan1'); ?>" disabled>						
								</div>
								<?php if (isset($error['jenis_kendaraan1'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan1'].'</span></small></i>';} ?>
							</div>
							<label for="nopol1" class="col-sm-3 control-label">NOMOR POLISI 1</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="nopol1" value="<?php echo $fgmembersite->SafeDisplay('nopol1'); ?>" disabled>						
								</div>
								<?php if (isset($error['nopol1'])){echo '<i><small><span class="help-block">'.$error['nopol1'].'</span></small></i>';} ?>
							</div>
						</div>
					<!------------------ KENDARAAN TERLIBAT 2 DAN NOMOR POLISI 2 ------------------->							
						<div class="form-group <?php if (isset($error['jenis_kendaraan2'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan2" class="col-sm-3 control-label">JENIS KENDARAAN 2</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan2" value="<?php echo $fgmembersite->SafeDisplay('jenis_kendaraan2'); ?>" disabled>						
								</div>
								<?php if (isset($error['jenis_kendaraan2'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan2'].'</span></small></i>';} ?>
							</div>
							<label for="nopol2" class="col-sm-3 control-label">NOMOR POLISI 2</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="nopol2" value="<?php echo $fgmembersite->SafeDisplay('nopol2'); ?>" disabled>						
								</div>
								<?php if (isset($error['nopol2'])){echo '<i><small><span class="help-block">'.$error['nopol2'].'</span></small></i>';} ?>
							</div>							
						</div>											
					<!------------------ KENDARAAN TERLIBAT 3 DAN NOMOR POLISI 3 ------------------->							
						<div class="form-group <?php if (isset($error['jenis_kendaraan3'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan3" class="col-sm-3 control-label">JENIS KENDARAAN 3</label>

							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan3" value="<?php echo $fgmembersite->SafeDisplay('jenis_kendaraan3'); ?>" disabled>						
								</div>
								<?php if (isset($error['jenis_kendaraan3'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan3'].'</span></small></i>';} ?>
							</div>
							<label for="nopol3" class="col-sm-3 control-label">NOMOR POLISI 3</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="nopol3" value="<?php echo $fgmembersite->SafeDisplay('nopol3'); ?>" disabled>						
								</div>
								<?php if (isset($error['nopol3'])){echo '<i><small><span class="help-block">'.$error['nopol3'].'</span></small></i>';} ?>
							</div>							
						</div>	
					<!------------------ KENDARAAN TERLIBAT 4 DAN NOMOR POLISI 4 ------------------->							
						<div class="form-group <?php if (isset($error['jenis_kendaraan4'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan4" class="col-sm-3 control-label">JENIS KENDARAAN 4</label>

							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan4" value="<?php echo $fgmembersite->SafeDisplay('jenis_kendaraan4'); ?>" disabled>						
								</div>
								<?php if (isset($error['jenis_kendaraan4'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan4'].'</span></small></i>';} ?>
							</div>
							<label for="nopol4" class="col-sm-3 control-label">NOMOR POLISI 4</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="nopol4" value="<?php echo $fgmembersite->SafeDisplay('nopol4'); ?>" disabled>						
								</div>
								<?php if (isset($error['nopol4'])){echo '<i><small><span class="help-block">'.$error['nopol4'].'</span></small></i>';} ?>
							</div>							
						</div>							
					<!------------------ KENDARAAN TERLIBAT 5 DAN NOMOR POLISI 5 ------------------->							
						<div class="form-group <?php if (isset($error['jenis_kendaraan5'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan5" class="col-sm-3 control-label">JENIS KENDARAAN 5</label>

							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan5" value="<?php echo $fgmembersite->SafeDisplay('jenis_kendaraan5'); ?>" disabled>						
								</div>
								<?php if (isset($error['jenis_kendaraan5'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan5'].'</span></small></i>';} ?>
							</div>
							<label for="nopol5" class="col-sm-3 control-label">NOMOR POLISI 5</label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="nopol5" value="<?php echo $fgmembersite->SafeDisplay('nopol5'); ?>" disabled>						
								</div>
								<?php if (isset($error['nopol5'])){echo '<i><small><span class="help-block">'.$error['nopol5'].'</span></small></i>';} ?>
							</div>							
						</div>						
					  
												
						<hr/>
						
						
						
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
							
								<h4 ><span class="label label-success  ">KETERANGAN</span></h4>
								
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['keterangan'])){echo 'has-error';} ?>">
							<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan ..." disabled ><?php echo $fgmembersite->SafeDisplay('keterangan'); ?></textarea>					
								</div>
								<?php if (isset($error['keterangan'])){echo '<i><small><span class="help-block">'.$error['keterangan'].'</span></small></i>';} ?>
							</div>
						</div>
						
						
					  </div>
					  <!-- /.box-body -->
					  <div class="box-footer">
						<div class="form-group margin-bottom-none">
							<div class="col-sm-10 col-sm-offset-2">

							</div>	
						</div>					  
						
						
					  </div>
					  <!-- /.box-footer -->
					</form>
				  </div>
				   </div>
				   </div>
				  <!-- /.box -->
		  
			</div>
			<!------------- /.tab-pane ------------------------->
			<!---------- tab 2 pilih kendaraan -------------->			
			<div class="tab-pane" id="tab_2">
				<!-- Pencarian box 
				<div class="box">
					<div class="box-header with-border">-->
				<div class="box box-primary box-solid">
					<div class="box-header ">
						<h3 class="box-title">Pencarian Data </h3>
						<!--<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fa fa-times"></i></button>
						</div>
						-->
					</div>
					
					<div class="box-body">
					<form class="form-horizontal" id="caribox" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET['mod']; ?>' method='post' accept-charset='UTF-8'>
					<input type='hidden' name='cari' id='cari' value='1'/>
						<div class="form-group <?php if (isset($error['shift'])){echo 'has-error';} ?>">
							<label for="shift" class="col-sm-2 control-label">Tanggal</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right tanggal" name="tgl" id="datepicker" value="<?php echo $fgmembersite->SafeDisplay('tgl'); ?>">							
								</div>
								<?php if (isset($error['shift'])){echo '<i><small><span class="help-block">'.$error['shift'].'</span></small></i>';} ?>
							</div>
						</div>
						<div class="form-group <?php if (isset($error['perioda'])){echo 'has-error';} ?>">
							<label for="perioda" class="col-sm-2 control-label">Perioda</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<select class="form-control" id="perioda" name="perioda">
										<option value="">--</option>
										<?php									
										$fgmembersite->select('tbl_shift','id_shift,nama_shift','','',''); 
										$res = $fgmembersite->getResult();
										foreach($res as $output)
										{
											if($fgmembersite->SafeDisplay('perioda')==$output['id_shift']){ $a='selected'; }else{$a='';}
											echo '<option value="'.$output['id_shift'].'" '.$a.'>Perioda '.$output['nama_shift'].'</option>';
										}
										?>										
									</select>							
								</div>
								<?php if (isset($error['perioda'])){echo '<i><small><span class="help-block">'.$error['perioda'].'</span></small></i>';} ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" class="btn btn-md btn-success pull-right btn-block" name='Submit' value='Cari'>
								
							</div>
						</div>
					</form>
					</div>
					<!-- /.box-body 
					<div class="box-footer">
								
					</div>
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->
				
				<!-- Pencarian box 
				<div class="box">
					<div class="box-header with-border">
					<style>
					hr { background-color: red; height: 2px; border: 0; }
					</style>-->
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Laporan Harian Petugas PIK</h3>
						<!--<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fa fa-times"></i></button>
						</div>
						-->
					</div>
					<style>
					th {
						background-color: #596468;
						color:#ffffff;
						text-align: center;
					} 
					</style>
					<div class="box-body">
					<div class="table-responsive">
					<?php
					if(isset($_POST['cari']))
					{  		
						$q	="";
						if (isset($_POST['tgl'])and($_POST['tgl']<>""))
						{
							$q .="date(a.tgl_laporan) = '".$_POST['tgl']."'";
						}
						if (isset($_POST['perioda'])and($_POST['perioda']<>""))
						{
							if($q<>""){$q .= ' AND ';}
							$q .="a.perioda = '".$_POST['perioda']."'";
						}
						if($q<>""){$q = ' AND '.$q;}						
						#$sqlh = 'select * from tb_laporan a,tb_pegawai b where a.id_ka_shift=b.id_user and a.tgl_laporan="'.date("Y-m-d").'" and a.id_user="'.$useridglob.'" '.$q;
						$sqlh = 'select * from tb_laporan a,tb_pegawai b where a.id_ka_shift=b.id_user  and a.id_user="'.$useridglob.'" '.$q;
						?>
						<script>
						$(function(){
							$('.nav-tabs a[href="#tab_2"]').tab('show');						   
						});
						</script>
						<?php
						
					}
					else
					{
						$sqlh = 'select * from tb_laporan a,tb_pegawai b where a.id_ka_shift=b.id_user and a.tgl_laporan="'.date("Y-m-d").'" and a.id_user="'.$useridglob.'"';
					}
					#echo $sqlh;
					$fgmembersite->sql($sqlh);
					$resh = $fgmembersite->getResult();
					foreach($resh as $outputh)
					{
						
						?>
						<table class="table table-hover table-bordered table-striped">
						
						<tr>
						<td align="right"><strong>Tanggal</strong></td>
						<td width='1'>:</td>
						<td ><?php echo $outputh['tgl_laporan']; ?></td>						
						</tr>
						<tr>
						<td align="right"><strong>Perioda</strong></td>
						<td width='1'>:</td>						
						<td><span class="label label-danger"><?php echo $outputh['perioda']; ?></span></td>
						</tr>
						<tr>
						<td align="right"><strong>KA Shift</strong></td>
						<td width='1'>:</td>
						<td><?php echo $outputh['name']; ?> (<?php echo $outputh['npp']; ?>)</td>
						</tr>
						</table>
						<hr>
						
						<table class="table table-hover table-bordered table-striped">
						
						<tr >
							<th>NO</th>
							<th>INFO DITERIMA</th>
							<th>WAKTU RESPONSD</th>
							<th>SUMBER INFORMASI</th>
							<th>JENIS KEJADIAN</th>
							<th>KAMTIB</th>
							<th>JENIS KENDARAAN</th>
							<th>NOPOL</th>
							<th>KILOMETER</th>
							<th>Keterangan</th>		
                            <th>EDIT</th>							
						</tr>
						<?php 
						$fgmembersite->select('tb_checklist_sarana','time(tgl) as t1,km_awal,km_akhir',null,'id_kendaraan="LJT212" and date(tgl)="'.$outputh['tgl_laporan'].'" and shift="'.$outputh['perioda'].'"','');
						$resLjt = $fgmembersite->getResult();					
						
						?>
						<tr>
							<td>1</td>								
							<td><?php echo $resLjt[0]['t1']; ?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td align='center'><span class="label label-primary">212</span></td>
							<td>Observasi beat I dgn KM awal: <span class="label label-danger"><?php echo $resLjt[0]['km_awal']; ?></span>	akhir: <span class="label label-danger"><?php echo $resLjt[0]['km_akhir']; ?></span></td>
							<td>Total: <span class="label label-danger"><?php if(($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']) >0) {echo ($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']);}else{echo "0"; } ?> Km.</span></td>
						</tr>
						<?php 
						$fgmembersite->select('tb_checklist_sarana','time(tgl) as t1,km_awal,km_akhir',null,'id_kendaraan="LJT213" and date(tgl)="'.$outputh['tgl_laporan'].'" and shift="'.$outputh['perioda'].'"','');
						$resLjt = $fgmembersite->getResult();					
						
						?>
						<tr>
							<td>2</td>								
							<td><?php echo $resLjt[0]['t1']; ?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td align='center'><span class="label label-success">213</span></td>
							<td>Observasi beat II dgn KM awal: <span class="label label-danger"><?php echo $resLjt[0]['km_awal']; ?></span>	akhir: <span class="label label-danger"><?php echo $resLjt[0]['km_akhir']; ?></span></td>
							<td>Total: <span class="label label-danger"><?php echo ($resLjt[0]['km_akhir']-$resLjt[0]['km_awal']); ?> Km.</span></td>
						</tr>
						<?php
						
						$sqld = 'select * from tb_detail_laporan where id_laporan="'.$outputh['id_laporan'].'"';
						#echo $sqld;
						$fgmembersite->sql($sqld);						
						$resd = $fgmembersite->getResult();			
						$a = 3;
						foreach($resd as $outputd)
						{
							$sqlsub = 'Select * from tb_sub_detail_laporan where id_detail_laporan="'.$outputd["id"].'"';		
							#echo $sqlsub;
							$fgmembersite->sql($sqlsub);
							$rowssub = $fgmembersite->numRows();
							$rowspan = $rowssub + 1;
							
							?>
							<tr>
								<td><?php echo $a; ?></td>
								<td><?php echo $outputd['waktu_1']; ?></td>
								<td>
								<?php 
								if($outputd['taruna_dari']=="LJT212"){ echo $outputd['waktu_4']; }
								else if($outputd['taruna_dari']=="LJT213"){ echo $outputd['waktu_4']; }
								else
								{ echo $outputd['waktu_4']; }
								?>
								</td>
								<td align='center'>
								<?php 
								if($outputd['taruna_dari']=="201"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="203"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="204"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="241"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="223"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="130A"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="LJT210"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="LJT212"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="LJT213"){ echo '<span class="label label-info">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="DEREK"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="RESCUE"){ echo '<span class="label label-danger">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="AMBULANCE"){ echo '<span class="label label-danger">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="PJR"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="GT.MANYARAN"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="GT.TEMBALANG"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="GT.GAYAMSARI"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}								
								if($outputd['taruna_dari']=="GT.MUKTIHARJO"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="WARGA"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}								
								if($outputd['taruna_dari']=="PANTAUAN CCTV"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}																
								if($outputd['taruna_dari']=="TELPON PENGGUNA JALAN"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}								
								if($outputd['taruna_dari']=="TELPON RADIO RASIKA"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}								
								if($outputd['taruna_dari']=="TELPON RADIO IDOLA"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="TELPON RADIO RRI"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="TELPON RADIO ELSINTA"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								?>
								</td>
								<td rowspan="<?php echo $rowspan; ?>"><?php echo $outputd['type_kejadian']; ?> </td>
							    <td rowspan="<?php echo $rowspan; ?>"><?php echo $outputd['kamtib']; ?></td>
								<td rowspan="<?php echo $rowspan; ?>">
								<?php 
								echo $outputd['jenis_kendaraan'];
								/*
								for($a=1;$a<=5;$a++)
								{
									if ($outputd['jenis_kendaraan'.$a]<>""){ echo $outputd['jenis_kendaraan'.$a]."<br>";}
								}
								*/
								?>
								</td>
								<td rowspan="<?php echo $rowspan; ?>">
								<?php 
								echo $outputd['nopol'];
								/*
								for($a=1;$a<=5;$a++)
								{
									if ($outputd['nopol'.$a]<>""){ echo $outputd['nopol'.$a]."<br>"; }
								}
								*/
								?>
								</td>
								<td rowspan="<?php echo $rowspan; ?>"><?php echo $outputd['kilometer']; ?> <?php echo $outputd['meter']; ?> <small><i>(<?php echo $outputd['ruas']; ?>)</i></small></td>
								<td rowspan="<?php echo $rowspan; ?>"><?php echo $outputd['keterangan']; ?></td>
								<td rowspan="<?php echo $rowspan; ?>">
									<a href="index.php?mod=formKejadian&id=<?php echo $outputd["id"]; ?>&st=edit" class="btn bg-maroon  btn-flat" id="<?php echo $outputd["id"]; ?>" ><i class="fa fa-outdent"></i></a>
								</td>
							</tr>
							<?php
							
							
							
							if ($rowssub > 0)
							{
								$ressub = $fgmembersite->getResult();
								#$a = 0;
								$b = 1;
								foreach($ressub as $outputdsub)
								{
									?>
									<tr>
										<td><?php echo $a.".".$b; ?></td>
										<td><?php echo $outputdsub['waktu_sub_1']; ?></td>
										<td><?php echo $outputdsub['waktu_sub_3']; ?></td>
										<td align='center'>
										<?php 
										if($outputdsub['petugas']=="201"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="203"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="204"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="241"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="223"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="130A"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="LJT210"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="LJT212"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="LJT213"){ echo '<span class="label label-info">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="DEREK"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="RESCUE"){ echo '<span class="label label-danger">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="AMBULANCE"){ echo '<span class="label label-danger">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="PJR"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="GT.MANYARAN"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="GT.TEMBALANG"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="GT.GAYAMSARI"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}								
										if($outputdsub['petugas']=="GT.MUKTIHARJO"){ echo '<span class="label label-primary">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="WARGA"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}								
										if($outputdsub['petugas']=="PANTAUAN CCTV"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}																		
										if($outputdsub['petugas']=="TELPON PENGGUNA JALAN"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}								
										if($outputdsub['petugas']=="TELPON RADIO RASIKA"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}								
										if($outputdsub['petugas']=="TELPON RADIO IDOLA"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="TELPON RADIO RRI"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										if($outputdsub['petugas']=="TELPON RADIO ELSINTA"){ echo '<span class="label label-warning">'.$outputdsub['petugas'].'</span>';}
										?>
										</td>								
									</tr>
									<?php
									$b++;
								}
							}
			
							$a++;
						}
						?>
						</table>
						<?php
					}
					?>
					</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					<?php
					if(isset($_POST['cari']))
					{  		
						$q	="";
						if (isset($_POST['tgl'])and($_POST['tgl']<>""))
						{
							$q .="tgl=".$_POST['tgl']."";
						}
						if (isset($_POST['perioda'])and($_POST['perioda']<>""))
						{
							if($q<>""){$q .= '&';}
							$q .="perioda=".$_POST['perioda']."";
						}
						if($q<>""){$q = '&'.$q;}						
						?>						
						<a href="<?php echo $fgmembersite->sitename; ?>/harianPetugasPikExc.php?cari=<?php echo $_POST['cari'].$q; ?>" class="btn btn-app pull-right" id="xlsexport"> 
							<i class="fa fa-file-excel-o" ></i> Export<span class="badge bg-green">XLS</span>
						</a>						
						<?php						
					}
					else
					{
						?>
						<a href="<?php echo $fgmembersite->sitename; ?>/harianPetugasPikExc.php" class="btn btn-app pull-right" id="xlsexport"> 
							<i class="fa fa-file-excel-o" ></i> Export<span class="badge bg-green">XLS</span>
						</a>
						<?php
					}
					?>						

						<button class="btn btn-app pull-right" id="xlsexport"> 
							<i class="fa fa-print" ></i> Print <span class="badge bg-purple">Print</span>
						</button>
										
					</div>
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->
				

			</div>
		</div>
	</div>
	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<!-- <form class="form-horizontal" id="timeKejadianForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=posisiPetugas' method='post' accept-charset='UTF-8'> -->
<form class="form-horizontal" id="timeKejadianForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=posisiPetugas' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
      <div class="modal-body">
		<div class="form-group <?php if (isset($error['petugas'])){echo 'has-error';} ?>">
			<label for="petugas" class="col-md-3 control-label">Petugas</label>

			<div class="col-md-9">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-car"></i>
					</div>
					<select class="form-control" id="taruna_dari_modal" name="taruna_dari" required>
						<option value="">--</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="201") {echo "selected"; } ?> data-value="201" value="201"  >201</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="203") {echo "selected"; } ?> data-value="203" value="203">203</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="204") {echo "selected"; } ?> data-value="204" value="204">204</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="241") {echo "selected"; } ?> value="241">241</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="223") {echo "selected"; } ?> value="223">223</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="130A") {echo "selected"; } ?> value="130A">130A</option>										
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT210") {echo "selected"; } ?> value="LJT210" >LJT210</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT212") {echo "selected"; } ?> value="LJT212">LJT212</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT213") {echo "selected"; } ?> value="LJT213">LJT213</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="DEREK") {echo "selected"; } ?> value="DEREK">DEREK</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="RESCUE") {echo "selected"; } ?> value="RESCUE">RESCUE</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="AMBULANCE") {echo "selected"; } ?> value="AMBULANCE">AMBULANCE</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="PJR") {echo "selected"; } ?> value="PJR">PJR</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.MANYARAN") {echo "selected"; } ?> value="GT.MANYARAN">GT.MANYARAN</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.TEMBALANG") {echo "selected"; } ?> value="GT.TEMBALANG">GT.TEMBALANG</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.GAYAMSARI") {echo "selected"; } ?> value="GT.GAYAMSARI">GT.GAYAMSARI</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="GT.MUKTIHARJO") {echo "selected"; } ?> value="GT.MUKTIHARJO">GT.MUKTIHARJO</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="WARGA") {echo "selected"; } ?> value="WARGA">WARGA</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="PANTAUAN CCTV") {echo "selected"; } ?> value="PANTAUAN CCTV">PANTAUAN CCTV</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON PENGGUNA JALAN") {echo "selected"; } ?> value="TELPON PENGGUNA JALAN">TELPON PENGGUNA JALAN</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO RASIKA") {echo "selected"; } ?> value="TELPON RADIO RASIKA">TELPON RADIO RASIKA</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO IDOLA") {echo "selected"; } ?> value="TELPON RADIO IDOLA">TELPON RADIO IDOLA</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO RR") {echo "selected"; } ?> value="TELPON RADIO RR">TELPON RADIO RRI</option>
						<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TELPON RADIO ELSINTA") {echo "selected"; } ?> value="TELPON RADIO ELSINTA">TELPON RADIO ELSINTA</option>
					</select>
				</div>
				<?php if (isset($error['petugas'])){echo '<i><small><span class="help-block">'.$error['petugas'].'</span></small></i>';} ?>
			</div>
		</div>
		
		<div class="form-group <?php if (isset($error['t1'])){echo 'has-error';} ?>">
			<label for="t1" class="col-md-3 control-label">INFO DITERIMA (T1)</label>

			<div class="col-md-9">
				<div class="input-group bootstrap-timepicker timepicker">
					<div class="input-group-addon">
						<i class="glyphicon glyphicon-time"></i>
					</div>
					<input type="text" class="form-control timepicker " id="t1" name="t1" value="<?php echo $fgmembersite->SafeDisplay('t1'); ?>" >
				</div>
				<?php if (isset($error['t1'])){echo '<i><small><span class="help-block">'.$error['t1'].'</span></small></i>';} ?>
			</div>
		</div>
		
		<div class="form-group <?php if (isset($error['t2'])){echo 'has-error';} ?>">
			<label for="t2" class="col-md-3 control-label">TIBA DI LOKASI (T2)</label>

			<div class="col-md-9">
				<div class="input-group bootstrap-timepicker timepicker">
					<div class="input-group-addon">
						<i class="glyphicon glyphicon-time"></i>
					</div>
					<input type="text" class="form-control timepicker " id="t2" name="t2" value="<?php echo $fgmembersite->SafeDisplay('t2'); ?>" style="z-index:1151 !important" >
				</div>
				<?php if (isset($error['t2'])){echo '<i><small><span class="help-block">'.$error['t2'].'</span></small></i>';} ?>
			</div>
		</div>
		
		<div class="form-group <?php if (isset($error['t3'])){echo 'has-error';} ?>">
			<label for="t3" class="col-md-3 control-label">RESPOND TIMES (T3)</label>

			<div class="col-md-9">
				<div class="input-group bootstrap-timepicker timepicker">
					<div class="input-group-addon">
						<i class="glyphicon glyphicon-time"></i>
					</div>
					<input type="text" class="form-control timepicker " id="t3" name="t3" value="<?php echo $fgmembersite->SafeDisplay('t3'); ?>" style="z-index:1151 !important" >
				</div>
				<?php if (isset($error['t3'])){echo '<i><small><span class="help-block">'.$error['t3'].'</span></small></i>';} ?>
			</div>
		</div>
			

							
      </div>
	  <!-- // modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<!-- // Modal --> 

    </section>

<script>
function goBack() {
  window.history.back();										}
</script>
<script>
$(function()
{
	
	
//Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
	showSeconds: true,
                showMeridian: false,
				defaultTime: 'current',
				maxHours:24,
				secondStep:1,
    });
	$(".timepicker2").timepicker({
		showInputs: false,
	showSeconds: true,
                showMeridian: false,
				defaultTime: 'current',
				maxHours:24,
				secondStep:1,
		template: 'exampleModal'
    });
	/*
	$(".timepicker2").timepicker({
      showInputs: false,
	showSeconds: true,
                showMeridian: false,
                defaultTime: false
    });
	*/
	$("#waktu2").timepicker({
      showInputs: false,
	showSeconds: true,
                showMeridian: false,
                defaultTime: false,
				//change: function(){alert('changed');}
				/*'onSelect': function() {
           alert('changed')                       
      }*/
    });
	
	$('#waktu2').on('change', function() 
	{
		/*
		//alert($('#waktu1_ljt212').val());
		$.ajax({
			url: 'formKejadian.php',
			data: ({ 'counttime': "1" }),
			//dataType: 'json', 
			type: 'post',
			success: function(data) {
				//alert(data);
				/*
				data=$.trim(data);
				data=data.split("#");
				
				if (data[0]=="True"){
					row.remove().draw( false );
					new PNotify({
						title: 'Success',
						text: data[1],
						type: 'success'
					});
					
				}					
				else
				{
					new PNotify({
						title: 'Error',
						text: data[1],
						type: 'error'
					});
				}
				
			}             
		});
		return false;
		*/
		//alert("change");
		
		var timeOfCall = $('#t1table').val(),
		timeOfResponse = $('#t2table').val(),
		hours = timeOfResponse.split(':')[0] - timeOfCall.split(':')[0],
		minutes = timeOfResponse.split(':')[1] - timeOfCall.split(':')[1];

		if (timeOfCall <= "12:00:00" && timeOfResponse >= "13:00:00")
		{
		a = 1;
		} else {
		a = 0;
		}

		minutes = minutes.toString().length<2?'0'+minutes:minutes;
		if(minutes<0){ 
		hours--;
		minutes = 60 + minutes;        
		}
		hours = hours.toString().length<2?'0'+hours:hours;

		$('#t3table').val(hours-a+ ':' + minutes+':00');
	});
	
	/*
	$('#waktu2_ljt213').on('change', function() 
	{
		
		var timeOfCall = $('#waktu1_ljt213').val(),
		timeOfResponse = $('#waktu2_ljt213').val(),
		hours = timeOfResponse.split(':')[0] - timeOfCall.split(':')[0],
		minutes = timeOfResponse.split(':')[1] - timeOfCall.split(':')[1];

		if (timeOfCall <= "12:00:00" && timeOfResponse >= "13:00:00")
		{
		a = 1;
		} else {
		a = 0;
		}

		minutes = minutes.toString().length<2?'0'+minutes:minutes;
		if(minutes<0){ 
		hours--;
		minutes = 60 + minutes;        
		}
		hours = hours.toString().length<2?'0'+hours:hours;

		$('#waktu4_ljt213').val(hours-a+ ':' + minutes+':00');
	
	
	});
	*/

	
	
});


</script>
<script>
$(function(){
	//Date picker
    $('.tanggal').datepicker({
  format: "yyyy-mm-dd"
});
 
});
</script>
<script>
/*
$(function() {
	$( "#waktu2_ljt212" ).change(function() 
	{
		alert( "Handler for .change() called." );
	});
});
*/
</script>