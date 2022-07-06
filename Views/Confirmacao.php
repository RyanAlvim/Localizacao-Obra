<?php 
include_once("../Protect/Protect.php");
include("../Requisicao/ReqPost.php");
include("../Requisicao/Send.php");
include("../Mensagens/Mensagem.php");

$queryObra = $_GET['queryObra'];
$usuario = $_SESSION["usuario"];

if($queryObra != ""){
    $requisicao = new RequisicaoPost("
               SELECT 
          OBR.CODOBRA,
          OBR.NOMEOBRA ,
          P.RAZAOSOCIAL AS CLIENTE ,
          E.NOMEEND,
          B.NOMEBAI,
          C.NOMECID
          FROM BH_CCTOBR OBR
			INNER JOIN BH_CCTCON CON ON CON.AD_CODOBRA = OBR.CODOBRA
            INNER JOIN BH_CCTCAB CAB ON CAB.NUMCONTRATO = CON.NUMCONTRATO
            LEFT JOIN TSIEND E ON E.CODEND = OBR.CODEND
            LEFT JOIN TSIBAI B ON B.CODBAI = OBR.CODBAI
            LEFT JOIN TSICID C ON C.CODCID = OBR.CODCID
            INNER JOIN TGFPAR P ON P.CODPARC = OBR.AD_CODPARC 
        WHERE CAB.NUPEDIDO= '$queryObra'
    ");
}

if(isset($_POST["iniciarVistoria"])){
    $codigoV = new RequisicaoPost('SELECT COUNT(CODVISTORIA) from AD_RELVISTOBRA');
    $codigo = new RequisicaoPost("select CODUSU from tsiusu where NOMEUSU = '$usuario'");
    $codigoVistoria = $codigoV->ReqAPI(0)+1;
    $enviarDados = new SendDados($codigoVistoria,"DATAHORAINICIAL","CODUSU");
    $enviarDados->EnviarAPI(date('d/m/Y H:i:s'),$codigo->ReqAPI(0));
    
    $enviarDadoscodObra = new SendDados($codigoVistoria,"NUPEDIDO","");
    echo $enviarDadoscodObra->EnviarAPI1($queryObra) != "1" ? MsgAlert("Ocorreu um Erro") : header("Location: Tabela.php?codigoVistoria=$codigoVistoria");

}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TOPMIX - Confirmação dados Obra</title>
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
                        <h5 class="card-title text-center">Confirmação de Dados | TOPMIX <span><br> 1 de 5 </span></h5>
                        <form action="" method="POST">

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Código Obra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $requisicao->ReqAPI(0);?>" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nome Cliente</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $requisicao->ReqAPI(2);?>" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nome Obra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $requisicao->ReqAPI(1);?>" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Endereço</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $requisicao->ReqAPI(3);?>" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Bairro</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $requisicao->ReqAPI(4);?>" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Cidade</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $requisicao->ReqAPI(5);?>" disabled>
                                </div>
                            </div>
                            

                            <div class="row mb-3">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" name="iniciarVistoria" class="btn btn-success btn-lg">Iniciar Vistoria</button>
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