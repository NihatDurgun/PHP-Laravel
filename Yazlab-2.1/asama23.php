<?php
header('Content-Type: text/html; charset=UTF-8');

function TurnTurkishText($content){
    return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-9', true));
}

function findsimularity($keywords1,$keywords2){
    $a = array_keys($keywords1);
    $b = array_keys($keywords2);
    $c = 0;
    foreach ($a as $i) {
        if (in_array($i,$b)) $c++;
    }
    return ($c/count($b))*100;
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

function tr_strtolower($text)
{
    $search=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $replace=array("ç","i","ı","ğ","ö","ş","ü");
    $text=str_replace($search,$replace,$text);
    $text=strtolower($text);
    return $text;
}


function findTotal($freq){
    $Total=0;
    foreach($freq as $word)
    {
        if($word > 1) {
            $Total += $word;
        }
    }
    return $Total;
}

function filterContent($content){
    $listanegra = array('ve','veya','ile','için','amaç','dolasıyla','bir','neden','olan','gibi','her','çok','diğer','ise','http','https','com','ise','org','net','ext','olarak');
    $blockedWord = array();
    if (!empty($_POST["blockedWords"])) {
        $blockedWord = explode(',',strtolower($_POST["blockedWords"]));
    }

    $filterResult = array();
    foreach($content as $word)
    {
        $word = tr_strtolower(trim($word, ' .,!?()\''));
        if (!in_array($word, $listanegra) && !in_array($word, $blockedWord) && strlen($word) > 2)
        {
            $filterResult[] = $word;
        }
    }

    $filterResult = array_count_values($filterResult);
    $result = arsort($filterResult, SORT_NUMERIC);
    if($result == true) {
        return $filterResult;
    }
}

?>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<p> <b>Anahtar Kelime:Metinde geçen bağlaç ve yasaklı kelimeler haricinde bulunan kelimelerin frekanslarına en az 2 defa kullanılmak şartıyla göre en çoktan en aza doğru sıralayarak, en çok kullanılan ve anahtar kelime potansiyeline sahip 5 kelime ekranda gösterilecektir.</b></p>
<p> <b>Benzerlik Skoru: 1.urldeki bütün anahtar kelime potansiyeline sahip kelimeler ile 2.urldeki bütün anahtar kelime listesini karşılatırıp ortak olanlardan bir oran hesaplaması yapılmaktadır.</b></p>

<form action="asama23.php" method="post">
    <p>URL-1:<br> <input type="text" name="url1" /></p>
    <p>URL-2:<br> <input type="text" name="url2" /></p>
    <p>Yasaklı Kelimeler (Örn:deneme,test): <br> <input type="text"width="48" height="48" name="blockedWords" /></p>
    <p><input type="submit" /></p>
</form>
<?php
if (!empty($_POST["url1"]) && !empty($_POST["url2"])) {
    $url1 = $_POST["url1"];
    $url2 = $_POST["url2"];
    echo "URL-1:<br>".$url1."<br><br>";
    echo "URL-2:<br>".$url2."<br><br>";
    echo "Yasaklı Kelimeler:<br>".$_POST["blockedWords"]."<br><br>";
    echo "Anahtar Kelimeler-1:<br>-------------------------<br>";
    echo "<pre>";
    $freq1 = findFrequency(getPageDatas($url1));
    $output1 = array_slice(filterContent($freq1), 0, 5);
    print_r($output1);
    echo "<br>Toplam Kelime Uzunluğu:".findTotal(filterContent($freq1));
    echo "<br><br>";

    echo "Anahtar Kelimeler-2:<br>-------------------------<br>";
    echo "<pre>";
    $freq2 = findFrequency(getPageDatas($url2));
    $output2 = array_slice(filterContent($freq2), 0, 5);
    print_r($output2);
    echo "<br>Toplam Kelime Uzunluğu:".findTotal(filterContent($freq2));
    echo "</pre>";
    echo "<br><br>";
    echo "Benzerlik Oranı: %".findsimularity(filterContent($freq1),filterContent($freq2));


}else if (!empty($_POST["url1"])) {
    $url1 = $_POST["url1"];
    $url2 = $_POST["url2"];
    echo "URL-1:<br>".$url1."<br><br>";
    echo "Yasaklı Kelimeler:<br>".$_POST["blockedWords"]."<br><br>";
    echo "Anahtar Kelimeler-1:<br>-------------------------<br>";
    echo "<pre>";
    $freq1 = findFrequency(getPageDatas($url1));
    $output1 = array_slice(filterContent($freq1), 0, 5);
    print_r($output1);
}
?>
</body>
</html>
