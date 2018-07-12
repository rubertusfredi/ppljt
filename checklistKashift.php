<title>PPLJT | Kilmeter Beat Petugas</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kilometer Beat Petugas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Main</a></li>
        <li class="active">Kilometer Beat Petugas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">	
		  
		  
		  <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
			<h3 class="box-title">Data Kilometer Beat Petugas</h3>
			
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="tablesatu" class="table table-bordered table-striped">
					<thead>
		            <tr>					
							<th class='text-center'>No</th>
							<th class='text-center'>Tanggal</th>
							<th class='text-center'>Shift</th>
							<th class='text-center'>Jenis Sarana</th>							
							<th class='text-center'>Kilometer Awal</th>		
							<th class='text-center'>Kilometer Akhir</th>
							<th class='text-center'>Total Kilometer</th>							
		            </tr>						
					</thead>
					<tbody>
					<?php
					$sqlh = "select * from tb_tugas order by tgl_tugas desc";
					#echo $sqlh;
					#$sqlh = 'select *,date(tgl_tugas) as tglj from tb_tugas  order by tgl_tugas desc, shift desc';
					$fgmembersite->sql($sqlh);
					$resh = $fgmembersite->getResult();					
					$a=1;					
					foreach($resh as $outputh)
					{
						$sqlCek = "Select * from tb_checklist_sarana where id_tugas='".$outputh['id_tugas']."' or (date(tgl)='".$outputh['tgl_tugas']."' and shift='".$outputh['shift']."')";	
						#echo $sqlCek;				

						
						$fgmembersite->sql($sqlCek);
						#$rows = $fgmembersite->numRows();
						$rowChecklist = $fgmembersite->getResult();
						foreach($rowChecklist as $outChecklist)
						{
							#$rowspan = "";
							#if ($rows>1)
							#{
								#$rowspan = "rowspan='".$rows."'";							
							#	$rowspan = "rowspan='1'";							
							#}
							echo "<tr>";					
							echo "<td  class='text-center'>".$a."</td>";
							echo "<td  class='text-center'><span class='label label-warning'>".$outputh['tgl_tugas']."</span></td>";
							if($outputh['shift']=="1"){ $label = "success"; }
							if($outputh['shift']=="2"){ $label = "primary"; }
							if($outputh['shift']=="3"){ $label = "warning"; }
							echo "<td ".$rowspan." class='text-center'><span class='label label-".$label."'>".$outputh['shift']."</span></td>";
							echo "<td  class='text-center'>".$outChecklist['id_kendaraan']."</td>";
							echo "<td  class='text-center'>".$outChecklist['km_awal']."</td>";
							?>
							<?php
							echo "<td  class='text-center'>".$outChecklist['km_akhir']."</td>";
							
							?>

							<td>Total: <span class="label label-danger"><?php echo ($outChecklist['km_akhir']-$outChecklist['km_awal']); ?> Km.</span></td>
	
							<?php
							echo "</tr>";
							$a++;
							
						}
					}
					?>                  
                  </tbody>
                </table>
            
              <!-- /.table-responsive -->
            </div>
            </div>
        <!-- /.box-body -->
        <div class="box-footer">
         <div id="test" class="pull-right"></div>
        </div>
        <!-- /.box-footer-->
      </div>

    </section>
    <!-- /.content -->
<script>

$(function () 
{
	
	var table = $('#tablesatu').DataTable( 
	{

	"columns": [
		            { "data": "no" },
		            { "data": "tanggal" },
					{ "data": "Shift" },
					{ "data": "Jenis_Sarana" },
					{ "data": "Kilometer_Awal" },
		            { "data": "Kilometer_Akhir" },
					{ "data": "Total_Kilometer" },
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
				filename: 'Data Kilometer Beat Petugas <?php echo date("Ymd"); ?>'
			
			},
			{
				extend: 'excel',
				className: 'btn btn-app pull-right',
				text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
				filename: 'Data Kilometer Beat Petugas <?php echo date("Ymd"); ?>'
			}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": false, "targets": 6 }
		]
	})
	

    table.buttons().container()
        .appendTo( '#test' );
	
$("#idForm").submit(function(e) 
{
	e.preventDefault(); // avoid to execute the actual submit of the form.
	//alert('<?php echo $fgmembersite->sitename; ?>/dataKejadianJs.php?'+$( this ).serialize());
	
	//var table = $('#tablesatu').DataTable();
	table.ajax.url( '<?php echo $fgmembersite->sitename; ?>/dataKejadian33Js.php?'+$( this ).serialize() ).load();
 


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
				$('#tanggal').html(obj.tanggal);
				$('#Shift').html(obj.shift);
				$('#Jenis_Sarana').html(obj.id_ka_shift);
				$('#Kilmeter_Awal').html(obj.pik_assistant);
				$('#Kilmeter_Akhir').html(obj.pik_assistant);
				$('#Total_Kilometer').html(obj.LJT212);
			
			}             
		});
		//return false;
		
		$('#modal-default').modal({
			show: 'false'
		}); 
	
		
		
		
    });
	
  });
</script>