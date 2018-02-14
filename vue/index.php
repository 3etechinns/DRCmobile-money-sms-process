<?php
include_once 'menu.php';
?>


<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3">
      <a class="card card-banner card-green-light">
  <div class="card-body">
    
    <div class="content">
      <div class="title">NOMBRE DE COMMANDES</div>
      <div class="value"><span id="livretotal"></span></div>
    </div>
  </div>
</a>
  </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a class="card card-banner card-green-light">
            <div class="card-body">
                
                <div class="content">
                    <div class="title">TOTAL EN ARGENT</div>
                    <div class="value"><span class="sign">$</span><span id="montanttotal"></span></div>
                </div>
            </div>
        </a>
    </div>


</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3">
    <div class="card card-mini">
      <div class="card-header">
        <div class="card-title">Derniers paiement</div>
        <ul class="card-action">
          <li>
            <a>
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
                <th>Client</th>
                <th>Panier</th>
                <th>IdTransaction</th>
            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
  <footer class="app-footer"> 
  <div class="row">
    <div class="col-xs-12">
      <div class="footer-copyright">
        Copyright © odigroup.
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
          commandetotal();

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


      function commandetotal() {
          $.ajax({
              method: "POST",
              url: "http://devpay.biz/odipay/Controlleur/paiementprocess.php",
              data: {commandetotal:'commandetotal'},
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

</script>

</body>
>


</html>
