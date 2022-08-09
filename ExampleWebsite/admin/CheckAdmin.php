<?php

    
    /* Oluşturalan otomasyon sistemlerinin herkes tarafından erişilip sisteme gereksiz yüklenmelere engellemek amacıyla
    admin kontrolu yapan basit giriş sistemi.Şifre ve Kullanıcı Adını Settings.php'den değiştirebilirsiniz.

      Yorum satırı içindeki kodu korumak istediğiniz sistemin en başına kopyalamanız yeterli!
      
      require_once '/home/mcbafcrj/public_html/src/CheckAdmin.php';
      if(count($argv) == 3){

          $data = explode('=', $argv[1]);
          $user = $data[1];
        
          $data = explode('=', $argv[2]);
          $pass = $data[1];

          $status = CheckAdmin($user,$pass);

      }else if( isset($_SESSION["username"]) && isset($_SESSION["password"])){
          $status = CheckAdmin($_SESSION["username"],$_SESSION["password"]);
      }else{
        header("location:https://mcbase.website/src/index.php");
      }
    
    */

    require_once 'RootPath.php';
    session_start();

    function CheckAdmin($Username,$Password){
        if(isset($Username) && isset($Password))  
        {  
          require_once 'Settings.php';
            
            if($Admin_Login == $Username && $Admin_Pass == $Password)
            {
              $_SESSION["username"] = $Username;
              $_SESSION["password"] = $Password;
              return true;
            }else{
              header("location:index.php");
            }

        }else{
          header("location:index.php");  
        }
  }


?>