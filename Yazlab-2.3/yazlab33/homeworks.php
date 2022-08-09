<?php
    error_reporting(E_ERROR | E_PARSE);
    
    session_start();
    require_once('./connectDB.php');
    require_once('./phpReader.php');

    if(isset($_SESSION["studentCredentials"])){
        $hwResults = getHomeworks();
    }else{
        header("Location: login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadHw"])){
        global $stop;
        $fileName;$filePath;
    
        if(isset($_FILES['project'])){
            $fileName = $_FILES['project']['name'];
            $file_tmp =$_FILES['project']['tmp_name'];    
            $filePath = "uploads/".$fileName;
            move_uploaded_file($file_tmp,$filePath);
            echo "File Upload is Success <br><br>";
        }
        $datas = extractData($filePath);

        checkIsset(true,$_POST["hwID"],$hwID);
        checkIsset(true,$_POST["userID"],$studentID);
        
        if(isset($fileName) && isset($filePath)){
            $result = addUploads($hwID,$studentID,implode(', ', $datas["Authors"]),$datas["LessonName"],$datas["Summary"],$datas["DeliveryDate"],$datas["ProjectName"],$datas["Keywords"],$datas["CounselorName"],implode(',', $datas["Juryies"]) ,$filePath);
            //header("Refresh:1");
        }
        else{
            echo "Required field is empty!";
            $stop = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Homeworks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <body class="text-center" style="background-color: antiquewhite">

        <div class="cover-container d-flex h-100 mx-auto flex-column ">
            <div class="container-fluid navbar-nav">
                <nav class="navbar-nav mt-3" style="background-color: antiquewhite">
                    <span class="mx-auto">
                        <h3>Students Homeworks</h3>
                    </span>
                </nav>
            </div>
            <div class="container-fluid " style="background-color: antiquewhite">
                <div class="row">
                    <div class="col-8 mx-auto mt-4">
                        <?php foreach ($hwResults as &$hwRow) {
                            $uploadResult = getStudentUploads($_SESSION["studentCredentials"]["userID"],$hwRow["hwID"]);
                        ?>
                            <div class="card">
                                <div class="card-header float-left">
                                    <span class="float-left">Ders Adı</span><br>
                                    <span class="float-left"><?php echo $hwRow["lessonName"] ?></span>
                                </div>
                                <div class="card-body float-left">
                                    <span class="float-left">Ödev Adı</span><br>
                                    <span class="float-left"><?php echo $hwRow["hwName"] ?></span>
                                </div>
                                <div class="card-body bg-light float-left">
                                    <span class="float-left">Açıklama</span><br>
                                    <span class="float-left"><?php echo $hwRow["hwDescription"] ?></span>
                                </div>
                                <div class="card-body float-right">
                                <h5 class="float-left">
                                    Uploaded File
                                </h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Authors</th>
                                                <th>Lesson Name</th>
                                                <th>Project Summary</th>
                                                <th>Project Period</th>
                                                <th>Project Name</th>
                                                <th>Keywords</th>
                                                <th>Counselors</th>
                                                <th>Juryies</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $uploadResult as &$uRow){ ?>
                                                <tr>
                                                    <td><?php echo $uRow["file_Authors"] ?></td>
                                                    <td><?php echo $uRow["file_LessonName"] ?></td>
                                                    <td><?php echo $uRow["file_ProjectSummary"] ?></td>
                                                    <td><?php echo $uRow["file_ProjectPeriod"] ?></td>
                                                    <td><?php echo $uRow["file_ProjectName"] ?></td>
                                                    <td><?php echo $uRow["file_Keywords"] ?></td>
                                                    <td><?php echo $uRow["file_Counselors"] ?></td>
                                                    <td><?php echo $uRow["file_Juryies"] ?></td>
                                                    <td><a href="<?php echo $uRow["filePath"]?>">File</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="pt-3 form-inline" method="post" enctype="multipart/form-data">
                                <input type="text" style="visibility: hidden;" class="form-control  w-100 mt-1"  id="userID" name = "userID" value="<?php echo $_SESSION["studentCredentials"]["userID"]?>">
                                <input type="text" style="visibility: hidden;" class="form-control  w-100 mt-1"  id="hwID" name = "hwID" value="<?php echo $hwRow["hwID"]?>">
                                <input type="file" name="project" id="project">
                                <button type="submit" class="btn btn-primary mx-auto" name="uploadHw">Upload Project</button>
                            </form>
                            <br><br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>
