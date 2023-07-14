 <title>MTRS-TMJ | Data Lajur Penyelamat</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Lajur Penyelamat 
        <small>Menampilkan Seluruh Data Lajur Penyelamat</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Lajur Penyelamat </li>
        <!-- <li class="active">Blank page</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pencarian Data Lajur Penyelamat Rentang Waktu Tertentu</h3>
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
          <h3 class="box-title">Seluruh Data Lajur Penyelamat</h3>

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
			<th class='text-center'>Tanggal</th>
			<th class='text-center'>Pukul</th>
			<th class='text-center'>Lokasi</th>
			<th class='text-center'>Nama KR</th>
			<th class='text-center'>Nopol</th>
			<th class='text-center'>Kendala</th>
			<th class='text-center'>Tujuan</th>
			
			<th>DETAIL</th>
		</tr>
	</thead>
	<tbody>
	<?php 

		$sqlKejadian = "SELECT * FROM tb_laporan a left join tb_pegawai c on a.id_user=c.id_user , tb_detail_laporan b where a.id_laporan=b.id_laporan and kilometer in (425,430,431) and keterangan like '%lajur penyelamat%'  order by tgl_detail_created desc LIMIT 100";
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
			<td class='text-center'><?php echo $fgmembersite->namahari($datestr->format('l')); ?>,<?php echo $datestr->format('Y-m-d'); ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_1"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["kilometer"]; ?><?php echo $valkejadian["meter"]; ?></td>
			
			<td class='text-center'><?php echo $valkejadian["jenis_kendaraan"]; ?></td>
			
			<td class='text-center'><?php echo $valkejadian["nopol"]; ?></td>	
			
			<td class='text-center'><?php echo $valkejadian["type_kejadian"]; ?></td>		
			<td class='text-center'><?php echo $valkejadian["keterangan"]; ?></td>				
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
	
	<div class="example-modal">
	<div class="modal modal-success" id="tampil-data" >
          <div class="modal-dialog modal-lg">	
		  <div id="print-me">			  
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Kendaraan Masuk Jalur Penyelamat </h4>
              </div>
			  
			  <form class="form-horizontal" id="harianPetugasPik" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET['mod']; ?>' method='post' accept-charset='UTF-8'>
              <div class="modal-body">

            <!---------------------modifikasi --------------------------------->


      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa fa-info-circle"></i> Detail Data Kendaraan Masuk Jalur Penyelamat
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Petugas PIK : </strong><br>
            <span id="pik"></span>	<br>
            <strong>ID Kashift : </strong><br>
            <span id="kashift"></span>	<br>			
          </address>
        <!-- /.col -->			  
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <strong>Taruna Dari : </strong>
          <address>
            <span id="taruna_dari"></span><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
		<address>
          <strong>Tanggal Laporan : </strong><br>
		  <span id="tgl_laporan"></span><br>
          <strong>Perioda : </strong></br>
		  <span id="perioda"></span><br>
		</address>
        </div>
        <!-- /.col -->
	
      </div>
      <!-- /.row -->


      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Type Kejadian : </strong><br>
            <span id="type_kejadian"></span><br>
          </address>		  
        </div>
        <!-- /.col -->			
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Cuaca : </strong><br>
            <span id="Cuaca"></span><br>
          </address>		  
        </div>
        <!-- /.col -->		
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Info Diterima: </strong><br>
            <span id="t1"></span><br>
          </address>		  
        </div>
        <!-- /.col -->			
      </div>
      <!-- /.row -->

      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Lokasi Di Kilometer :</strong><br>
            <span id="kilometer"></span> <span id="meter"></span> <span id="ruas"></span><br>
          </address>		  
        </div>
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Jenis Kendaraan: </strong><br>
            <span id="jenis_kendaraan"></span><br>
          </address>		  
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Nomor Polisi : </strong><br>
            <span id="nopol"></span><br>
          </address>		  
        </div>
        <!-- /.col -->		
      </div>
      <!-- /.row -->

      <!-- info row -->
      <!--  <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Kendaraan Terlibat dan Nopol :</strong><br>
            <span id="jenis_kendaraan1"></span> - <span id="nopol1"></span> /
			<span id="jenis_kendaraan2"></span> - <span id="nopol2"></span> /
			<span id="jenis_kendaraan3"></span> - <span id="nopol3"></span> /
			<span id="jenis_kendaraan4"></span> - <span id="nopol4"></span> /
			<span id="jenis_kendaraan5"></span> - <span id="nopol5"></span> /
			<br>
          </address>		  
        </div>
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Korban Meniggal /LB /LR</strong><br>
            <span id="meninggal"></span>/<span id="luka_berat"></span>/<span id="luka_ringan"></span><br>
          </address>		  
        </div>

      </div>
	  -->
      <!-- /.row -->
	  
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Keterangan:</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
		<span id="keterangan"></span>
          </p>
        </div>
        <!-- /.col -->
        <!--
		<div class="col-xs-6">
          <p class="lead">Kerusakan dan Kerugian Sarana</p>
          <address>
            <strong>Kerusakan Sarana:</strong><br>
            <span id="sarana"></span><br>
          </address>
          <address>
            <strong>Nilai Kerugian:</strong><br>
            <span id="materi_rupiah"></span><br>
          </address>
        </div>
		-->
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
		<button type="button" class="btn btn-default pull-left" data-dismiss="print" onclick="printDiv('print-me')">
		<i class="fa fa-print" ></i>
		<span class="badge bg-blue">Print</span>
		</button>
		

        </div>
      </div>
    </section>			
			  
			  
			 </div>
            </div>
			</div>
            <!-- /.tambahan print area -->
          </div>
		  </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->	
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
					{ "data": "kilometer" },
					{ "data": "jenis_kendaraan" },
		            { "data": "nopol" },
		            { "data": "type_kejadian"},
		            { "data": "keterangan"},					
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
				filename: 'DataKamtib<?php echo date("Ymd"); ?>'
			
			},
			{
				extend: 'excel',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
				filename: 'DataKamtib<?php echo date("Ymd"); ?>'
			}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": true, "targets": 6 }
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
	table.ajax.url( '<?php echo $fgmembersite->sitename; ?>/dataKamtibJs.php?'+$( this ).serialize() ).load();
 


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
<script>
function printDiv(div) {    
    // Create and insert new print section
    var elem = document.getElementById(div);
    var domClone = elem.cloneNode(true);
    var $printSection = document.createElement("div");
    $printSection.id = "printSection";
    $printSection.appendChild(domClone);
    document.body.insertBefore($printSection, document.body.firstChild);

    window.print(); 

    // Clean up print section for future use
    var oldElem = document.getElementById("printSection");
    if (oldElem != null) { oldElem.parentNode.removeChild(oldElem); } 
                          //oldElem.remove() not supported by IE

    return true;
}
</script>