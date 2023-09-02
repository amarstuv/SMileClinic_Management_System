<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>
<head>

	<title>Clinic Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
  	  <a class="navbar-brand" href="#" style="padding:0px;">
        <img src="clinicLogo.png" alt="" style="width:100px; height:50px;">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">        

      	<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Dashboard</a></li>
      <?php if(isset($_SESSION['Role']) && $_SESSION['Role']==3){?>
        <li id="setAppt"><a href="setAppointment.php"><i class="fa fa-calendar"></i> Appointment</a></li>
      <?php } ?>
      <?php if(isset($_SESSION['Role']) && $_SESSION['Role']==1) { ?>
        <li class="dropdown" id="navPatient">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-heartbeat"></i> Patient <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAptmnt"><a href="appointment.php"> <i class="fa fa-calendar"></i>  Apointment</a></li>      
            <li id="topNavPrescribe"><a href="prescribe.php"> <i class="fa fa-medkit"></i>  Prescribe</a></li>            
          </ul>
        </li> 
        <!--<li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Report </a></li>-->
		  <?php } ?>
      <?php if(isset($_SESSION['Role']) && $_SESSION['Role']==2) {?>
        <li id="navPatientAppt"><a href="patient.php"> <i class="fa fa-user-md"></i> Patient </a></li>
        <li id="navTreatment"><a href="treatment.php"> <i class="fa fa-h-square"></i> Treatment </a></li>
      <?php } ?>
        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-menu-hamburger"></i> <!--<span class="caret"></span></a>-->
          <ul class="dropdown-menu">    
            <li id="topNavProfile"><a href="profile.php"> <i class="glyphicon glyphicon-user"></i> Profile</a></li>
      <?php if(isset($_SESSION['Role']) && $_SESSION['Role']==1 || $_SESSION['Role']==2) { ?>
            <li id="topNavRegister"><a href="register.php"> <i class="fa fa-plus-square"></i> Register</a></li>
      <?php } ?>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
          </ul>
        </li>        
           
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">