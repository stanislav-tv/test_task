<?php

$holiday = [
        [
            'date' => 1,
            'month' => 1,
            'desc' => '1 Января'
        ],
        [
            'date' => 1,
            'month' => 4,
            'desc' => 'День смеха'
        ],
        [
            'date' => 2,
            'month' => 5,
            'desc' => 'Пасха'
        ],
        [
            'date' => 7,
            'month' => 1,
            'desc' => 'Рождество'
        ],
    [
        'date' => 1,
        'month' => 5,
        'desc' => '1 Мая'
    ],

    ];

$evenMonth = [
    4 =>    'апрель',
    6 =>        'июнь',
    9 =>        'сентябрь',
    11 =>        'ноябрь'
];
$oddMonth = [
    1 => 'январь',
    3 => 'март',
    5 => 'май',
    7 => 'июль',
    8 => 'август',
    10 => 'октябрь',
    12 => 'декабрь',
];
$month = [
    1 => 'январь',
    2 => 'февраль',
    3 => 'март',
    4 => 'апрель',
    5 => 'май',
    6 => 'июнь',
    7 => 'июль',
    8 => 'август',
    9 => 'сентябрь',
    10 => 'октябрь',
    11 => 'ноябрь',
    12 => 'декабрь',
];



if (!empty($_REQUEST['date'])){

    $date = parseDate($_REQUEST, $month);

    $finaltime =  chooseTime($date, $evenMonth, $oddMonth, $month);

    if ($finaltime['month'] === 13) $finaltime['month'] = 1 ;

    $finaltime =  checkHoliday($holiday, $finaltime);


    if(empty($finaltime['old_date'])){

        echo  'Время заказа: ' .  $date['time']['hour'] . ':' . $date['time']['minutes'] . '<br>';
        echo 'Дата заказа: ' . $date['day']['day'] .' ' .$month[$date['day']['month']] . ' ' . $date['day']['year'] . '<br>';
        echo 'Доставка на: ' . $finaltime['new_date']['day'] . ' ' . $month[$finaltime['new_date']['month']] . '<br>';

    }else{

        echo  'Время заказа: ' .  $date['time']['hour'] . ':' . $date['time']['minutes'] . '<br>';
        echo 'Дата заказа: ' . $date['day']['day'] .' ' .$month[$date['day']['month']] . ' ' . $date['day']['year'] . '<br>';
        echo 'Доставка на: ' . $finaltime['old_date']['day'] . ' ' . $month[$finaltime['old_date']['month']] . '<br>';
        echo '<br>';
        echo 'Извините за неудобства , но дата доставки выпала на ' . $holiday[$finaltime['num_hol']]['desc'] . '<br>';
        echo 'Новая дата доставки: ' . $finaltime['new_date']['day'] . ' ' . $month[$finaltime['new_date']['month']] . '<br>';

    }




//    echo 'Дата заказа: ' . $date['day']['day'] .' ' .$month[$date['day']['month']] . ' ' . $date['day']['year'] . '<br>';
//    echo 'Доставка на : ' . $finaltime['day'] . ' ' . $month[$finaltime['month']] . '<br>';

}else{

    echo 'Выберете дату заказа!' . '<br>';

}


function checkHoliday($holArr, $delivTime){

    for ($i = 0 ; $i < count($holArr); $i++){


//        var_dump($holArr[$i]['date'] . ' ' . $holArr[$i]['month']);
//        var_dump($delivTime['day'] . ' ' . $delivTime['month']);


        if ($holArr[$i]['date']===$delivTime['day'] && $holArr[$i]['month']===$delivTime['month']){


            $delivTimeNew['day'] = $holArr[$i]['date'] + 1;
            $delivTimeNew['month'] = $delivTime['month'];

            $result =  [
                'new_date' => $delivTimeNew,
                'old_date' => $delivTime,
                'num_hol' =>$i
            ];

            break;

        }else{

            $result = [
                'new_date' => $delivTime,
                'old_date' => '',
                'num_hol' => ''
            ];
        }

    }

    return $result;
}


function chooseTime(array $time, $eMonth, $oMonth, $allMonth ){


    if ($time['time']['hour'] < 20){



        $deliveryDay = $time['day']['day'] + 1;

//        var_dump(dayOnMonth($time['day']['month'], $eMonth));
//        var_dump(dayOnMonth($time['day']['month'], $oMonth));
//        die();

        if(dayOnMonth($time['day']['month'], $eMonth)){
            $minus = 30;
        }elseif (dayOnMonth($time['day']['month'], $oMonth)){
            $minus = 31;
        }else{
            $minus = 28;
        }


//       var_dump(__LINE__);
//       var_dump($deliveryDay . ' ' . $minus);


        if ($deliveryDay>30 && $minus === 30){


            $deliveryDay = $deliveryDay - $minus;

            foreach ($allMonth as $key => $item){

                if ($key === $time['day']['month']){

                    $deliveryMonth = $key+1;

                    break;
                }

            }

            $result = [
                'day' => $deliveryDay,
                'month' => $deliveryMonth
            ];

        }elseif($deliveryDay>31 && $minus === 31){

            $deliveryDay = $deliveryDay - $minus;

            foreach ($allMonth as $key => $item){

                if ($key === $time['day']['month']){

                    $deliveryMonth = $key+1;

                    break;
                }

            }

            $result = [
                'day' => $deliveryDay,
                'month' => $deliveryMonth
            ];

        }elseif($minus === 28) {


            if ($deliveryDay < 29){

                $result = [
                    'day' => $deliveryDay,
                    'month' => $time['day']['month']
                ];

            }else{

                $deliveryDay -= $minus;

                $deliveryMonth = $time['day']['month']+1;

                $result = [
                    'day' => $deliveryDay,
                    'month' => $deliveryMonth
                ];

            }

        }else{

            $result = [
                'day' => $deliveryDay,
                'month' => $time['day']['month']
            ];

        }

    }else{

        $deliveryDay = $time['day']['day'] + 2;

//        var_dump(dayOnMonth($time['day']['month'], $eMonth));
//        var_dump(dayOnMonth($time['day']['month'], $oMonth));
//        die();

        if(dayOnMonth($time['day']['month'], $eMonth)){
            $minus = 30;
        }elseif (dayOnMonth($time['day']['month'], $oMonth)){
            $minus = 31;
        }else{
            $minus = 28;
        }

//        var_dump($minus);
//        die();


        if ($deliveryDay>30 && $minus === 30){

            $deliveryDay = $deliveryDay - $minus;

            foreach ($allMonth as $key => $item){

                if ($key === $time['day']['month']){

                    $deliveryMonth = $key+1;

                    break;
                }

            }

            $result = [
                'day' => $deliveryDay,
                'month' => $deliveryMonth
            ];

        }elseif($deliveryDay>31 && $minus === 31){

            $deliveryDay = $deliveryDay - $minus;

            foreach ($allMonth as $key => $item){

                if ($key === $time['day']['month']){

                    $deliveryMonth = $key+1;

                    break;
                }

            }

            $result = [
                'day' => $deliveryDay,
                'month' => $deliveryMonth
            ];

        }elseif($minus === 28) {
            //var_dump($deliveryDay);

            if ($deliveryDay < 27){

                $result = [
                    'day' => $deliveryDay,
                    'month' => $time['day']['month']
                ];

            }else{

                $deliveryDay -= $minus;
                $deliveryMonth = $time['day']['month']+1;

                $result = [
                    'day' => $deliveryDay,
                    'month' => $deliveryMonth
                ];

            }

        }else{
            $result = [
                'day' => $deliveryDay,
                'month' => $time['day']['month']
            ];

        }

    }

    return $result;

}

function dayOnMonth($month, $eoMonth){

    foreach ($eoMonth as $key => $item){

        if ($key === $month){

            $res = true;

         //   var_dump($key . '=>' . $eoMonth[$key] . ' = ' . $month . ' - '. $res );
            break;

        }else{
            $res = false;
        //    var_dump($key . '=>' . $eoMonth[$key] . ' = ' . $month . ' - '. $res );
        }

    }

return $res;

}

function parseDate($data, $monthArr){


    $arr = explode('T',  $data['date']);


    $day = array_reverse(explode('-', $arr[0]));
    $time = explode(':', $arr[1]);


    foreach ($time as $key => $item){

        if($key === 0){
            $time['hour'] = $item;
            unset($time[0]);
        }else{
            $time['minutes'] = $item;
            unset($time[1]);
        }
    }



    foreach ($day as $key => $item){

        switch ($key){

            case 0:
                $day['day'] = $item;
                unset($day[0]);
                break;

            case 1:
                $day['month'] = (int)$item ;
                unset($day[1]);
                break;

            case 2:
                $day['year'] = $item;
                unset($day[2]);
                break;
        }

    }


    foreach ($monthArr as $key ){
        if($key === $day['month']){

            $day['month'] = $monthArr[$key];

        }
    }

    $finalDate = [
        'day' => $day,
        'time' => $time
    ];

    return $finalDate;

}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
    <input type="datetime-local" name="date">
    <input type="submit">
</form>

</body>
</html>
