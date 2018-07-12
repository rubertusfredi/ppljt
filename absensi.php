<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absensi Petugas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Main</a></li>
        <li class="active">Absensi Petugas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<!-- Small boxes (Stat box) -->
	

		  <!-- /.row -->
		  
		  <!-- Main row -->

		  
		  <?php /*
		  <div class="row">
	<div class="col-md-12 connectedSortable">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user1-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user8-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user7-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user6-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
				  
				  <ul class="users-list clearfix">                    
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
		  */ ?>
		  
		  <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Petugas</h3>

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
							<th class='text-center'>Kepala Shift</th>
							<th class='text-center'>PIK</th>
							<th class='text-center'>Assistant PIK</th>
							<th class='text-center'>LJT212</th>
							<th class='text-center'>LJT213</th>
							<th class='text-center'>Ambulance</th>
							<th class='text-center'>Driver Ambulance</th>
							<th class='text-center'>Rescue</th>
							
						</tr>
					</thead>
					<tbody>
					<?php
					$sqlh = 'select *,date(tgl_tugas) as tglj from tb_tugas  order by tgl_tugas desc';
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
						
						echo "<tr>";
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
							$imgtemp = $fgmembersite->sitename.$fgmembersite->media_img.$resPeg[0]['foto'];
						}
						else
						{
							$imgtemp = $fgmembersite->sitename.$fgmembersite->assets.'dist/img/user-160x160.png';
						}						
						#echo "<td ".$rowspan."><img src='".$imgtemp."' alt='User Image' class='img-circle' width='60'> <div class='caption'><a class='' href='#'>".$resKa[0]['name']." </a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span></div></div></td>";
						
						echo "<td ".$rowspan." class='text-center'><img src='".$imgtemp."' alt='User Image' class='img-circle' width='50'> <div class='caption'><a class='' href='#'>".$resKa[0]['name']." </a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span></td>";
						
						
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
						echo "<td ".$rowspan." class='text-center'><img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br> <a class='' href='#'>".$resKa[0]['name']."</a> <span class='users-list-date'>(".$resKa[0]['npp'].")</span> </td>";
						
						if ($rows>0)
						{
							//---------------------- Assistant PIK --------	
						$fgmembersite->select('tb_pegawai','*',null,'id_user="'.$outputh['pik_assistant'].'"','');
						$resAss = $fgmembersite->getResult();
						if ($resAss[0]['foto']<>"")
							$b=1;
							echo  "<td class='text-center'><ul class='users-list clearfix'>";
							foreach($resAss as $outputdet)
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
								echo " <img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";							
							 //---------------------- LJT212 --------		
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="LJT212"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo  "<td class='text-center'><ul class='users-list clearfix'>";
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
								echo " <img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";							
						 //---------------------- LJT213 --------	
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="LJT213"';	
							$fgmembersite->sql($sqldet);
							$resdet = $fgmembersite->getResult();
							$b=1;
							echo  "<td class='text-center'><ul class='users-list clearfix'>";
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
								echo " <img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
		
		                  //---------------------- Ambulance --------
		
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
								echo " <img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
							

		                  //----------------------Driver Ambulance --------
		
							$sqldet = 'select * from tbl_tugas_detail a,tb_pegawai b where a.id_user=b.id_user and a.id_tugas="'.$outputh['id_tugas'].'" and id_kendaraan="Driver Ambulance"';	
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
								echo " <img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";
							
		                  //----------------------Rescue --------
		
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
								echo " <img src='".$imgtemp."' class='img-circle' alt='User Image' width='50'> <br><a class='' href='#'>";echo $outputdet['name']."</a> <span class='users-list-date'>(".$outputdet['npp'].") <strong>".$outputdet['id_kendaraan']."</strong>";echo "</span> ";

							}
							echo "</td>";							
							
							
						}
						else
						{
							echo "<td>&nbsp;</td>";
						}
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

	<?php /*
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Start creating your amazing application!
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	  */ ?>

    </section>
    <!-- /.content -->

