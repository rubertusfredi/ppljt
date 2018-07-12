<?php
if(isset($_POST['submitted']))
{ 

	if($fgmembersite->posisiPetugas())
	{   

		$fgmembersite->SafeDisplay(null);
		//header("location:index.php?mod=harianPetugasPik");
		?>
	   <script>
		$(function(){
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Posisi Petugas berhasil di simpan',
			  type: 'success'
		   });
		   //$("#harianPetugasPik")[0].reset();
		   
		});
		</script>
		<?php
		
		
	}
	else
	{
		if (isset($fgmembersite->error_message))
		{
		?>
	   <script>
		$(function(){
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Error!',
			  text: '<?php print_r($fgmembersite->error_message); ?>',
			  type: 'error'
		   });
		   //$("#harianPetugasPik")[0].reset();
		   
		});
		</script>
		<?php
		}
	}
}
		
$moduleTitle = "Posisi Petugas LJT ";
$moduleDesc = "Menampilkan data posisi petugas periode tertentu ";
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small><?php echo $moduleDesc; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li> 
		<li>Laporan LJT </li>		
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

	<form class="form-horizontal" id="absensiForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=posisiPetugas' method='post' accept-charset='UTF-8'>
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<!-- Pencarian box -->
	<div class="box">
		<div>
			<span class='error'>
			<?php 
				$error = $fgmembersite->GetErrorMessageInput();
				 ?>
			</span>
		</div>
		<div class="box-header with-border">
			<h3 class="box-title">Form Input Posisi Petugas LJT</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>

			</div>
		</div>
		
		<div class="box-body">
			<div class="form-group <?php if (isset($error['petugas'])){echo 'has-error';} ?>">
				<label for="petugas" class="col-sm-2 control-label">Petugas</label>

				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-car"></i>
						</div>
						<select class="form-control" id="petugas" name="petugas">
							<option value="">--</option>
							<?php									
							$fgmembersite->select('tb_kendaraan','id_kendaraan,type,jenis','','',''); 
							$res = $fgmembersite->getResult();
							foreach($res as $output)
							{
								if($fgmembersite->SafeDisplay('petugas')==$output['id_kendaraan']){ $a='selected'; }else{$a='';}
								echo '<option value="'.$output['id_kendaraan'].'" '.$a.'>'.$output['jenis'].'</option>';
							}
							?>																	
						</select>
					</div>
					<?php if (isset($error['petugas'])){echo '<i><small><span class="help-block">'.$error['petugas'].'</span></small></i>';} ?>
				</div>
			</div>
			
			<div class="form-group <?php if (isset($error['waktu'])){echo 'has-error';} ?>">
				<label for="waktu" class="col-sm-2 control-label">Waktu</label>
				<div class="col-sm-3 ">		
                                 <div class="input-group">
									<div class="input-group-addon">
										<i class="glyphicon glyphicon-time"></i>
									</div>
									<select class="form-control" id="waktu" name="waktu">
										<option value="">--</option>
										<option value="06:00-07:00">06:00-07:00</option>
										<option value="07:00-08:00">07:00-08:00</option>
										<option value="08:00-09:00">08:00-09:00</option>
										<option value="09:00-10:00">09:00-10:00</option>
										<option value="10:00-11:00">10:00-11:00</option>										
										<option value="11:00-12:00">11:00-12:00</option>
										<option value="12:00-13:00">12:00-13:00</option>
										<option value="13:00-14:00">13:00-14:00</option>
										<option value="14:00-15:00">14:00-15:00</option>
										<option value="15:00-16:00">15:00-16:00</option>
										<option value="16:00-17:00">16:00-17:00</option>
										<option value="17:00-18:00">17:00-18:00</option>
										<option value="18:00-19:00">18:00-19:00</option>
										<option value="19:00-20:00">19:00-20:00</option>
										<option value="20:00-21:00">20:00-21:00</option>
										<option value="21:00-22:00">21:00-22:00</option>
										<option value="22:00-23:00">22:00-23:00</option>
										<option value="23:00-00:00">23:00-00:00</option>
										<option value="00:00-01:00">00:00-01:00</option>
										<option value="01:00-02:00">01:00-02:00</option>
										<option value="02:00-03:00">02:00-03:00</option>
										<option value="03:00-04:00">03:00-04:00</option>
										<option value="04:00-05:00">04:00-05:00</option>
										<option value="05:00-06:00">05:00-06:00</option>										
									</select>							
								</div>						
					<div class=""></div>
					</div>
					<?php if (isset($error['waktu'])){echo '<i><small><span class="help-blo ck">d'.$error['waktu'].'</span></small></i>';} ?>
				</div>
			
			
			<div class="form-group <?php if (isset($error['kilometer'])){echo 'has-error';} ?>">
				<label for="kilometer" class="col-sm-2 control-label">ODO Meter</label>

				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-dashboard"></i>
						</div>
						<input type="text" class="form-control"  name="kilometer" value="<?php echo $fgmembersite->SafeDisplay('kilometer'); ?>">						
					</div>
					<?php if (isset($error['kilometer'])){echo '<i><small><span class="help-block">'.$error['kilometer'].'</span></small></i>';} ?>
				</div>
			</div>
			
			<div class="form-group <?php if (isset($error['10_2'])){echo 'has-error';} ?>">
				<label for="10_2" class="col-sm-2 control-label">10-2</label>

				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<input type="text" class="form-control"  name="10_2" value="<?php echo $fgmembersite->SafeDisplay('10_2'); ?>">						
					</div>
					<?php if (isset($error['10_2'])){echo '<i><small><span class="help-block">'.$error['10_2'].'</span></small></i>';} ?>
				</div>
			</div>
			
			
			<div class="form-group <?php if (isset($error['keterangan'])){echo 'has-error';} ?>">
				<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>

				<div class="col-sm-5">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<textarea class="form-control" name="keterangan" id="keterangan" ><?php echo $fgmembersite->SafeDisplay('keterangan'); ?></textarea>
					</div>
					<?php if (isset($error['keterangan'])){echo '<i><small><span class="help-block">'.$error['keterangan'].'</span></small></i>';} ?>
				</div>
			</div>
			</div>
			<!--
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-md btn-success" name='Submit' value='Cari'>
					
				</div>
			</div>
			-->
		
		
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="form-group margin-bottom-none">
				<div class="col-sm-10 col-sm-offset-2">
					<input type="submit" class="btn btn-danger  btn-md " value="Save">
					<input type="reset" class="btn btn-default  btn-md " value="Cancel">
				</div>	
			</div>
		</div>
	<!-- /.box-footer-->
	</div>
	</div>
	<!-- /.box -->
	</form>
	
	<div class="box box-primary">
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
						<div class="form-group <?php if (isset($error['tglcari'])){echo 'has-error';} ?>">
							<label for="tglcari" class="col-sm-2 control-label">Tanggal</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right tanggal" name="tglcari" id="datepicker" value="<?php echo $fgmembersite->SafeDisplay('tglcari'); ?>">							
								</div>
								<?php if (isset($error['tglcari'])){echo '<i><small><span class="help-block">'.$error['tglcari'].'</span></small></i>';} ?>
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
				
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Waktu dan Posisi Petugsa Layanan Jalan Tol</h3>
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
						if (isset($_POST['tglcari'])and($_POST['tglcari']<>""))
						{
							$q .="date(tgl_tugas) = '".$_POST['tglcari']."'";
						}
						if (isset($_POST['perioda'])and($_POST['perioda']<>""))
						{
							if($q<>""){$q .= ' AND ';}
							$q .="shift= '".$_POST['perioda']."'";
						}
						if($q<>""){$q = ' where '.$q;}						
						$sqlh = 'select * from tb_tugas '.$q;
						
						/*
						?>
						<script>
						$(function(){
							$('.nav-tabs a[href="#tab_2"]').tab('show');						   
						});
						</script>
						<?php
						*/
						
					}
					else
					{					
						$sqlh = 'select * from tb_tugas  limit 1';
					}
					
					$fgmembersite->sql($sqlh);
					$resh = $fgmembersite->getResult();
					foreach($resh as $outputh)
					{
						?>
						<table class="table table-hover table-bordered table-striped">
						
						<tr>
						<td align="right"><strong>Tanggal</strong></td>
						<td width='1'>:</td>
						<td ><?php echo $outputh['tgl_tugas']; ?></td>						
						</tr>
						<tr>
						<td align="right"><strong>Perioda</strong></td>
						<td width='1'>:</td>						
						<td><span class="label label-danger"><?php echo $outputh['shift']; ?></span></td>
						</tr>
						<tr>
						<td align="right"><strong>KA Shift</strong></td>
						<td width='1'>:</td>
						<td>
						<?php 
						$fgmembersite->select('tb_pegawai','name,npp',null,'id_user="'.$outputh['id_ka_shift'].'"',''); 
						$res = $fgmembersite->getResult();
						#$sqlka = 'select * from 
						echo $res[0]['name']; 
						?> (<?php echo $res[0]['npp']; ?>)
						</td>
						</tr>
						</table>
						<hr>
						<?php
						$sqldgroup = 'select * from tb_petugas_posisi where id_tugas="'.$outputh['id_tugas'].'" group by petugas';
						$fgmembersite->sql($sqldgroup);						
						$resdgroup = $fgmembersite->getResult();
						foreach($resdgroup as $outputdgroup)
						{
							$sqlpetugas = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_kendaraan="'.$outputdgroup['petugas'].'"';
							
							$fgmembersite->sql($sqlpetugas);						
							$respetugas = $fgmembersite->getResult();
							$petugas = "";
							foreach($respetugas as $outputpetugas)
							{
								if ($petugas<>""){$petugas = $petugas." & ";}
								$petugas = $petugas.' '.$outputpetugas['name'];
							}
						?>
						<table class="table table-hover table-bordered table-striped">
						<tr ><th colspan='6'><?php echo $outputdgroup['petugas']; ?> (<?php echo $petugas; ?>)</th></tr>
						<tr >
							<th colspan='2'>&nbsp;</th>
							<th>WAKTU DAN POSISI</th>
							<th>JARAK TEMPUH</th>
							<th>RESPON</th>
							<th>KETERANGAN</th>												
						</tr>
						
						<?php
						$sqld = 'select * from tb_petugas_posisi where id_tugas="'.$outputh['id_tugas'].'" and petugas="'.$outputdgroup['petugas'].'"';						
						$fgmembersite->sql($sqld);						
						$resd = $fgmembersite->getResult();			
						$a = 1;
						$jt = 0;
						foreach($resd as $outputd)
						{
							
							?>
							<tr>
								<td rowspan='3'><?php echo $a; ?></td>
								<td>PUKUL</td><td><?php echo $outputd['waktu']; ?></td><td>&nbsp;</td><td rowspan='3'><?php echo $outputd['respon']; ?></td><td rowspan='3'><?php echo $outputd['keterangan']; ?></td>
								<tr><td>km</td><td><?php echo $outputd['kilometer']; ?></td><td><?php if ($jt<>0){ echo ($outputd['kilometer'] - $jt).'Km'; }else{echo '0 Km'; } ?></td></tr>
								<tr><td>10-2</td><td><?php echo $outputd['10_2']; ?></td>								
							</tr>
							<?php
							$a++;
							$jt = $outputd['kilometer'];
						}
						?>
						</table>
						<?php
						}
					}
					?>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button class="btn btn-app pull-right" id="xlsexport"> 
							<i class="fa fa-file-excel-o" ></i> Export <span class="badge bg-green">XLS</span>
						</button>
						<button class="btn btn-app pull-right" id="xlsexport"> 
							<i class="fa fa-print" ></i> Print <span class="badge bg-purple">Print</span>
						</button>
										
					</div>
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->
	<?php
	/*
		if(isset($_POST['submitted']))
		{  		
			?>
			<!-- Pencarian box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Pencarian Data </h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				
				<div class="box-body">
				<form class="form-horizontal" id="absensiForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=posisiPetugas' method='post' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
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
					<div class="form-group <?php if (isset($error['shift'])){echo 'has-error';} ?>">
						<label for="shift" class="col-sm-2 control-label">Perioda</label>

						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="shift" name="shift">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tbl_shift','id_shift,nama_shift','','',''); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('shift')==$output['id_shift']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_shift'].'" '.$a.'>Perioda '.$output['nama_shift'].'</option>';
									}
									?>										
								</select>							
							</div>
							<?php if (isset($error['shift'])){echo '<i><small><span class="help-block">'.$error['shift'].'</span></small></i>';} ?>
						</div>
					</div>
					
					
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-md btn-success" name='Submit' value='Cari'>
							
						</div>
					</div>
				</form>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
							
				</div>
			<!-- /.box-footer-->
			</div>
			<!-- /.box -->
			<?php
		}
		*/
		?>	

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