 <title>PPLJT | Data Kejadian dan Kamtib</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kejadian dan Kamtib 
        <small>Menampilkan Seluruh data Kejadian dan Gangguan Keamananan Ketertiban</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Kejadian dan Kamtib </li>
        <!-- <li class="active">Blank page</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pencarian Data Kejadian dan Gangguan Keamananan Ketertiban Rentang Waktu Tertentu</h3>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Rentang waktu</label>

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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Seluruh Data Kejadian dan Gangguan Keamanan Ketertiban</h3>

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
			<th class='text-center'>Kejadian</th>
			<th class='text-center'>Kamtib</th>
			<th class='text-center'>Info Diterima</th>
			<th class='text-center'>Taruna Dari</th>
			<th class='text-center'>Cuaca</th>				
			<th>DETAIL</th>
		</tr>
	</thead>
	<tbody>
	<?php 

		$sqlKejadian = "SELECT * FROM tb_laporan a left join tb_pegawai c on a.id_user=c.id_user , tb_detail_laporan b where a.id_laporan=b.id_laporan order by tgl_detail_created desc LIMIT 1500";
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
			<td class='text-center'><?php echo $valkejadian["type_kejadian"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["kamtib"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_1"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["taruna_dari"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["cuaca"]; ?></td>			
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
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <div id="test" class="pull-right"></div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
	
	<div class="modal fade " id="tampil-data">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"></span></button>
				  					<img src="assets1/img/now-logo.png" width="150px" height="90px" alt="">	
                <h4 class="modal-title">LAPORAN KEJADIAN KHUSUS </h4>
				PETUGAS INFORMASI DAN KOMUNIKASI
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
		 <!--------------------  Type Kejadian / Kamtib-------------------------------->					
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
					
		 <!-------------------- Waktu Taruna / Waktu Kejadian / Keperluan -------------------------------->
		 
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
				      <td><h4 ><span class="label label-success ">Kendaraan 3-3</span></td>				
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
		 <!-------------------- Kendaraan Terlibat-------------------------------->					
				      <td><h4 ><span class="label label-success ">Kendaraan Terlibat</span></td>				
					<tr>
						<td align="right">Jenis Kendaraan 1</td>
						<td>:</td>
						<td>
							<span id="jenis_kendaraan1"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Nomor Polisi 1</td>
						<td>:</td>
						<td>
							<span id="nopol1"></span>
						</td>
	                </tr>	

					<tr>
						<td align="right">Jenis Kendaraan 2</td>
						<td>:</td>
						<td>
							<span id="jenis_kendaraan2"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Nomor Polisi 2</td>
						<td>:</td>
						<td>
							<span id="nopol2"></span>
						</td>
	                </tr>		
					<tr>
						<td align="right">Jenis Kendaraan 3</td>
						<td>:</td>
						<td>
							<span id="jenis_kendaraan3"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Nomor Polisi 3</td>
						<td>:</td>
						<td>
							<span id="nopol3"></span>
						</td>
	                </tr>	
					<tr>
						<td align="right">Jenis Kendaraan 4</td>
						<td>:</td>
						<td>
							<span id="jenis_kendaraan4"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Nomor Polisi 4</td>
						<td>:</td>
						<td>
							<span id="nopol4"></span>
						</td>
	                </tr>	
					<tr>
						<td align="right">Jenis Kendaraan 5</td>
						<td>:</td>
						<td>
							<span id="jenis_kendaraan5"></span>
						</td>
	                </tr>					
					<tr>
						<td align="right">Nomor Polisi 5</td>
						<td>:</td>
						<td>
							<span id="nopol5"></span>
						</td>
	                </tr>						
			 <!-------------------- Lokasi -------------------------------->					
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
			 <!-------------------- Korban Jiwa -------------------------------->					
				      <td><h4 ><span class="label label-success ">Korban Jiwa</span></td>			
					<tr>
						<td align="right">Luka Berat</td>
						<td>:</td>
						<td>
							<span id="luka_berat"></span>
						</td>
	                </tr>
					<tr>
						<td align="right">Luka Ringan</td>
						<td>:</td>
						<td>
							<span id="luka_ringan"></span>
						</td>
	                </tr>
					<tr>
						<td align="right">Meniggal</td>
						<td>:</td>
						<td>
							<span id="meninggal"></span>
						</td>
	                </tr>	
			 <!-------------------- Kerugian Sarana -------------------------------->					
				      <td><h4 ><span class="label label-success ">Kerusakan dan Kerugian Sarana</span></td>			
					<tr>
						<td align="right">Kerusakan Sarana</td>
						<td>:</td>
						<td>
							<span id="sarana"></span>
						</td>
	                </tr>	
					<tr>
						<td align="right">Nilai Kerugian</td>
						<td>:</td>
						<td>
							<span id="materi_rupiah"></span>
						</td>
	                </tr>
			 <!-------------------- Cuaca -------------------------------->					
				      <td><h4 ><span class="label label-success ">Info Cuaca</span></td>
					<tr>
						<td align="right">Cuaca</td>
						<td>:</td>
						<td>
							<span id="Cuaca"></span>							
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
				<button type="button" class="btn btn-primary" onclick="window.print();">Print</button>					
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
					{ "data": "Kejadian" },
		            { "data": "T1" },
		            { "data": "Kilometer"},
					{ "data": "Cuaca" },
					{ "data": "DETAIL" },
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
				filename: 'DataKejadianKecelakaan<?php echo date("Ymd"); ?>'
			
			},
			{
				extend: 'excel',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
				filename: 'DataKejadianKecelakaan<?php echo date("Ymd"); ?>'
			}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": true, "targets": 10 }
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
	table.ajax.url( '<?php echo $fgmembersite->sitename; ?>/dataKejadianJs.php?'+$( this ).serialize() ).load();
 


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
				$('#jenis_kendaraan1').html(obj.jenis_kendaraan1);
				$('#nopol1').html(obj.nopol1);	
				$('#jenis_kendaraan2').html(obj.jenis_kendaraan2);
				$('#nopol2').html(obj.nopol2);	
				$('#jenis_kendaraan3').html(obj.jenis_kendaraan3);
				$('#nopol3').html(obj.nopol3);					
				$('#jenis_kendaraan4').html(obj.jenis_kendaraan4);
				$('#nopol4').html(obj.nopol4);
				$('#jenis_kendaraan5').html(obj.jenis_kendaraan5);
				$('#nopol5').html(obj.nopol5);	
				$('#luka_berat').html(obj.luka_berat);	
				$('#luka_ringan').html(obj.luka_ringan);	
				$('#meninggal').html(obj.meninggal);					
				$('#sarana').html(obj.sarana);					
				$('#materi_rupiah').html(obj.materi_rupiah);							
				$('#info').html(obj.waktu_info_diterima);
				$('#keperluan').html(obj.keperluan);				
				$('#kilometer').html(obj.kilometer);
				$('#meter').html(obj.meter);
				$('#ruas').html(obj.ruas);
				$('#uraian_kegiatan').html(obj.uraian_kegiatan);
				$('#Cuaca').html(obj.cuaca);				
				$('#keterangan').html(obj.keterangan);				
			}             
		});
		//return false;
		
		$('#tampil-data').modal({
			show: 'false'
		}); 
	
		
		
		
    });
	
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

?>
 
});
</script>