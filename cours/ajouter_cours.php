<?php




session_start();
if ($_SESSION['role']!= 'enseignant') { header('Location: ../login.php'); }

require '../config.php' ;

try {
    
    if (isset($_POST['submit'])) {
        $nomCours = $_POST['nom_cours'];
        $description = $_POST['description'];
        $dateAjout = date("Y-m-d"); // Date actuelle
        $enseignant =$_SESSION['id_utilisateur'];
        $stmt = $db->prepare("INSERT INTO cours (nom_cours, description, date_ajout,enseignant) VALUES (:nomCours, :description, :dateAjout,:enseignant)");

        $stmt->bindValue(':nomCours', $nomCours);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':dateAjout', $dateAjout);
        $stmt->bindValue(':enseignant', $enseignant);
        $stmt->execute();

        $message = "Cours inséré avec succès.";

        
        header("Location: liste_cours.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>





<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Ajout Cours</title>
</head>
<body>
  <div class="container p-5">

   <div class="card mx-3 mt-n5 shadow-lg" style="border-radius: 10px; border-left:8px #007bff solid; border-right: none; border-top:none; border-bottom:none">
    <div class="card-body">
      <h4 class="card-title mb-3 text-primary text-uppercase">Ajout Cours</h4>
      
      <form method="post">
        <div class="row">
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="nom_cours" id="floatingTextInput1" placeholder="John">
              <label for="floatingTextInput1">nom du cours</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="description" id="floatingTextInput2" placeholder="Smith">
              <label for="floatingTextInput2">description</label>
            </div>
          </div>
        </div>
        <div class="form-floating mb-3">
          <input type="text-field" class="form-control" value=" <?php echo $_SESSION['id_utilisateur'] ; ?>" id="floatingEmailInput" placeholder="name@example.com">
          <label for="floatingEmailInput">Enseignant</label>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>
</html>