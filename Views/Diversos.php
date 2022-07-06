<?php 
include_once("../Protect/Protect.php");
include("../Requisicao/Send.php");
include("../Mensagens/Mensagem.php");



$codigoVistoria = $_GET["codigoVistoria"];
if(isset($_POST["enviarDiversos"])){
    
    $enviarDados2 = new SendDados($codigoVistoria,"SITUACAODAPECA","");
    $enviarDados2->EnviarAPI1($_POST["pergunta1"]);
    
    $enviarDados3 = new SendDados($codigoVistoria,"TIPODELANAMENTO","");
    echo  $enviarDados3->EnviarAPI1($_POST["pergunta2"]);
    
    $enviarDados4 = new SendDados($codigoVistoria,"DISTANCIAENTREBOMBAEAPEA","");
    echo  $enviarDados4->EnviarAPI1($_POST["distancia"]);
    
    $enviarDados5 = new SendDados($codigoVistoria,"QUANTIDADEDETUBOS","");
    echo   $enviarDados5->EnviarAPI1($_POST["qtdTubos"]);
    
    $enviarDados6 = new SendDados($codigoVistoria,"QUANTIDADEDEMANGOTES","");
    echo  $enviarDados6->EnviarAPI1($_POST["qtdMangotes"]);
    
    $enviarDados7 = new SendDados($codigoVistoria,"VOLUMETRANSPORTADOPORBT","");
    echo $enviarDados7->EnviarAPI1($_POST["qtdVolumeBT"]);
    
    $enviarDados8 = new SendDados($codigoVistoria,"QUANTIDADEDECIMENTOPARAARGAMAS","");
    echo $enviarDados8->EnviarAPI1($_POST["qtdCimento"]);
    
    $enviarDados8 = new SendDados($codigoVistoria,"QUANTIDADEDEAREIAPARAARGAMASSA","");
   echo $enviarDados8->EnviarAPI1($_POST["qtdAreia"]);
   
   $enviarDados1 = new SendDados($codigoVistoria,"PECA","");

   echo $enviarDados1->EnviarAPI1($_POST["peca"]) != "1" ? MsgAlert("Ocorreu um Erro") : header("Location: Observacao.php?codigoVistoria=$codigoVistoria");


}

?>
	


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TopMix - Diversos TOPMIX</title>
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
                       <h5 class="card-title text-center">Localização de Obras | TOPMIX <span><br> 3 de 5 | Cód. Vistoria: <?php echo $codigoVistoria;?> </span></h5>


                        <form action="" method="POST">

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Peça Vistoriada</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="peca" value="" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Situação de peça a ser concretada</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta1" id="flexRadioDefault1" value="PRONTA" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pronta
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta1" id="flexRadioDefault1" value="PARCIALMENTE" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Parcialmente
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta1" id="flexRadioDefault1" value="ATRASADA" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Atrasada
                                        </label>
                                    </div>
                                </div>
                            </div>
							
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tipo de Lançamento</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta2" id="flexRadioDefault1" value="BOMBA ESTACIONARIA" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Bomba Estacionária
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta2" id="flexRadioDefault1" value="BOMBA LANCA - OPCIONAL" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Bomba Lança - Opcional
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta2" id="flexRadioDefault1" value="BOMBA LANCA - SOLICITACAO" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Bomba Lança - Solicitação
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pergunta2" id="flexRadioDefault1" value="CONVENCIONAL" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Convencional
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Distância entre a bomba e a peça</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="" name="distancia" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Quantidade de Tubos</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="" name="qtdTubos" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Quantidade de mangotes</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="" name="qtdMangotes" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Volume transportado por BT</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="" name="qtdVolumeBT" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Quantidade de Cimento para Argamassa (Sacos)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="" name="qtdCimento" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Quantidade de Areia para Argamassa (Carrinho)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="" name="qtdAreia" required>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" name="enviarDiversos" class="btn btn-success btn-lg">Prosseguir</button>
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