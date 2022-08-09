<?php
    error_reporting(E_ERROR | E_PARSE);

    session_start();
    require_once('./connectDB.php');
    require_once('./phpReader.php');

    if(isset($_SESSION["employeeCredentials"]) && !isset($_POST["searchUploads"])){
        $uploadResult = getUploads();
    }else if(!isset($_SESSION["employeeCredentials"])){
        header("Location: login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchUploads"])){
        global $stop;

        checkIsset(false,$_POST["file_Authors"],$file_Authors);
        checkIsset(false,$_POST["file_LessonName"],$file_LessonName);
        checkIsset(false,$_POST["file_ProjectName"],$file_ProjectName);
        checkIsset(false,$_POST["file_Keywords"],$file_Keywords);
        checkIsset(false,$_POST["file_ProjectPeriod"],$file_ProjectPeriod);
    
        if($stop == false){
            $uploadResult = getUploadsWithSearch($file_Authors,$file_LessonName,$file_ProjectName,$file_Keywords,$file_ProjectPeriod);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Project</title>
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
                        <h3>Search Page</h3>
                    </span>
                </nav>
            </div>
            <div class="row text-center mx-auto">
                <div class="col-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="pt-3 form-inline" method="post" >
                        <input type="text" class="form-control" id="file_Authors" placeholder="Author" name="file_Authors">
                        <input type="text" class="form-control" id="file_LessonName" placeholder="Lesson Name" name="file_LessonName">
                        <input type="text" class="form-control" id="file_ProjectName" placeholder="Project Name" name="file_ProjectName">                
                        <input type="text" class="form-control" id="file_Keywords" placeholder="Project Keyword" name="file_Keywords">
                        <input type="text" class="form-control" id="file_ProjectPeriod" placeholder="Period" name="file_ProjectPeriod">
                        <button type="submit" class="btn btn-primary mx-auto w-25 mt-2" name="searchUploads">Submit</button>
                    </form>
                </div>
            </div>
            <div class="container-fluid " style="background-color: antiquewhite">
                <div class="row">
                    <div class="col-12 mx-auto mt-4">
                        <div class="card">
                            <div class="card-body float-left">
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>
