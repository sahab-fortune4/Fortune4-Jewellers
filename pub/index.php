<?php
/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */



    function getMetalPrices($apiKey, $currency = 'INR', $unit = 'g') {
        // API URL
        $url = "https://api.metals.dev/v1/latest?api_key=" . $apiKey . "&currency=" . $currency . "&unit=" . $unit;
    
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array("Accept: application/json");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);
    
        // Check if there was an error in the cURL request
        if(curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        }
    
        // Close cURL session
        curl_close($curl);
    
        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if the data is valid
        if (isset($data['status']) && $data['status'] === 'success') {
            // return $data['metals'];
            return $data;

        } else {
            // Return an error message if the API response is invalid
            echo 'Error: Unable to fetch data from the API.';
        }
    }
 
    // Usage example:
    // $apiKey = 'INKIZKIOTWCK7JDGCPXR422DGCPXR'; // Replace with your actual API key
    // $currency = 'INR'; // Example: INR or USD
    // $unit = 'g'; // Example: g, kg
    
    // $prices = getMetalPrices($apiKey, $currency, $unit);
    
    // if (is_array($prices)) {
    //     echo "Metal Rate<pre>";
    //     print_r($prices); // Prints the metal prices data
    //     echo "</pre>";
    // } else {
    //     // Display error message
    //     echo $prices;
    // }
 
 
    // die;
use Magento\Framework\App\Bootstrap;

try {
    require __DIR__ . '/../app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    http_response_code(500);
    exit(1);
}

$bootstrap = Bootstrap::create(BP, $_SERVER);
/** @var \Magento\Framework\App\Http $app */
$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
$bootstrap->run($app);
