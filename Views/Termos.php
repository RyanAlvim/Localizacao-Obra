<?php 
include_once("../Protect/Protect.php");
include("../Requisicao/ReqPost.php");
include("../Requisicao/Send.php");
include("../Download/DownloadAssinatura.php");
include("../Mensagens/Mensagem.php");

$codigoVistoria = $_GET["codigoVistoria"];
$latitude = "";
$longitude = "";

$requisicao = new RequisicaoPost("SELECT * FROM AD_RELVISTOBRA WHERE CODVISTORIA='$codigoVistoria'");
if(isset($_POST["finalizar"])){
    
    $enviarDados1 = new SendDados($codigoVistoria,"RESPONSAVELPELOATENDIMENTO","");
    $enviarDados1->EnviarAPI1($_POST["nomeResponsavel"]);
    
    $enviarDados2 = new SendDados($codigoVistoria,"EMAILDORESPONSAVEL","");
    $enviarDados2->EnviarAPI1($_POST["emailResponsavel"]);
    
    $enviarDados3 = new SendDados($codigoVistoria,"DATAHORAFINAL","");
    $enviarDados3->EnviarAPI1(date("d/m/Y H:i:s"));
    
    $enviarDados4 = new SendDados($codigoVistoria,"LATITUDE","LONGITUDE");
    $enviarDados4->EnviarAPI($_POST["latitude"],$_POST["longitude"]);


    $assinaturaDownload = new Assinatura("Vistoria$codigoVistoria",$_POST["assinatura"]);
    $assinaturaDownload->Download();
    
    $enviarAssinatura = new SendDados($codigoVistoria,"IMAGEMASSINATURA","");
    $url = "http://".$_SERVER["HTTP_HOST"]."/assets/assinaturas/Vistoria".$codigoVistoria.".png";
    
    echo $enviarAssinatura->EnviarAPI1($url) != "1" ? MsgAlert("Ocorreu um Erro") : header("Location: ../index.php");

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TopMix - Termos TOPMIX</title>
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
                       <h5 class="card-title text-center">Termos | TOPMIX <span><br> 5 de 5 | Cód. Vistoria: <?php echo $codigoVistoria;?> </span></h5>

                        <br>
                        <form action="" method="POST">

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <p class="mb-0">- É proibida a abertura de equipamento lança, acima de rede elétrica, em um raio mínimo de 5 metros de distância</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <p class="mb-0">- É proibido o posicionamento do equipamento, abertura de patolas próximo a valas ou em solo que não apresente resistência suficiente</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <p class="mb-0">- É proibida a movimentação de carga acima dos equipamentos e trabalhadores da Top Mix</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <p class="mb-0">- Direito de recusa: Qualquer funcionário da Top Mix tem o direito de recusar qualquer atividade que exponha sua saúde e segurança em risco eminente. Quando a situação de risco apontada for de responsabilidade do cliente, a Top Mix não se responsavilizará quanto aos danos gerados até a adequação</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table class="table table-active table-striped table-sm ">
                                            <thead>
                                            <tr>
                                                <th scope="col">INFORMAÇÕES</th>
                                                <th scope="col">SIM/NÃO</th>
                                                <th scope="col">OBSERVAÇÕES</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr >
                                                <td scope="row">Acesso seguro para manobra das betoneiras</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(2);?>" disabled></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(12);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Acesso seguro para patolagem da bomba</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(3);?>" disabled></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(13);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Acesso liberado para parada da bomba e das betoneiras</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(4);?>" disabled ></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(14);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Necessário licença para estacionar</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(5);?>" disabled></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(15);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Escoramento</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(6);?>" disabled></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(16);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Guarda Corpo</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(7);?>" disabled ></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(17);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Possui tubulação fixa</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(8);?>" disabled ></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(18);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Dispoẽ de iluminação artificial adequada caso necessário</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(9);?>" disabled ></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(19);?>" disabled></td>
                                            </tr>

                                            <tr>
                                                <td scope="row">Local de limpeza das betoneiras e da bomba dentro da</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(10);?>" disabled ></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(20);?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Local para moldagem e armazenamento dos CP'S</td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(11);?>" disabled ></td>
                                                <td> <input type="text" class="form-control" name="peca" value="<?php echo $requisicao->ReqAPI(21);?>" disabled></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="disableBtn">
                                <label class="form-check-label" for="defaultCheck1">
                                    Aceite os termos
                                </label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Assinatura do Cliente</label>
                                <div class="col-sm-10">
                                    <canvas id="quadro" style="border:1px solid #000000; border-radius:15px;"> </canvas>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="button" id="clear-canvas" class="btn btn-danger btn-lg">Limpar assinatura</button>
                                </div>
                            </div>
							
							<div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nome do responsável</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="" name="nomeResponsavel" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email do responsável</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="" name="emailResponsavel" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">                              
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" value="" id="latitude" name="latitude" value="">
                                </div>
                            </div>
                            
                             <div class="row mb-3">                              
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" value="" id="assinatura" name="assinatura" value="">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" value="" id="longitude" name="longitude" value="">
                                </div>
                            </div>
                            
                            
                            <div class="row mb-3">
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" onclick="AssinaturaDownload()" name="finalizar" id="prosseguir" class="btn btn-success btn-lg">Finalizar</button>
                                </div>
                            </div>
                            

                        </form>

                    </div>
                </div>

            </div>


        </div>
    </section>

</main>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.js"></script>
<script src="../assets/js/assinatura.js"></script>
<script src="../assets/js/location.js"></script>
<script src="../assets/js/downloadAssinatura.js"></script>

<script>
function name(){
	console.log("aabba");	
}

</script>

<script>

    // Retrieve reference to checkbox
    const disableCheckBox = document.getElementById("disableBtn");
    // Retrieve reference to button
    const submitButton = document.getElementById("prosseguir");
    submitButton.disabled = true;
    disableCheckBox.addEventListener("change", (e) => {
        if (e.target.checked) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    });
</script>


<script>
    function mostrarTela(){
        window.location.href="../index.php"
    }

</script>



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