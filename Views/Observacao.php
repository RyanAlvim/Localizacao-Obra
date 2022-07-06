<?php 
include_once("../Protect/Protect.php");
include("../Requisicao/Send.php");
include("../Mensagens/Mensagem.php");

$codigoVistoria = $_GET["codigoVistoria"];
if(isset($_POST["enviarObservacao"])){
    $enviarDados1 = new SendDados($codigoVistoria,"OBS_GERAIS","");
    echo $enviarDados1->EnviarAPI1($_POST["observacao"]) != "1" ? MsgAlert("Ocorreu um Erro") : header("Location: Termos.php?codigoVistoria=$codigoVistoria");

}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TopMix - Observações TOPMIX</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="http://topmix.com.br/wp-content/themes/topmix/images/logo-topmix.png" rel="icon">
    <link href="http://topmix.com.br/wp-content/themes/topmix/images/logo-topmix.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    
    

</head>

<body>
<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                       <h5 class="card-title text-center">Observações | TOPMIX <span><br> 4 de 5 | Cód. Vistoria: <?php echo $codigoVistoria;?> </span></h5>


                        <form action="" method="POST">

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Observações</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control z-depth-1" name="observacao" id="exampleFormControlTextarea6" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" name="enviarObservacao" class="btn btn-success btn-lg">Prosseguir</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>


        </div>
    </section>

</main>




<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.min.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>



<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>