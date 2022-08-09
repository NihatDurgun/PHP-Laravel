<?php
    function Connect(){
        include 'Settings.php';

		$request = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME);
        $request->set_charset("utf8");
		if (!$request) {

			echo "Error: Unable to connect to MySQL." . PHP_EOL;

			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;

			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;

			exit;
		}
		
		return $request;
    }

    function CheckUser($USERNAME,$PASSWORD){
        $request = Connect();
        $result = $request->query("select UserID from users where UserName ='$USERNAME' and Userpswd ='$PASSWORD'");
        
        close_db($request);
        $row = $result->fetch_assoc();
        if($row[UserID] != ""){
            return $row[UserID];
        }else{
            return -1;
        }
    }

    function PushOrder($ProdudctID,$USER_ID,$Amount,$Address){
        $request = Connect();
        $result = $request->query("call pushMyOrder($USER_ID,$ProdudctID,$Amount,'$Address')");
        close_db($request);
        return $result;
    }

    function GetProducts(){
        $request = Connect();
        $result = $request->query("select * from product");
        close_db($request);
        return $result;
    }

    function GetLimitProducts($startROW,$startEND){
        $request = Connect();
        $result = $request->query("CALL getLimitedProduct($startROW,$startEND)");
        close_db($request);
        return $result;
    }


    function GetProductsCount(){
        $request = Connect();
        $result = $request->query("CALL getAllProductCount()");
        close_db($request);
        $row = $result->fetch_assoc();
        return $row[count];
    }

    function GetProduct($ProdudctID){
        $request = Connect();
        $result = $request->query("call getProductDetail($ProdudctID)");
        close_db($request);
        return $result;
    }


    function GetOrders($USER_ID){
        $request = Connect();
        $result = $request->query("call getMyOrders($USER_ID)");
        close_db($request);
        return $result;
    }

    function GetPageDatas($Page_Name){
        $request = Connect();
        $result = $request->query("call getPage('$Page_Name')");
        close_db($request);
        $row = $result->fetch_assoc();
        return $row;
    }

    function close_db($request){

		mysqli_close($request);

    }

    
?>