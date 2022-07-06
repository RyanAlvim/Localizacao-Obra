<?php 

class ConnectAPI{
    
    public $jsessionID;
    
    function ConectarSankhya($usuario, $senha){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://app.mgmix.com.br:8180/mge/service.sbr?serviceName=MobileLoginSP.login&outputType=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
          "serviceName": "MobileLoginSP.login",
              "requestBody": {
                  "NOMUSU": {
                      "$": "'.$usuario.'"
                  },
                  "INTERNO":{
                      "$":"'.$senha.'"
                  },
                  "KEEPCONNECTED": {
                      "$": "S"
                  }
              }
          }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $response_decode = json_decode($response,true);
        $responseBody = $response_decode["responseBody"];
        $jsessionID = $responseBody["jsessionid"];
        $this->jsessionID = $jsessionID["$"];

	return $response_decode["status"];
    }
    
    function getID() : string{
        return strval($this->jsessionID);
    }
    
}

?>
