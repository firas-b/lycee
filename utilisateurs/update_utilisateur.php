<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id']) && isset($_GET['role'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare('UPDATE utilisateur SET nom = ?, prenom = ?, cin = ?, num_tel = ? WHERE id = ?');
        $stmt1=$pdo->prepare('UPDATE enseignant  SET , prenom = ?, cin = ?, num_tel = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $title, $created, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    
    $stmt = $pdo->prepare("SELECT * from  utilisateur   join  on utilisateur.id_utilisateur=${role}.utilisateur WHERE id = ? ");
    $stmt->execute([$_GET['id']]);
    $resultt = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
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
                <input type="text" class="form-control" name="prenom" value= <?php echo $result['prenom'] ?>required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>nom</label>
                <input type="text" value= <?php echo $result['nom'] ?> name="nom"class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>cin</label>
                <input type="text" value= <?php echo $result['cin'] ?> name ="cin"class="form-control" required>
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
                <input type="email"  name="mail" value= <?php echo $result['email'] ?>class="form-control" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>num_tel</label>
                <input type="tel" name="num_tel" value= <?php echo $result['num_tel'] ?> class="form-control" required>
            </div>
        </div>
        <div class=" my-md-2 my-3">
            <label>matricule</label>
            <input type="text" name="matricule" value= <?php echo $result['mtricule_'] ?>  class="form-control" required>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
</form>
    </div>

</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
