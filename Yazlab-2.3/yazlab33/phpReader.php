<?php 
include 'vendor/autoload.php';

//Onay Sayfası Başlangıç
define("ApprovalPage_Index",1); 
define("AP_LessonName_Index", 4);
define("AP_ProjectName_Index", 5);
define("AP_CounselorName_Index", 7);
define("AP_JuryName1_Index", 9);
define("AP_JuryName2_Index", 11);
define("AP_DeliveryDate",13);
//Onay Sayfası Bitiş

//İmza Sayfası Başlangıç
define("SignaturePage_Index",3); 
//İmza Sayfası Bitiş

function extractData($path){
    $pages  = readPages($path);
    $datas=array();
    for ($i=0;$i<count($pages); $i++) {
        $tempData = array();
        $text = $pages[$i]->getText();
        $arrText = explode("\n",$text);
       
        if($i==ApprovalPage_Index){
            $tempData = getFromApprovalPage($datas,$arrText);
        }else if($i==SignaturePage_Index){
            $tempData = getFromSignaturePage($datas,$arrText);
        }else{
            $searchingWords = ["ÖZET","Anahtar"];
            $wordStatus1=strpos($text, $searchingWords[0]);
            $wordStatus2=strpos($text, $searchingWords[1]);

            if($wordStatus1 == TRUE && $wordStatus2 == TRUE){
                $tempData = getFromSummaryPage($datas,$text);
            } 
        }
        if($tempData != null){
        $datas += $tempData;
        }
    }
    return $datas;
}

function getFromSummaryPage($datas,$text){    
    //echo $text;
    $text = substr($text, strpos($text, "ÖZET") + 5);
    $sentences = explode(".", $text);

    $summary ="";
    $keywords ="";
    for($i=0;$i<count($sentences)-2;$i++){
        $summary .= $sentences[$i].".";
    }
    $keywords .= $sentences[count($sentences)-2].".";
    
    $tempArr = array("Summary" => $summary,"Keywords"=>$keywords);
    $datas += $tempArr;
    
    return($datas);
}

function getFromSignaturePage($datas,$arrText){
    $editedDatas = array(); 
    foreach($arrText as &$splitText){
        if(IsNullOrEmptyString($splitText) == 0){
            array_push($editedDatas,$splitText);
        }
    }
    $textIndex=0;
    $studentIndex=1;    
    $tempStudents=array();
    foreach($editedDatas as &$editedData){
       // print_r($datas);
        $textIndex++;
        
        if($textIndex > 4){
            $tempName = preg_replace('/\s+/', '', $editedData);
            $tempData = preg_replace('/\s+/', '', $editedData);
            //echo $tempData."<br>";
            $tempName = substr($tempName, 0,strpos($tempName, ":"));
            $tempData = substr($tempData, strpos($tempData, ":") + 1);
            if($tempName == "ÖğrenciNo"){  
                $tempStudents += array("StudentNo".$studentIndex => $tempData);
            }else if($tempName == "AdıSoyadı"){
                $tempStudents += array("StudentName".$studentIndex => $tempData);
            }else if($tempName == "İmza"){
                $studentIndex+=1;
            }
            /*$tempArr = array("  " => $editedData);
            $datas += $tempArr;*/
        }
    }
    $datas += array("Authors"=>$tempStudents);
    return $datas;
}

function readPages($path){
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile($path);  
    $pages = $pdf->getPages();
    return $pages;
}

function getFromApprovalPage($datas,$arrText){
    $textIndex = 0;
    $tempJuries=array();
    foreach($arrText as &$splitText){
        if(IsNullOrEmptyString($splitText) == 0){
            $textIndex++;
        }
        if($textIndex == AP_LessonName_Index){
            $tempArr = array("LessonName" => $splitText);
            $datas += $tempArr;
        }else if($textIndex == AP_ProjectName_Index){
            $tempArr = array("ProjectName" => $splitText);
            $datas += $tempArr;
        }else if($textIndex == AP_CounselorName_Index){
            $tempArr = array("CounselorName" => $splitText);
            $datas += $tempArr;
        }
        else if($textIndex == AP_JuryName1_Index){
            $tempJuries += array("JuryName1" => $splitText);
        }else if($textIndex == AP_JuryName2_Index){
            $tempJuries += array("JuryName2" => $splitText);
        }
        else if($textIndex == AP_DeliveryDate){
            try{
                $date = preg_replace('/\s+/', '', $splitText);
                $date = substr($date, strpos($date, ":") + 1);
                
                $datetime = new DateTime($date);
                $year = $datetime->format('Y');
                $month = $datetime->format('m');
                if(intval($month) < 7){
                    $tempArr = array("DeliveryDate" => strval($year)."-".strval($year+1)." Bahar");
                }else{
                    $tempArr = array("DeliveryDate" => strval($year)."-".strval($year+1)." Güz");
                }

            
            }catch (Exception $e) {
                $tempArr = array("DeliveryDate" => "NULL");
            }

            $datas += $tempArr;
        }
    }
    $datas += array("Juryies"=>$tempJuries);
    return $datas;
}



function IsNullOrEmptyString($str){
    if((!isset($str) || trim($str) === '') == 1){
        return 1;
    }else{
        return 0;
    }
}



?>