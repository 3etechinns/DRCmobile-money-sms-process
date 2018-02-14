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
    <title>Dev crm</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.dataTables.css">


    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue-sky.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/theme/yellow.css">

</head>
<body>
<div class="app app-default">

    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a class="sidebar-brand" href="#"><img style="width: 100px; height: 80px" src="assets/images/logo.png"></a>
            <button type="button" class="sidebar-toggle">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav">
                <li >
                    <a href="index.php">
                        <div class="icon">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="detailsclients.php">
                        <div class="icon">
                            <i class="fa fa-group" aria-hidden="true"></i>
                        </div>
                        <div class="title">Clients</div>
                    </a>
                </li>

                <li>
                    <a href="paiementdetails.php">
                        <div class="icon">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <div class="title">Paiement</div>
                    </a>
                </li>
                <li>
                    <a href="livraisondetails.php">
                        <div class="icon">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <div class="title">Livraison</div>
                    </a>
                </li>
                <li class="active">
                    <a href="livreur.php">
                        <div class="icon">
                            <i class="fa fa-male" aria-hidden="true"></i>
                        </div>
                        <div class="title">Livreur</div>
                    </a>
                </li>

            </ul>
        </div>
        <div class="sidebar-footer">

        </div>
    </aside>


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
                                <span class="fa fa-user fa-3x" ></span>
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


        <div class="row">
            <div class="container">
                <form>
                    <input placeholder="nom.." type="text" id="nom">
                    <input placeholder="numtel.." type="text" id="numtel">
                    <button id="btn_ajout">Ajouter</button>
                </form>

            </div>
            <input type="text" id="search" placeholder="recherche"/>
            <div class="card card-mini">
                <div class="card-body no-padding table-responsive">
                    <table    class="table card-table" >
                        <thead>
                        <tr>

                            <th>Idlivreur</th>
                            <th>Nom</th>
                            <th>Numtel</th>

                        </tr>
                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>

                </div>
            </div>




            <footer class="app-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="footer-copyright">
                            Copyright © 2017 .APL Co,Ltd.
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <script type="text/javascript" src="./assets/js/vendor.js"></script>
    <script type="text/javascript" src="./assets/js/app.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.dataTables.js"></script>



    <script type="text/javascript" language="javascript" >
        $(document).ready(function() {

            $.ajax({
                url :"http://devpay.biz/odipay/Controlleur/livreurprocess.php",
                method: "post",
                data:{details:'details'},
                success:function (result) {
                    $("#tbody").html(result);


                },
                error: function(){  // error handling
                    $("#tbody").append('<tbody class="employee-grid-error"><tr><th colspan="3">Aucune donnee trouvee</th></tr></tbody>');

                }
            });

        } );
    </script>


    <script>

        $(document).ready(function () {
            var objet=$("#search");
            objet.keyup(function () {
                var mot=objet.val();

                $.ajax({
                    url :"http://devpay.biz/odipay/Controlleur/livreurprocess.php",
                    method: "post",
                    data:{mot:mot},
                    success:function (result) {
                        $("#tbody").html(result);


                    },
                    error: function(){  // error handling
                        $("#tbody").append('<tbody class="employee-grid-error"><tr><th colspan="3">Aucune donnee trouvee</th></tr></tbody>');

                    }

                })
            })
        })

    </script>

    <script>
        $(document).ready(function () {
            var objet=$("#btn_ajout");
            objet.click(function () {
                var nom=$("#nom").val();
                var numtel=$("#numtel").val();

                $.ajax({
                    url:'http://devpay.biz/odipay/Controlleur/livreurprocess.php',
                    method: "post",
                    data:{ajout:'ajout',nom:nom,numtel:numtel},
                    success:function (result) {
                       alert(result);
                    },
                    error: function(){  // error handling
                        //$("#tbody").append('<tbody class="employee-grid-error"><tr><th colspan="3">Aucune donnee trouvee</th></tr></tbody>');

                    }

                })
            })
        })

    </script>



</body>
</html>