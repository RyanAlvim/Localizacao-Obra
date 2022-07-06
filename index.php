<?php 

include_once('Protect/Protect.php');

include("Header/Header.php");

?>



  <main id="main">

    
    <!--<section class="section-services section-t8">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12">
            
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <br>
                <div class="col-md-12 mb-2">
            <div class="form-group">
             <br>
             <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Busque Algo" id="gg" aria-label="Recipient's username" aria-describedby="button-addon2">
              <div class="input-group-append">
              <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" onclick="links_redirect()" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
              <i class="bi bi-search"></i>
            </button>
              </div>
            </div>
                <h2 class="title-a text-center">Recentes</h2>
                
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card-box-c foo" onclick="RedirectPage('page.html')">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <center>
                  <span class="bi bi-check-square"></span>
                  </center>
                  <div class="card-title-c align-self-center">
                    <h2 class="title-c text-center">Atualizar Registros</h2>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-c foo " onclick="RedirectPage('page.html')">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <center>
                  <span class="bi bi-search"></span>
                  </center>
                  <div class="card-title-c align-self-center">
                    <h2 class="title-c text-center">Inserir Registros</h2>
                  </div>
                </div>
                
              </div>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-c foo" onclick="RedirectPage('page.html')">
              <div class="card-header-c d-flex">
                <div class="card-box-ico ">
                  <center>
                  <span class="bi bi-file-earmark-excel"></span>
                </center>
                  <div class="card-title-c ">
                    <h2 class="title-c text-center">Excluir Registros</h2>
                  </div>
                </div>
                
              </div>
              
             
            </div>
          </div>
        </div>
      </div>
    </section>-->

    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          
          <h2 class="title-a text-center"><?php echo "<br>";?></h2>
                
        </div>
        <div class="row">
          <div class="col-md-4">
            <center>
              <br>
            <img src="http://topmix.com.br/wp-content/themes/topmix/images/logo-topmix.png" height="100%" width="100%">
            </center>
          </div>
          
        </div>
      </div>
    </section>
    
    

  </main><!-- End #main -->

  <!-- Vendor JS Files -->

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
  function links_redirect(){
    var campo_texto = document.querySelector("#gg");
    var redirect = campo_texto.value;
    if(redirect == "Alterar Usuário"){
      window.location.href = "buscar_produto.php";
    }
  }

</script>

<script>
      $(function() {
        var opcoes = [
          "Alterar Usuário",
          "banana",
          "uva",
          "bicicleta",
          "motocicleta"
        ];
        $("#gg" ).autocomplete({
          source: opcoes
        });
      });
  </script>
</body>

</html>