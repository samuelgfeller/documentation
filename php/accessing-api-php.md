# How to access to an API with php 

```php
    // Get ip https://stackoverflow.com/questions/33302442/get-info-from-external-api-url-using-php
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.ipify.org?format=json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    if (!empty($err)){
        echo $err;
    }
    curl_close($curl);

    $ip = json_decode($response, true)['ip'];
`
