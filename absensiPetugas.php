  <title>PPLJT | Absensi Petugas</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absensi Petugas
        <small>Menampilkan Data Absensi Petugas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Absen Petugas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">	
<!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pencarian Data Absensi Petugas Rentang Waktu Tertentu</h3>
			  <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
			  
            <form class="form-horizontal" id="idForm">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Rentang Waktu</label>

                  <div class="col-md-10 col-sm-10 col-xs-10">
                    <input type="text" class="form-control pull-right reservation" name="reservation" id="reservation">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right">Cari</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
		  
      <!-- Default box -->
          <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Absensi Petugas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
				<table id="tablesatu"  class="table table-hover table-bordered table-striped">
					<thead>
						<tr class='text-center'>
							<th class='text-center'>No</th>
							<th class='text-center'>Tanggal</th>
							<th class='text-center'>Shift</th>
							<th class='text-center'>KaShift</th>
							<th class='text-center'>PIK</th>
							<th class='text-center'>Ass.PIK</th>
							<th class='text-center'>LJT212</th>
							<th class='text-center'>LJT213</th>
							<th class='text-center'>Ambulance</th>
							<th class='text-center'>Rescue</th>
							<th class='text-center'>PJR</th>
							<th class='text-center'>Gajah</th>

						</tr>
					</thead>
					<tbody>
					<?php
					$sqlh = 'select *,date(tgl_tugas) as tglj from tb_tugas  order by tgl_tugas desc, shift desc ';
					$fgmembersite->sql($sqlh);
					$resh = $fgmembersite->getResult();					
					$a=1;					
					foreach($resh as $outputh)
					{
						$sqlCek = 'Select * from tbl_tugas_detail where id_tugas="'.$outputh['id_tugas'].'"';		
						$fgmembersite->sql($sqlCek);
						$rows = $fgmembersite->numRows();
						$rowspan = "";
						if ($rows>1)
						{
							#$rowspan = "rowspan='".$rows."'";							
							$rowspan = "rowspan='1'";							
						}
						
						echo "<tr id='tr".$outputh['id_tugas']."'>";
						echo "<td ".$rowspan." class='text-center'>".$a."</td>";
						echo "<td ".$rowspan." class='text-center'><span class='label label-success'>".$outputh['tglj']."</span></td>";
						if($outputh['shift']=="1"){ $label = "success"; }
						if($outputh['shift']=="2"){ $label = "primary"; }
						if($outputh['shift']=="3"){ $label = "danger"; }
						echo "<td ".$rowspan." class='text-center'><span class='label label-".$label."'>".$outputh['shift']."</span></td>";
						
						$fgmembersite->select('tb_pegawai','*',null,'id_user="'.$outputh['id_ka_shift'].'"','');
						$resKa = $fgmembersite->getResult();
						if ($resKa[0]['foto']<>"")
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$resKa[0]['foto'];
						}
						else
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
						}						
						#echo "<td ".$rowspan."><img src='".$imgtemp."' alt='User Image' class='img-circle' width='60'> <div class='caption'><a class='' href='#'>".$resKa[0]['name']." </a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span></div></div></td>";
						
						echo "<td ".$rowspan." class='text-center'><img src='".$imgtemp."' alt='User Image' class='img-circle' width='60'> <div class='caption'><a class='' href='#'>".$resKa[0]['name']." </a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span></td>";
						
						
						$fgmembersite->select('tb_pegawai','*',null,'id_user="'.$outputh['id_pik'].'"','');
						$resKa = $fgmembersite->getResult();
						if ($resKa[0]['foto']<>"")
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$resKa[0]['foto'];
						}
						else
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
						}
						echo "<td ".$rowspan." class='text-center'><img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br> <a class='' href='#'>".$resKa[0]['name']."</a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span> </td>";
                        
						#Tambahan Assistan PIK
						$fgmembersite->select('tb_pegawai','*',null,'id_user="'.$outputh['pik_assistant'].'"','');
						$resKa = $fgmembersite->getResult();
						if ($resKa[0]['foto']<>"")
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$resKa[0]['foto'];
						}
						else
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
						}
						echo "<td ".$rowspan." class='text-center'><img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br> <a class='' href='#'>".$resKa[0]['name']."</a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span> </td>";

						
						if ($rows>0)
						{
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="LJT212"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'>";
							foreach($resdet as $outputdet)
							{
								$imgtemp = "";
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
							
							## LJT213
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="LJT213"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'>";
							foreach($resdet as $outputdet)
							{
								$imgtemp = "";
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";

							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="Ambulance"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'>";
							foreach($resdet as $outputdet)
							{
								$imgtemp = "";
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
							
							## Rescue
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="Rescue"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'>";
							foreach($resdet as $outputdet)
							{
								$imgtemp = "";
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
							
							## PJR
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="PJR"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'>";
							foreach($resdet as $outputdet)
							{
								$imgtemp = "";
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
							
							## Gajah
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="Gajah"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'>";
							foreach($resdet as $outputdet)
							{
								$imgtemp = "";
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <img src='".$imgtemp."' class='img-circle' alt='User Image' width='60'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
						}
						else
						{
							echo "<td>&nbsp;</td>";
						}
						?>

						<?php
						echo "</tr>";
						$a++;
					}
					?>                  
                  </tbody>
</table>
		</div> 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <div id="test" class="pull-right"></div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
<script>

$(function () 
{
	
	var table = $('#tablesatu').DataTable( 
	{
		/*
		'ajax': {
	"type"   : "POST",
	"url"    : '<?php echo $fgmembersite->sitename; ?>/dataKejadianJs.php',
	//"url"    : '',
	
	"data"   : {
	  "no" : "2",
	  //"key_example2" : "value_example2"
	 },
	 /*
	"dataSrc": ""
	
	},
	*/
	"columns": [
		            { "data": "no" },
		            { "data": "tanggal" },
					{ "data": "Shift" },
					{ "data": "KaShift" },
					{ "data": "PIK" },
					{ "data": "AssPIK" },
		            { "data": "LJT212" },
		            { "data": "LJT213" },
					{ "data": "Ambulance" },
					{ "data": "Rescue" },
					{ "data": "PJR" },
					{ "data": "Gajah" },
		        ],
		'paging'      : true,      
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : true,
		'responsive': true,
		lengthChange: true,
		buttons: [ 
			{
				extend: 'print',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-print" ></i> <span class="badge bg-purple">Print</span>',
				filename: 'Data Absensi Petugas <?php echo date("Ymd"); ?>'
			
			},
			{
				extend: 'excel',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
				filename: 'Data Absensi Petugas <?php echo date("Ymd"); ?>'
			}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": false, "targets": 11 }
		]
	})

    table.buttons().container()
        .appendTo( '#test' );
	
$("#idForm").submit(function(e) 
{
	e.preventDefault(); // avoid to execute the actual submit of the form.
	//alert('<?php echo $fgmembersite->sitename; ?>/dataKejadianJs.php?'+$( this ).serialize());
	
	//var table = $('#tablesatu').DataTable();
	table.ajax.url( '<?php echo $fgmembersite->sitename; ?>/absnsipetugasJs.php?'+$( this ).serialize() ).load();
 


});

	$('#tablesatu tbody').on( 'click', 'button', function () 
	{
		var data = $(this).attr('id');
		$.ajax({
			url: '<?php echo $fgmembersite->sitename; ?>jsuno.php',
			data: ({ 'id': data }),
			//dataType: 'json', 
			type: 'post',
			//dataType: 'json',
			success: function(data) 
			{
				var obj = jQuery.parseJSON( data );
				$('#tanggal').html(obj.tanggal);
				$('#Shift').html(obj.shift);
				$('#KaShift').html(obj.id_ka_shift);
				$('#PIK').html(obj.pik_assistant);
				$('#Ass.PIK').html(obj.pik_assistant);
				$('#LJT212').html(obj.LJT212);
				$('#LJT213').html(obj.LJT213);
				$('#Ambulance').html(obj.Ambulance);
				$('#Rescue').html(obj.Rescue);
				$('#PJR').html(obj.PJR);
				$('#Gajah').html(obj.Gajah);		
			}             
		});
		//return false;
		
		$('#modal-default').modal({
			show: 'false'
		}); 
	
		
		
		
    });
	
  });
</script>