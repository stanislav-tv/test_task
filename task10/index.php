<?php

$result = countSummaryCurrency($_REQUEST);

echo "$_REQUEST[amount] $_REQUEST[currency] конвертируются по курсу 
      $result[rate] ($result[date]) и равны $result[sum] UAH";

//
//Перевод нашей запрашеваемой валюты в грн
//

function countSummaryCurrency($request){

    $res_verify = verifyRateInLog(parseCurrencyLog(), getCorrectData($request));

    if ($res_verify['status']){
        $summary = round($_REQUEST['amount']*$res_verify['rate'], 2);

        $res_verify['date'] = explode('.', date('Y.m.d', strtotime($res_verify['date'])));

        krsort($res_verify['date']);

        $res_verify['date'] = implode('.', $res_verify['date']);

        $final_res = [
            'sum' => $summary,
            'rate' => $res_verify['rate'],
            'date' => $res_verify['date']
        ];

    }else{

        $resultRequest = sendRequest(getCorrectData($request));

        writeToLogCurl($resultRequest, $request);

        writeToLogСurrency($resultRequest);

        $summary = round($_REQUEST['amount']*$resultRequest['rate'], 2);

        $final_res = [
            'sum'=> $summary,
            'rate'=>$resultRequest['rate'],
            'date'=> $resultRequest['exchangedate']
        ];
    }

    return $final_res;
}


//
// проверка есть ли запрашеваемый запрос в логе
// вывод true или false + значения rate
//

function verifyRateInLog($log, $data_request){

    foreach ($log as $item){


        if ($item['currency'] == $data_request['currency'] &&
            $item['date'] == $data_request['date']){

            $result = [
              'status' => true,
              'rate' => $item['rate'],
              'date'=> $item['date']
            ];
            break;
        }else{
            $result = [
                'status'=> false
            ];
        }
    }
    return $result;
}



// Получаем Лог с файла
//
//  0 => array
//      'value' => string '27.8226'
//      'currency' => string 'USD'
//      'date' => string '20210401
//

function parseCurrencyLog(){

    $log = file('currency.txt');

    foreach ($log as $key => $value){
        $log[$key] = explode(' ', $value);

        for ($i = 0; $i <= count($log[$key]); $i++){

            switch ($i){
                case 0:
                    $key2 = 'rate';
                    $log[$key][$key2] = $log[$key][$i];
                    unset($log[$key][$i]);
                    break;
                case 1:
                    $key2 = 'currency';
                    $log[$key][$key2] = $log[$key][$i];
                    unset($log[$key][$i]);
                    break;
                case 2:
                    $key2 = 'date';
                    $log[$key][$key2] = $log[$key][$i];
                    unset($log[$key][$i]);
                    break;
            }
        }
    }

    return $log;

}

function writeToLogCurl($log , $request){

    $request = getCorrectData($request);
    $request = "Request 
{
valcode = $request[currency],
date = $request[date]
}
";
    $response = "Response
{
'r030' => $log[r030],
'txt' => $log[txt],
'rate' => $log[rate],
'cc' => $log[cc],
'exchangedate' => $log[exchangedate]
}
";

    $data = $request.$response.date('H:m:s - Y.m.d')."\n" . '###########################' . "\n";

    file_put_contents('log_curl.txt', $data, FILE_APPEND);
}

//
// Записуем в файл
//  в формате 27.8226 USD 20210401
//
function writeToLogСurrency($data_request){

    $dateArr = explode('.', $data_request['exchangedate']);

    krsort($dateArr);

    $data_request['exchangedate'] = implode($dateArr);

    $addString = "$data_request[rate] $data_request[cc] $data_request[exchangedate]";
    file_put_contents('currency.txt', $addString . PHP_EOL, 8);

}



// Отправляем запрос в НБУ и получаем
//  'r030' => int 840
//  'txt' => string 'Долар США'
//  'rate' => float 27.8226
//  'cc' => string 'USD'
//  'exchangedate' => string '01.04.2021'

function sendRequest($data_request){
    $url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchangenew?json';
    $endpoint = "&valcode=$data_request[currency]&date=$data_request[date]";

    $curl = curl_init($url.$endpoint);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);

    $result_ex = json_decode(curl_exec($curl), true)[0];

    return $result_ex;

}

//форматируем дату и валюту под нужный формат перед отправкой запроса
//  'amount' => string '100'
//  'currency' => string 'USD'
//  'date' => string '20210401'

function getCorrectData(array $data_form){

    $data_form['currency'] = strtoupper($data_form['currency']);

    $data_form['date'] = implode('', explode('-', substr($data_form['date'], 0,10)));

    return $data_form;

}




