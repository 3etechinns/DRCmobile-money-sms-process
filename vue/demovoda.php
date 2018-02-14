<?php

require_once '../../../Controlleur/sessions.php';
if(!isset($_SESSION['username']))
{
    header('Location:pages/logindemo.php');

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dev crm</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">

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
            <a class="sidebar-brand" href="#">DEMO VODACOM </a>
            <button type="button" class="sidebar-toggle">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav">
                <li class="active">
                    <a href="#">
                        <div class="icon">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="title">Dashboard</div>
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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card card-mini">
                    <div class="card-header">
                        <div class="card-title">Derniers paiement</div>
                        <ul class="card-action">
                            <li>
                                <a href="/">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th>num</th>
                                <th class="right">Montant</th>
                                <th>Distributeur</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        </div>


        <footer class="app-footer">
            <div class="row">
                <div class="col-xs-12">
                    <div class="footer-copyright">
                        Copyright © 2016 Company Co,Ltd.
                    </div>
                </div>
            </div>
        </footer>
    </div>

</div>

<script type="text/javascript" src="./assets/js/vendor.js"></script>
<script type="text/javascript" src="./assets/js/app.js"></script>
<script type="text/javascript" src="./assets/js/jquery.js"></script>




<script>
    $(document).ready(function() {

        $("#btn_dec").click(function () {
            $.ajax({
                method: "POST",
                url: "http://devpay.biz/odipay/Controlleur/adminprocess.php",
                data: {deconnexion:'deconnexion'},
                success: function (result) {
                    if(result=='true')
                    {
                        window.location.replace('http://devpay.biz/odipay/vue/dist/html/pages/login.php');

                    }
                    else
                    {
                        alert('Probleme de deconnexion');
                        alert(result);

                    }

                }
            });


        });


        //affichage montant total
        montanttotal();

        //affichage livre total
        livretotal();

        //affichage montant deja paye
        totalmontantdejapaye();

        //affichage total distributeur
        distributeur();

        //affichage dernier paiement
        dernierpaiment();

        //affihcage dtachart
        datachart();



    });


</script>

<script>

    function montanttotal() {

        $.ajax({
            method: "POST",
            url: "http://devpay.biz/odipay/Controlleur/paiementprocess.php",
            data: {montanttotal:'montanttotal'},
            success: function (result) {
                if(result)

                    $("#montanttotal").html(result);


            }

        });


    }


    function totalmontantdejapaye() {

        $.ajax({
            method: "POST",
            url: "http://devpay.biz/odipay/Controlleur/paiementprocess.php",
            data: {dejapaye:'dejapaye'},
            success: function (result) {
                if(result)

                    $("#dejapaye").html(result);



            }

        });

    }


    function livretotal() {
        $.ajax({
            method: "POST",
            url: "http://devpay.biz/odipay/Controlleur/livreprocess.php",
            data: {livretotal:'livretotal'},
            success: function (result) {
                if(result)

                    $("#livretotal").html(result);

            }

        });

    }

    function distributeur() {
        $.ajax({
            method: "POST",
            url: "http://devpay.biz/odipay/Controlleur/distributeurprocess.php",
            data: {disttotal:'disttotal'},
            success: function (result) {
                if(result)

                    $("#totaldistributeur").html(result);

            }

        });

    }

    function dernierpaiment() {
        console.log('ok');

        $(document).ready(function() {

            $.ajax({
                url :"http://devpay.biz/odipay/Controlleur/paiementprocess.php",
                method: "post",
                data:{limit:'limit'},
                success:function (result) {
                    $("#tbody").html(result);
                },
                error: function(){  // error handling
                    $("#tbody").append('<tbody class="employee-grid-error"><tr><th colspan="3">Aucune donnee trouvee</th></tr></tbody>');

                }
            });

        } );

    }


    function datachart() {
        $.ajax({
            method: "POST",
            url: "http://devpay.biz/odipay/Controlleur/paiementprocess.php",
            data: {datachart:'datachart'},
            success: function (result) {
                if(result)
                {
                    var tableau=result.split(";");
                    var nb1=tableau[0];
                    var nb2=tableau[1];
                    var nb3=nb1-nb2;
                    console.log(nb1+" "+nb2);

                    var data = {
                        labels: ["debit", "credit"],
                        series: [nb2, nb3]
                    };

                    new Chartist.Pie(".ct-chart", data);
                }

                console.log(result);

            }

        });

    }
</script>

<script>

    var timeout = setInterval(dernierpaiment, 5000);


</script>


<script>

</script>

</body>
>


</html>