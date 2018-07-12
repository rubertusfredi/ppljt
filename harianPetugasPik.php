<?PHP
if(isset($_POST['submitted']))
{  
   if($fgmembersite->LaporanPIK())
   {   
	   $fgmembersite->SafeDisplay(null);
	   header("location:index.php?mod=harianPetugasPik");
		?>
	   <script>
		$(function(){
			$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Checklist berhasil di simpan',
			  type: 'success'
		   });
		   $("#harianPetugasPik")[0].reset();
		   
		});
		</script>
		<?php
		
   }
   
}

?>
<?php
$moduleTitle = "Laporan Harian Petugas PIK ";
$moduleDesc = "Menghimpun data informasi dari LJT ";
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small><?php echo $moduleDesc; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li> 
		<li>Laporan PIK </li>		
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">Form Input Laporan</a></li>
			<li><a href="#tab_2" data-toggle="tab">Pencarian Laporan Harian</a></li>
		</ul>
		<div class="tab-content">
			<!---------- tab 1 pilih kendaraan -------------->			
			<div class="tab-pane active" id="tab_1">
				<!-- Horizontal Form 
				<div class="box box-info">
					<div class="box-header with-border">-->
				<div class="">
					<div class="box-header with-border">
					  <h3 class="box-title"></h3><small>&nbsp;</small>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" id="harianPetugasPik" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET['mod']; ?>' method='post' accept-charset='UTF-8'>			
					<input type='hidden' name='submitted'  value='1'/>
					<input type='hidden' name='id_user' value='<?php echo $_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user']; ?>'/>
					<div class="box-body">
						<div class="form-group <?php if (isset($error['tgl_laporan'])){echo 'has-error';} ?>">
							<label for="tgl_laporan" class="col-sm-2 control-label">Tanggal</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right tanggal" name="tgl_laporan" id="tgl_laporan" value="<?php echo date("Y-m-d");#echo $fgmembersite->SafeDisplay('tgl_laporan');?>" readonly required="true" oninvalid="this.setCustomValidity('Tanggal laporan kejadian masih kosong')">							
								</div><i><small><span class="help-block">Format Tanggal (Y-m-d) Ex: 2018-12-31</span></small></i>
								<?php if (isset($error['tgl_laporan'])){echo '<i><small><span class="help-block">'.$error['tgl_laporan'].'</span></small></i>';} ?>
							</div>
						</div>
						<div class="form-group <?php if (isset($error['perioda'])){echo 'has-error';} ?>">
							<label for="perioda" class="col-sm-2 control-label">Perioda</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<select class="form-control" id="perioda" name="perioda" required="true" >
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
						
						<div class="form-group <?php if (isset($error['shift'])){echo 'has-error';} ?>">
							<label for="shift" class="col-sm-2 control-label">KA Shift</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<select class="form-control" id="ka_shift" name="ka_shift" required="true" >
										<option value="">--</option>
										<?php									
										$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="3"','id_user DESC'); 
										$res = $fgmembersite->getResult();
										foreach($res as $output)
										{
											if($fgmembersite->SafeDisplay('ka_shift')==$output['id_user']){ $a='selected'; }else{$a='';}
											echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
										}
										?>
									</select>							
								</div>
								<?php if (isset($error['ka_shift'])){echo '<i><small><span class="help-block">'.$error['ka_shift'].'</span></small></i>';} ?>
							</div>
						</div>
						<hr/>
						<div class="form-group <?php if (isset($error['taruna_dari'])){echo 'has-error';} ?>">
							<label for="shift" class="col-sm-2 control-label">Taruna Dari</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<select class="form-control" id="taruna_dari" name="taruna_dari">
										<option value="">--</option>
										<option value="201">201</option>
										<option value="203">203</option>
										<option value="241">241</option>
										<option value="223">223</option>
										<option value="130A">130A</option>										
										<option value="LJT210">LJT210</option>
										<option value="LJT212">LJT212</option>
										<option value="LJT213">LJT213</option>
										<option value="DEREK">DEREK</option>
										<option value="RESCUE">RESCUE</option>
										<option value="AMBULANCE">AMBULANCE</option>
										<option value="PJR">PJR</option>
										<option value="GT.MANYARAN">GT.MANYARAN</option>
										<option value="GT.TEMBALANG">GT.TEMBALANG</option>
										<option value="GT.GAYAMSARI">GT.GAYAMSARI</option>
										<option value="GT.MUKTIHARJO">GT.MUKTIHARJO</option>
										<option value="Telpon">Telpon</option>							
									</select>							
								</div>
								<?php if (isset($error['taruna_dari'])){echo '<i><small><span class="help-block">'.$error['taruna_dari'].'</span></small></i>';} ?>
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['type_kejadian'])){echo 'has-error';} ?>">

							<label for="type_kejadian" class="col-sm-2 control-label">Type Kejadian</label>
							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<select class="form-control" id="type_kejadian" name="type_kejadian">
										<option value="">--</option>
										<option value="MESIN RUSAK">MESIN RUSAK</option>
										<option value="BBM">BBM</option>
										<option value="RODA">RODA</option>
										<option value="BAN">BAN</option>
										<option value="LAIN2">LAIN2</option>
									</select>
								</div>
								<?php if (isset($error['type_kejadian'])){echo '<i><small><span class="help-block">'.$error['type_kejadian'].'</span></small></i>';} ?>
							</div>
						</div>

						<hr/>
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
							
								<h4 ><span class="label label-success  ">Waktu Taruna</span></h4>
								
							</div>
						</div>
						<div class="form-group <?php if (isset($error['waktu_1'])){echo 'has-error';} ?>">
							<label for="waktu_1" class="col-sm-2 control-label">T 1:  Waktu Taruna</label>

							<div class="col-sm-10 ">
								<div class="input-group bootstrap-timepicker">
									<div class="input-group-addon ">
										<i class="glyphicon glyphicon-time"></i>
									</div>
									<input type="text" class="form-control timepicker " name="waktu_1" value="" >			
								<div class=""></div>
								</div><i><small><span class="help-block">Format Waktu (h:i:s) Ex: 23:22:21</span></small></i>
								<?php if (isset($error['waktu_1'])){echo '<i><small><span class="help-block">'.$error['waktu_1'].'</span></small></i>';} ?>
							</div>
						</div>
						
						
						<div class="form-group <?php if (isset($error['waktu_2'])){echo 'has-error';} ?>">
							<label for="waktu_2" class="col-sm-2 control-label">T 2:  Waktu Taruna</label>

							<div class="col-sm-10 ">
								<div class="input-group bootstrap-timepicker">
									<div class="input-group-addon">
										<i class="glyphicon glyphicon-time"></i>
									</div>
									<input type="text" class="form-control timepicker2" name="waktu_2" value="">						
								</div><i><small><span class="help-block">Format Waktu (jam:menit:detik) contoh: 23:22:21</span></small></i>
								<?php if (isset($error['waktu_2'])){echo '<i><small><span class="help-block">'.$error['waktu_2'].'</span></small></i>';} ?>
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['waktu_3'])){echo 'has-error';} ?>">

							<label for="waktu_3" class="col-sm-2 control-label">Respond Times</label>



							<div class="col-sm-10">

								<div class="input-group bootstrap-timepicker">

									<div class="input-group-addon">

										<i class="glyphicon glyphicon-time"></i>

									</div>

									<input type="text" class="form-control timepicker2" name="waktu_3" value="">						

								</div><i><small><span class="help-block">Total Respond times = T2 - T1</span></small></i>

								<?php if (isset($error['waktu_3'])){echo '<i><small><span class="help-block">'.$error['waktu_3'].'</span></small></i>';} ?>

							</div>

						</div>
						
						
						
						<hr/>
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
								<h4 ><span class="label label-success  ">Kendaraan</span></h4>
							</div>
						</div>
						
						
			  
						<div class="form-group <?php if (isset($error['jenis_kendaraan'])){echo 'has-error';} ?>">
							<label for="jenis_kendaraan" class="col-sm-2 control-label">Jenis Kendaraan</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="jenis_kendaraan" value="">						
								</div>
								<?php if (isset($error['jenis_kendaraan'])){echo '<i><small><span class="help-block">'.$error['jenis_kendaraan'].'</span></small></i>';} ?>
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['nopol'])){echo 'has-error';} ?>">
							<label for="nopol" class="col-sm-2 control-label">No Polisi</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="nopol" value="">						
								</div>
								<?php if (isset($error['nopol'])){echo '<i><small><span class="help-block">'.$error['nopol'].'</span></small></i>';} ?>
							</div>
						</div>												
						
						<hr/>
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
								<h4 ><span class="label label-success  ">Lokasi</span></h4>
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['kilometer'])){echo 'has-error';} ?>">
							<label for="kilometer" class="col-sm-2 control-label">Di Kilometer</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" required="true" name="kilometer" value="">						
								</div>
								<?php if (isset($error['kilometer'])){echo '<i><small><span class="help-block">'.$error['kilometer'].'</span></small></i>';} ?>
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['ruas'])){echo 'has-error';} ?>">
							<label for="ruas" class="col-sm-2 control-label">Ruas</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<input type="text" class="form-control" name="ruas" value="">						
								</div>
								<?php if (isset($error['ruas'])){echo '<i><small><span class="help-block">'.$error['ruas'].'</span></small></i>';} ?>
							</div>
						</div>
						
					  
						<hr/>
						<div class="row">							
							<div class="col-sm-10 col-sm-offset-2">
							
								<h4 ><span class="label label-success  ">Isi Taruna</span></h4>
								
							</div>
						</div>
						<div class="form-group <?php if (isset($error['uraian_kegiatan'])){echo 'has-error';} ?>">
							<label for="uraian_kegiatan" class="col-sm-2 control-label">Uraian Kegiatan</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<textarea class="form-control" rows="6" name="uraian_kegiatan" placeholder="Uraian Kegiatan ..."></textarea>						
								</div>
								<?php if (isset($error['uraian_kegiatan'])){echo '<i><small><span class="help-block">'.$error['uraian_kegiatan'].'</span></small></i>';} ?>
							</div>
						</div>
						
						<div class="form-group <?php if (isset($error['keterangan'])){echo 'has-error';} ?>">
							<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan ..."></textarea>					
								</div>
								<?php if (isset($error['keterangan'])){echo '<i><small><span class="help-block">'.$error['keterangan'].'</span></small></i>';} ?>
							</div>
						</div>
						
						
					  </div>
					  <!-- /.box-body -->
					  <div class="box-footer">
						<div class="form-group margin-bottom-none">
							<div class="col-sm-10 col-sm-offset-2">
								<input type="submit" class="btn btn-danger  btn-md " value="Save">
								<input type="reset" class="btn btn-default  btn-md " value="Cancel">
							</div>	
						</div>					  
						
						
					  </div>
					  <!-- /.box-footer -->
					</form>
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
							<th>T1</th>
							<th>T2</th>
							<th>T3</th>
							<th>Taruna Dari</th>
							<th>Isi Taruna Uraian Kegiatan</th>
							<th>Keterangan</th>					
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
						$fgmembersite->sql($sqld);						
						$resd = $fgmembersite->getResult();			
						$a = 3;
						foreach($resd as $outputd)
						{
							?>
							<tr>
								<td><?php echo $a; ?></td>								
								<td><?php echo $outputd['waktu_1']; ?></td>
								<td><?php echo $outputd['waktu_2']; ?></td>
								<td><?php echo $outputd['waktu_3']; ?></td>
								<td align='center'>
								<?php 
								if($outputd['taruna_dari']=="201"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="203"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="241"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="223"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="130A"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="LJT212"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="LJT213"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="LJT210"){ echo '<span class="label label-info">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="DEREK"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="RESCUE"){ echo '<span class="label label-danger">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="AMBULANCE"){ echo '<span class="label label-danger">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="PJR"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="GT.MANYARAN"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="GT.TEMBALANG"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="GT.GAYAMSARI"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}								
								if($outputd['taruna_dari']=="GT.MUKTIHARJO"){ echo '<span class="label label-primary">'.$outputd['taruna_dari'].'</span>';}
								if($outputd['taruna_dari']=="Telpon"){ echo '<span class="label label-warning">'.$outputd['taruna_dari'].'</span>';}								
								?>
								</td>
								<td><?php echo $outputd['uraian_kegiatan']; ?></td>
								<td><?php echo $outputd['keterangan']; ?></td>
							</tr>
							<?php
							$a++;
						}
						?>
						</table>
						<?php
					}
					?>
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
	
      

    </section>
    <!-- /.content -->
	<script>
$(function(){
	
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
                defaultTime: false
    });
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