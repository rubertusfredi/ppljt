<?php
$moduleTitle = "Serah Terima Sarana PIK ";
$moduleDesc = "Menghimpun data kondisi Sarana PIK";

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
if(isset($_POST['absensi']))
{ 

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
}
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
		
		<form class="form-horizontal" id="absensiPIK" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=saranaPik' method='post' accept-charset='UTF-8'>
		
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
			
			<div class="form-group <?php if (isset($error['ka_shift'])){echo 'has-error';} ?>">
				<label for="ka_shift" class="col-sm-2 control-label">KA Shift</label>

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
if(isset($_POST['absensi'])and(isset($resCheck[0]["status"])))
{ 
?>
		<!-- Default box -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Checklist</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		
		<form class="" id="checklist" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=saranaPik' method='post' accept-charset='UTF-8'>
		<input type="hidden" name="id_user" value="<?php echo $useridglob; ?>" />
		<input type="hidden" name="tgl_tugas" value="<?php echo date("y-m-d"); ?>" />
		<input type="hidden" name="sarana" value="<?php echo $fgmembersite->id_checklist_sarana; ?>" />
		<input type="hidden" name="checklist" value="<?php echo $resCheck[0]["status"]; ?>" />
		<input type="hidden" name="shift" value="<?php echo $_POST["shift"]; ?>" />
			
        <div class="box-body">
		<div><span class='error'><?php $error = $fgmembersite->GetErrorMessageInput(); ?></span></div>
		
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
					$sql = 'select *,b.id,a.nama_sarana,a.volume,a.satuan from tb_sarana a,tb_sarana_kendaraan b where a.id_sarana=b.id_sarana and b.jenis_sarana="pik"';			
				}
				else if ($resCheck[0]["status"]=="2")
				{
					$sql = 'select *,c.id,a.nama_sarana,a.satuan,c.volume_awal,c.kondisi_awal from tb_sarana a,tb_sarana_kendaraan b,tb_detail_checklist_sarana c where a.id_sarana=b.id_sarana and b.id=c.id_sarana and c.id_checklist_sarana="'.$fgmembersite->id_checklist_sarana.'"';			
				}
				else if ($resCheck[0]["status"]=="3")
				{
					$sql = 'select *,c.id,a.nama_sarana,a.satuan,c.volume_awal,c.kondisi_awal from tb_sarana a,tb_sarana_kendaraan b,tb_detail_checklist_sarana c where a.id_sarana=b.id_sarana and b.id=c.id_sarana and c.id_checklist_sarana="'.$fgmembersite->id_checklist_sarana.'"';			
				}				
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

				
		  
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
			<div class="form-group">
				<div class=" col-sm-10">
					<input type="submit" class="btn btn-danger" name='Submit' value='Submit' <?php if ($resCheck[0]["status"]=="3"){ echo "disabled";} ?>>							
					<input type="reset" class="btn" name='reset' value='Reset' <?php if ($resCheck[0]["status"]=="3"){ echo "disabled";} ?>>
				</div>
			</div>
        </div>
        <!-- /.box-footer-->
		</form>
      </div>
      <!-- /.box -->
<?php
}
?>
    </section>
    <!-- /.content -->