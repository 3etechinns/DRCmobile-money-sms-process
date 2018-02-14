<?php

require_once '../../../Controlleur/sessions.php';
if(!isset($_SESSION['username']))
{
    header('Location:pages/login.php');

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>odi</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">

    <!-- Theme -->
  
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">
   


</head>
<body>
<div class="app app-default">

    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a class="sidebar-brand" href="#"><img style="width: 100px; height: 80px" src="assets/images/logo.png"> </a>
            <button type="button" class="sidebar-toggle">
               
            </button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav">
                <li  <?php if($_SERVER['PHP_SELF']=="/odipay/vue/dist/html/index.php") echo "class=\"active\"" ?>>
                    <a href="index.php">
                        
                        <div class="title">Dashboard</div>
                    </a>
                </li>


                <li <?php if($_SERVER['PHP_SELF']=="/odipay/vue/dist/html/paiementdetails.php") echo "class=\"active\"" ?>>
                    <a href="paiementdetails.php">
                      
                        <div class="title">Paiement</div>
                    </a>
                </li>


            </ul>
        </div>

    </aside>

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
        <div class="dropdown-background">
            <div class="bg"></div>
        </div>
        <div class="dropdown-container">
            {{list}}
        </div>
    </script>
    <div class="app-container">

        <nav class="navbar navbar-default" id="navbar">
            <div class="container-fluid">
                <div class="navbar-collapse collapse in">
                    <ul class="nav navbar-nav navbar-mobile">
                        <li>
                            <button type="button" class="sidebar-toggle">
                                <i class="fa fa-bars"></i>
                            </button>
                        </li>
                        <li class="logo">
                            <a class="navbar-brand" href="#"><span class="highlight">DEV CRM</span> Admin</a>
                        </li>
                        <li>
                            <button type="button" class="navbar-toggle">
                                <img class="profile-img" src="./assets/images/profile.png">
                            </button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">



                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
                           
                                <a id="a_dec" class="title">Deconnexion</a>
                            </a>
                            <div class="dropdown-menu">
                                <div class="profile-info">
                                    <h4 class="username"><?php echo $_SESSION['username']?></h4>
                                </div>
                                <ul class="action">
                                    <li id="btn_dec">
                                        <a href="#" id="a_dec">
                                            Deconnection
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

