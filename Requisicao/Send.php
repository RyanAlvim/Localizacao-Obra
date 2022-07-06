<?php 

include_once("../Protect/Protect.php");
class SendDados{
    
    public $codVistoria;
    public $Field1;
    public $Field2;
    
    function __construct($codVistoria,$Field1,$Field2) {
        $this->codVistoria = $codVistoria;
        $this->Field1 = $Field1;
        $this->Field2 = $Field2;
    }
    
    
    function EnviarAPI($args1, $args2){
        $id = $_SESSION["id"];
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://app.mgmix.com.br:8180/mge/service.sbr?serviceName=DatasetSP.save&outputType=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'
            {
                "serviceName":"DatasetSP.save",
                "requestBody":{
                    "dataSetID":"00C",
                    "entityName":"AD_RELVISTOBRA",
                    "standAlone":false,
                    "fields":["CODVISTORIA","'.$this->Field1.'","'.$this->Field2.'"],
                    "records":[{
                        "pk":{"CODVISTORIA":"'.$this->codVistoria.'"},
                        "values":{"1":"'.$args1.'","2":"'.$args2.'"}}],
                    "ignoreListenerMethods":"",
                    "clientEventList":{}
                }
            }
            ',
            CURLOPT_HTTPHEADER => array(
                "Cookie: JSESSIONID=$id",
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        
        $response_json = json_decode($response,true);
        
        return $response_json["status"];
        
    }
    
    function EnviarAPI1($args1){
        $id = $_SESSION["id"];
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://app.mgmix.com.br:8180/mge/service.sbr?serviceName=DatasetSP.save&outputType=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'
            {
                "serviceName":"DatasetSP.save",
                "requestBody":{
                    "dataSetID":"00C",
                    "entityName":"AD_RELVISTOBRA",
                    "standAlone":false,
                    "fields":["CODVISTORIA","'.$this->Field1.'"],
                    "records":[{
                        "pk":{"CODVISTORIA":"'.$this->codVistoria.'"},
                        "values":{"1":"'.$args1.'"}}],
                    "ignoreListenerMethods":"",
                    "clientEventList":{}
                }
            }
            ',
            CURLOPT_HTTPHEADER => array(
                "Cookie: JSESSIONID=$id",
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        
        $response_json = json_decode($response,true);
        return $response_json["status"];
    }
}

?>