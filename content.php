<?PHP
if(isset($_POST['submitted']))
{  
   if($fgmembersite->AbsenPetugas())
   {
		#echo "ada".$fgmembersite->jenis_kendaraan;
		$sqlChecklist = "select * from tb_checklist_sarana where id_checklist_sarana='".$fgmembersite->id_checklist_sarana."'";
		$jenis_kendaraan = $fgmembersite->jenis_kendaraan;
		$fgmembersite->sql($sqlChecklist);		
		$resCheck = $fgmembersite->getResult();
		$foundData = 1;
		$fgmembersite->SafeDisplay(null);
		?>
		<script>
		$(function(){
			$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data berhasil di simpan',
			  type: 'success'
		   });
		   $("#absensiForm")[0].reset();
		   
		});
		</script>
		<?php
   }
   #$error = $fgmembersite->GetErrorMessageInput();
   #echo "Ada";
   #print_r($error);
   
}

if(isset($_POST['checklistawal']))
{  
   if($fgmembersite->ChecklistAwal())
   {
		$fgmembersite->SafeDisplay(null);
		header("location:index.php");
		?>
	   <script>
		$(function(){
			$('.nav-tabs a[href="#tab_1"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Checklist berhasil di simpan',
			  type: 'success'
		   });
		   $("#absensiForm")[0].reset();
		   
		});
		</script>
		<?php
		
   }
   
}

if(isset($_POST['checklist']))
{  
   if($fgmembersite->ChecklistPIK())
   {
	   //$fgmembersite->SafeDisplay(null);
       ?>
	   <script>
		$(function(){
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Checklist berhasil di simpan',
			  type: 'success'
		   });
		   //$("#checklist")[0].reset();
		   
		});
		</script>
		<?php
   }
   
}

if(isset($_POST['findData']))
{
	// Cek tabel checklist
	$tgl = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
	$jam = $tgl->format('H');
	$jam1 = $tgl->format('H a');
	$tglCek = $tgl->format('Y-m-d');
	if ($_POST["shift"]=="3")
	{
		if ($jam < 6) 
		{			  
		   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
		}		
	}	
	$sqlCek2 = 'Select * from tb_checklist_sarana where shift="'.$_POST['shift'].'" and date(tgl)="'.$tglCek.'" and jenis_sarana="'.$_POST['kendaraan'].'" and id_kendaraan="'.$_POST['kendaraan'].'"';
	#echo $sqlCek2;
	$fgmembersite->sql($sqlCek2);
	$rowsCek2 = $fgmembersite->numRows();	
	$foundData = 0;
	if ($rowsCek2>0)
	{			
		$resCek2 = $fgmembersite->getResult();			
		$fgmembersite->id_checklist_sarana  = $resCek2[0]["id_checklist_sarana"];
		$sqlChecklist = "select * from tb_checklist_sarana where id_checklist_sarana='".$fgmembersite->id_checklist_sarana."'";
		$fgmembersite->sql($sqlChecklist);		
		$resCheck = $fgmembersite->getResult();
		$foundData = 1;
	}
	else
	{			
		#$this->id_checklist_sarana = date("YmdHis").mt_rand(100,999);
		#$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tglCek,'id_kendaraan'=>$_POST['kendaraan'],'shift'=>$_POST['shift'],'jenis_sarana'=>'LJT'.$_POST['kendaraan'],'id_tugas'=>$idtugas));
		#print_r($this->getSql());
		#$this->getResult();
		
		//$_POST = array();
		
		#$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$id_checklist_sarana,'tgl'=>date("Y-m-d H:i:s"),'id_kendaraan'=>$_POST['id_kendaraan'],'km_awal'=>$_POST['km']));
		
	}
	?>
   <script>
	$(function(){
		$('.nav-tabs a[href="#tab_2"]').tab('show');	   
	});
	</script>
	<?php
}
?>
<?php #echo "tezst:".$resCheck[0]["status"]; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Laporan Petugas LJT
		<small>it all starts here</small>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i> Home</li>
		<li class="active">Laporan Petugas LJT</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">1. Data Petugas</a></li>
			<li><a href="#tab_2" data-toggle="tab">2. Form Ceklist KR</a></li>
			<!--
			<li><a href="#tab_3" data-toggle="tab">3. Hasil Tugas</a></li>			  
			<li><a href="#tab_4" data-toggle="tab">4. Form Ceklist Akhir</a></li>
			-->
		</ul>
		<div class="tab-content">
			<!---------- tab 1 pilih kendaraan -------------->			
			<div class="tab-pane active" id="tab_1">
			<!-- <div class="box box-primary"> -->
			<div class="">
			<div class="box-header">
				<h3 class="box-title">Absensi Petugas Layanan Jalan Tol</h3>
				<p class="help-block">Silahkan lengkapi kolom absensi data petugas, bila sudah tekan tombol kirim.</p>
				</div>
            <div class="box-body">
			<div><span class='error'><?php
 
			$error = $fgmembersite->GetErrorMessageInput();
			
			#print_r($fgmembersite->GetErrorMessageInput());
			#f (isset($error['shift'])){echo $error['shift'];}
			#$error = $fgmembersite->GetErrorMessage('error');
			#var_dump($error); ?></span></div>
				<form class="form-horizontal" id="absensiForm" enctype="multipart/form-data" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<!--
					<div class="form-group">
						<label for="inputName" class="col-md-2 control-label">Tanggal</label>
						<div class="input-group col-md-10 ">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" id="datepicker">
						</div>
						<!-- /.input group 
					</div>
					-->
					
					<div class="form-group <?php if (isset($error['shift'])){echo 'has-error';} ?>">
						<label for="shift" class="col-sm-2 control-label">PILIH SHIFT/PERIODA</label>

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
										echo '<option value="'.$output['id_shift'].'" '.$a.'>Shift '.$output['nama_shift'].'</option>';
									}
									?>										
								</select>							
							</div>
							<?php if (isset($error['shift'])){echo '<i><small><span class="help-block">'.$error['shift'].'</span></small></i>';} ?>
						</div>
					</div>
					
					
					<div class="form-group <?php if (isset($error['kendaraan'])){echo 'has-error';} ?>">
						<label for="kendaraan" class="col-sm-2 control-label">PILIH Kendaraan</label>

						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="kendaraan" name="kendaraan">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_kendaraan','id_kendaraan,type,jenis','','',''); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('kendaraan')==$output['id_kendaraan']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_kendaraan'].'" '.$a.'>'.$output['jenis'].'</option>';
									}
									?>																	
								</select>
							</div>
							<?php if (isset($error['kendaraan'])){echo '<i><small><span class="help-block">'.$error['kendaraan'].'</span></small></i>';} ?>
						</div>
					</div>

					<div class="form-group <?php if (isset($error['petugas1'])){echo 'has-error';} ?>">
						<label for="petugas1" class="col-sm-2 control-label">Nama Petugas LJT 1</label>

						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="petugas1" name="petugas1">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','id_user DESC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas1')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>
								</select>
							</div>
							<?php if (isset($error['petugas1'])){echo '<i><small><span class="help-block">'.$error['petugas1'].'</span></small></i>';} ?>
						</div>
					</div>
					<div class="form-group <?php if (isset($error['user_image_petugas1'])){echo 'has-error';} ?>">
						<label for="user_image_petugas1" class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-10">
							<div class="input-group">						
								<input class="input-group" type="file" id="user_image_petugas1" name="user_image_petugas1" accept="image/*" />
								<p class="help-block">Uplodad Foto Petugas I.</p>
							</div>
							<?php if (isset($error['user_image_petugas1'])){echo '<i><small><span class="help-block">'.$error['user_image_petugas1'].'</span></small></i>';} ?>							
						</div>
					</div>
					
					<div class="form-group <?php if (isset($error['petugas2'])){echo 'has-error';} ?>">
						<label for="inputName" class="col-sm-2 control-label">Nama Petugas Pendamping 2</label>

						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" name="petugas2">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','id_user DESC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas2')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>							
								</select>
							</div>
							<?php if (isset($error['petugas2'])){echo '<i><small><span class="help-block">'.$error['petugas2'].'</span></small></i>';} ?>
						</div>
					</div>
					<div class="form-group <?php if (isset($error['user_image_petugas2'])){echo 'has-error';} ?>">
						<label for="user_image_petugas2" class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-10">
							<div class="input-group">						
								<input class="input-group" type="file" id="user_image_petugas2" name="user_image_petugas2" accept="image/*" />
								<p class="help-block">Uplodad Foto Petugas II.</p>
							</div>
							<?php if (isset($error['user_image_petugas2'])){echo '<i><small><span class="help-block">'.$error['user_image_petugas2'].'</span></small></i>';} ?>							
						</div>
					</div>



					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-danger" name='Submit' value='Submit'>							
						</div>
					</div>
				</form>
				</div>
				</div>
			</div>
			<!------------- /.tab-pane ------------------------->
			<!---------- tab 2 pilih kendaraan -------------->			
			<div class="tab-pane" id="tab_2">
			<?PHP
if(!isset($_POST['submitted']))
{  
?>
			<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Checklist</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		
		<form class="form-horizontal" id="absensiPIK" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
		<input type="hidden" name="findData" value="1" />
		
        <div class="box-body">
		<div><span class='error'><?php $error = $fgmembersite->GetErrorMessageInput(); ?></span></div>
		
		
			<input type="hidden" name="id_user" value="<?php echo $useridglob; ?>" />
			<input type="hidden" name="tgl_tugas" value="<?php echo date("y-m-d"); ?>" />
			<input type="hidden" name="absensi" value="1" />

			<div class="form-group <?php if (isset($error['shift'])){echo 'has-error';} ?>">
				<label for="shift" class="col-sm-2 control-label">PILIH SHIFT/PERIODA</label>

				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<select class="form-control" id="shift" name="shift" required="true">
							<option value="">--</option>
							<?php									
							$fgmembersite->select('tbl_shift','id_shift,nama_shift','','',''); 
							$res = $fgmembersite->getResult();
							foreach($res as $output)
							{
								if($fgmembersite->SafeDisplay('shift')==$output['id_shift']){ $a='selected'; }else{$a='';}
								echo '<option value="'.$output['id_shift'].'" '.$a.'>Shift '.$output['nama_shift'].'</option>';
							}
							?>										
						</select>							
					</div>
					<?php if (isset($error['shift'])){echo '<i><small><span class="help-block">'.$error['shift'].'</span></small></i>';} ?>
				</div>
			</div>
			
			<div class="form-group <?php if (isset($error['kendaraan'])){echo 'has-error';} ?>">
				<label for="kendaraan" class="col-sm-2 control-label">PILIH Kendaraan</label>

				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<select class="form-control" id="kendaraan" name="kendaraan">
							<option value="">--</option>
							<?php									
							$fgmembersite->select('tb_kendaraan','id_kendaraan,type,jenis','','',''); 
							$res = $fgmembersite->getResult();
							foreach($res as $output)
							{
								if($fgmembersite->SafeDisplay('kendaraan')==$output['id_kendaraan']){ $a='selected'; }else{$a='';}
								echo '<option value="'.$output['id_kendaraan'].'" '.$a.'>'.$output['jenis'].'</option>';
							}
							?>																	
						</select>
					</div>
					<?php if (isset($error['kendaraan'])){echo '<i><small><span class="help-block">'.$error['kendaraan'].'</span></small></i>';} ?>
				</div>
			</div>

		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="form-group">
				<div class=" col-sm-10">
					<input type="submit" class="btn btn-danger" name='Submit' value='Submit'>							
					<input type="reset" class="btn" name='reset' value='Reset'>
				</div>
			</div>
		</div>
		<!-- /.box-footer-->
		</form>
		</div>
      <!-- /.box -->
<?php
}
if(isset($foundData)and($foundData=='1'))
{  
?>
	  <div class="box">
		<h3 class="box-title">Laporan Serah terima Kendaraan Dan Sarana Layanan Jalan Tol</h3>
		
		<form class="" id="checklist" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
		<input type="hidden" name="idtugas" value="<?php echo $fgmembersite->idtugas; ?>" />
		<input type="hidden" name="sarana" value="<?php echo $fgmembersite->id_checklist_sarana; ?>" />
		<input type="hidden" name="id_kendaraan" value="<?php echo $_POST['kendaraan']; ?>" />
		<input type="hidden" name="checklist" value="<?php echo $resCheck[0]["status"]; ?>" />		
		
		<input type="hidden" name="shift" value="<?php echo $_POST["shift"]; ?>" />
		
		<?php
		if ($resCheck[0]["status"]=="1")
		{
			?>
			<p class="help-block">Silahkan isi kilometer awal dan cek kelengkapan, bila isi sudah sesuai dan tidak ada perubahan tekan tombol kirim.</p>
			<div class="input-group input-group-sm ">
				<span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
					<input type="text" class="form-control" name="km" required="true" placeholder="Isi Kilometer Awal contoh 1000 km" >
				<!--<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat">Kirim !</button>
				</span>
				-->
			</div>
			<?php
		}
		else if ($resCheck[0]["status"]=="2")
		{
			?>
			<p class="help-block">Silahkan isi kilometer akhir dan cek kelengkapan, bila isi sudah sesuai dan tidak ada perubahan tekan tombol kirim.</p>
			<div class="input-group input-group-sm ">
				<span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
					<input type="text" class="form-control" name="km" required="true" placeholder="Isi Kilometer Akhir contoh 1000 km" >
				<!--<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat">Kirim !</button>
				</span>
				-->
			</div>
			<?php
		}
		else if ($resCheck[0]["status"]=="3")
		{
			?>
			<div class="input-group input-group-sm ">
				<span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
					<input type="text" class="form-control" readonly="true" name="km" required="true" value="Kilometer Awal : <?php echo $resCek2[0]["km_awal"]; ?> - Kilometer Akhir : <?php echo $resCek2[0]["km_akhir"]; ?>" >
				<!--<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat">Kirim !</button>
				</span>
				-->
			</div>
			<?php
		}
		?>
		<br />				
			<table class="table table-hover table-bordered table-striped">
			<?php
			if ($resCheck[0]["status"]=="1")
			{
				?>
				<tr>
					<th>NO</th>
					<th>Pengecekan Sarana dan Prasarana PIK</th>
					<th>Satuan</th>
					<th>Volume Awal</th>					
					<th>Kondisi Awal</th>
					<th>Tindak Lanjut</th>
					<th>Keterangan</th>					
				</tr>
				<?php
			}
			else if ($resCheck[0]["status"]=="2")
			{
				?>
				<tr>
					<th>NO</th>
					<th>Pengecekan Sarana dan Prasarana PIK</th>
					<th>Satuan</th>
					<th>Volume Awal</th>					
					<th>Kondisi Awal</th>
					<th>Volume Akhir</th>
					<th>Kondisi Akhir</th>
					<th>Tindak Lanjut</th>
					<th>Keterangan</th>					
				</tr>
				<?php
			}
			else if ($resCheck[0]["status"]=="3")
			{
				?>
				<tr>
					<th>NO</th>
					<th>Pengecekan Sarana dan Prasarana PIK</th>
					<th>Satuan</th>
					<th>Volume Awal</th>					
					<th>Kondisi Awal</th>
					<th>Tindak Lanjut Akhir</th>
					<th>Keterangan Akhir</th>	
					<th>Volume Akhir</th>
					<th>Kondisi Akhir</th>
					<th>Tindak Lanjut Akhir</th>
					<th>Keterangan Akhir</th>					
				</tr>
				<?php
			}

				if ($resCheck[0]["status"]=="1")
				{
					$sql = 'select *,b.id,a.nama_sarana,a.volume,a.satuan from tb_sarana a,tb_sarana_kendaraan b where a.id_sarana=b.id_sarana and b.jenis_sarana="kendaraan" and b.id_kendaraan="'.$jenis_kendaraan.'"';			
				}
				else if ($resCheck[0]["status"]=="2")
				{
					$sql = 'select *,c.id,a.nama_sarana,a.satuan,c.volume_awal,c.kondisi_awal from tb_sarana a,tb_sarana_kendaraan b,tb_detail_checklist_sarana c where a.id_sarana=b.id_sarana and b.id=c.id_sarana and c.id_checklist_sarana="'.$fgmembersite->id_checklist_sarana.'"';			
				}
				else if ($resCheck[0]["status"]=="3")
				{
					$sql = 'select *,c.id,a.nama_sarana,a.satuan,c.volume_awal,c.kondisi_awal from tb_sarana a,tb_sarana_kendaraan b,tb_detail_checklist_sarana c where a.id_sarana=b.id_sarana and b.id=c.id_sarana and c.id_checklist_sarana="'.$fgmembersite->id_checklist_sarana.'"';			
				}
				#echo $sql;
				$fgmembersite->sql($sql);				
				$res = $fgmembersite->getResult();
				
				$a = 1;
				foreach($res as $outputSarana)
				{
					?>
					<tr>
					<td><?php echo $a; ?></td>
					<td><?php echo $outputSarana['nama_sarana']; ?></td>
					<td><?php echo $outputSarana['satuan']; ?></td>
					<?php
					if ($resCheck[0]["status"]=="1")
					{
						?>
						<td>
						<div class="form-group col-lg-12">							
							<input type="number" class="form-control " name="volume_awal[<?php echo $outputSarana['id']; ?>]" value="<?php echo $outputSarana['volume']; ?>">
							</div>
						</td>						
						<td>
							<div class="form-group col-lg-12">							
							<select class="form-control " name="kondisi[<?php echo $outputSarana['id']; ?>]">
							<?php									
							$fgmembersite->select('kondisi_ljt','id,nama_kondisi,kode_kondisi','','',''); 
							$res = $fgmembersite->getResult();
							foreach($res as $output)
							{
								/*?>
								<label>
									<input type="radio" name="r1" class="minimal" checked><?php echo $output['kode_kondisi']; ?>
								</label>
								<?php
								*/
								echo '<option value="'.$output['id'].'" '.$a.'>'.$output['nama_kondisi'].'</option>';
							}
							?>								               
							</div>
							</select>
						</td>
						<td>
							<div class="form-group col-lg-12">								
								<input type="text" class="form-control" name="tindaklanjut[<?php echo $outputSarana['id']; ?>]" placeholder="Tindak lanjut">
							</div>
						</td>
						<td>
							<div class="form-group col-lg-12">								
								<input type="text" class="form-control" name="keterangan[<?php echo $outputSarana['id']; ?>]" placeholder="Keterangan">
							</div>
						</td>
						<?php
					}
					else if ($resCheck[0]["status"]=="2")
					{
						?>
						<td><?php echo $outputSarana['volume_awal']; ?></td>						
						<td><?php									
							$fgmembersite->select('kondisi_ljt','id,nama_kondisi,kode_kondisi',null,'id="'.$outputSarana['kondisi_awal'].'"',''); 
							$res = $fgmembersite->getResult();
							echo $res[0]['nama_kondisi'];
							?>
						</td>
						<td>
						<div class="form-group col-lg-12">							
							<input type="number" class="form-control " name="volume_akhir[<?php echo $outputSarana['id']; ?>]" value="<?php echo $outputSarana['volume_awal']; ?>">
							</div>
						</td>						
						<td>
							<div class="form-group col-lg-12">							
								<select class="form-control " name="kondisi[<?php echo $outputSarana['id']; ?>]">
								<?php									
								$fgmembersite->select('kondisi_ljt','id,nama_kondisi,kode_kondisi','','',''); 
								$res = $fgmembersite->getResult();
								foreach($res as $output)
								{
									/*?>
									<label>
										<input type="radio" name="r1" class="minimal" checked><?php echo $output['kode_kondisi']; ?>
									</label>
									<?php
									*/
									echo '<option value="'.$output['id'].'" '.$a.'>'.$output['nama_kondisi'].'</option>';
								}
								?>								               
								</div>
							</select>
						</td>
						<td>
							<div class="form-group col-lg-12">								
								<input type="text" class="form-control" name="tindaklanjut[<?php echo $outputSarana['id']; ?>]" placeholder="Tindak lanjut">
							</div>
						</td>
						<td>
							<div class="form-group col-lg-12">								
								<input type="text" class="form-control" name="keterangan[<?php echo $outputSarana['id']; ?>]" placeholder="Keterangan">
							</div>
						</td>
						<?php					
					}
					else if ($resCheck[0]["status"]=="3")
					{
						?>
						<td><?php echo $outputSarana['volume_awal']; ?></td>						
						<td><?php									
							$fgmembersite->select('kondisi_ljt','id,nama_kondisi,kode_kondisi',null,'id="'.$outputSarana['kondisi_awal'].'"',''); 
							$res = $fgmembersite->getResult();
							echo $res[0]['nama_kondisi'];
							?>
						</td>
						<td><?php echo $outputSarana['tindaklanjut']; ?></td>
						<td><?php echo $outputSarana['keterangan']; ?></td>
						<td><?php echo $outputSarana['volume_akhir']; ?></td>						
						<td><?php									
							$fgmembersite->select('kondisi_ljt','id,nama_kondisi,kode_kondisi',null,'id="'.$outputSarana['kondisi_akhir'].'"',''); 
							$res = $fgmembersite->getResult();
							echo $res[0]['nama_kondisi'];
							?>
						</td>
						<td><?php echo $outputSarana['tindaklanjut_akhir']; ?></td>
						<td><?php echo $outputSarana['keterangan_akhir']; ?></td>
						<?php					
					}
					?>
											
					</tr>
					<?php
					$a++;
				}
				?>
			</table>
<?php
/*
				<table class="table table-hover table-bordered table-striped">
					<tr>
					<th>NO</th>
					<th>Pengecekan Sarana dan Prasarana Kendaraan</th>
					<th>Volume</th>
					<th>Satuan</th>
					<th>Kondisi</th>
					<th>Tindak Lanjut</th>
					<th>Keterangan</th>					
					</tr>
					<?php
					$sql = 'select *,b.id,a.nama_sarana,a.volume,a.satuan from tb_sarana a,tb_sarana_kendaraan b where a.id_sarana=b.id_sarana and b.id_kendaraan="'.$_POST['kendaraan'].'"';			

					$fgmembersite->sql($sql);
					#$fgmembersite->select('sarana_ljt','nama_sarana,volume,satuan,kondisi,tindak_lanjut,ket','','',''); 
					$res = $fgmembersite->getResult();
					#print_r($res);
					#$rows = $fgmembersite->numRows();
					$a = 1;
					foreach($res as $outputSarana)
					{
						?>
						<tr>
						<td><?php echo $outputSarana['id']; ?></td>
						<td><?php echo $outputSarana['nama_sarana']; ?></td>
						<td><?php echo $outputSarana['volume']; ?></td>
						<td><?php echo $outputSarana['satuan']; ?></td>
						<td>
							<div class="form-group">
							<select class="form-control" name="kondisi[<?php echo $outputSarana['id']; ?>]">
							<?php									
							$fgmembersite->select('kondisi_ljt','id,nama_kondisi,kode_kondisi','','',''); 
							$res = $fgmembersite->getResult();
							foreach($res as $output)
							{
								echo '<option value="'.$output['id'].'" '.$a.'>'.$output['nama_kondisi'].'</option>';
							}
							?>								               
							</div>
							</select>
						</td>
						<td>
							<div class="form-group">								
								<input type="text" class="form-control" name="tindaklanjut[<?php echo $outputSarana['id']; ?>]" placeholder="Tindak lanjut">
							</div>
						</td>
						<td>
							<div class="form-group">								
								<input type="text" class="form-control" name="keterangan[<?php echo $outputSarana['id']; ?>]" placeholder="Keterangan">
							</div>
						</td>						
						</tr>
						<?php
						$a++;
					}
					?>
				</table>
				*/ ?>
				<?php
				if ($resCheck[0]["status"]<>"3")
				{
					?>
				<input type="submit" class="btn btn-primary" value="KIRIM">
				<?php
				}
				?>
			  </form>
			  </div>
			  <!-- /.box -->
			  
			<?php
			}
			?>
			</div>
			<!------------- /.tab-pane ------------------------->
			<!---------- tab 3 pilih kendaraan --------------		
			<div class="tab-pane" id="tab_3">
				<h3 class="box-title">Absensi Petugas Layanan Jalan Tol</h3>
				<p class="help-block">Silahkan lengkapi kolom absensi data petugas, bila sudah tekan tombol kirim.</p>
			</div>
			<!------------- /.tab-pane ------------------------->
			<!---------- tab 4 pilih kendaraan --------------		
			<div class="tab-pane" id="tab_4">
				<h3 class="box-title">Absensi Petugas Layanan Jalan Tol</h3>
				<p class="help-block">Silahkan lengkapi kolom absensi data petugas, bila sudah tekan tombol kirim.</p>
			</div>
			<!------------- /.tab-pane ------------------------->
		</div>
		<!-- /.tab-content -->
	</div>
	<!-- /.Custom Tabs -->

</section>
<!-- /.content -->