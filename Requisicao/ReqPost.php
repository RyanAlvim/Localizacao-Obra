<?php 
include_once("../Protect/Protect.php");


class RequisicaoPost{
    
    public $querySQL;
    
    public function __construct($querySQL){
        $this->querySQL = $querySQL;
    }
    
    function ReqAPI($retornoNumber){
        $id = $_SESSION['id'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://app.mgmix.com.br:8180/mge/service.sbr?serviceName=DbExplorerSP.executeQuery&outputType=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"serviceName":"DbExplorerSP.executeQuery","requestBody":{"sql":"'.$this->querySQL.'"}}',
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
        
        if($retornoNumber != null || $retornoNumber == 0){
            foreach ($json_array_utf8["responseBody"]["rows"] as $info){
                return $info[$retornoNumber]; //$info[$retornoNumber];
            }
        }else{
            return $response;
        }
      
        
        
    }
}

?>