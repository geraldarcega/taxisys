<!DOCTYPE html>
<html lang="en" ng-app="taxisystemApp">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">

<title>Taxi System</title>

  <?php echo $css; ?>
  <script type="text/javascript">
	var base_url = '<?php echo base_url();?>'
	var dashboard_url = '<?php echo dashboard_url();?>'
	var search = '<?php echo $this->input->get("column");?>'
  </script>
</head>
<body>
	<div id="wrapper">