<?PHP
if(isset($_POST['cari']))
{ 
	$date = DateTime::createFromFormat('Y-m-d', $_POST['tgl']);
	$dy = $date->format('t');
}
else
{
	$date = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
	$dy = date('t');
}

?>
<?php
$moduleTitle = "Kendaraan Mogok";
$moduleDesc = "Rekapitulasi data kejadian pada kendaraan ";
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small><?php echo $moduleDesc; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li> 
		<li>Laporan </li>		
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

	<div class="box box-primary ">
					<div class="box-header ">
						<h3 class="box-title">Pencarian Data </h3>
						<!--<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fa fa-times"></i></button>
						</div>
						-->
					</div>
					
					<div class="box-body">
					<form class="form-horizontal" id="caribox" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=<?php echo $_GET['mod']; ?>' method='post' accept-charset='UTF-8'>
					<input type='hidden' name='cari' id='cari' value='1'/>
						<div class="form-group <?php if (isset($error['shift'])){echo 'has-error';} ?>">
							<label for="shift" class="col-sm-2 control-label">Tanggal</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right tanggal" name="tgl" id="datepicker" value="<?php echo $fgmembersite->SafeDisplay('tgl'); ?>">							
								</div>
								<?php if (isset($error['shift'])){echo '<i><small><span class="help-block">'.$error['shift'].'</span></small></i>';} ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" class="btn btn-md btn-primary pull-right btn-block" name='Submit' value='Cari'>
								
							</div>
						</div>
					</form>
					</div>
					<!-- /.box-body 
					<div class="box-footer">
								
					</div>
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->
				
      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tabel Rekapitulasi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

<table id="tablesatu" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>MESIN RUSAK</th>
			<th>BBM</th>
			<th>RODA</th>
			<th>BAN</th>
			<th>LAIN-LAIN</th>
			<th>JUMLAH</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$jml["MESIN RUSAK"] = 0;
	$jml["BBM"] = 0;
	$jml["RODA"] = 0;
	$jml["BAN"] = 0;
	$jml["LAIN2"] = 0;
	for($a=1;$a<=$dy;$a++)
	{
		$data["MESIN RUSAK"] = 0;
		$data["BBM"] = 0;
		$data["RODA"] = 0;
		$data["BAN"] = 0;
		$data["LAIN2"] = 0;
		$data["jmltot"] = 0;	
		$sqlKejadian = "SELECT a.tgl_laporan,b.type_kejadian,count(b.type_kejadian) as jml_kejadian FROM tb_laporan a,tb_detail_laporan b WHERE a.id_laporan=b.id_laporan and date(a.tgl_laporan)='".$date->format('Y-m-').$a."' group by a.tgl_laporan,b.type_kejadian";
		$fgmembersite->sql($sqlKejadian);						
		$resKejadian = $fgmembersite->getResult();		
		foreach($resKejadian as $outputkejadian => $valkejadian)
		{
			#echo "data[".$valkejadian["type_kejadian"]."]<br>";
			$data[$valkejadian["type_kejadian"]] = $valkejadian["jml_kejadian"];
		}
		$jml["MESIN RUSAK"] = $jml["MESIN RUSAK"] + $data["MESIN RUSAK"];
		$jml["BBM"] = $jml["BBM"] + $data["BBM"];
		$jml["RODA"] = $jml["RODA"] + $data["RODA"];
		$jml["BAN"] = $jml["BAN"] + $data["BAN"];
		$jml["LAIN2"] = $jml["LAIN2"] + $data["LAIN2"];
		$jml["jmltot"] = $jml["jmltot"] + array_sum($data);
		?>
		<tr>
			<td><?php echo $date->format('Y/m/').$a; ?></td>
			<td><?php echo $data["MESIN RUSAK"]; ?></td>
			<td><?php echo $data["BBM"]; ?></td>
			<td><?php echo $data["RODA"]; ?></td>
			<td><?php echo $data["BAN"]; ?></td>
			<td><?php echo $data["LAIN2"]; ?></td>
			<td><?php echo array_sum($data); ?></td>
		</tr>
		<?php
	}
	?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Jumlah</th>
			<th><?php echo $jml["MESIN RUSAK"]; ?></th>
			<th><?php echo $jml["BBM"]; ?></th>
			<th><?php echo $jml["RODA"]; ?></th>
			<th><?php echo $jml["BAN"]; ?></th>
			<th><?php echo $jml["LAIN2"]; ?></th>
			<th><?php echo $jml["jmltot"]; ?></th>
		</tr>
	</tfoot>
</table>
		  
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
	<script>
$(function(){
	//Date picker
    $('.tanggal').datepicker({
  format: "yyyy-mm-dd"
});
 
});
</script>
	<script>
  $(function () {
	  var table = $('#tablesatu').DataTable( {
'paging'      : true,      
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
	  'responsive': true,
        lengthChange: false,
        buttons: [ {
			extend: 'print',
			className: 'btn btn-app pull-right',
			text:'<i class="fa fa-print" ></i> <span class="badge bg-purple">Print</span>',
			filename: 'KendaraanMogok<?php echo date("Ymd"); ?>'
		
		},
		{
			extend: 'excel',
			className: 'btn btn-app pull-right',
			text:'<i class="fa fa-file-excel-o" ></i> <span class="badge bg-green">XLS</span>',
			filename: 'KendaraanMogok<?php echo date("Ymd"); ?>'
		}
		],
		"columnDefs": [
			{ "orderable": true, "targets": 0 },
			{ "orderable": true, "targets": 3 },
			{ "orderable": true, "targets": 4 }
		]
    } );
 
    table.buttons().container()
        .appendTo( '#test' );
		
    /*$("#tablesatu").DataTable({
		dom: 'Bfrtip',
            buttons: ['print', 'excel', 'pdf' 
                'copy', 'excel', 'pdf', 'print'
            ]
	});   
	*/
  });
</script>