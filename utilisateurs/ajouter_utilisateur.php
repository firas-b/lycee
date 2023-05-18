<?php
require_once '../config.php';
include '../passwd.php';

if (isset($_POST['submit'])) {
    try {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $cin = $_POST['cin'];
        $num_tel = $_POST['num_tel'];
        $email = $_POST['mail'];
        $role = $_POST['role'];
        $matricule = $_POST['matricule'];
        $mdp = generateStrongPassword($length = 4, $add_dashes = false, $available_sets = 'luds');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO utilisateur VALUES (null, :prenom, :nom, :cin, :num_tel, :role, :mdp)");
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':cin', $cin);
        $stmt->bindValue(':num_tel', $num_tel);
        $stmt->bindValue(':role', $role);
        $stmt->bindValue(':mdp', $mdp);
        $stmt->execute();

        $last_id = $db->lastInsertId();

        if ($role == "eleve") {
            $stmt2 = $db->prepare("INSERT INTO eleve VALUES (:last_id, :matricule)");
        } else {
            $stmt2 = $db->prepare("INSERT INTO ${role} VALUES (:last_id, :matricule, :email)");
            $stmt2->bindValue(':email', $email);

            //
            $to = $_POST['mail'];
$subject = "mdp pour l'app de gestion des notes";
$message = $mdp;
$headers = "From: application de gestion note\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "L'e-mail a été envoyé avec succès.";
} else {
    echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
}

            //
        }

        $stmt2->bindValue(':last_id', $last_id);
        $stmt2->bindValue(':matricule', $matricule);
        $stmt2->execute();

        header('location: liste_utilisateur.php');
    } catch(PDOException $e) {
        echo $e->getMessage();
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
                <select class="form-select" name = "role" aria-label="Default select example">
  <option selected disabled>choisir le role</option>
  <option value="eleve">eleve</option>
  <option value="enseignant">enseignant</option>
  
</select>
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
