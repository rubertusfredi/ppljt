<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PPLJT- Monitoring Tinggi Air</title>

    <!-- Bootstrap -->
    <link href="css/iframe.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <-e-script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <-e-script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <section class="content">
<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">Menampilkan Data Tinggi Air KM 422</a></li>
			<li><a href="#tab_2" data-toggle="tab" >Menampilkan Data Grafik Tinggi Air KM 422</a></li>
			<script>
				window.open(
					'https://thingspeak.com/channels/1688208/private_show',
					'_blank' // <- This is what makes it open in a new window.
					);
			</script>
		</ul>
		
	
		<div class="tab-content">
			<!---------- tab 1 pilih kendaraan -------------->			
			<div class="tab-pane active" id="tab_1">

				<div class="">
					<div class="box-header with-border">
					  <h3 class="box-title"></h3><small>&nbsp;</small>
					</div>  

                </div>

				<h1>Menampilkan Data Tinggi Air KM 422</h1>
			<div class="embed-responsive embed-responsive-16by9"></div>
			<!------------- /.tab-pane ------------------------->
			<!---------- tab 2 pilih grafik-------------->			
				<div class="tab-pane" id="tab_2">
					<div class="box box-primary box-solid">
					<div class="box-header ">
						<h3 class="box-title"></h3>
					</div>	
					
							<div id="itemcontent">
								<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1688208/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
							</div>
					</div>
				</div>				
			</div> 
		</div>  
  


  
  

    </div>

<!-- // Modal --> 

    </section>
    <!-- /.content -->

<script>

$(document).ready(function() {
 
  $('a.item').on('click', function(e) {
    var src = $(this).attr('data-src');
    var height = $(this).attr('data-height') || 300;
    var width = $(this).attr('data-width') || 400;
    $("#itemcontent iframe").attr({'src':src,'height': height,'width': width});
  });
 
});

</script>
	  
	  

 
      </div>
    </div>
    <div class="col-md-2"></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>