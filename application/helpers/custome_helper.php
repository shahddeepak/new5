<?php
function curl_post ($url, $form_data) {
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    return $response;
}

function curl_get($url) {
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    return $response;
    
}

function curl_put($url, $form_data) {
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($client, CURLOPT_POSTFIELDS,http_build_query($form_data));
    curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($client);
    curl_close($client);
    return $response;
}

function curl_delete($url) {
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_CUSTOMREQUEST, "DELETE");
    $response = curl_exec($client);
    curl_close($client);
    return $response;
}
?>