 <title>PPLJT | Data Kilometer Kendaraan</title>
<?php
#echo "<pre>";
#print_r($_SESSION[$fgmembersite->GetLoginSessionVar()]);
#echo "</pre>";
#echo $_SESSION[$fgmembersite->GetLoginSessionVar()]["user"]["id_user"];
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kilometer Kendaraan Petugas LJT
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Main</a></li>
        <li class="active">Checklist Kendaraan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">	
		  
		  
		  <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><a href="<?php echo "?mod=checklistForm"; ?>" class="btn btn-info btn-flat "><i class="fa fa-plus"></i> Kilometer Awal</a> <a href="<?php echo "?mod=checklistAkhirForm"; ?>" class="btn bg-olive btn-flat "><i class="fa fa-plus"></i> Kilometer Akhir</a></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
				<table  class="table table-hover table-bordered table-striped">
					<thead>
						<tr class='text-center'>
							<th>No</th>
							<th class='text-center'>Tanggal</th>
							<th class='text-center'>Shift</th>
							<th class='text-center'>Jenis Sarana</th>							
							<th class='text-center'>Kilometer Awal</th>
							<th class='text-center'>EDIT</th>							
							<th class='text-center'>Kilometer Akhir</th>
							<th class='text-center'>EDIT</th>
							<th class='text-center'>Total Klometer</th>							
							<th class='text-center'>DELETE</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sqlh = "select * from tb_tugas where id_pik='".$_SESSION[$fgmembersite->GetLoginSessionVar()]["user"]["id_user"]."' order by tgl_tugas desc";
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
							
							echo "<tr id='tr".$outChecklist['id_checklist_sarana']."'>";
							echo "<td  class='text-center'>".$a."</td>";
							echo "<td  class='text-center'><span class='label label-success'>".$outputh['tgl_tugas']."</span></td>";
							if($outputh['shift']=="1"){ $label = "success"; }
							if($outputh['shift']=="2"){ $label = "primary"; }
							if($outputh['shift']=="3"){ $label = "danger"; }
							echo "<td ".$rowspan." class='text-center'><span class='label label-".$label."'>".$outputh['shift']."</span></td>";
							echo "<td  class='text-center'>".$outChecklist['id_kendaraan']."</td>";
							echo "<td  class='text-center'>".$outChecklist['km_awal']."</td>";
							?>
							<td class='text-center'>
								<a href='<?php echo "?mod=checklistForm&st=edit&id=".$outputh['id_tugas']; ?>' class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> </a>
								<!--<button type="button" class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> </button>  -->
							</td>
							<?php
							echo "<td  class='text-center'>".$outChecklist['km_akhir']."</td>";
							
							?>
							<td class='text-center'>
								<a href='<?php echo "?mod=checklistAkhirForm&st=edit&id=".$outputh['id_tugas']; ?>' class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> </a>
								<!--<button type="button" class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> </button>  -->
							</td>
							<td>Total: <span class="label label-danger"><?php echo ($outChecklist['km_akhir']-$outChecklist['km_awal']); ?> Km.</span></td>
							<td class='text-center'>
								<button type="button" class="btn bg-maroon  btn-flat delete" id="del<?php echo $outChecklist['id_checklist_sarana']; ?>"><i class="fa fa-trash"></i></button>
								
							</td>
							<?php
							echo "</tr>";
							$a++;
							
						}
					}
					?>                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body 
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->


    </section>
    <!-- /.content -->
<script type="text/javascript">
$(document).ready(function () 
{
	$('.delete').click(function() 
	{
		id=$(this).attr("id");
		cd=$(this).attr("id");
		req=cd.substring(0,3);
		id=cd.substring(3,40);
		//alert(id);
		var cnfm = confirm("Yakin, data "+id+" akan dihapus...?");
		{
			if (cnfm)
			{		
		
				
				//alert( data[1] +"'s salary is: "+ data[2] );
				$.ajax({
					url: '<?php echo $fgmembersite->sitename; ?><?php echo "delData.php"; ?>',
					data: ({ 'id': id,'mod' : '<?php echo $_GET["mod"]; ?>' }),
					//dataType: 'json', 
					type: 'post',
					success: function(data) {
						//alert(data);
						
						
						data=$.trim(data);
						data=data.split("#");
						
						if (data[0]=="True"){
							$('#tr'+id).remove();
							new PNotify({
								title: 'Success',
								text: data[1],
								type: 'success'
							});
							
							
						}					
						else
						{
							new PNotify({
								title: 'Error',
								text: data[1],
								type: 'error'
							});
						}
						
					}             
				});
				return false;
			}
			else
			{
				//$("#tr"+id).css({ backgroundColor:"ffffff",fontWeight: "normal" });
				//$("#tr"+id).css({ fontWeight: "normal" });
				//$("#"+cd).removeClass();
				//$("#"+cd).addClass(cls);
			}
		};
	});
});
</script>