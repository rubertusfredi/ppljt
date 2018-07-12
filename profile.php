<?php
if(isset($_POST['submitted']))
{ 	
	if($fgmembersite->updateProfile())
	{   

		$fgmembersite->SafeDisplay(null);
		//header("location:index.php?mod=harianPetugasPik");
		?>
	   <script>
		$(function(){
			//$('.nav-tabs a[href="#tab_2"]').tab('show');
		   new PNotify({
			  title: 'Success!',
			  text: 'Data Profil petugas Berhasil di Update',
			  type: 'success'
		   });
		   //$("#harianPetugasPik")[0].reset();
		   
		});
		</script>
		<?php
	}
	
}
else
{
	$fgmembersite->select('tb_pegawai','*',null,'id_user="'.$_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user'].'"','');
	$res = $fgmembersite->getResult();	
	#print_r($res);
	#$fgmembersite->SafeDisplay('name') = $res[0]['name'];
}
#print_r($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']);
$moduleTitle = "Profile";
$moduleDesc = "Data Profile Petugas LJT";
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $moduleTitle; ?>
        <small><?php echo $moduleDesc; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>       
        <li class="active"><?php echo $moduleTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Profil Petugas LJT</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form class="form-horizontal" id="absensiForm" enctype="multipart/form-data" action='<?php echo $fgmembersite->GetSelfScript(); ?>?mod=profile' method='post' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<input type='hidden' name='id_user' id='submitted' value='<?php echo $_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['id_user']; ?>'/>
				
				
        <div class="box-body">
				<div><span class='error'><?php $error = $fgmembersite->GetErrorMessageInput(); ?></span></div>
				
			<!------- Nama Petugas --------------->	
					<div class="form-group <?php if (isset($error['name'])){echo 'has-error';} ?>">
						<label for="name" class="col-sm-2 control-label">Nama </label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='name' id='name' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('name'); }else{ echo $res[0]['name'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['name'])){echo '<i><small><span class="help-block">'.$error['name'].'</span></small></i>';} ?>
						</div>
					</div>
			<!------- NPP--------------->		
					<div class="form-group <?php if (isset($error['npp'])){echo 'has-error';} ?>">
						<label for="npp" class="col-sm-2 control-label">NPP</label>

						<div class="col-sm-2">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='npp' id='npp' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('npp'); }else{ echo $res[0]['npp'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['npp'])){echo '<i><small><span class="help-block">'.$error['npp'].'</span></small></i>';} ?>
						</div>
					</div>	
			<!------- Username --------------->		
					<div class="form-group <?php if (isset($error['username'])){echo 'has-error';} ?>">
						<label for="username" class="col-sm-2 control-label">User Name</label>

						<div class="col-sm-2">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='username' id='username' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('username'); }else{ echo $res[0]['username'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['username'])){echo '<i><small><span class="help-block">'.$error['username'].'</span></small></i>';} ?>
						</div>
					</div>						
			<!------- Password --------------->		
					<div class="form-group <?php if (isset($error['password'])){echo 'has-error';} ?>">
						<label for="password" class="col-sm-2 control-label">Password md5+</label>

						<div class="col-sm-6">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='password' id='password' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('password'); }else{ echo $res[0]['password'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['password'])){echo '<i><small><span class="help-block">'.$error['password'].'</span></small></i>';} ?>
						</div>
					</div>	
			<!------- Level User --------------->		
					<div class="form-group <?php if (isset($error['level_user'])){echo 'has-error';} ?>">
						<label for="level_user" class="col-sm-2 control-label">Level User</label>

						<div class="col-sm-2">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='level_user' id='level_user' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('level_user'); }else{ echo $res[0]['level_user'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['level_user'])){echo '<i><small><span class="help-block">'.$error['level_user'].'</span></small></i>';} ?>
						</div>
					</div>		
			<!------- Login Hash --------------->		
					<div class="form-group <?php if (isset($error['login_hash'])){echo 'has-error';} ?>">
						<label for="login_hash" class="col-sm-2 control-label">Jabatan</label>

						<div class="col-sm-2">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='login_hash' id='login_hash' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('login_hash'); }else{ echo $res[0]['login_hash'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['login_hash'])){echo '<i><small><span class="help-block">'.$error['login_hash'].'</span></small></i>';} ?>
						</div>
					</div>
			<!------- Cabang--------------->		
					<div class="form-group <?php if (isset($error['cabang'])){echo 'has-error';} ?>">
						<label for="cabang" class="col-sm-2 control-label">Cabang</label>

						<div class="col-sm-2">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='cabang' id='cabang' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('cabang'); }else{ echo $res[0]['cabang'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['cabang'])){echo '<i><small><span class="help-block">'.$error['cabang'].'</span></small></i>';} ?>
						</div>
					</div>					
			<!------- Telp. --------------->		
					<div class="form-group <?php if (isset($error['phone_number'])){echo 'has-error';} ?>">
						<label for="phone_number" class="col-sm-2 control-label">Telpon </label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='phone_number' id='phone_number' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('phone_number'); }else{ echo $res[0]['phone_number'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['phone_number'])){echo '<i><small><span class="help-block">'.$error['phone_number'].'</span></small></i>';} ?>
						</div>
					</div>					
			<!------- Email Petugas --------------->		
					<div class="form-group <?php if (isset($error['email'])){echo 'has-error';} ?>">
						<label for="email" class="col-sm-2 control-label">Email </label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='email' id='email' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('email'); }else{ echo $res[0]['email'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['email'])){echo '<i><small><span class="help-block">'.$error['email'].'</span></small></i>';} ?>
						</div>
					</div>
			<!------- Telp. --------------->		
					<div class="form-group <?php if (isset($error['phone_number'])){echo 'has-error';} ?>">
						<label for="phone_number" class="col-sm-2 control-label">Telpon </label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='phone_number' id='phone_number' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('phone_number'); }else{ echo $res[0]['phone_number'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['phone_number'])){echo '<i><small><span class="help-block">'.$error['phone_number'].'</span></small></i>';} ?>
						</div>
					</div>	
			<!------- Salt --------------->		
					<div class="form-group <?php if (isset($error['salt'])){echo 'has-error';} ?>">
						<label for="salt" class="col-sm-2 control-label">Key Enkripsi</label>

						<div class="col-sm-3">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='salt' id='salt' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('salt'); }else{ echo $res[0]['salt'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['salt'])){echo '<i><small><span class="help-block">'.$error['salt'].'</span></small></i>';} ?>
						</div>
					</div>		
			<!------- Confirm Code --------------->		
					<div class="form-group <?php if (isset($error['confirmcode'])){echo 'has-error';} ?>">
						<label for="confirmcode" class="col-sm-2 control-label">Status Aktif</label>

						<div class="col-sm-2">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-genderless"></i>
								</div>
								<input type='text' class="form-control" name='confirmcode' id='confirmcode' value='<?php if(isset($_POST['submitted'])) {  echo $fgmembersite->SafeDisplay('confirmcode'); }else{ echo $res[0]['confirmcode'];} ?>' maxlength="50" />
							</div>
							<?php if (isset($error['confirmcode'])){echo '<i><small><span class="help-block">'.$error['confirmcode'].'</span></small></i>';} ?>
						</div>
					</div>	


					
			<!------- Ganti Foto --------------->					
					<div class="form-group <?php if (isset($error['user_image_petugas1'])){echo 'has-error';} ?>">
						<label for="user_image_petugas1" class="col-sm-2 control-label">Ganti Foto</label>
						<div class="col-sm-10">
							<div class="input-group">						
								<input class="input-group" type="file" id="user_image_petugas1" name="user_image_petugas1" accept="image/*" />
								<p class="help-block">Uplodad Foto.</p>
							</div>
							<?php if (isset($error['user_image_petugas1'])){echo '<i><small><span class="help-block">'.$error['user_image_petugas1'].'</span></small></i>';} ?>							
						</div>
					</div>
					
					
					
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-danger" name='Submit' value='Update'>							
						</div>
					</div>
        </div>
        <!-- /.box-footer-->
		</form>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->