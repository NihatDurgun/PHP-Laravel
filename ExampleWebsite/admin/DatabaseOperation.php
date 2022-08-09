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

    function GetAllPages(){
        $request = Connect();
        $result = $request->query("call getAllPages()");
        close_db($request);
        return $result;
    }  

    function PushOrder($ProdudctID,$USER_ID,$Amount){
        $request = Connect();
        $result = $request->query("call pushMyOrder($ProdudctID,$USER_ID,$Amount)");
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

    function GetAllAccounts(){
        $request = Connect();
        $result = $request->query("call getAllAccounts()");
        close_db($request);
        return $result;
    }

    function GetUser($USER_ID){
        $request = Connect();
        $result = $request->query("call getUser($USER_ID)");
        close_db($request);
        return $result;
    }

    function addUser($NAME,$SURNAME,$USER_NAME,$USER_PASSWORD,$EMAIL){
        $request = Connect();
        echo "call addUser('$USER_NAME','$USER_PASSWORD','$EMAIL','$NAME','$SURNAME')";
        $result = $request->query("call addUser('$USER_NAME','$USER_PASSWORD','$EMAIL','$NAME','$SURNAME')");
        close_db($request);
        return $result;
    }

    function updateUser($USER_ID,$NAME,$SURNAME,$USER_NAME,$USER_PASSWORD,$EMAIL){
        $request = Connect();
        $result = $request->query("call updateUser('$USER_ID','$NAME','$SURNAME','$USER_NAME','$USER_PASSWORD','$EMAIL')");
        close_db($request);
        return $result;
    }

    function removeUser($USER_NAME){
        $request = Connect();
        $result = $request->query("call deleteUser('$USER_NAME')");
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

    function updatePage($Page_Name,$Header,$MainTitle,$MainTitleDesc){
        $request = Connect();
        $result = $request->query("call updatePage('$Page_Name','$Header','$MainTitle','$MainTitleDesc')");
        close_db($request);
        return $result;
    }

    function close_db($request){

		mysqli_close($request);

    }

    
?>