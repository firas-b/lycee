<?php 
include  '../config.php';
if(isset($_GET['id']))
{
//Get row id
$uid=$_GET['id'];
//Qyery for deletion
$sql = "delete from utilisateur WHERE  id= $uid";
// Prepare query for execution
$query = $db->prepare($sql);
$query -> execute();
// Mesage after updation
echo "<script>alert('Record Delete successfully');</script>";
// Code for redirection
echo "<script>window.location.href='fetch.php'</script>";
}
?>