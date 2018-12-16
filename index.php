<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="index, follow">
		<title>Lookup Your Instagram User ID</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="img/favicon32.png">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css">
		<style type="text/css">
			body{
				background: rgba(59,183,120,1);background: -moz-linear-gradient(left, rgba(59,183,120,1) 47%, rgba(71,196,218,1) 100%);background: -webkit-gradient(left top, right top, color-stop(47%, rgba(59,183,120,1)), color-stop(100%, rgba(71,196,218,1)));background: -webkit-linear-gradient(left, rgba(59,183,120,1) 47%, rgba(71,196,218,1) 100%);background: -o-linear-gradient(left, rgba(59,183,120,1) 47%, rgba(71,196,218,1) 100%);background: -ms-linear-gradient(left, rgba(59,183,120,1) 47%, rgba(71,196,218,1) 100%);background: linear-gradient(to right, rgba(59,183,120,1) 47%, rgba(71,196,218,1) 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3bb778', endColorstr='#47c4da', GradientType=1 );
				font-family:Roboto;
			}
			.transparent .tuyin{
				margin-top: 20px; 
				background-color: rgba(255, 255, 255, 0.37);
				border: 1px solid #F7F7F7;
				border-radius: 5px;
				box-shadow: 0px 0px 2px 0px rgba(181, 181, 181, 0.3);
				padding: 3%;
				text-align: center;
				position: relative;
				margin-bottom: 25px;
			}
			.transparent .tuyin .title{
				text-align: center; 
				color: #FFF;
				font-size: 49px; 
			}
			.transparent .tuyin .full-name{
				font-size: 20px;
				font-weight: 400;
				font-weight: bold;
			}
			.transparent .tuyin .user-id{
				font-size: 20px;
				font-weight: 400;
				font-weight: bold;
				color: red;
			}
			.transparent .tuyin .text{
				color: #474747;
				font-weight: 300;
				margin-bottom: 13px; 
				font-size: 16px;
				text-align: center;
			}
			h1.title{
				text-transform: uppercase;
				font-weight: bolder;
				color: #FFF;
			}		
			.searchField {
				display: inline-block;
				width: 98%;
				height: 38px;
				margin: 10px;
				border: 1px solid grey;
				font-size: 20px;
				outline: grey;
				padding: 5px;
				padding-right: 50px;
				color: grey;
				box-sizing:border-box;
			}
			.searchInput {
				position: relative;
			}
			.searchInput .glyphicon {
				position: absolute;
				z-index: 2;
				right: 0px;
				font-size: 24px;
				width: 24px;
				color: #4b4b4b;
				text-align: center;
				padding: 6px 0;
				top: 11px;
				cursor: pointer;
				width: 60px;
			}
			p.copyright{
				color:#fff;
			}
		</style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script>
			function getInfo(){
				$("#result").html('<div class="col-md-12"><div class="tuyin first"><img src="img/loading.gif" border="0"></div></div>');		
				var link = $('#username').val();		
				if(link==""){
					$("#result").html('<div class="col-md-12"><div class="tuyin first"><div class="alert alert-danger">Please enter a valid Instagram username</div></div></div>');
				}else{
					var dataString = 'username='+ link;
					$.ajax({
						type: "POST",
						url: "process.php",
						data: dataString,
						cache: false,
						success: function(result){
							$("#result").html(result.data);
						}
					});
				}
			}	
			$(document).ready(function(){
				$('#search-submit').click(function(){
					getInfo();
				});
				$("#username").on('keyup', function (e) {
					if (e.keyCode == 13) {
						getInfo();
					}
				});
			});
		</script>
	</head>
	<body>
		<div class="container">
		  <div class="row transparent">  
			<h1 class="title text-center">LOOKUP YOUR INSTAGRAM USER ID</h1>
			<div class="col-md-12">
			  <div class="tuyin first">		  
				<div class="searchInput">
					<input id="username" type="text" class="searchField" placeholder="Enter a valid Instagram username">
					<label for="search" class="glyphicon glyphicon-search" rel="tooltip" title="search" id="search-submit"></label>
				</div>
			  </div>
			</div>
			<div id="result"></div>
			<div class="col-md-12">
				<hr>
				<p class="copyright text-center">
					Copyright &copy <?php echo date('Y'); ?> by <a href="http://www.shopifytips.com" target="_blank">Shopify Tips</a>. All Rights Reserved.<br>
					Developed and Designed by <a href="http://www.anhkiet.info" target="_blank">Huynh Mai Anh Kiet</a>.
				</p>
			</div>	
		  </div>
		</div>
	</body>
</html>