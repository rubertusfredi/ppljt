 <title>PPLJT | Data Absensi</title>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absensi Petugas
        <small>Menampilkan Data Absensi Petugas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Main</a></li>
        <li class="active">Absen Petugas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">	
		  
		  
		  <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><a href="<?php echo "?mod=absenPetugasForm"; ?>" class="btn bg-olive btn-flat "><i class="fa fa-plus"></i> Tambah Data Absensi</a></h3>

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
							<th class='text-center'>KaShift</th>
							<th class='text-center'>PIK</th>
							<th class='text-center'>Ass.PIK</th>
							<th class='text-center'>LJT212</th>
							<th class='text-center'>LJT213</th>
							<th class='text-center'>Ambulance</th>
							<th class='text-center'>Rescue</th>
							<th class='text-center'>PJR</th>
							<th class='text-center'>Gajah</th>
							<th class='text-center'>EDIT</th>
							<th class='text-center'>DELETE</th>
							
						</tr>
					</thead>
					<tbody>
					<?php
					$sqlh = 'select *,date(tgl_tugas) as tglj from tb_tugas order by tgl_tugas desc, shift desc';
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
							/*
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="LJT213"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo "<td class='text-center'><ul class='users-list clearfix'>";
							foreach($resdet as $outputdet)
							{
								if ($outputdet['foto']<>"")
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$outputdet['foto'];
								}
								else
								{
									$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
								}
								echo "
                    <li><img src='".$imgtemp."' alt='User Image' width='60'><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> </li>";

							}
							echo "</ul></td>";
							*/
							
							## Ambulance
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
						<td>
							<a href='<?php echo "?mod=absenPetugasForm&st=edit&id=".$outputh['id_tugas']; ?>' class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> </a>
							<!--<button type="button" class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> </button>  -->
						</td>
						<td>
							<button type="button" class="btn bg-maroon  btn-flat delete" id="del<?php echo $outputh['id_tugas']; ?>"><i class="fa fa-trash"></i></button>
							
						</td>
						<td>
							<button type="button" class="btn bg-green  btn-flat delete" id="verifi<?php echo $outputh['id_tugas']; ?>"><i class="fa fa-trash"></i></button>
							
						</td>						
						<?php
						echo "</tr>";
						$a++;
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