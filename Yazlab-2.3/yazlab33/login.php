<?php
    session_start();
    require_once('./connectDB.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!isset($_SESSION["studentCredentials"])){
            print_r($_POST);        
            if (isset($_POST['login']) && !empty($_POST['mailAddress']) && !empty($_POST['password'])) {
                    global $stop;

                    checkIsset(true,$_POST["mailAddress"],$mailAddress);
                    checkIsset(true,$_POST["password"],$password);

                    if($stop == false){
                        $result = checkStudentCredentials($mailAddress,$password);
                        if($result != "invalid credentials"){
                            $_SESSION["studentCredentials"] = $result;
                        }
                        print_r($_SESSION["studentCredentials"]);
                        header("Location: homeworks.php");
                    }
            }
        }else{
            header("Location: homeworks.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <body class="text-center bg-light">

        <div class="cover-container d-flex h-100 mx-auto flex-column ">
            <div class="container-fluid navbar-nav">
                <nav class="navbar-nav bg-success">
                    <span class="mx-auto">
                        <h3>Student Login</h3>
                    </span>
                </nav>
            </div>
            <div class="container-fluid  bg-light">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-5 pt-3 form-inline" method="post">
                    <div class="col-12 form-group mt-5 mx-auto ">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control  w-100 mt-1" placeholder="Enter email" id="mailAddress" name = "mailAddress">
                    </div>
                    <div class="col-12 form-group mt-5 mx-auto ">
                        <label for="pwd">Password :</label>
                        <input type="password" class="form-control  w-100 mt-1" placeholder="Enter password" id="password" name = "password">
                    </div>
                    <button type="submit" class="col-12 m-0 btn btn-primary mt-5" name = "login">Login</button>   
                </form>   
            </div>
        </div>
    </body>
</body>

</html>
