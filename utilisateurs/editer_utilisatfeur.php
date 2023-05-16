<?php
require_once'../config.php';
include ('../passwd.php');
if (isset($_POST['submit'])){
try {
    
 $prenom=$_POST['prenom'];
 $nom=$_POST['nom'];
 $cin=$_POST['cin'];
 $num_tel=$_POST['num_tel'];
 $email=$_POST['mail'];
 $role =$_POST['radio'];
 $matricule=$_POST['matricule'];
  $mdp=generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO utilisateur values   (null,'$prenom','$nom','$cin','$num_tel','$mdp')";
   $db->exec($sql);
  $last_id = $db->lastInsertId();
  if($role =="eleve"){$sql2 ="INSERT eleve values('$last_id','$matricule')";}
  else 
  $sql2 ="INSERT into enseignant values('$last_id','$matricule','$email')";
  $db->exec($sql2) ;
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
}

?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib"> <link rel="stylesheet" href="assets/bootstrap.min.css">
    <script src="assets/bootstrap.min.js"></script>
    <meta name="keywords" content="Colorlib Templates">
 <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/form1.css" rel="stylesheet" media="all">
</head>

<body>
   .
<div class="wrapper rounded bg-white ">

    <div class="h3">Registration Form</div>

    <div class="form">
        <form  action="" method="POST">
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>prenom</label>
                <input type="text" class="form-control" name="prenom" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>nom</label>
                <input type="text"  name="nom"class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>cin</label>
                <input type="text"  name ="cin"class="form-control" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>role</label>
                <div class="d-flex align-items-center mt-2">
                    <label class="option">
                        <input type="radio" name="radio">eleve
                        <span class="checkmark"></span>
                    </label>
                    <label class="option ms-4">
                        <input type="radio" name="radio">enseignant
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Email</label>
                <input type="email"  name="mail" class="form-control" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>num_tel</label>
                <input type="tel" name="num_tel" class="form-control" required>
            </div>
        </div>
        <div class=" my-md-2 my-3">
            <label>matricule</label>
            <input type="text" name="matricule" class="form-control" required>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
</form>
    </div>

</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
