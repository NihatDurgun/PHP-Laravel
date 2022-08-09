<?php
    error_reporting(E_ERROR | E_PARSE);

    session_start();
    require_once('./connectDB.php');
    require_once('./phpReader.php');

    if(isset($_SESSION["employeeCredentials"])){
        $hwResults = getHomeworks();
    }else{
        header("Location: login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove"])){
        global $stop;

        checkIsset(true,$_POST["uploadID"],$uploadID);
    
        if($stop == false){
            $result = deleteUploads($uploadID);
            header("Refresh:1");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Homeworks</title>
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
                        <h3>Student Homeworks</h3>
                    </span>
                </nav>
            </div>
            <div class="container-fluid " style="background-color: antiquewhite">
                <div class="row">
                    <div class="col-8 mx-auto mt-4">
                        <?php foreach ($hwResults as &$hwRow) {
                            $uploadResult = getStudentUploadsWithHomeworks($hwRow["hwID"]);
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
                                    Upload Files
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
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $uploadResult as &$uRow){ print_r($uRow["file_Juryies"])?>
                                                <tr>
                                                    <td><?php print_r( $uRow["file_Authors"]) ?></td>
                                                    <td><?php echo $uRow["file_LessonName"] ?></td>
                                                    <td><?php echo $uRow["file_ProjectSummary"] ?></td>
                                                    <td><?php echo $uRow["file_ProjectPeriod"] ?></td>
                                                    <td><?php echo $uRow["file_ProjectName"] ?></td>
                                                    <td><?php echo $uRow["file_Keywords"] ?></td>
                                                    <td><?php print_r($uRow["file_Counselors"]) ?></td>
                                                    <td><?php print_r($uRow["file_Juryies"]) ?></td>
                                                    <td><a href="<?php echo $uRow["filePath"]?>">Link</a></td>
                                                    <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-5 pt-3 form-inline" method="post">
                                                        <input type="hidden" name="uploadID" value="<?php echo $uRow["uploadID"] ?>"/>
                                                        <button type="submit" class="btn btn-primary" name="remove">Sil</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                            <br><br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>


