<?php
$mySqlDb = array("localhost", "root", "pookie", "gymmate");
$AddrStack=array();
$exerciseQueryStack;
$gymQueryStack;
$userQueryStack;
$supplementQueryStack;
addrArr();

function writeToConsole( $data ) {
    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
function prompt( $data ) {
    if ( is_array( $data ) )
        $output = "<script>prompt( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>prompt( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

function addrArr(){
	global $AddrStack;
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="gyms"; // Table name 
	$counter=0;
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");

	$sql="SELECT * FROM $tbl_name";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$AddrStack[$counter]=$row['Address'].", ".$row['State'];
		//$htmlStack[$counter]=$row['Gym Name']."<br>".$row['Address'].", ".$row['State']."<br>".$row['Phone Number'];
		$counter=$counter+1;
	}
}

function getGymFieldsArr(){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="gyms"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");
	$arrStack=array(array());
	$sql="SELECT * FROM $tbl_name";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		 array_push($arrStack,array($row['Gym Name'],$row['Address'],$row['State'],$row['Open Time'],$row['Phone Number'],$row['Distance']));
	}
	return $arrStack;
}
function getUserFieldsArr(){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="users"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");
	$arrStack=array(array());
	$sql="SELECT * FROM $tbl_name";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		 array_push($arrStack,array($row['name'],$row['gender'],$row['experience'],$row['weight'],$row['height'],$row['goal'],$row['age']));
	}
	return $arrStack;
}
function getExerciseFieldsArr(){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="exercises"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");
	$arrStack=array(array());
	$sql="SELECT * FROM $tbl_name";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		 array_push($arrStack,array($row['Exercise Name'],$row['Body Part'],$row['Difficulty'],$row['Exercise Rating']));
	}
	return $arrStack;
}
function getSupplementFieldsArr(){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="supplements"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");
	$arrStack=array(array());
	$sql="SELECT * FROM $tbl_name";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		 array_push($arrStack,array($row['Brand Name'],$row['Supplement Name'],$row['Price'],$row['Type'],$row['Supplement Rating']));
	}
	return $arrStack;
}
function login($username,$password,$remember){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="users"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");

	// To protect MySQL injection (more detail about MySQL injection)
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$sql="SELECT * FROM $tbl_name WHERE name='$username' and password='$password'";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $username and $password, table row must be 1 row
	if($count==1){
	    session_start();
	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] = $username;
	    if($remember){
	    	setcookie('username', $username, time()+60*60*24*365, '/');
            setcookie('password', md5($password), time()+60*60*24*365, '/');
	    }else{
	    	setcookie('username', $username, false, '/');
	    	setcookie('password', md5($password), false, '/');
	    }
	    return true; //user is now logged in.. read cookies to get login
	}//sets session cookie
	return false; //login failed
}

function getUserPassword($username){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="users"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");

	// To protect MySQL injection
	$username = stripslashes($username);
	$username = mysql_real_escape_string($username);
	$sql="SELECT * FROM $tbl_name WHERE name='$username'";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	$count=mysql_num_rows($result);
	if($count==1){
		return $row['password'];
	}
	return "";
}

//make sure username is not already in database
function doesUserExist($username){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="users"; // Table name 
	$con=mysql_connect($host,$db_username,$db_password) or die("Failed to connect to MySQL: " .     mysql_error());
	$db=mysql_select_db($db_name,$con) or die("Failed to connect to MySQL DB: " . mysql_error());
	$sql="SELECT * FROM $tbl_name WHERE name='$username'";
	$result=mysql_query($sql)or die(mysql_error());
	$row=mysql_fetch_assoc($result);

	// Mysql_num_row is counting table row
	$counter=mysql_num_rows($result);
	if ($counter>0){
    	return true; /* Username already exists */
	}else{
		return false;
	}
}

//make sure all fields are filled
function fieldsAreValid($username,$password,$gender,$weight,$height,$experience,$goal,$age){
	if($username!=""&&$password!=""&&$weight!=""&&$height!=""&&$experience!=""&&$goal!=""&&$age!=""){
		return true;
	}
	return false;
}

function register($username,$password,$gender,$weight,$height,$experience,$goal,$age){
	global $mySqlDb;
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="users"; // Table name 
	// Connect to server and select databse.
	$con=mysql_connect($host,$db_username,$db_password) or die("Failed to connect to MySQL: " .     mysql_error());
	$db=mysql_select_db($db_name,$con) or die("Failed to connect to MySQL: " . mysql_error());


	$query = "INSERT INTO $tbl_name (name,password,gender,experience,weight,height,goal,age) VALUES ('$username','$password','$gender','$experience','$weight','$height','$goal','$age')";
	$data = mysql_query ($query)or die(mysql_error());
	if($data){
		return true; //registration complete
	}else{
		return false; //error
	}
}

function getSessionUser(){
	if($_SESSION['loggedin']){
		if($_SESSION['username']!=''){
			return $_SESSION['username'];
		}
	}
	return false;
}

//At Top of Every Page call isLogged In
function isLoggedIn(){
	$loginResult;
	if(!$_SESSION['loggedin']){
		$loginResult = false;
		if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
			$username=$_COOKIE['username'];
    		if ((!doesUserExist($_COOKIE['username'])) || ($_COOKIE['password'] != md5(getUserPassword($username)))) {    
        		$loginResult = false;
    		} else {
    			session_unset();
    			session_start();
    			$_SESSION['loggedin'] = true;
	    		$_SESSION['username'] = $username;
        		$loginResult = true;
    		}
    	}
    }else{
		$loginResult = true;
	}
	return $loginResult;
}

function logout(){
	session_unset();
	foreach ($_COOKIE as $c_id => $c_value){
    	setcookie($c_id, NULL, 1, "/");
	}
}

function getGyms($gymState,$gymOpenTime){
	if($gymOpenTime==''){
		$gymOpenTime=false;
	}
	if($gymState==''){
		$gymState=false;
	}
	global $mySqlDb;
	global $gymQueryStack;
	$_SESSION['gymQuery'] = true;
	$addressStack=array();
	$dataStack=array();
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="gyms"; // Table name 
	// Connect to server and select databse.
	mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
	mysql_select_db($db_name)or die("cannot select DB");
	if($gymState!=""&&$gymOpenTime!=""){
		$sql="SELECT * FROM $tbl_name WHERE State='$gymState' and `Open Time`='$gymOpenTime'";
	}else if(($gymState!="")&&!$gymOpenTime){
		$sql="SELECT * FROM $tbl_name WHERE State='$gymState'";
	}else if(($gymOpenTime!="")&&!$gymState){
		$sql="SELECT * FROM $tbl_name WHERE `Open Time`='$gymOpenTime'";
	}
	$counter=0;
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$addressStack[$counter]=$row['Address'].", ".$row['State'];
		$dataStack[$counter]=array($row['Gym Name'],$row['Address'],$row['State'],$row['Open Time'],$row['Phone Number'],$row['Distance']);
		$counter=$counter+1;
		writeToConsole($row['Open Time']);
	}
	$gymQueryStack=array($addressStack,$dataStack);
}
function getUsers($userName,$userGoal,$userGym,$userGender,$userAge){
	if($userName==''){
		$userName=false;
	}
	if($userGoal==''){
		$userGoal=false;
	}
	if($userGym==''){
		$userGym=false;
	}
	if($userGender==''){
		$userGender=false;
	}
	if($userAge==''){
		$userAge=false;
	}
	global $mySqlDb;
	global $userQueryStack;
	$dataStack=array();
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="users"; // Table name 

	//do something for userGym here
	if($userGym!=""||$userGym!=false){
		$dataStack2=array();
		$gymDataStack=array();
		$gymDataStack2=array();
		$tbl_name="trainsat";
		$link=mysql_connect($host, $db_username, $db_password)or die("cannot connect");
		mysql_select_db($db_name)or die("cannot select DB");
		if(($userName!=""||$userName!=false)&&($userGym!=""||$userGym!=false)){
			$sql="SELECT * FROM $tbl_name WHERE Name='$userName' and `Gym Name`='$userGym'";
		}else if(($userGym!=""||$userGym!=false)&&!$userName){
			$sql="SELECT * FROM $tbl_name WHERE `Gym Name`='$userGym'";
		}
		$counter=0;
		$result=mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$gymDataStack[$counter]=$row['Name'];
			$counter=$counter+1;
		}
		mysql_close($link);
		//Remove Duplicates from array
		$gymDataStack=array_unique($gymDataStack);
		// Connect to server and select databse.
		for($i=0;$i<$counter;$i++){
			$link=mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
			mysql_select_db($db_name)or die("cannot select DB");
			$tbl_name="users"; // Table name 
			$userName=$gymDataStack[$i];
			$subsqlName="";
			if($userName!=""||$userName!=false){
				$subsqlName="name='$userName'";
			}
			$subsqlGoal="";
			if($userGoal!=""||$userGoal!=false){
				if($subsqlName!=""){
					$subsqlGoal=" and goal='$userGoal'";
				}else{
					$subsqlGoal="goal='$userGoal'";
				}
			}
			$subsqlGender="";
			if($userGender!=""||$userGender!=false){
				if($subsqlName!=""||$subsqlGoal!=""){
					$subsqlGender=" and gender='$userGender'";
				}else{
					$subsqlGender="gender='$userGender'";
				}
			}
			$subsqlAge="";
			if($userAge!=""||$userAge!=false){
				if($subsqlName!=""||$subsqlGoal!=""||$subsqlGender!=""){
					$subsqlAge=" and age='$userAge'";
				}else{
					$subsqlAge="age='$userAge'";
				}
			}
			$subsubsql=$subsqlName.$subsqlGoal.$subsqlGender.$subsqlAge;
			$sql="SELECT * FROM $tbl_name WHERE $subsubsql";
			$result=mysql_query($sql);
			$innercounter=0;
			while ($row = mysql_fetch_assoc($result)) {
				$gymDataStack2[$innercounter]=array($row['name'],$row['gender'],$row['experience'],$row['weight'],$row['height'],$row['goal'],$row['age']);
				$innercounter=$innercounter+1;
			}
			//array_push($dataStack2, $gymDataStack2);
			$dataStack2[$i]=$gymDataStack2[0];
			mysql_close($link);
		}
		$userQueryStack=$dataStack2;
		//mysql_close($link);


	}else{


		$tbl_name="users"; // Table name 
		// Connect to server and select databse.
		mysql_connect($host, $db_username, $db_password)or die("cannot connect"); 
		mysql_select_db($db_name)or die("cannot select DB");
		
		$subsqlName="";
		if($userName!=""||$userName!=false){
			$subsqlName="name='$userName'";
		}
		$subsqlGoal="";
		if($userGoal!=""||$userGoal!=false){
			if($subsqlName!=""){
				$subsqlGoal=" and goal='$userGoal'";
			}else{
				$subsqlGoal="goal='$userGoal'";
			}
		}
		$subsqlGender="";
		if($userGender!=""||$userGender!=false){
			if($subsqlName!=""||$subsqlGoal!=""){
				$subsqlGender=" and gender='$userGender'";
			}else{
				$subsqlGender="gender='$userGender'";
			}
		}
		$subsqlAge="";
		if($userAge!=""||$userAge!=false){
			if($subsqlName!=""||$subsqlGoal!=""||$subsqlGender!=""){
				$subsqlAge=" and age='$userAge'";
			}else{
				$subsqlAge="age='$userAge'";
			}
		}
		$subsubsql=$subsqlName.$subsqlGoal.$subsqlGender.$subsqlAge;
		$sql="SELECT * FROM $tbl_name WHERE $subsubsql";
		//writeToConsole("test");
		//writeToConsole($sql);
		$counter=0;
		$result=mysql_query($sql);
		//prompt("pause for console");
		while ($row = mysql_fetch_assoc($result)) {
			$dataStack[$counter]=array($row['name'],$row['gender'],$row['experience'],$row['weight'],$row['height'],$row['goal'],$row['age']);
			$counter=$counter+1;
		}
		$userQueryStack=$dataStack;
	}
}

function getExercises($exerciseName,$bodyPart,$rating,$difficulty){	
	if($exerciseName==''){
		$exerciseName=false;
	}
	if($bodyPart==''){
		$bodyPart=false;
	}
	if($rating==''){
		$rating=false;
	}
	if($difficulty==''){
		$difficulty=false;
	}
	global $mySqlDb;
	global $exerciseQueryStack;
	$dataStack=array();
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="exercises"; // Table name 

		// Connect to server and select databse.
	$con=mysql_connect($host,$db_username,$db_password) or die("Failed to connect to MySQL: " .     mysql_error());
	$db=mysql_select_db($db_name,$con) or die("Failed to connect to MySQL DB: " . mysql_error());

	$subsqlBodyPart="";
	if($bodyPart!=""||$bodyPart!=false){
		$subsqlBodyPart="`Body Part`='$bodyPart'";
	}
	$subsqlRating="";
	if($rating!=""||$rating!=false){
		if($subsqlBodyPart!=""){
			$subsqlRating=" and `Exercise Rating`='$rating'";
		}else{
			$subsqlRating="`Exercise Rating`='$rating'";
		}
	}
	$subsqlDifficulty="";
	if($difficulty!=""||$difficulty!=false){
		if($subsqlBodyPart!=""||$subsqlRating!=""){
			$subsqlDifficulty=" and Difficulty='$difficulty'";
		}else{
			$subsqlDifficulty="Difficulty='$difficulty'";
		}
	}
	$subsqlExerciseName="";
	if($exerciseName!=""||$exerciseName!=false){
		if($subsqlBodyPart!=""||$subsqlRating!=""||$subsqlDifficulty!=""){
			$subsqlExerciseName=" and `Exercise Name`='$exerciseName'";
		}else{
			$subsqlExerciseName="`Exercise Name`='$exerciseName'";
		}
	}
	$subsubsql=$subsqlBodyPart.$subsqlRating.$subsqlDifficulty.$subsqlExerciseName;
	$sql="SELECT * FROM $tbl_name WHERE $subsubsql";
		//writeToConsole("test");
		//writeToConsole($sql);
	$counter=0;
	$result=mysql_query($sql);
		//prompt("pause for console");
	while ($row = mysql_fetch_assoc($result)) {
		$dataStack[$counter]=array($row['Exercise Name'],$row['Body Part'],$row['Difficulty'],$row['Exercise Rating']);
		$counter=$counter+1;
	}
	$exerciseQueryStack=$dataStack;
}

function getSupplements($supplementName,$supplementBrand,$supplementType){	
	if($supplementName==''){
		$supplementName=false;
	}
	if($supplementBrand==''){
		$supplementBrand=false;
	}
	if($supplementType==''){
		$supplementType=false;
	}
	global $mySqlDb;
	global $supplementQueryStack;
	$dataStack=array();
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="supplements"; // Table name 

		// Connect to server and select databse.
	$con=mysql_connect($host,$db_username,$db_password) or die("Failed to connect to MySQL: " .     mysql_error());
	$db=mysql_select_db($db_name,$con) or die("Failed to connect to MySQL DB: " . mysql_error());

	$subsqlsupplementBrand="";
	if($supplementBrand!=""||$supplementBrand!=false){
		$subsqlsupplementBrand="`Brand Name`='$supplementBrand'";
	}
	$subsqlsupplementType="";
	if($supplementType!=""||$supplementType!=false){
		if($subsqlsupplementBrand!=""){
			$subsqlsupplementType=" and Type='$supplementType'";
		}else{
			$subsqlsupplementType="Type='$supplementType'";
		}
	}
	$subsqlsupplementName="";
	if($supplementName!=""||$supplementName!=false){
		if($subsqlsupplementBrand!=""||$subsqlsupplementType!=""){
			$subsqlsupplementName=" and `Supplement Name`='$supplementName'";
		}else{
			$subsqlsupplementName="`Supplement Name`='$supplementName'";
		}
	}
	$subsubsql=$subsqlsupplementBrand.$subsqlsupplementType.$subsqlsupplementName;
	$sql="SELECT * FROM $tbl_name WHERE $subsubsql";
		//writeToConsole("test");
		//writeToConsole($sql);
	$counter=0;
	$result=mysql_query($sql);
		//prompt("pause for console");
	while ($row = mysql_fetch_assoc($result)) {
		$dataStack[$counter]=array($row['Brand Name'],$row['Supplement Name'],$row['Price'],$row['Type'],$row['Supplement Rating']);
		$counter=$counter+1;
	}
	$supplementQueryStack=$dataStack;
}

function getExercisesSupported($gymName){
	global $mySqlDb;
	$exerciseStack='';
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="equippedfor"; // Table name 
	$sql="SELECT `Exercise Name` FROM $tbl_name WHERE `Gym Name`='$gymName'";
	$counter=0;
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		if($counter==6){
			$counter=0;
			$exerciseStack=$exerciseStack."<br>";
		}
		$exerciseStack=$exerciseStack.$row['Exercise Name'].", ";
		$counter=$counter+1;
	}
	return $exerciseStack;
}
function getGymUsers($gymName){
	global $mySqlDb;
	$userStack='';
	$host=$mySqlDb[0]; // Host name 
	$db_username=$mySqlDb[1]; // Mysql username 
	$db_password=$mySqlDb[2]; // Mysql password 
	$db_name=$mySqlDb[3]; // Database name 
	$tbl_name="trainsat"; // Table name 
	$sql="SELECT Name FROM $tbl_name WHERE `Gym Name`='$gymName'";
	$counter=0;
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		if($counter==6){
			$counter=0;
			$userStack=$userStack."<br>";
		}
		$userStack=$userStack.$row['Name'].", ";
		$counter=$counter+1;
	}
	return $userStack;
}

if (isset($_POST['action-login-user'])) {
   	$username=$_POST["login_user_name"];
   	$password=$_POST["login_password"];
	//call a validate function here to make sure values are cool

   	if (isset($_POST['remember'])){
   		$loginResult=login($username,$password,true);
   	}else{
   		$loginResult=login($username,$password,false);
   	}
   	if(!$loginResult){
   		echo "Invalid Password!";
   	}
}

if (isset($_POST['action-create-user'])) {
	$username=$_POST["user_name"];
	$password=$_POST["password"];
	$gender=$_POST["gender"];
	$weight=$_POST["weight"];
	$heightfeet=$_POST["heightfeet"];
	$heightinches=$_POST["heightinches"];
	$height=$heightfeet+($heightinches*12);
	$age=$_POST["age"];
	$experience=$_POST["experience"];
	$goal=$_POST["goal"];
	if(doesUserExist($username)){
		echo "User Already Exists";
	}else{
		if(fieldsAreValid($username,$password,$gender,$weight,$height,$experience,$goal,$age)){
		echo "User Has Been Registerred";
		register($username,$password,$gender,$weight,$height,$experience,$goal,$age);
		}else{
			echo "you have an invalid field";
		}
	}
}

if (isset($_POST['action-gym-query'])) {
	if(isset($_POST["gymState"])){
		$gymState=$_POST["gymState"];
	}
	if(isset($_POST["gymOpenTime"])){
		$gymOpenTime=$_POST["gymOpenTime"];
	}
	session_start();
	if(isset($_POST["gymState"])){
		$_SESSION['gymState'] = $gymState;
	}
	if(isset($_POST["gymOpenTime"])){
		$_SESSION['gymOpenTime'] = $gymOpenTime;
	}
	$_SESSION['gymQuery'] = true;
}

if (isset($_SESSION['gymState'])||isset($_SESSION['gymOpenTime'])) {
	session_start();
	$_SESSION['gymQuery'] = true;
	if (isset($_SESSION['gymState'])&&isset($_SESSION['gymOpenTime'])) {
		getGyms($_SESSION['gymState'],$_SESSION['gymOpenTime']);
	}else if(isset($_SESSION['gymState'])&&(!isset($_SESSION['gymOpenTime']))){
		getGyms($_SESSION['gymState'],'');
	}else if((!isset($_SESSION['gymState']))&&isset($_SESSION['gymOpenTime'])){
		getGyms('',$_SESSION['gymOpenTime']);
	}
}
//USER QUERY START
if (isset($_POST['action-users-query'])) {
	if(isset($_POST["userName"])){
		$userName=$_POST["userName"];
	}
	if(isset($_POST["userGoal"])){
		$userGoal=$_POST["userGoal"];
	}
	if(isset($_POST["userGym"])){
		$userGym=$_POST["userGym"];
	}
	if(isset($_POST["userGender"])){
		$userGender=$_POST["userGender"];
	}
	if(isset($_POST["userAge"])){
		$userAge=$_POST["userAge"];
	}
	session_start();
	if(isset($_POST["userName"])){
		$_SESSION['userName'] = $userName;
	}
	if(isset($_POST["userGoal"])){
		$_SESSION['userGoal'] = $userGoal;
	}
	if(isset($_POST["userGym"])){
		$_SESSION['userGym'] = $userGym;
	}
	if(isset($_POST["userGender"])){
		$_SESSION['userGender'] = $userGender;
	}
	if(isset($_POST["userAge"])){
		$_SESSION['userAge'] = $userAge;
	}
}

if (isset($_SESSION['userName'])||isset($_SESSION['userGoal'])||isset($_SESSION['userGym'])||isset($_SESSION['userGender'])||isset($_SESSION['userAge'])) {
	$userName = "";
	$userGoal = "";
	$userGym = "";
	$userGender = "";
	$userAge = "";
	session_start();
	if(isset($_SESSION['userName'])){
		$userName = $_SESSION['userName'];
	}
	if(isset($_SESSION['userGoal'])){
		$userGoal = $_SESSION['userGoal'];
	}
	if(isset($_SESSION['userGym'])){
		$userGym = $_SESSION['userGym'];
	}
	if(isset($_SESSION['userGender'])){
		$userGender = $_SESSION['userGender'];
	}
	if(isset($_SESSION['userAge'])){
		$userAge = $_SESSION['userAge'];
	}
	getUsers($userName,$userGoal,$userGym,$userGender,$userAge);
}
//USERQUERY END


//EXERCISE QUERY START
if (isset($_POST['action-exercise-query'])) {
	if(isset($_POST["exerciseName"])){
		$bodyPart=$_POST["exerciseName"];
	}
	if(isset($_POST["bodyPart"])){
		$bodyPart=$_POST["bodyPart"];
	}
	if(isset($_POST["rating"])){
		$rating=$_POST["rating"];
	}
	if(isset($_POST["difficulty"])){
		$difficulty=$_POST["difficulty"];
	}
	session_start();
	if(isset($_POST["exerciseName"])){
		$_SESSION['exerciseName'] = $exerciseName;
	}
	if(isset($_POST["bodyPart"])){
		$_SESSION['bodyPart'] = $bodyPart;
	}
	if(isset($_POST["rating"])){
		$_SESSION['rating'] = $rating;
	}
	if(isset($_POST["difficulty"])){
		$_SESSION['difficulty'] = $difficulty;
	}
}

if (isset($_SESSION['exerciseName'])||isset($_SESSION['bodyPart'])||isset($_SESSION['rating'])||isset($_SESSION['difficulty'])) {
	$exerciseName = "";
	$bodyPart = "";
	$rating = "";
	$difficulty = "";
	session_start();
	if(isset($_SESSION['exerciseName'])){
		$exerciseName = $_SESSION['exerciseName'];
	}
	if(isset($_SESSION['bodyPart'])){
		$bodyPart = $_SESSION['bodyPart'];
	}
	if(isset($_SESSION['rating'])){
		$rating = $_SESSION['rating'];
	}
	if(isset($_SESSION['difficulty'])){
		$difficulty = $_SESSION['difficulty'];
	}
	getExercises($exerciseName,$bodyPart,$rating,$difficulty);
}
//EXERCISE QUERY END

//SUPPLEMENT QUERY START
if (isset($_POST['action-supplement-query'])) {
	if(isset($_POST["supplementName"])){
		$bodyPart=$_POST["supplementName"];
	}
	if(isset($_POST["supplementBrand"])){
		$bodyPart=$_POST["supplementBrand"];
	}
	if(isset($_POST["supplementType"])){
		$rating=$_POST["supplementType"];
	}
	session_start();
	if(isset($_POST["supplementName"])){
		$_SESSION['supplementName'] = $exerciseName;
	}
	if(isset($_POST["supplementBrand"])){
		$_SESSION['supplementBrand'] = $bodyPart;
	}
	if(isset($_POST["supplementType"])){
		$_SESSION['supplementType'] = $rating;
	}
}

if (isset($_SESSION['supplementName'])||isset($_SESSION['supplementBrand'])||isset($_SESSION['supplementType'])) {
	$supplementName = "";
	$supplementBrand = "";
	$supplementType = "";
	session_start();
	if(isset($_SESSION['supplementName'])){
		$supplementName = $_SESSION['supplementName'];
	}
	if(isset($_SESSION['supplementBrand'])){
		$supplementBrand = $_SESSION['supplementBrand'];
	}
	if(isset($_SESSION['supplementType'])){
		$supplementType = $_SESSION['supplementType'];
	}
	getSupplements($supplementName,$supplementBrand,$supplementType);
}
//SUPPLEMENT QUERY END



if (isset($_POST['action-logout'])) { 
   echo "User Has Been Logged Out"; 
   logout();
   header("Location: http://".$_SERVER['HTTP_HOST']);//send to homepage after logout
}

?>