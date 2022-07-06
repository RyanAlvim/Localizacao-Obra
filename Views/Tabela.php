<?php 
include_once("../Protect/Protect.php");
include("../Requisicao/Send.php");
include("../Mensagens/Mensagem.php");

$codigoVistoria = $_GET["codigoVistoria"];
//Diversos.php => Próxima Tela

if(isset($_POST["enviarTabela"])){
    $enviarDados1 = new SendDados($codigoVistoria,"QUADRO_PERG_01","QUADRO_OBS_01");
    $enviarDados1->EnviarAPI($_POST["pergunta1"],$_POST["pergunta1TXT"]);
    
    $enviarDados2 = new SendDados($codigoVistoria,"QUADRO_PERG_02","QUADRO_OBS_02");
    $enviarDados2->EnviarAPI($_POST["pergunta2"],$_POST["pergunta2TXT"]);
    
    $enviarDados3 = new SendDados($codigoVistoria,"QUADRO_PERG_03","QUADRO_OBS_03");
    $enviarDados3->EnviarAPI($_POST["pergunta3"],$_POST["pergunta3TXT"]);
    
    $enviarDados4 = new SendDados($codigoVistoria,"QUADRO_PERG_04","QUADRO_OBS_04");
    $enviarDados4->EnviarAPI($_POST["pergunta4"],$_POST["pergunta4TXT"]);
    
    $enviarDados5 = new SendDados($codigoVistoria,"QUADRO_PERG_05","QUADRO_OBS_05");
    $enviarDados5->EnviarAPI($_POST["pergunta5"],$_POST["pergunta5TXT"]);
    
    $enviarDados6 = new SendDados($codigoVistoria,"QUADRO_PERG_06","QUADRO_OBS_06");
    $enviarDados6->EnviarAPI($_POST["pergunta6"],$_POST["pergunta6TXT"]);
    
    $enviarDados7 = new SendDados($codigoVistoria,"QUADRO_PERG_07","QUADRO_OBS_07");
    $enviarDados7->EnviarAPI($_POST["pergunta7"],$_POST["pergunta7TXT"]);
    
    $enviarDados8 = new SendDados($codigoVistoria,"QUADRO_PERG_08","QUADRO_OBS_08");
    $enviarDados8->EnviarAPI($_POST["pergunta8"],$_POST["pergunta8TXT"]);
    
    $enviarDados9 = new SendDados($codigoVistoria,"QUADRO_PERG_09","QUADRO_OBS_09");
    $enviarDados9->EnviarAPI($_POST["pergunta9"],$_POST["pergunta9TXT"]);
    
    $enviarDados10 = new SendDados($codigoVistoria,"QUADRO_PERG_10","QUADRO_OBS_10");
    $enviarDados10->EnviarAPI($_POST["pergunta10"],$_POST["pergunta10TXT"]);
    echo $enviarDados10->EnviarAPI($_POST["pergunta10"],$_POST["pergunta10TXT"]) != "1" ? MsgAlert("Ocorreu um erro") : header("Location: Diversos.php?codigoVistoria=$codigoVistoria");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TopMix - Lista de Obras TOPMIX</title>
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

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">


                            <div class="card-body">
                                <h5 class="card-title text-center">Lista de Obras | TOPMIX <span><br> 2 de 5 | Cód. Vistoria: <?php echo $codigoVistoria;?> </span></h5>
                               <form action="" method="POST":
                                <div class="table-responsive">
                                    <table class="table table-active table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">INFORMAÇÕES</th>
                                            <th scope="col">SIM</th>
                                            <th scope="col">NÃO</th>
                                            <th scope="col">OBSERVAÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr >
                                            <td scope="row">Acesso seguro para manobra das betoneiras</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta1" id="pergunta1" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta1" id="pergunta1" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta1TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Acesso seguro para patolagem da bomba</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta2" id="pergunta2" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta2" id="pergunta2" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta2TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Acesso liberado para parada da bomba e das betoneiras</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta3" id="pergunta3" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta3" id="pergunta3" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta3TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Necessário licença para estacionar</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta4" id="pergunta4" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta4" id="pergunta4" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta4TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Escoramento</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta5" id="pergunta5" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta5" id="pergunta5" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta5TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Guarda Corpo</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta6" id="pergunta6" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta6" id="pergunta6" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta6TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Possui tubulação fixa</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta7" id="pergunta7" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta7" id="pergunta7" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta7TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Dispoẽ de iluminação artificial adequada caso necessário</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta8" id="pergunta8" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta8" id="pergunta8" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta8TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
    
                                        <tr>
                                            <td scope="row">Local de limpeza das betoneiras e da bomba dentro da</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta9" id="pergunta9" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta9" id="pergunta9" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta9TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Local para moldagem e armazenamento dos CP'S</td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta10" id="pergunta10" value="SIM" required></td>
                                            <td> <input class="form-check-input" type="radio" name="pergunta10" id="pergunta10" value="NAO" required></td>
                                            <td> <textarea class="form-control" name="pergunta10TXT" aria-label="With textarea"></textarea></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                   </div>

                                <div class="row mb-3">
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" name="enviarTabela" class="btn btn-success btn-lg">Prosseguir</button>
                                    </div>
                                </div>
							</form>
                            </div>

                        </div>
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