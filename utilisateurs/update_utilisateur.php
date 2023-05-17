<?php
include '../config.php';

$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id']) &&isset($_GET['role']) ) {
    $role=$_GET['role'];
    $id=$_GET['id'];
    if (!empty($_POST)&& isset($_POST['submit'])) {
        // This part is similar to the create.php, but instead we update a record and not insert
        
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $phone = isset($_POST['cin']) ? $_POST['cin'] : '';
        $num_tel= isset($_POST['num_tel']) ? $_POST['num_tel'] : '';
        $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : '';
        $cin=isset($_POST['cin']) ? $_POST['cin'] : '';
       $email=isset($_POST['mail']) ? $_POST['mail'] : '';
        // Update the record
        $stmt = $db->prepare('UPDATE utilisateur SET   prenom = ? ,nom = ?, cin = ?, num_tel = ? WHERE id_utilisateur = ? ');
        $stmt->execute([$prenom,$nom,$cin,$num_tel,$id]);
        if ($role == 'enseignant')
        { $db->exec("UPDATE enseignant SET matricule = '$matricule', email='$email' where utilisateur ='$id'");}
      else{ $db->exec("UPDATE eleve  SET matricule= '$matricule' where utilisateur ='$id' ") ;} 
        
        header( 'location:liste_utilisateur.php');
    }
    // Get the contact from the contacts table
   
    $stmt = $db->prepare("SELECT  * from  utilisateur   join  ${role} on utilisateur.id_utilisateur=${role}.utilisateur WHERE id_utilisateur = $id ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
   
    if (!$result) { 
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit($_GET['role']);
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

    <div class="h3">editer utilsateur </div>

    <div class="form">
        <form  action="" method="POST">
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>prenom</label>
                <input type="text" class="form-control" name="prenom" value= "<?php echo $result['prenom'] ?>"required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>nom</label>
                <input type="text" value= <?php echo $result['nom'] ?> name="nom"class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>cin</label>
                <input type="text" value= "<?php echo $result['cin'] ?>" name ="cin"class="form-control" required>
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
            <?php if ($role=='enseignant'){?>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Email</label>
                <input type="email"  name="mail" value= "<?php echo $result['email'] ?>"class="form-control" >
            </div>
            <?php }?>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>num_tel</label>
                <input type="tel" name="num_tel" value= "<?php echo $result['num_tel'] ?> "class="form-control" required>
            </div>
        </div>
        <div class=" my-md-2 my-3">
            <label>matricule</label>
            <input type="text" name="matricule" value=" <?php echo $result['matricule'] ?>" class="form-control" required>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
</form>
    </div>

</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
