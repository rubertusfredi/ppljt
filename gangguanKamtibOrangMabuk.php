<title>PPLJT | Data Gangguan Kamtib Orang Mabuk</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Informasi Detail
        <small>Data Gangguan Keamanan dan Ketertiban Orang Mabuk Masuk Tol</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $fgmembersite->sitename; ?>?mod=gangguanKamtib">Data Gangguan Kamtib</a></li>
        <li class="active">Orang Mabuk</li>	
        <!-- <li class="active">Blank page</li> -->
      </ol>
    </section>

   <!-- Main content -->
    <section class="content">
<!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pencarian Data Gangguan Orang Mabuk Masuk Tol Rentang Waktu Tertentu</h3>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Date range</label>

                  <div class="col-sm-10">
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
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Gangguan Orang Mabuk Masuk Tol</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         <div class="table-responsive">             
		  <table id="tablesatu" class="table table-bordered table-striped">
	<thead>
		<tr >
			<th class='text-center'>No</th>
			<th class='text-center'>Hari</th>
			<th class='text-center'>Tanggal</th>
			<th class='text-center'>Shift</th>
			<th class='text-center'>PIK</th>
			<th class='text-center'>Kamtib</th>
			<th class='text-center'>Info Diterima</th>
			<th class='text-center'>Taruna Dari</th>
			<th>DETAIL</th>
		</tr>
	</thead>
	<tbody>
	<?php 

		$sqlKejadian = "SELECT * FROM tb_laporan a left join tb_pegawai c on a.id_user=c.id_user , tb_detail_laporan b where a.id_laporan=b.id_laporan and kamtib='ORANG MABUK' order by tgl_detail_created desc";
		$fgmembersite->sql($sqlKejadian);						
		$resKejadian = $fgmembersite->getResult();
		$a = 1;
		foreach($resKejadian as $outputkejadian => $valkejadian)
		{
			$datestr = DateTime::createFromFormat('Y-m-d H:i:s', $valkejadian["tgl_detail_created"]);
			#echo $date->format('Y-m-d');
	?>

		<tr>
			<td class='text-center'><?php echo $a; ?></td>
			<td class='text-center'><?php echo $fgmembersite->namahari($datestr->format('l')); ?></td>
			<td class='text-center'><?php echo $datestr->format('Y-m-d'); ?></td>
			<td class='text-center'><?php echo $valkejadian["perioda"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["name"]."(".$valkejadian["npp"].")"; ?></td>
			<td class='text-center'><?php echo $valkejadian["kamtib"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_1"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["taruna_dari"]; ?></td>
			<td class='text-center'>
				<button type="button" class="btn bg-maroon  btn-flat" id="<?php echo $valkejadian["id"]; ?>" ><i class="fa fa-outdent"></i></button>
			</td>
		</tr>
		<?php
		$a++;
		}
		
	?>
		
	</tbody>
</table>
		  
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <div id="test" class="pull-right"></div>
        </div>
        <!-- /.box-footer-->
      </div>
	  </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
	
	<div class="modal fade " id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"></span></button>
                <h4 class="modal-title">Data Detail Gangguan Keamanan dan Ketertiban Orang Mabuk Masuk Tol</h4>
              </div>
			  
			  <form class="form-horizontal" id="harianPetugasPik" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET['mod']; ?>' method='post' accept-charset='UTF-8'>			
					<input type='hidden' name='submitted'  value='1'/>
              <div class="modal-body">
         <div class="table-responsive">    				  
                <table class="table table-bordered table-striped">
            <!-------------------- Data Petugas -------------------------------->				
				      <td><h4 ><span class="label label-success ">Data Petugas</span></td>
					<tr>
						<td align="right">Tanggal</td>
						<td width="10">:</td>
						<td>
							<span id="tgl_laporan"></span>
						</td>
					</tr>
					<tr>
						<td align="right">Perioda</td>
						<td>:</td>
						<td>
							<span id="perioda"></span>							
						</td>
					</tr>
					<tr>
						<td align="right">Petugas PIK</td>
						<td>:</td>
						<td>
							<span id="pik"></span>							
						</td>
					</tr>					
					<tr>
						<td align="right">Kepala Shift</td>
						<td>:</td>
						<td>
							<span id="kashift"></span>							
						</td>
					</tr>
					<tr>
						<td align="right">Taruna Dari</td>
						<td>:</td>
						<td>
							<span id="taruna_dari"></span>							
						</td>
					</tr>
				      <td><h4 ><span class="label label-success ">Type Kejadian / Kamtib</span></td>						
					<tr>
						<td align="right">Kejadian</td>
						<td>:</td>
						<td>
							<span id="type_kejadian"></span>							
						</td>
					</tr>
					<tr>
						<td align="right">Kamtib</td>
						<td>:</td>
						<td>
							<span id="kamtib"></span>							
						</td>
					</tr>					
					
		 <!-------------------- Waktu Taruna -------------------------------->
		 
				      <td><h4 ><span class="label label-success ">Waktu Kejadian</span></td>				
					<tr>
						<td align="right">Info Diterima</td>
						<td>:</td>
						<td>
							<span id="t1"></span>
						</td>
	                </tr>
					<tr>
						<td align="right">Telp. Diterima</td>
						<td>:</td>
						<td>
							<span id="info"></span>
						</td>
	                </tr>
					<tr>
						<td align="right">Keperluan</td>
						<td>:</td>
						<td>
							<span id="keperluan"></span>
						</td>
	                </tr>	
					
		 <!-------------------- Kendaraan -------------------------------->					
				      <td><h4 ><span class="label label-success ">Kendaraan</span></td>				
					<tr>
						<td align="right">Jenis Kendaraan</td>
						<td>:</td>
						<td>
							<span id="jenis_kendaraan"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Nomor Polisi</td>
						<td>:</td>
						<td>
							<span id="nopol"></span>
						</td>
	                </tr>	
			 <!-------------------- Kendaraan -------------------------------->					
				      <td><h4 ><span class="label label-success ">Lokasi</span></td>			
					<tr>
						<td align="right">Di Kilometer</td>
						<td>:</td>
						<td>
							<span id="kilometer"></span>
						</td>
	                </tr>
					<tr>
						<td align="right">+ meter</td>
						<td>:</td>
						<td>
							<span id="meter"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Ruas</td>
						<td>:</td>
						<td>
							<span id="ruas"></span>
						</td>
	                </tr>
			 <!-------------------- Isi Taruna -------------------------------->					
				      <td><h4 ><span class="label label-success ">Isi Taruna</span></td>
					<tr>
						<td align="right">Keterangan</td>
						<td>:</td>
						<td>
							<span id="keterangan"></span>							
						</td>
					</tr>
				</table>
              </div>
			  </form>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>                
              </div>
            </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		

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
		            { "data": "hari" },
		            { "data": "tanggal" },
					{ "data": "Shift" },
					{ "data": "PIK" },
					{ "data": "Kamtib" },
		            { "data": "T1" },
		            { "data": "Taruna_Dari" },
					{ "data": "DETAIL" },
		        ],
		'paging'      : true,      
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false,
		'responsive': true,
		lengthChange: false,
		buttons: [ 
			{
				extend: 'print',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-print" ></i> <span class="badge bg-purple">Print</span>',
				filename: 'DataKejadian<?php echo date("Ymd"); ?>'
			
			},
			{
				extend: 'excel',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
				filename: 'DataKejadian<?php echo date("Ymd"); ?>'
			}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": false, "targets": 8 }
		]
	})
	
	/*
	yadcf.init(table,
	[
		{
                column_number: 2,
                filter_type: "range_date",
                date_format: "yyyy-mm-dd",
                filter_delay: 500
        }
		]);0BNR00
		bunga mawar
		cita cita kasih bunga
		laper atau wafer
		cinta yg miris
		kekasih bayaran
		
 */
    table.buttons().container()
        .appendTo( '#test' );
	
$("#idForm").submit(function(e) 
{
	e.preventDefault(); // avoid to execute the actual submit of the form.
	//alert('<?php echo $fgmembersite->sitename; ?>/dataKejadianJs.php?'+$( this ).serialize());
	
	//var table = $('#tablesatu').DataTable();
	table.ajax.url( '<?php echo $fgmembersite->sitename; ?>/gangguanKamtibOrangMabukJs.php?'+$( this ).serialize() ).load();
 


});

	$('#tablesatu tbody').on( 'click', 'button', function () 
	{
		var data = $(this).attr('id');
		$.ajax({
			url: '<?php echo $fgmembersite->sitename; ?>jspro.php',
			data: ({ 'id': data }),
			//dataType: 'json', 
			type: 'post',
			//dataType: 'json',
			success: function(data) 
			{
				var obj = jQuery.parseJSON( data );
				$('#tgl_laporan').html(obj.tgl_detail_created);
				$('#perioda').html(obj.perioda);
				$('#pik').html(obj.name);
				$('#kashift').html(obj.id_ka_shift);
				$('#taruna_dari').html(obj.taruna_dari);
				$('#type_kejadian').html(obj.type_kejadian);
				$('#kamtib').html(obj.kamtib);
				$('#t1').html(obj.waktu_1);
				$('#jenis_kendaraan').html(obj.jenis_kendaraan);
				$('#nopol').html(obj.nopol);
				$('#info').html(obj.waktu_info_diterima);
				$('#keperluan').html(obj.keperluan);				
				$('#kilometer').html(obj.kilometer);
				$('#meter').html(obj.meter);
				$('#ruas').html(obj.ruas);
				$('#uraian_kegiatan').html(obj.uraian_kegiatan);
				$('#keterangan').html(obj.keterangan);				
			}             
		});
		//return false;
		
		$('#modal-default').modal({
			show: 'false'
		}); 
	
		
		
		
    });
	
    /*$("#tablesatu").DataTable({
		dom: 'Bfrtip',
            buttons: ['print', 'excel', 'pdf' 
                'copy', 'excel', 'pdf', 'print'
            ]
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
	//Date range picker
    $('.reservation').daterangepicker(
	{
        locale: {
            format: 'YYYY-MM-DD'
        }
    }
	);
	
	<?php 
	/*
	// this is the id of the form
/*$("#idForm").submit(function(e) {
e.preventDefault(); // avoid to execute the actual submit of the form.
alert("ada");


//table.ajax.reload( function ( json ) {
   // $('#myInput').val( json.lastInput );
//} );
table.ajax.url( 'newData.json' ).load();

//table.ajax.reload( function ( json ) {
	/*
$('#tablesatu').DataTable({
	"processing" : true,
	'ajax': {
	"type"   : "POST",
	"url"    : 'http://127.0.0.1/ljt23/dataKejadianJs.php'
	
	"data"   : {
	  "key_example1" : "value_example1",
	  "key_example2" : "value_example2"
	 },
	"dataSrc": ""
	
	},
  'columns': [
    {"data" : "no"},
    {"data" : "hari"},
    {"data" : "tanggal"},
    {"data" : "shift"}
  ]
});
*/

 /*
 var url = "script.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#idForm").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    
});
*/
?>
 
});
</script>