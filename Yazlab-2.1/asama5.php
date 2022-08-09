<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type: text/html; charset=UTF-8');

function TurnTurkishText($content)
{
    return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-9', true));
}

function findsimularity($keywords1, $keywords2)
{
    $a = array_keys($keywords1);
    $b = array_keys($keywords2);
    $c = 0;
    foreach ($a as $i) {
        if (in_array($i, $b)) $c++;
    }
    return ($c / count($a)) * 100;
}

function getPageDatas($URL)
{
    $content = file_get_contents($URL);
    $content = TurnTurkishText($content);
    $text = strip_tags($content);
    $text = TurnTurkishText($text);
    return $text;
}

function findFrequency($content)
{
    $array = str_word_count($content, 1, "öçşığüÖÇŞİĞÜ");
    return $array;
}

function tr_strtolower($text)
{
    $search = array("Ç", "İ", "I", "Ğ", "Ö", "Ş", "Ü");
    $replace = array("ç", "i", "ı", "ğ", "ö", "ş", "ü");
    $text = str_replace($search, $replace, $text);
    $text = strtolower($text);
    return $text;
}


function findTotal($freq)
{
    $Total = 0;
    foreach ($freq as $word) {
        if ($word > 1) {
            $Total += $word;
        }
    }
    return $Total;
}

function filterContent($content)
{
    $listanegra = array('ve', 'veya', 'ile', 'için', 'amaç', 'dolasıyla', 'bir', 'neden', 'olan', 'gibi', 'her', 'çok', 'diğer', 'ise', 'http', 'https', 'com', 'ise', 'org', 'net', 'ext', 'olarak','and','or','for','the','but','when','while');
    $blockedWord = array();
    if (!empty($_POST["blockedWords"])) {
        $blockedWord = explode(',', strtolower($_POST["blockedWords"]));
    }

    $filterResult = array();
    foreach ($content as $word) {
        $word = tr_strtolower(trim($word, ' .,!?()'));
        if (!in_array($word, $listanegra) && !in_array($word, $blockedWord) && strlen($word) > 2) {
            $filterResult[] = $word;
        }
    }

    $filterResult = array_count_values($filterResult);
    $result = arsort($filterResult, SORT_NUMERIC);
    if ($result == true) {
        return $filterResult;
    }
}

function getLinks($URL)
{
    $html = file_get_contents($URL);

    $htmlDom = new DOMDocument;
    @$htmlDom->loadHTML($html);
    $links = $htmlDom->getElementsByTagName('a');
    $extractedLinks = array();

    foreach ($links as $link) {

        $linkText = $link->nodeValue;
        $linkHref = $link->getAttribute('href');

        if (strlen(trim($linkHref)) == 0) {
            continue;
        }

        if ($linkHref[0] == '#') {
            continue;
        }

        $extractedLinks[] = array(
            'text' => $linkText,
            'href' => $linkHref,
        );
    }

    return $extractedLinks;
}

function contains($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}

function generateUrl($main, $alt){
    if(($main[strlen($main)-1] == "/" && $alt[0] != "/") || ($main[strlen($main)-1] != "/" && $alt[0] == "/")){
        return $main.$alt;
    }else if($main[strlen($main)-1] != "/" && $alt[0] != "/"){
        return $main."/".$alt;
    }
}

function getAltLinks($mainUrl,$url,$depth){
    $TotalLinks=array($mainUrl);
    $links = getLinks($url);
    $searchedLink = 0;

    foreach ($links as $link) {
        if (( contains('http',$link["href"]) == false && contains('www',$link["href"]) == false) && $searchedLink <= 5) {
            $len = count($TotalLinks);

            $TotalLinks = array_merge($TotalLinks,[generateUrl($mainUrl,$link["href"])]);
            $TotalLinks = array_unique($TotalLinks);
            if($len < count($TotalLinks)){
                $searchedLink++;
                if($depth == 1){
                    $TotalLinks = array_merge($TotalLinks,getAltLinks($mainUrl,$url.$link["href"],$depth+1));
                }
            }else{
                continue;
            }
        }
        else if( $searchedLink > 5 ){
            break;
        }
    }
    
    return $TotalLinks;
}

function getAllKeywords($links){
    $TotalKeywords = [];
    foreach ($links as $link) {
        $freq1 = findFrequency(getPageDatas($link));
        $o1 = array_keys(array_slice(filterContent($freq1),0,5));
        $TotalKeywords = array_merge($TotalKeywords,$o1);
        $TotalKeywords = array_unique($TotalKeywords);
        //($TotalKeywords);
    }
    return $TotalKeywords;
}

function getSynonyms($keys)
{
    $searched = array();
    foreach ($keys as $key) {
        /*if($key == "millet"){
            echo($key);
        }*/
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yazlab21";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM ea WHERE kelime='$key'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //print_r($row);
                $ea1 = str_replace(' ', '', $row["esanlam1"]);
                $ea2 = str_replace(' ', '', $row["esanlam2"]);
                $ea3 = str_replace(' ', '', $row["esanlam3"]);
                $ea4 = str_replace(' ', '', $row["esanlam4"]);

                $kprep1 = in_array($ea1, $searched);
                $kprep2 = in_array($ea2, $searched);
                $kprep3 = in_array($ea3, $searched);
                $kprep4 = in_array($ea4, $searched);
                
                $key1 = null;
                $key2 = null;
                $key3 = null;
                $key4 = null;

                if (!($kprep1 != null || $kprep1 != "")) {
                    $key1 = in_array($ea1, $keys);
                }
                if (!($kprep2 != null || $kprep2 != "")) {
                    $key2 = in_array($ea2, $keys);
                }
                if (!($kprep3 != null || $kprep3 != "")) {
                    $key3 = in_array($ea3, $keys);
                }
                if (!($kprep4 != null || $kprep4 != "")) {
                    $key4 = in_array($ea4, $keys);
                }

                $founded = 0;
                $sonuc = $key . "-";
                if ($key1 != null || $key1 != "") {
                    array_push($searched,$ea1);
                    $sonuc .= $ea1 . "-";
                    $founded++;
                }
                if ($key2 != null || $key2 != "") {
                    array_push($searched,$ea2);
                    $sonuc .= $ea2 . "-";
                    $founded++;
                }
                if ($key3 != null || $key3 != "") {
                    array_push($searched,$ea3);
                    $sonuc .= $ea3 . "-";
                    $founded++;
                }
                if ($key4 != null || $key4 != "") {
                    array_push($searched,$ea4);
                    $sonuc .= $ea4 . "-";
                    $founded++;
                }

                if($founded > 0){
                    array_push($searched,$key);
                    echo $sonuc . "<br>";
                    //print_r($searched);
                    //echo "<br><br>";
                }
                //echo $key1." - ".$key2." - ".$key3." - ".$key4." - ";
            }
        }
        $conn->close();
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

    <form action="asama5.php" method="post">
        <p>Website Kümesi(max 5):<br><textarea name="wk" cols="40" rows="5" placeholder="Her Satıra Bir Url Giriniz!"></textarea></p>
        <p>Karşılaştırılacak URL:<br> <input type="text" name="url1" /></p>
        <p>Yasaklı Kelimeler (Örn:deneme,test): <br> <input type="text" width="48" height="48" name="blockedWords" /></p>
        <p><input type="submit" /></p>
    </form>
    <?php
    
    if (!empty($_POST["url1"])) {
        $wkArr = array();
        if(!empty($_POST["wk"])){
            $wk = $_POST["wk"];
            $wkArr = explode("\n", $wk);
        }
        
        $url1 = $_POST["url1"];

        echo "Karşılaştırılacak URL:<br>" .  $url1 . "<br><br>";
        echo "Yasaklı Kelimeler:<br>" . $_POST["blockedWords"] . "<br><br>";
        echo "<pre>";

        $links = getAltLinks($url1,$url1,1);
        $links = array_unique($links);
        $url1Key = getAllKeywords($links);
        
        echo "Bu Urlden Bulunan Linkler:<br>" . $url1 . "<br><br>";
        print_r($links);
        echo "<br><br>"."Bu Urlden Bulunan Anahtar Kelimeler" . "<br><br>";
        print_r($url1Key);
        echo "</pre>";
        echo "Semantik Analiz:<br>-------------------------<br>";
        echo "<pre>";
        getSynonyms($url1Key);
        echo "</pre>";
        for($i=0;$i<count($wkArr);$i++){
            echo "URL-$i:<br>" .  $wkArr[$i] . "<br><br>";
            echo "<pre>";


            $links = getAltLinks($wkArr[$i],$wkArr[$i],1);
            $links = array_unique($links);
            $urlCom = getAllKeywords($links);
            echo "Bu Urlden Bulunan Linkler:<br>" . $wkArr[$i] . "<br><br>";
            print_r($links);
            echo "<br><br>"."Bu Urlden Bulunan Anahtar Kelimeler" . "<br><br>";
            print_r($urlCom);
            echo "Semantik Analiz:<br>-------------------------<br>";
            echo "<pre>";
            getSynonyms($urlCom);
            echo "</pre>";
            echo "Benzerlik Oranı: %".findsimularity(filterContent($url1Key),filterContent($urlCom));
        }
    }
    ?>
</body>

</html>