<?php
    error_reporting(E_ERROR | E_PARSE);

    session_start();
    require_once('./connectDB.php');
    require_once('./phpReader.php');

    if(isset($_SESSION["employeeCredentials"])){
        $employeeResult = getEmployess();
        print_r($employeeResult);
    }else{
        header("Location: login.php");
        exit;
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        if(isset($_POST["remove"])){
            global $stop;

            checkIsset(true,$_POST["userID"],$userID);
        
            if($stop == false){
                $result = deleteEmployees($userID);
                header("Refresh:1");
            }
        }else if(isset($_POST["update"])){
            global $stop;

            checkIsset(true,$_POST["userID"],$userID);
            checkIsset(true,$_POST["mailAddress"],$mailAddress);
            checkIsset(true,$_POST["password"],$password);  
        
            if($stop == false){
                $result = updateEmployees($userID,$mailAddress,$password);
                header("Refresh:1");
            }
        }else if(isset($_POST["add"])){
            global $stop;

            checkIsset(true,$_POST["mailAddress"],$mailAddress);
            checkIsset(true,$_POST["password"],$password);
        
            if($stop == false){
                $result = addEmployees($mailAddress,$password);
                header("Refresh:1");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <body class="text-center" style="background-color: antiquewhite">
        <div class="container-fluid navbar-nav">
            <nav class="navbar-nav mt-3" style="background-color: antiquewhite">
                <span class="mx-auto">
                    <h3>Admin Operations</h3>
                </span>
            </nav>
        </div>
        <div class="container col-8 " style="background-color: bisque">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>E-Mail</th>
                        <th>Password</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($employeeResult as &$employeeRow) { ?>
                    <tr>
                        <td><?php echo $employeeRow["userID"] ?></td>
                        <td><?php echo $employeeRow["mailAddress"] ?></td>
                        <td><?php echo $employeeRow["password"] ?></td>
                        <td>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-5 pt-3 form-inline" method="post">
                            <input type="hidden" name="userID" value="<?php echo $employeeRow["userID"] ?>"/>
                            <button type="submit" class="btn btn-primary" name="remove">Delete Employee</button>
                        </form>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
        <p>Add New Student</p>
        <div class="row mt-4">
            <div class="col-6 mx-auto mt-4">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-5 pt-3 form-inline" method="post">
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" placeholder="Enter email" id="mailAddress" name="mailAddress">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password :</label>
                        <input type="password" class="form-control" placeholder="Enter password" id="password" name="password">
                    </div>
                    <div class="row ">
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-primary mt-4 ml-2" name="add">Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <p>Update Student</p>
        <div class="row mt-4">
            <div class="col-6 mx-auto mt-4">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-5 pt-3 form-inline" method="post">
                    <div class="form-group">
                        <label for="email">ID:</label>
                        <input type="text" class="form-control" placeholder="Enter email" id="userID" name="userID">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter email" id="mailAddress" name="mailAddress">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter password" id="password" name="password">
                    </div>
                    <div class="row ">
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-primary mt-4 ml-2" name="update">Güncelle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</body>

</html>
