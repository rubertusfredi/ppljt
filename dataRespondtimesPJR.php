<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Respond Times PJR
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $fgmembersite->sitename; ?>?mod=respondTimes">Data Respondtimes</a></li>
        <li class="active">PJR</li>
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
          <h3 class="box-title">Data Respond Times PJR Tahun <?php echo date("Y"); ?></h3>

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
			<th class='text-center'>ID Laporan</th>
			<th class='text-center'>Layanan</th>
			<th class='text-center'>Waktu Taruna</th>
			<th class='text-center'>Waktu Tiba</th>
			<th class='text-center'>Respond Times</th>
			<th>Informasi Detail</th>
		</tr>
	</thead>
	<tbody>
	<?php 			
		$sqlKejadian = "SELECT * FROM tb_sub_detail_laporan WHERE petugas='PJR' order by id_sub desc";
		$fgmembersite->sql($sqlKejadian);						
		$resKejadian = $fgmembersite->getResult();
		$a = 1;
		foreach($resKejadian as $outputkejadian => $valkejadian)
		{
		
	?>

		<tr>
			<td class='text-center'><?php echo $a; ?></td>
			<td class='text-center'><?php echo $valkejadian["id_detail_laporan"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["petugas"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_sub_1"]; ?></td>
			<td class='text-center'><?php echo $valkejadian["waktu_sub_2"]; ?></td>			
			<td class='text-center'><?php echo $valkejadian["waktu_sub_3"]; ?></td>			
			<td class='text-center'>
				<button type="button" class="btn bg-yellow"  >
				<a href="index.php?mod=formKejadianView&id=<?php echo $valkejadian["id_detail_laporan"]; ?>&st=edit" >
				<i class="fa fa-arrow-circle-right"></i>
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
      <!-- /.box -->

    </section>
    <!-- /.content -->
	
   <!-- /.modal -->
		


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