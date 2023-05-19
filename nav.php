<!DOCTYPE html>
<html>
<head>
    <title>Navbar avec icône de connexion</title>
 
    <!-- Inclusion des fichiers CSS de FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../logout.php">
            <i class="fas fa-sign-out-alt ml-2 mr-2"></i> <!-- Icône de connexion -->
            Quitter
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php if ($_SESSION['role']=='enseignant') {echo ' <a class="nav-link" href="../examen/liste_examen.php">Examens</a>';} ?>
               
            </li>
            <li class="nav-item">
            <?php if ($_SESSION['role']=='enseignant') {echo '   <a class="nav-link" href="../cours/liste_cours.php">Cours</a>';} ?>
              
            </li>
        </ul>
    </nav>

   
</body>
</html>
