<?php

function postCurl($url, $data)
{
  // return $data;
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      'x-api-key: vEWUUFSjQ3jCBU9hOje@$1@PLHbf!q$0',
      'Content-Type: application/json',
      'Cookie: csrftoken=aU4UMnh3VOYMmecEhHy4VQaSlzD6xzMWVfXoj3O3aI6QPoWD26Rq5zTLDFLdbGyd; csrftoken=NAvsV1ZiX4I719KblxefU4IFu4cOQywVDJR5I5ltYr7VP5XJRrr14BRxx8NlIuNh; csrftoken=oy0uwFcnnC1PtIr2m59MAkYqrPrCrh9Bmx63yypzHpSOUTMiEbH8LaxoqDRLRflY; csrftoken=YbL0TO3SDOuCBL2P5hsBfFZELGEL0TGdoEskwOjt3ZJFmc1AIt6xqZsNUEswJMTH; csrftoken=f5w7yjEvjNiHj2cDSWAbjDqmpdxCzRBVTwVXwf70tNkinIuc7G06lDz7jS0fLQlT; csrftoken=BlCa5TjcAnAPiiWQaGEORTvdefTC3LF6jOs3ZSBdP9W7PG9rrNryWSm6YFVAl9fn; csrftoken=8w8j2NN19PyqrngnlxS5vhgFwTwZ0faWyDNnLSt9sjJ8MPfq6yEWQ12sIxoUmzcl; csrftoken=6yc76UBr6d2IPVuYpTeJNssAZEVKB1ZzlU8vzNJOya04nmPhzzMqabYrgw68DJgM; csrftoken=f5w7yjEvjNiHj2cDSWAbjDqmpdxCzRBVTwVXwf70tNkinIuc7G06lDz7jS0fLQlT'
    ),
  )
  );

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}


function imageSave($tmpName, $ext, $docName, $uploadName, $files)
{
  $res = move_uploaded_file($tmpName, $uploadName);

  if ($res) {
    $upName = '@' . $uploadName;
    $curl = curl_init();

    $postData = array(
      'file' => curl_file_create($uploadName),
      'doc_name' => $docName,
      'service_name' => 'junkyard',
      'extension' => $ext,
      'is_public' => 'true',
      'doc_type' => 'image',
      'is_view_only' => 'true'
    );

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://storage.parkplus.io/api/v1/document/upload/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_POST => true,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_POSTFIELDS => $postData,
      CURLOPT_HTTPHEADER => array(
        'client-id: 8186c1be-660f-428c-93a7-6480c2d8af66',
        'client-secret: hjjh0uw8c3j7vw5jgba8',
        'x-api-key: 2eb80017-f525-4ee7-8b8f-aa1a94ec3412'
      ),
    )
    );

    $response = curl_exec($curl);
    // print_r($response);
    curl_close($curl);
    return json_decode($response,true);
  } else {
    $resArr['status'] = 1;
    $resArr['message'] = 'Something went wrong';
    return json_encode($resArr);
  }
}