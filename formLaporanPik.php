<?php
if(isset($_POST['submitted']))
{ 

	if($fgmembersite->laporanKegiatan())
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
}
$moduleTitle = "Form Laporan Kegiatan PIK ";
$moduleDesc = "Meninputkan kegiatan kegiatan PIK";
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small><?php echo $moduleDesc; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li> 
		<li>Laporan</li>		
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <form class="form-horizontal" id="absensiForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=formLaporanPik' method='post' accept-charset='UTF-8'>
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
			<h3 class="box-title">Form Laporan </h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			</div>
		</div>
		
		<div class="box-body">
		
			<div class="form-group <?php if (isset($error['tgl'])){echo 'has-error';} ?>">
				<label for="tgl" class="col-sm-2 control-label">Tanggal</label>

				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right tanggal" name="tgl" id="datepicker" value="<?php echo $fgmembersite->SafeDisplay('tgl'); ?>">							
					</div>
					<?php if (isset($error['tgl'])){echo '<i><small><span class="help-block">'.$error['tgl'].'</span></small></i>';} ?>
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
		
			
			<div class="form-group <?php if (isset($error['keterangan'])){echo 'has-error';} ?>">
				<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>

				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<textarea class="form-control" name="keterangan" id="keterangan" ><?php echo $fgmembersite->SafeDisplay('keterangan'); ?></textarea>
					</div>
					<?php if (isset($error['keterangan'])){echo '<i><small><span class="help-block">'.$error['keterangan'].'</span></small></i>';} ?>
				</div>
			</div>
			<!--
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-md btn-success" name='Submit' value='Cari'>
					
				</div>
			</div>
			-->
		
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
	<!-- /.box-footer-->
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
			<h3 class="box-title">Laporan Kegiatan PIK</h3>
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
			$sqlh = 'select * from tb_laporan_kegiatan where id_user="'.$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user'].'"';
		}
		
		$fgmembersite->sql($sqlh);
		$resh = $fgmembersite->getResult();
		foreach($resh as $outputh)
		{
			?>
			<strong>I. LAPORAN UMUM</strong>
			<table class="table table-hover table-bordered table-striped">			
			<tr >				
				<th colspan="3">ARMADA YANG OPERASI</th>															
			</tr>
			<tr>					
				<td align="right">PATROLI JASA MARGA</td>
				<td align="right">:</td>
				<td>
				<?php
				$sqlarmada = "select * from tb_tugas a,tbl_tugas_detail b where a.id_tugas=b.id_tugas and shift='".$outputh['perioda']."' and date(a.tgl_tugas)='".$outputh['tgl_laporan_kegiatan']."' group by b.id_kendaraan";
				
				$jml = $fgmembersite->sql($sqlarmada);
				#print_r($jml);
				$resarmada = $fgmembersite->getResult();
				foreach($resarmada as $outputarmada)
				{
					echo $jml." Unit Layanan; ".$outputarmada['id_kendaraan'];
				}
				?>
				
				</td>
			</tr>
			<tr>					
				<td align="right">PJR</td>
				<td align="right">:</td>
				<td>-</td>							
			</tr>
			<tr>					
				<td align="right">AMBULANCE</td>
				<td align="right">:</td>
				<td>-</td>							
			</tr>
			<tr>					
				<td align="right">DEREK</td>
				<td align="right">:</td>
				<td>-</td>							
			</tr>
			<tr>					
				<td align="right">RESCUE</td>
				<td align="right">:</td>
				<td>-</td>							
			</tr>
			<tr>					
				<td align="right">TANGKI AIR</td>
				<td align="right">:</td>
				<td>-.</td>							
			</tr>
			<tr>					
				<td align="right">LAIN - LAIN</td>
				<td align="right">:</td>
				<td>-</td>							
			</tr>
			</table>
			
			<hr>

			<strong>II. LAPORAN KEGIATAN</strong>
			<table class="table table-hover table-bordered table-striped">			
			<tr >				
				<th>PUKUL</th>
				<th>URAIAN KEGIATAN</th>											
			</tr>
			
			<?php
			#$sqld = 'select * from tb_petugas_posisi where id_tugas="'.$outputh['id_tugas'].'" and petugas="'.$outputdgroup['petugas'].'"';						
			$fgmembersite->sql($sqlh);						
			$resd = $fgmembersite->getResult();			
			$a = 1;
			$jt = 0;
			foreach($resd as $outputd)
			{
				
				?>
				<tr>					
					<td><?php echo $outputd['waktu']; ?></td>
					<td><?php echo $outputd['kegiatan']; ?></td>							
				</tr>
				<?php
				$a++;
				$jt = $outputd['kilometer'];
			}
			?>
			</table>
			<?php
			
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