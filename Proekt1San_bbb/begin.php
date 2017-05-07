<?
include( 'config.php');
echo "ole";
$insert = "INSERT INTO user(Name,Kind,Sum) VALUES " .
	"('Grand Hotel Plovdiv' , 1 , 120.50) , " . 
	"('Metro Plovdiv' , 2 , 222.90)" ;
	
$results = mysqli_query($conn , $insert)
	or die(mysqli_error($conn));
	
echo "Table 'User' in database 'Balance' has been populated with 2 rows";
?>