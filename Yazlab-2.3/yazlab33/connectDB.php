<?php
function connectDB(){
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "yazlab33";

    $conn = new mysqli($servername, $username, $password,$database);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function checkIsset($required,$postVariable,&$editedVariable){
    global $stop;

    if(isset($postVariable)){
        $editedVariable = $postVariable;
    }else if($required){
        echo "Required field is empty!";
        $stop = true;
    }
}

function addParameter(&$sql,&$parameterCount,$parameterName,$parameterVariable,$addAnd=False,$addEmpty=True){
    if(isset($parameterVariable)){
        if($parameterVariable == "" && $addEmpty == False){
            return;
        }
        if($parameterCount > 0 ){
            if($addAnd == FALSE){
                $sql .= " ,$parameterName = '$parameterVariable'";
            }else{
                $sql .= " and $parameterName = '$parameterVariable'";
            }
        }else{
            $sql .= " $parameterName = '$parameterVariable'";
        }
        $parameterCount = $parameterCount + 1;
    }
}

function addLIKEParameter(&$sql,&$parameterCount,$parameterName,$parameterVariable,$addAnd=False,$addEmpty=True){
    if(isset($parameterVariable)){
        if($parameterVariable == "" && $addEmpty == False){
            return;
        }
        if($parameterCount > 0 ){
            if($addAnd == FALSE){
                $sql .= " ,$parameterName LIKE '%$parameterVariable%'";
            }else{
                $sql .= " and $parameterName LIKE '%$parameterVariable%'";
            }
        }else{
            $sql .= " $parameterName LIKE '%$parameterVariable%'";
        }
        $parameterCount = $parameterCount + 1;
    }
}

//Start Students Query
function checkStudentCredentials($mailAddress,$password){
    $conn = connectDB();

    if ($result = $conn -> query("SELECT * FROM students WHERE mailAddress = '$mailAddress' and password = '$password'")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "invalid credentials";
            return false;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }

}

function addStudent($mailAddress,$password){
    $conn = connectDB();
    if ($result = $conn -> query("INSERT INTO students VALUES(NULL,'$mailAddress','$password')")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function updateStudent($userID,$mailAddress,$password){
    $conn = connectDB();
    $parameterCount = 0;

    $sql = "UPDATE students SET";

    addParameter($sql,$parameterCount, "mailAddress",$mailAddress);
    addParameter($sql,$parameterCount, "password",$password);

    $sql .= " WHERE userID='$userID';";

    if ($result = $conn -> query($sql)) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function deleteStudent($userID){
    $conn = connectDB();
    if ($result = $conn -> query("DELETE FROM students WHERE userID='$userID';")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getStudents(){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM students")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getStudent($userID){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM students WHERE userID='$userID'")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}
//Ends Students Query

//Start Counselors Query
function checkEmployeesCredentials($mailAddress,$password){
    $conn = connectDB();

    if ($result = $conn -> query("SELECT * FROM employees WHERE mailAddress = '$mailAddress' and password = '$password'")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "invalid credentials";
            return false;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function addEmployees($mailAddress,$password){
    $conn = connectDB();
    echo "INSERT INTO employees VALUES(NULL,'$mailAddress','$password')";
    if ($result = $conn -> query("INSERT INTO employees VALUES(NULL,'$mailAddress','$password')")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function updateEmployees($userID,$mailAddress,$password){
    $conn = connectDB();
    $parameterCount = 0;


    $sql = "UPDATE employees SET";

    addParameter($sql,$parameterCount, "mailAddress",$mailAddress);
    addParameter($sql,$parameterCount, "password",$password);

    $sql .= " WHERE userID='$userID';";

    if ($result = $conn -> query($sql)) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function deleteEmployees($userID){
    $conn = connectDB();
    if ($result = $conn -> query("DELETE FROM employees WHERE userID='$userID';")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getEmployess(){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM employees")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getEmployee($userID){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM employees WHERE userID='$userID'")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}
//Ends Counselors Query

//Start Homeworks Query

function addHomeworks($juryID,$lessonName,$hwName,$hwDescription){
    $conn = connectDB();
    if ($result = $conn -> query("INSERT INTO homeworks VALUES(NULL,'$juryID','$lessonName','$hwName','$hwDescription')")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function updateHomeworks($hwID,$juryID,$lessonName,$hwName,$hwDescription){
    $conn = connectDB();
    $parameterCount = 0;


    $sql = "UPDATE homeworks SET";

    addParameter($sql,$parameterCount, "juryID",$juryID);
    addParameter($sql,$parameterCount, "lessonName",$lessonName);
    addParameter($sql,$parameterCount, "hwName",$hwName);
    addParameter($sql,$parameterCount, "hwDescription",$hwDescription);

    $sql .= " WHERE hwID='$hwID';";

    if ($result = $conn -> query($sql)) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function deleteHomeworks($hwID){
    $conn = connectDB();
    if ($result = $conn -> query("DELETE FROM homeworks WHERE hwID='$hwID';")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getHomeworks(){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM homeworks")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getHomework($hwID){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM homeworks WHERE hwID='$hwID';")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function addUploads($hwID,$studentID,$authors,$lessonName,$summary,$period,$projectName,$keywords,$counselors,$juryies,$filePath){
    $conn = connectDB();
    if ($result = $conn -> query("INSERT INTO uploads VALUES(NULL,'$hwID','$studentID   ','$authors','$lessonName','$summary','$period','$projectName','$keywords','$counselors','$juryies','$filePath')")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function updateUploads($uploadID,$hwID,$studentID,$uploadPeriod,$keywords,$fileName,$filePath){
    $conn = connectDB();
    $parameterCount = 0;

    $sql = "UPDATE uploads SET";

    addParameter($sql,$parameterCount, "hwID",$hwID);
    addParameter($sql,$parameterCount, "studentID",$studentID);
    addParameter($sql,$parameterCount, "uploadPeriod",$uploadPeriod);
    addParameter($sql,$parameterCount, "keywords",$keywords);
    addParameter($sql,$parameterCount, "fileName",$fileName);
    addParameter($sql,$parameterCount, "filePath",$filePath);

    $sql .= " WHERE uploadID='$uploadID';";

    if ($result = $conn -> query($sql)) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function deleteUploads($uploadID){
    $conn = connectDB();
    if ($result = $conn -> query("DELETE FROM uploads WHERE uploadID='$uploadID';")) {
        echo $result;
        return $result;
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getUploads(){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM uploads")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}


function getStudentUploadsWithHomeworks($homeworkID){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM uploads WHERE hwID = '$homeworkID'")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $row =  mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $row;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getStudentUploads($studentID,$homeworkID){
    $conn = connectDB();
    if ($result = $conn -> query("SELECT * FROM uploads WHERE studentID = '$studentID' and  hwID = '$homeworkID'")) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $row =  mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $row;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}

function getUploadsWithSearch($file_Authors,$file_LessonName,$file_ProjectName,$file_Keywords,$file_ProjectPeriod){
    $conn = connectDB();
    $parameterCount = 0;

    $sql = "SELECT * FROM uploads WHERE";

    addLIKEParameter($sql,$parameterCount, "file_Authors",$file_Authors,False,FALSE);
    addLIKEParameter($sql,$parameterCount, "file_LessonName",$file_LessonName,TRUE,FALSE);
    addLIKEParameter($sql,$parameterCount, "file_ProjectName",$file_ProjectName,TRUE,FALSE);
    addLIKEParameter($sql,$parameterCount, "file_Keywords",$file_Keywords,TRUE,FALSE);
    addLIKEParameter($sql,$parameterCount, "file_ProjectPeriod",$file_ProjectPeriod,TRUE,FALSE);

    if ($result = $conn -> query($sql)) {
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $datas = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            return $datas;
        }
    }else{
        echo("Error description: " . $conn -> error);
        return false;
    }
}



?>