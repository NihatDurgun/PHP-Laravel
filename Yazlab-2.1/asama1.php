<?php
    header('Content-Type: text/html; charset=UTF-8');

    function TurnTurkishText($content){
        return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-9', true));
    }

    function getPageDatas($URL){
        $content = file_get_contents($URL);
        $content = TurnTurkishText($content);
        $text = strip_tags($content);
        $text = TurnTurkishText($text);
        return $text;
    }

    function findFrequency($content){
        $array = str_word_count($content, 1,"öçşığüÖÇŞİĞÜ");
        return $array;
    }
?>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>  
<p>Metinde geçen kelimelerin frekansları en çoktan en aza doğru sıralamak</p>
<form action="asama1.php" method="post">
    <p>URL: <input type="text" name="url" /></p>
    <p><input type="submit" /></p>
</form>
<?php
    if (!empty($_POST["url"])) {
        $url = $_POST["url"];
        echo "URL:<br>".$url."<br><br>";
        echo "Frekans:<br>-------------------------<br>";
        echo "<pre>";
        $freq = findFrequency(getPageDatas($url));

        $filterResult = array_count_values($freq);
        arsort($filterResult, SORT_NUMERIC);

        print_r($filterResult);
        //print_r(filterContent($freq));
        echo "</pre>";
    }
?>
</body>
</html>
