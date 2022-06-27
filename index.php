
<?php 

	$rnd = rand(); 

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-csp="" ng-app="HMZAdminApp"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Coppel Analytics</title>
		
		<!-- mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

		<!--[if IE]>
			<link rel="shortcut icon" href="favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">

		<!-- CSS -->		
		<link rel="stylesheet" type="text/css" class="ui" href="./css/semantic.min.css">
		<link rel="stylesheet" type="text/css" class="ui" href="css/main.css">
		

	</head>

	<body class="main-wrapper">
		
		<!--[if lt IE 8]>
		    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<div class="ui bottom attached segment pushable">
		<!-- Sidebar -->
		<!--side-bar class="ui visible inverted left vertical sidebar menu"></side-bar-->

		<!-- Main view for templates -->
		<div data-ng-view="" class="pusher" id="main-content"></div>
		</div>

	</body>

	<!-- Vendors -->
	<!-- build:nonangularlibs js/nonangularlibs.js -->
	<script type="text/javascript" src="js/nonangular/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/nonangular/semantic.min.js"></script>
	<script type="text/javascript" src="js/nonangular/Chart.min.js"></script>
	<script type="text/javascript" src="js/nonangular/moment.min.js"></script>
	<script type="text/javascript" src="js/nonangular/FileSaver.min.js"></script>
	<!-- endbuild -->

	<!-- Non-angular libraries -->
	<script type="text/javascript" src="js/main.js"></script>
	<!-- endbuild -->

	<!-- Angular external libraries for application -->
	<script type="text/javascript" src="js/angular/angular.js"></script>
	<script type="text/javascript" src="js/angular/angular-route.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-sanitize.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-moment.min.js"></script>
	
	<!-- Angular components -->
	<script type="text/javascript" src="app/app.js?r=<?php echo $rnd; ?>"></script>
	<script type="text/javascript" src="app/config.js"></script>
	<script type="text/javascript" src="components/services/queryService.service.js"></script>
	<script type="text/javascript" src="components/services/LocalStorage.service.js"></script>
	<script type="text/javascript" src="components/directives/sidebar.directive.js"></script>

	<!-- Application sections -->
	<!--script type="text/javascript" src="app/factory.js"></script>
	<script type="text/javascript" src="app/controller.js"></script>
	<script type="text/javascript" src="app/SysHealthController.js"></script-->
	<script type="text/javascript" src="app/analytics.js"></script>

	<!--Datatables -->
	<link rel="stylesheet" type="text/css" class="ui" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

	<!--Excel-->
	<script src="https://cdn.sheetjs.com/xlsx-0.18.9/package/dist/xlsx.full.min.js"></script>
</html>
