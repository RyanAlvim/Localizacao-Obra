<?php
require('ConnectAPI.php');

if(isset($_POST["usuario"]) || isset($_POST["password"])){
    if(strlen($_POST["usuario"]) == 0){
        echo "Usuário Inválido";
    }else if(strlen($_POST["password"]) == 0){
        echo "Senha inválida";
    }else{
        $connectAPI = new connectAPI;
       if($connectAPI->ConectarSankhya($_POST["usuario"],$_POST["password"]) == "1"){
        
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION["id"] = $connectAPI->getID();
        $_SESSION["usuario"] = trim($_POST["usuario"]);
        header("Location: ../index.php");
	}else{
	header("Location: ../index.php");
	}
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MgMix - Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="http://topmix.com.br/wp-content/themes/topmix/images/logo-topmix.png" rel="icon">
  <link href="http://topmix.com.br/wp-content/themes/topmix/images/logo-topmix.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">


</head>

<body>

  
  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <form action="" method="POST">
            <div class="title-single-box">
              <img src="http://topmix.com.br/wp-content/themes/topmix/images/logo-topmix.png" height="100px" width="300px">
              <h1 class="title-single text-center">Login</h1>
              <br>
              <input type="text" name="usuario" class="form-control form-control-lg form-control-a" placeholder="Seu usuário" required>
              <br>
              <input type="password" name="password" class="form-control form-control-lg form-control-a" placeholder="Sua senha" required>
            
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-b">Logar</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Contact Single ======= -->
   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  
  
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
