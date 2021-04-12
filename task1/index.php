


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
        <input type="text" name="censor" >
        <input type="submit">
    </form>

    <php>

        <?php

        echo checkCensor($_REQUEST);

        function checkCensor($par){

            $par_new = $par['censor'];

            $wrong_word = ['idiot', 'bitch', 'fuck', 'pirck', 'cock', 'penis'];

            foreach ($wrong_word as $value){

                if ($value === $par_new){

                    $result = $par_new;

                    $len = strlen($result);

                    for ($i = 0; $i <= $len; $i++ ){

                        if ($i === $len - 2 || $i === $len - 3){

                            $result[$i] = '*';

                        }

                    }

                    break;

                }else{

                    $result = 'correct' ;

                }

            }

            return '<br>' . 'Result: '.  "' $par_new '" . ' - ' .  $result;
        }

        ?>
    </php>
</body>
</html>


