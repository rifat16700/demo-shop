<?php
/*
 | --------------------------------------------------------------------------
<?php
/*
 | --------------------------------------------------------------------------
 | EKHONI DIGITAL - PAYMENT GATEWAY CORE
 | --------------------------------------------------------------------------
 |
 | WARNING: THIS FILE IS CRITICAL FOR THE PAYMENT GATEWAY.
 | DO NOT MODIFY OR DELETE THIS FILE. YOUR GATEWAY WILL STOP WORKING.
 | UNAUTHORIZED MODIFICATIONS WILL TRIGGER SYSTEM LOCK.
 */
namespace App\Libraries;

class GatewayApi
{
    public function payment($data = [], $header = [])
    {
        $headers = array(
            'Content-Type: application/json',
            'API-KEY: ' . $header['api'],
            'User-Agent: Ekhoni-Digital-Payment-Gateway/1.0',
            'Accept: application/json'
        );
        $url = $header['url'];
        $curl = curl_init();
        $data = json_encode($data);

        $is_local = (strpos(base_url(), 'localhost') !== false);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => false, // Security: don't follow redirects for API
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            // SSL Security: Enable on production, disable only on localhost
            CURLOPT_SSL_VERIFYPEER => !$is_local,
            CURLOPT_SSL_VERIFYHOST => $is_local ? 0 : 2,
        ));

        $response = curl_exec($curl);
        
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return json_encode(['status' => 'error', 'message' => 'Connection Error: ' . $error_msg]);
        }
        
        curl_close($curl);

        return $response;
    }
}
