<?php if($_SESSION[$fgmembersite->GetLoginSessionVar()]['user']['level_user']=='1')
{
	?>
	</div>
    <!-- /.container -->
	<?php
}
?>	
	
<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.2.1
    </div>
    <strong>Copyright &copy; 2018 <a href="<?php echo $fgmembersite->sitename; ?>"><?php echo $fgmembersite->sitename; ?></a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">


      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>dist/js/demo.js"></script>

<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/colorpicker/bootstrap-colorpicker.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- InputMask -->
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

<?php
/*
<!-- DataTables 
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
	-->
	*/ ?>
	
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<?php /* <script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/jquery.dataTables.yadcf.js"></script> */ ?>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.jqueryui.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.jqueryui.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">
	</script>
<!-- Notify -->


<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.buttons.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.nonblock.js"></script>

<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.animate.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.callbacks.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.confirm.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.desktop.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.history.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.mobile.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.reference.js"></script>
<script type="text/javascript" src="<?php echo $fgmembersite->sitename; ?><?php echo $fgmembersite->assets; ?>plugins/pnotify/src/pnotify.tooltip.js"></script>
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>

</body>
</html>
