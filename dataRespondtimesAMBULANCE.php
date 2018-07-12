<title>PPLJT | Data Respond Times Ambulance</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Respond Times Ambulance
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $fgmembersite->sitename; ?>?mod=respondTimes">Data Respond Times</a></li>
        <li class="active">Ambulance</li>	
        <!-- <li class="active">Blank page</li> -->
      </ol>
    </section>

   <!-- Main content -->
    <section class="content">
<!-- Horizontal Form -->
               <a class="btn btn-app bg-yellow">
                <i class="glyphicon glyphicon-hand-left" onclick="goBack()" ></i>Kembali
              </a>
					<script>
						function goBack() {
								window.history.back();
											}
					</script>		  
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Seluruh Data Respond Times Petugas Ambulance Tahun <?php echo date("Y"); ?></h3>

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
			<th class='text-center'>ID Detail Laporan</th>
			<th class='text-center'>Tanggal</th>
			<th class='text-center'>Layanan</th>
			<th class='text-center'>Waktu Taruna</th>
			<th class='text-center'>Waktu Tiba</th>
			<th class='text-center'>Respond Times</th>
			<th class='text-center'>Informasi Detail</th>
		</tr>
	</thead>
	<tbody>
	<?php 			
		$sqlKejadian = "SELECT * FROM tb_sub_detail_laporan WHERE petugas='AMBULANCE' order by id_sub desc";
		$fgmembersite->sql($sqlKejadian);						
		$resKejadian = $fgmembersite->getResult();
		$a = 1;
		foreach($resKejadian as $outputkejadian => $valkejadian)
		{
		$datestr = DateTime::createFromFormat('Y-m-d H:i:s', $valkejadian["id_detail_laporan"]);
	?>

		<tr>
			<td class='text-center'><?php echo $a; ?></td>
			<td class='text-center'><?php echo $valkejadian["id_detail_laporan"]; ?></td>
			<td class='text-center'><?php echo substr($valkejadian["id_detail_laporan"],0,8); ?></td>
			<td class='text-center'><?php echo $valkejadian["petugas"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_sub_1"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_sub_2"]; ?></td>			
			<td class='text-center'><?php echo $valkejadian["waktu_sub_3"]; ?></td>			
			<td class='text-center'>
				<button type="button" class="btn bg-orange">
				<a href="index.php?mod=formKejadianView&id=<?php echo $valkejadian["id_detail_laporan"]; ?>&st=edit" >
				<i class="fa fa-search"> Lihat Detail</i>
				</a>
				</button>
				
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
	
	
        <!-- /.modal -->
		


<script>

$(function () 
{
	
	var table = $('#tablesatu').DataTable( 
	{

	"columns": [
		            { "data": "no" },
		            { "data": "id" },
		            { "data": "petugas" },
					{ "data": "waktu_sub_1" },
					{ "data": "waktu_sub_2" },
					{ "data": "waktu_sub_3" },
					{ "data": "Informasi_Detail" },
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
				filename: 'Data Respon Times Ambulance<?php echo date("Ymd"); ?>'
			
			},
			{
				extend: 'excel',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
				filename: 'Data Respon Times Ambulance<?php echo date("Ymd"); ?>'
			}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": true, "targets": 7 }
		]
	})
	

    table.buttons().container()
        .appendTo( '#test' );
	
$("#idForm").submit(function(e) 
{
	e.preventDefault(); 

	table.ajax.url( '<?php echo $fgmembersite->sitename; ?>/dataRespondtimesAMBULANCEJs.php?'+$( this ).serialize() ).load();
 


});

	$('#tablesatu tbody').on( 'click', 'button', function () 
	{
		var data = $(this).attr('id_sub');
		$.ajax({
			url: '<?php echo $fgmembersite->sitename; ?>jsduo.php',
			data: ({ 'id_sub': data }),
			//dataType: 'json', 
			type: 'post',
			//dataType: 'json',
			success: function(data) 
			{
				var obj = jQuery.parseJSON( data );
				$('#id').html(obj.id_detail_laporan);
				$('#petugas').html(obj.petugas);
				$('#waktu_sub_1').html(obj.waktu_sub_1);
				$('#waktu_sub_2').html(obj.waktu_sub_2);
				$('#waktu_sub_3').html(obj.waktu_sub_3);			
			}             
		});
		//return false;
		
		$('#modal-default').modal({
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