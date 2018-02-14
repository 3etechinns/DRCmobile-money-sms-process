<?php
include_once 'menu.php';



?>

<div class="row">

            <input type="text" id="search" placeholder="recherche"/>
            <div class="card card-mini">
                <div class="card-body no-padding table-responsive">
                    <table    class="table card-table" >
                        <thead>
                        <tr>
                            <th>Num</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Panier</th>
                            <th>Idtrans</th>
                            <th>Montant</th>
                            <th>Heure</th>
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
                url :"http://devpay.biz/odipay/Controlleur/paiementprocess.php",
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
                    url :"http://devpay.biz/odipay/Controlleur/paiementprocess.php",
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





</body>
</html>