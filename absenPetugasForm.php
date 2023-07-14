 <title>PPLJT | Data Absensi</title>
<?php
$moduleTitle = "Tambah Daftar Absensi Petugas ";
$moduleDesc = "Layanan Jalan Tol";

if((isset($_GET['st']))and($_GET['st']=="edit"))
{ 
	if($fgmembersite->dataAbsensi($_GET['id']))
	{

	}
}

if(isset($_POST['absensi']))
{ 
	if($fgmembersite->AbsenPetugasPIKV2())
	{
		$fgmembersite->SafeDisplay(null);
		/*
		$sqlChecklist = "select * from tb_checklist_sarana where id_checklist_sarana='".$fgmembersite->id_checklist_sarana."'";
		$fgmembersite->sql($sqlChecklist);		
		$resCheck = $fgmembersite->getResult();
		#print_r($resCheck);
		*/
	   ?>
	   <script>
		$(function(){
			//$('#absensiPIK')[0].reset();
			//$('#absensiPIK').find('input:text, input:password, select, textarea').val('');
        //$('#absensiPIK').find('input:radio, input:checkbox').prop('checked', false);
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Absensi berhasil di simpan',
			  type: 'success'
		   });
		   $("#absensiPIK")[0].reset();
		   // redirect to google after 5 seconds
			//window.setTimeout(function() {
			//	window.location.href = '<?php echo $fgmembersite->sitename; ?>?mod=absenPetugas';
			//}, 2000);
			
			
		   
		});
		var delay = 2000; 			
		setTimeout(function(){ window.location = '<?php echo $fgmembersite->sitename; ?>?mod=absenPetugas'; }, delay);
		</script>
		<?php
	}

	/*
	if($fgmembersite->AbsenPetugasPIK())
	{
		$sqlChecklist = "select * from tb_checklist_sarana where id_checklist_sarana='".$fgmembersite->id_checklist_sarana."'";
		$fgmembersite->sql($sqlChecklist);		
		$resCheck = $fgmembersite->getResult();
		#print_r($resCheck);
	   ?>
	   <script>
		$(function(){
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Absensi berhasil di simpan',
			  type: 'success'
		   });
		   //$("#checklist")[0].reset();
		   
		});
		</script>
		<?php
	}
	*/
}
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dada Absensi Petugas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Absensi</a></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">	
		  
		  
		  <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
			  <!-- <a href="<?php echo "?mod=absenPetugasForm"; ?>" class="btn bg-olive btn-flat "><i class="fa fa-plus"></i> Tambah Data</a> -->
			  
			  </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
			
			<form class="form-horizontal" id="absensiPIK" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=absenPetugasForm' method='post' accept-charset='UTF-8'>
            <div class="box-body">
              <div><span class='error'><?php $error = $fgmembersite->GetErrorMessageInput(); ?></span></div>
		
		
			<input type="hidden" name="id_user" value="<?php echo $useridglob; ?>" />
			<input type="hidden" name="tgl_tugas" value="<?php echo date("y-m-d"); ?>" />
			<input type="hidden" name="absensi" value="1" />
			<?php
			if((isset($_GET['st']))and($_GET['st']=="edit"))
			{ 
			?>
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
			<input type="hidden" name="st" value="edit" />
			<?php
			}
			if((isset($_POST['st']))and($_POST['st']=="edit"))
			{ 
			?>
			<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>" />
			<input type="hidden" name="st" value="edit" />
			<?php
			}
			?>
    <!------------------------------ PILIHAN TANGGAL DAN PERIODA------------------------------------------>	

			<div class="form-group <?php if (isset($error['tgl_laporan'])){echo 'has-error';} ?>">
					<label for="tgl_laporan" class="col-sm-2 control-label">TANGGAL <?php echo $fgmembersite->SafeDisplay('tgl_laporan'); ?></label>
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
<?php
if(((isset($_GET['st']))and($_GET['st']=="edit"))or((isset($_POST['st']))and($_POST['st']=="edit")))
{ 
?>
								<input type="text" class="form-control pull-right tanggal" name="tgl_laporan" id="tgl_laporan" value="<?php 
								if(!empty($fgmembersite->SafeDisplay('tgl_laporan')))
								{
									echo $fgmembersite->SafeDisplay('tgl_laporan');
								}
								else
								{
									echo date("Y-m-d");
								}
								?>" disabled oninvalid="this.setCustomValidity('Tanggal laporan kejadian masih kosong')">							
<?php
}
else
{
?>
								<input type="text" class="form-control pull-right tanggal" name="tgl_laporan" id="tgl_laporan" value="<?php echo date("Y-m-d");#echo $fgmembersite->SafeDisplay('tgl_laporan');?>" required="true" oninvalid="this.setCustomValidity('Tanggal laporan kejadian masih kosong')">							
<?php
}
?>
						</div>
								<i><small><span class="help-block">Format Tanggal (Y-m-d) Ex: 2018-12-31</span></small></i>
								<?php if (isset($error['tgl_laporan'])){echo '<i><small><span class="help-block">'.$error['tgl_laporan'].'</span></small></i>';} ?>
					</div>
					<label for="shift" class="col-sm-2 control-label">PILIH SHIFT/PERIODA</label>
					<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<select class="form-control" id="shift" name="shift" required="true" >
							<option value="">--</option>
							<?php									
							$fgmembersite->select('tbl_shift','id_shift,nama_shift','','',''); 
							$res = $fgmembersite->getResult();
							#echo "<pre>";
							#print_r($res);
							#echo "<pre>";
							foreach($res as $output)
							{
								if(!empty($fgmembersite->SafeDisplay('shift'))and($fgmembersite->SafeDisplay('shift')==$output['id_shift'])){ $a='selected'; }else{$a='';}
								if(((isset($_GET['st']))and($_GET['st']=="edit"))or((isset($_POST['st']))and($_POST['st']=="edit")))
								{ 
									if ($a=='selected')
									{
										echo '<option value="'.$output['id_shift'].'" '.$a.'>Shift '.$output['nama_shift'].'</option>';
									}
								}
								else
								{
									echo '<option value="'.$output['id_shift'].'" '.$a.'>Shift '.$output['nama_shift'].'</option>';
								}
							}
							?>										
						</select>							
					</div>
					<?php if (isset($error['shift'])){echo '<i><small><span class="help-block">'.$error['shift'].'</span></small></i>';} ?>
					</div>					
					
					
					
			</div>		
			
    <!------------------------------ LABEL PETUGAS ------------------------------------------->				
			
			<div class="row">							
				<div class="col-sm-10 col-sm-offset-2">
					<h4 ><span class="label label-primary">DATA PETUGAS</span></h4>
				</div>
			</div>			

    <!------------------------------ PILIHAN KEPALA SHIFT DAN PIK------------------------------------------->	
	
			<div class="form-group <?php if (isset($error['ka_shift'])){echo 'has-error';} ?>">
				<label for="ka_shift" class="col-sm-2 control-label">Kepala Shift</label>

				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<select class="form-control" id="ka_shift" name="ka_shift" required="true" >
							<option value="">--</option>
							<?php									
							$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="3"','id_user ASC'); 
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
			<div class="form-group <?php if (isset($error['pik'])){echo 'has-error';} ?>">			
				<label for="pik" class="col-sm-2 control-label">PIK</label>								
				<div class="col-sm-3">					
					<div class="input-group">						
						<div class="input-group-addon">							
						<i class="fa fa-genderless"></i>						
						</div>						
						<select class="form-control" id="pik" name="pik"  >							
							<!-- <option value="">--</option> -->
							<?php																
							$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="2"','name ASC'); 							
							$res = $fgmembersite->getResult();							
							foreach($res as $output)							
							{
								#if ($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='2')
								#if($fgmembersite->SafeDisplay('pik')==$output['id_user'])
								if($useridglob == $output['id_user'])
								{ 
									$a='selected'; 
									echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
								}
								else
								{
									$a='';
								}								
															
							}							?>						
						</select>												
					</div>					
					<?php 
					if (isset($error['pik'])){echo '<i><small><span class="help-block">'.$error['pik'].'</span></small></i>';} ?>				
				</div>
				
				<label for="pik_2" class="col-sm-2 control-label">Assistant PIK</label>								
				<div class="col-sm-3">					
				<div class="input-group">						
				<div class="input-group-addon">							
				<i class="fa fa-genderless"></i>						
				</div>						
				<select class="form-control" id="pik_2" name="pik_2"  >							
				<option value="">--</option>							
				<?php																
				$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 							
				$res = $fgmembersite->getResult();							
				foreach($res as $output)							
				{								
				if($fgmembersite->SafeDisplay('pik_2')==$output['id_user']){ $a='selected'; }else{$a='';}								
				echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';							
				}							
				?>						
				</select>												
				</div>					
				<?php if (isset($error['pik_2'])){echo '<i><small><span class="help-block">'.$error['pik_2'].'</span></small></i>';} ?>				
				</div>																	
            </div>
			
    <!------------------------------ PILIHAN PETUGAS LJT212 DAN LJT213------------------------------------------->		
	   	
                    <div class="form-group <?php if (isset($error['kendaraan'])){echo 'has-error';} ?>">
						<label for="kendaraan" class="col-sm-2 control-label">LJT212</label>

						<div class="col-sm-3">
							<div class="input-group ">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="kendaraan" name="kendaraan" disabled>
									<option value="">Kendaraan LJT212</option>
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

						<label for="kendaraan" class="col-sm-2 control-label">LJT213</label>

						<div class="col-sm-3">
							<div class="input-group ">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="kendaraan1" name="kendaraan1" disabled>
									<option value="">Kendaraan LJT213</option>
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
						<label for="petugas1" class="col-sm-2 control-label">Petugas LJT212 1</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="petugas1" name="petugas1">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									
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

						<label for="petugas1" class="col-sm-2 control-label">Petugas LJT213 1</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" id="petugas3" name="petugas3">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas3')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>
								</select>
							</div>
							<?php if (isset($error['petugas3'])){echo '<i><small><span class="help-block">'.$error['petugas1'].'</span></small></i>';} ?>
						</div>						
						
					</div>

					
					<div class="form-group <?php if (isset($error['petugas2'])){echo 'has-error';} ?>">
						<label for="petugas2" class="col-sm-2 control-label">Petugas LJT212 2</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" name="petugas2">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas2')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>							
								</select>
							</div>
							<?php if (isset($error['petugas2'])){echo '<i><small><span class="help-block">'.$error['petugas4'].'</span></small></i>';} ?>
						</div>
						<label for="petugas4" class="col-sm-2 control-label">Petugas LJT213 2</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" name="petugas4">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas4')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>							
								</select>
							</div>
							<?php if (isset($error['petugas4'])){echo '<i><small><span class="help-block">'.$error['petugas4'].'</span></small></i>';} ?>
						</div>	
					</div>
					<div class="form-group <?php if (isset($error['petugas5'])){echo 'has-error';} ?>">
						<label for="petugas5" class="col-sm-2 control-label">Ambulance</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" name="petugas5">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas5')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>							
								</select>
							</div>
							<?php if (isset($error['petugas5'])){echo '<i><small><span class="help-block">'.$error['petugas5'].'</span></small></i>';} ?>
						</div>
						<label for="petugas6" class="col-sm-2 control-label">Rescue</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" name="petugas6">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas6')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>							
								</select>
							</div>
							<?php if (isset($error['petugas6'])){echo '<i><small><span class="help-block">'.$error['petugas6'].'</span></small></i>';} ?>
						</div>
												
						
					</div>
					
					<div class="form-group <?php if (isset($error['petugas7'])){echo 'has-error';} ?>">
						<label for="petugas7" class="col-sm-2 control-label">Driver Ambulance</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<select class="form-control" name="petugas7">
									<option value="">--</option>
									<?php									
									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="1"','name ASC'); 
									$res = $fgmembersite->getResult();
									foreach($res as $output)
									{
										if($fgmembersite->SafeDisplay('petugas7')==$output['id_user']){ $a='selected'; }else{$a='';}
										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';
									}
									?>							
								</select>
							</div>
							<?php if (isset($error['petugas7'])){echo '<i><small><span class="help-block">'.$error['petugas7'].'</span></small></i>';} ?>
						</div>
						
												
						
					</div>
					
					<hr/>
					<div class="form-group <?php if (isset($error['petugas8'])){echo 'has-error';} ?>">

						<label for="petugas8" class="col-sm-2 control-label">PJR</label>

						<div class="col-sm-3">

							<div class="input-group">

								<div class="input-group-addon">

									<i class="fa fa-genderless"></i>

								</div>

								<select class="form-control" name="petugas8">

									<option value="-">--</option>

									<?php									

									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="7"','name ASC'); 

									$res = $fgmembersite->getResult();

									foreach($res as $output)

									{

										if($fgmembersite->SafeDisplay('petugas8')==$output['id_user']){ $a='selected'; }else{$a='';}

										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';

									}

									?>							

								</select>

							</div>

							<?php if (isset($error['petugas8'])){echo '<i><small><span class="help-block">'.$error['petugas8'].'</span></small></i>';} ?>

						</div>	
						
						<label for="petugas9" class="col-sm-2 control-label">GAJAH 1</label>

						<div class="col-sm-3">

							<div class="input-group">

								<div class="input-group-addon">

									<i class="fa fa-genderless"></i>

								</div>

								<select class="form-control" name="petugas9">

									<option value="-">--</option>

									<?php									

									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="8"','name ASC'); 

									$res = $fgmembersite->getResult();

									foreach($res as $output)

									{

										if($fgmembersite->SafeDisplay('petugas9')==$output['id_user']){ $a='selected'; }else{$a='';}

										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';

									}

									?>							

								</select>

							</div>

							<?php if (isset($error['petugas9'])){echo '<i><small><span class="help-block">'.$error['petugas9'].'</span></small></i>';} ?>

						</div>
					<div class="form-group <?php if (isset($error['petugas13'])){echo 'has-error';} ?>">

						<label for="petugas13" class="col-sm-2 control-label">GAJAH 3</label>

						<div class="col-sm-3">

							<div class="input-group">

								<div class="input-group-addon">

									<i class="fa fa-genderless"></i>

								</div>

								<select class="form-control" name="petugas13">

									<option value="-">--</option>

									<?php									

									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="8"','name ASC'); 

									$res = $fgmembersite->getResult();

									foreach($res as $output)

									{

										if($fgmembersite->SafeDisplay('petugas13')==$output['id_user']){ $a='selected'; }else{$a='';}

										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';

									}

									?>							

								</select>

							</div>

							<?php if (isset($error['petugas13'])){echo '<i><small><span class="help-block">'.$error['petugas13'].'</span></small></i>';} ?>

						</div>													
					</div>						





						
					</div>
						
					<div class="form-group <?php if (isset($error['petugas10'])){echo 'has-error';} ?>">

						<label for="petugas10" class="col-sm-2 control-label">GAJAH 2</label>

						<div class="col-sm-3">

							<div class="input-group">

								<div class="input-group-addon">

									<i class="fa fa-genderless"></i>

								</div>

								<select class="form-control" name="petugas10">

									<option value="-">--</option>

									<?php									

									$fgmembersite->select('tb_pegawai','id_user,name,npp','','level_user="8"','name ASC'); 

									$res = $fgmembersite->getResult();

									foreach($res as $output)

									{

										if($fgmembersite->SafeDisplay('petugas10')==$output['id_user']){ $a='selected'; }else{$a='';}

										echo '<option value="'.$output['id_user'].'" '.$a.'>'.$output['name'].' ('.$output['npp'].')</option>';

									}

									?>							

								</select>

							</div>

							<?php if (isset($error['petugas10'])){echo '<i><small><span class="help-block">'.$error['petugas10'].'</span></small></i>';} ?>

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


    </section>
    <!-- /.content -->
	
		<script>
$(function(){
	//Date picker
    $('.tanggal').datepicker({
  format: "yyyy-mm-dd"
});
 
});
</script>