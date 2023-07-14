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
	if ($_POST["kendaraan"]=="3")
	{
		if ($jam < 6) 
		{			  
		   $tglCek = date('Y-m-d', strtotime('-1 days', strtotime($tglCek)));
		}		
	}	
	$sqlCek2 = 'Select * from tb_checklist_sarana where kendaraan="'.$_POST['kendaraan'].'" and date(tgl)="'.$tglCek.'" and jenis_sarana="'.$_POST['kendaraan'].'" and id_kendaraan="'.$_POST['kendaraan'].'"';
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
		#$this->insert('tb_checklist_sarana',array('id_checklist_sarana'=>$this->id_checklist_sarana ,'tgl'=>$tglCek,'id_kendaraan'=>$_POST['kendaraan'],'kendaraan'=>$_POST['kendaraan'],'jenis_sarana'=>'LJT'.$_POST['kendaraan'],'id_tugas'=>$idtugas));
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
		Laporan Petugas MCS
		<small>Inventaris Rubbercone</small>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i> Home</li>
		<li class="active">Laporan Petugas MCS</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">1. Pemasangan RC</a></li>
			<li><a href="#tab_2" data-toggle="tab">2. Pengamanan RC</a></li>
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
				<h3 class="box-title">Pemasanagan RC Oleh Petugas</h3>
				<p class="help-block">Silahkan lengkapi kolom isian.</p>
				</div>
            <div class="box-body">
			<div><span class='error'><?php
 
			$error = $fgmembersite->GetErrorMessageInput();
			
			#print_r($fgmembersite->GetErrorMessageInput());
			#f (isset($error['kendaraan'])){echo $error['kendaraan'];}
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
					
						<div class="form-group <?php if (isset($error['taruna_dari'])){echo 'has-error';} ?>">
							<label for="taruna_dari" class="col-sm-2 control-label">PILIH PETUGAS</label>
							<div class="col-sm-210">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-car"></i>
									</div>
									<select class="form-control" id="taruna_dari" name="taruna_dari">
										<option value="">--</option>
											<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="201") {echo "selected"; } ?> value="201" value="201">201</option>
											<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="203") {echo "selected"; } ?> value="203">203</option>
											<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="204") {echo "selected"; } ?> value="204">204</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="241") {echo "selected"; } ?> value="241">241</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="223") {echo "selected"; } ?> value="223">223</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="221E") {echo "selected"; } ?> value="221E">221E</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="130A") {echo "selected"; } ?> value="130A">130A</option>										
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT210") {echo "selected"; } ?> value="LJT210" >LJT210</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT212") {echo "selected"; } ?> value="LJT212">LJT212</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="LJT213") {echo "selected"; } ?> value="LJT213">LJT213</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="DEREK") {echo "selected"; } ?> value="DEREK">DEREK</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="RESCUE") {echo "selected"; } ?> value="RESCUE">RESCUE</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="AMBULANCE") {echo "selected"; } ?> value="AMBULANCE">AMBULANCE</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TIRTA") {echo "selected"; } ?> value="TIRTA">TIRTA</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="TI") {echo "selected"; } ?> value="TI">TI</option>
												<option <?php if($fgmembersite->SafeDisplay('taruna_dari')=="JMTM") {echo "selected"; } ?> value="JMTM">JMTM</option>
	
									</select>							
								</div>
								<?php if (isset($error['taruna_dari'])){echo '<i><small><span class="help-block">'.$error['taruna_dari'].'</span></small></i>';} ?>
							</div>					
					</div>	

						<div class="form-group <?php if (isset($error['km'])){echo 'has-error';} ?>">
							<label for="km" class="col-sm-2 control-label">KM</label>

							<div class="col-sm-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</div>
                                    <select class="form-control" id="km" name="km">
                                        <option value="">--</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Manyaran") {echo "selected"; } ?> value="GT.Manyaran">GT.Manyaran</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Tembalang") {echo "selected"; } ?> value="GT.Tembalang">GT.Tembalang</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Gayamsari") {echo "selected"; } ?> value="GT.Gayamsari">GT.Gayamsari</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Muktiharjo") {echo "selected"; } ?> value="GT.Muktiharjo">GT.Muktiharjo</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Srondol") {echo "selected"; } ?> value="GT.Srondol">GT.Srondol</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Jatingaleh1") {echo "selected"; } ?> value="GT.Jatingaleh1">GT.Jatingaleh1</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Jatingaleh2") {echo "selected"; } ?> value="GT.Jatingaleh2">GT.Jatingaleh2</option>										
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Krapyak1") {echo "selected"; } ?> value="GT.Krapyak1">GT.Krapyak1</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="GT.Krapyak2") {echo "selected"; } ?> value="GT.Krapyak2">GT.Krapyak2</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="TI") {echo "selected"; } ?> value="TI">TI</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="420") {echo "selected"; } ?> value="420">420</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="421") {echo "selected"; } ?> value="421">421</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="422") {echo "selected"; } ?> value="422">422</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="423") {echo "selected"; } ?> value="423">423</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="424") {echo "selected"; } ?> value="424">424</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="425") {echo "selected"; } ?> value="425">425</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="426") {echo "selected"; } ?> value="426">426</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="427") {echo "selected"; } ?> value="427">427</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="428") {echo "selected"; } ?> value="428">428</option>	
										<option <?php if($fgmembersite->SafeDisplay('km')=="429") {echo "selected"; } ?> value="429">429</option>	
										<option <?php if($fgmembersite->SafeDisplay('km')=="430") {echo "selected"; } ?> value="430">430</option>	
										<option <?php if($fgmembersite->SafeDisplay('km')=="431") {echo "selected"; } ?> value="431">431</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="432") {echo "selected"; } ?> value="432">432</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="433") {echo "selected"; } ?> value="433">433</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="434") {echo "selected"; } ?> value="434">434</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="435") {echo "selected"; } ?> value="435">435</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="436") {echo "selected"; } ?> value="436">436</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="437") {echo "selected"; } ?> value="437">437</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="438") {echo "selected"; } ?> value="438">438</option>
										<option <?php if($fgmembersite->SafeDisplay('km')=="439") {echo "selected"; } ?> value="439">439</option>													
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
                                    <select class="form-control" id="meter" name="meter">
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
                                    <select class="form-control" id="seksi" name="seksi">
                                        <option value="">--</option>
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="A") {echo "selected"; } ?>  value="A">A</option>										
										<option <?php if($fgmembersite->SafeDisplay('seksi')=="B") {echo "selected"; } ?>  value="B">B</option>										
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

						<div class="form-group <?php if (isset($error['keterangan'])){echo 'has-error';} ?>">
							<label for="keterangan" class="col-sm-2 control-label">Nomor Rubber Cone</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-genderless"></i>
									</div>
									<textarea class="form-control" rows="3" name="keterangan" placeholder="Nomor rubbercone ..."><?php echo $fgmembersite->SafeDisplay('keterangan'); ?></textarea>					
								</div>
								<?php if (isset($error['keterangan'])){echo '<i><small><span class="help-block">'.$error['keterangan'].'</span></small></i>';} ?>
							</div>
						</div>
						
						
					
					<div class="form-group <?php if (isset($error['user_image_petugas1'])){echo 'has-error';} ?>">
						<label for="user_image_petugas1" class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-10">
							<div class="input-group">						
								<input class="input-group" type="file" id="user_image_petugas1" name="user_image_petugas1" accept="image/*" />
								<p class="help-block">Uplodad Foto Rubbercone</p>
							</div>
							<?php if (isset($error['user_image_petugas1'])){echo '<i><small><span class="help-block">'.$error['user_image_petugas1'].'</span></small></i>';} ?>							
						</div>
					</div>


<button id="start-camera">Start Camera</button>
<video id="video" width="320" height="240" autoplay></video>
<button id="click-photo">Click Photo</button>
<canvas id="canvas" width="320" height="240"></canvas>
					
					
<script>	
function				
let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");

camera_button.addEventListener('click', async function() {
   	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
	video.srcObject = stream;
});

click_button.addEventListener('click', function() {
   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	let image_data_url = canvas.toDataURL('image/jpeg');

   	// data url of the image
   	console.log(image_data_url);
});					
</script>	
				
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

			<div class="form-group <?php if (isset($error['lokasi'])){echo 'has-error';} ?>">
				<label for="lokasi" class="col-sm-2 control-label">PILIH Lokasi</label>

				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<select class="form-control" id="lokasi" name="lokasi">
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
					<?php if (isset($error['lokasi'])){echo '<i><small><span class="help-block">'.$error['lokasi'].'</span></small></i>';} ?>
				</div>
			</div>
			
			<div class="form-group <?php if (isset($error['lokasi'])){echo 'has-error';} ?>">
				<label for="lokasi" class="col-sm-2 control-label">PILIH Lokasi</label>

				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-genderless"></i>
						</div>
						<select class="form-control" id="lokasi" name="lokasi">
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
					<?php if (isset($error['lokasi'])){echo '<i><small><span class="help-block">'.$error['lokasi'].'</span></small></i>';} ?>
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
		
		<input type="hidden" name="kendaraan" value="<?php echo $_POST["kendaraan"]; ?>" />
		
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
