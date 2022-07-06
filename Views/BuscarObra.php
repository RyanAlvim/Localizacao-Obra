<?php 

            include_once("../Protect/Protect.php");
            include("../Requisicao/ReqPost.php");
            
            
            
            $id = $_SESSION['id'];
            
            $usuario = $_SESSION["usuario"];
            
            $curl = curl_init();
            $codigoUsuario = new RequisicaoPost("select CODUSU from tsiusu where NOMEUSU = '$usuario'");
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://app.mgmix.com.br:8180/mge/service.sbr?serviceName=DbExplorerSP.executeQuery&outputType=json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{"serviceName":"DbExplorerSP.executeQuery","requestBody":{"sql":"
            SELECT 
            	OBR.NOMEOBRA,
            	PAR.RAZAOSOCIAL,
            	PEDCAB.DTPREVISTA,
            	PEDCAB.NUPEDIDO,
            	CASE WHEN V.NUPEDIDO IS NULL THEN \'PEND\' ELSE \'OK\' END AS VISTORIA
            	FROM BH_CCTCAB PEDCAB
            		INNER JOIN BH_CCTCON CON ON CON.NUMCONTRATO = PEDCAB.NUMCONTRATO
            		INNER JOIN BH_CCTOBR OBR ON OBR.CODOBRA = CON.AD_CODOBRA
            		INNER JOIN TGFPAR PAR ON PAR.CODPARC = OBR.AD_CODPARC
            		LEFT JOIN (SELECT DISTINCT V.NUPEDIDO FROM AD_RELVISTOBRA V WHERE V.DATAHORAFINAL IS NOT NULL ) V ON V.NUPEDIDO = PEDCAB.NUPEDIDO
            	WHERE PEDCAB.SITUACAO NOT IN (0,1) AND DTPREVISTA >= GETDATE()-1 
                    AND PEDCAB.AD_CODUSUVIST LIKE '.$codigoUsuario->ReqAPI(0).'
            	ORDER BY PEDCAB.DTPREVISTA
                
            "}}',
                CURLOPT_HTTPHEADER => array(
                    "Cookie: JSESSIONID=$id",
                    'Content-Type: application/json'
                ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            
            $decode = utf8_encode($response);
            $converte_str = mb_convert_encoding($decode,"UTF-8");
            $json_array_utf8 = json_decode($converte_str,true);
            
            //Obra , Cliente , Dt.Ped , Vistoria

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
                    <h5 class="card-title text-center">Vistorias <span>| TOPMIX</span></h5>
                    
                    <div class="table-responsive">
                    
                    	<table class="table table-active table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">OBRA</th>
                                            <th scope="col">CLIENTE</th>
                                            <th scope="col">DT.PEDIDO</th>
                                            <th scope="col">VISTORIA</th>
                                            <th scope="col">NÚMERO PEDIDO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       <?php foreach ($json_array_utf8["responseBody"]["rows"] as $vistorias){?>
                                        
                                        <tr >
                                            <td scope="row" onclick="MoverConfirmacao('<?php echo $vistorias[3]?>')"><?php echo $vistorias[0];?></td>
                                           <td scope="row" onclick="MoverConfirmacao('<?php echo $vistorias[3]?>')"><?php echo $vistorias[1];?></td>
                                            <td scope="row" onclick="MoverConfirmacao('<?php echo $vistorias[3]?>')"><?php 
                                            $dataExplode = explode("-", $vistorias[2]);
                                            echo $dataExplode[2]."/".$dataExplode[1];
                                            ?></td>
                                            <td scope="row" onclick="MoverConfirmacao('<?php echo $vistorias[3]?>')"><?php echo $vistorias[4];?></td>
											<td scope="row" onclick="MoverConfirmacao('<?php echo $vistorias[3]?>')"><?php echo $vistorias[3];?></td>
                                        </tr>
                                       <?php } ?>
                                        </tbody>
                                    </table>
                                   </div>
                    
                    
                  
                        </div>
        
                      </div>
                    </div>
        
                  </div>
                </div>
        
              </div>
            </section>
        
          </main>



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
        function MoverConfirmacao(codObra){
			window.location.href= `/Views/Confirmacao.php?queryObra=${codObra}`
        }

 </script>


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



