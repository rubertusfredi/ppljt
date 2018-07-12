 <title>PPLJT | Data Kilometer Petugas</title>
<?php
$moduleTitle = "Data Kilometer Kendaraan Petugas LJT ";
$moduleDesc = "Layanan Jalan Tol";

if(isset($_POST['submitKmAkhir']))
{ 
	if($fgmembersite->kmAkhir())
	{
		$fgmembersite->SafeDisplay(null);
	   ?>
	   <script>
		$(function(){
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data berhasil di simpan',
			  type: 'success'
		   });
		   //$("#checklist")[0].reset();
		   
		   $("#formKmAwal")[0].reset();
		   
		});
		var delay = 2000; 			
		setTimeout(function(){ window.location = '<?php echo $fgmembersite->sitename; ?>?mod=checklist'; }, delay);
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
if((isset($_GET['st']))and($_GET['st']=="edit"))
{ 
	if ($fgmembersite->getkmAkhir($_GET['id']))
	{
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
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>        
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">	
		  
		  
		  <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Pencatatan Kilometer Akhir</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
		
		<form class="form-horizontal" id="formKmAkhir" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET["mod"]; ?>' method='post' accept-charset='UTF-8'>
		<input type="hidden" name="submitKmAkhir" value="1" />
		<?php
		if((isset($_GET['st']))and($_GET['st']=="edit"))
		{ 
			?>
			<input type="hidden" name="st" value="edit" />
			<input type="hidden" name="id_tugas" value="<?php echo $_GET['id']; ?>" />
			<input type="hidden" name="tgl" value="<?php echo $fgmembersite->SafeDisplay('tgl'); ?>" />
			<input type="hidden" name="shift" value="<?php echo $fgmembersite->SafeDisplay('shift'); ?>" />
			<?php
		}
		?>
        <div class="box-body">
		<div><span class='error'><?php $error = $fgmembersite->GetErrorMessageInput(); ?></span></div>

		
			
    <!------------------------------ LABEL KILOMETE ------------------------------------------->				
			
			<div class="row">							
				<div class="col-sm-10 col-sm-offset-2">
					<h4 ><span class="label label-danger">KILOMETER AKHIR</span></h4>
				</div>
			</div>			

    <!------------------------------ KILOMETER AWAL------------------------------------------->	
	
			<div class="form-group <?php if (isset($error['awal_pik'])){echo 'has-error';} ?>">
				<label for="kmAkhir212" class="col-sm-2 control-label">AKHIR LJT212</label>
			<div class="col-sm-3">
			<div class="input-group input-group-sm ">
				<span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
					<input type="text" class="form-control" name="kmAkhir212" required="true" placeholder="Isi Kilometer Awal contoh 1000 km" value="<?php echo $fgmembersite->SafeDisplay('kmAkhir212'); ?>">
				<!--<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat">Kirim !</button>
				</span>
				-->
			</div>
			</div>
				
				<label for="kmAkhir213" class="col-sm-2 control-label">AKHIR LJT213</label>				
			<div class="col-sm-3">
			<div class="input-group input-group-sm ">
				<span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
					<input type="text" class="form-control" name="kmAkhir213" required="true" placeholder="Isi Kilometer Awal contoh 1000 km" value="<?php echo $fgmembersite->SafeDisplay('kmAkhir213'); ?>">
				<!--<span class="input-group-btn">
					<button type="button" class="btn btn-info btn-flat">Kirim !</button>
				</span>
				-->
			</div>
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