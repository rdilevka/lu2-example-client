<?php

require_once dirname(__FILE__).'/labour_unlocked.php';
$labourUnlocked = new LabourUnlocked();

//Attempt to extract the "code" value from the current GET request.
$code = isset($_GET['code']) ? $_GET['code'] : false;

//We did not get here by redirect from LU2, as there is no ?code= part to
//the URL
if (!$code) {
    print "<h1>Not Authorised</h1>";
    die();
}

//Use cURL to access the LU2 API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $labourUnlocked->getApiUrl($code));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json_encoded_content = curl_exec($ch);

//Decode the JSON response from the API
$response_data = json_decode($json_encoded_content, true);

//Check the response, see if an error was generated
if (isset($response_data['ErrorCode'])) {
    //An error was returned when accessing the API, so we cannot verify this user
    //successfully authenticated against the LU2 server.
    print "<h1> Authentication Failed!</h1>";
    print sprintf("<h2>%s</h2>", $response_data['ErrorMessage']);
    die();
} else {
    //If theres no error, display the data response from the API
    //This data would usually be saved to a session, and we would mark the user
    //as authenticated in this site.
    print("<h1>Authentication Successful!</h1>");

    print("<h2>Access Token</h2>");
    printf("<pre>%s</pre>", $code);

    print("<h2>JSON Data</h2>");
    printf("<pre>%s</pre>", $json_encoded_content);

    print("<h2>Decoded Data</h2>");
    printf("<pre>%s</pre>", print_r($response_data, true));
}

