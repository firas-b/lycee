<?php
session_start();
if ($_SESSION['role']!= 'enseignant') { header('Location: ../login.php'); }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
<script src="../assets/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/profile.css">



</head> 
<body>
  <div class="main-content">
    <!--    naavbar-->
    <link rel="stylesheet" href="../css/nav.css">
  <?php  include '../nav.php'?>
    <!----->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://www.usnews.com/dims4/USNEWS/0db25a9/2147483647/crop/2119x1413+1+0/resize/970x647/quality/85/?url=https%3A%2F%2Fwww.usnews.com%2Fcmsmedia%2F23%2F02%2Fa1a88058409d8bc02755e6ae8bfa%2F200825-studyingbook-stock.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Bonjour <?php  echo $_SESSION['username']?> </h1>

            <a href="ajouter_cours.php" class="btn btn-info">Ajouter cours</a>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row justify-content-center">
        
        <div class="col-xl-10 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">liste des cours</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body" style="background-color:white;">
              <?php  require '../config.php' ?>
              <table class="table-sm  w-100 justify-content" style=" overflow:scroll; border-radious:8px;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nom du cours</th>

      <th scope="col">description </th>
      <th scope="col">date_ajout </th>
      
      <th scope="col">enseignant</th>
      <th scope="col">actions</th>
    
    </tr>
  </thead>
  <tbody class="table-group-divider">
 <?php

 try {
  $en=$_SESSION['id_utilisateur'];
    $sql = "SELECT *,utilisateur.prenom , utilisateur.nom from cours join enseignant ON cours.enseignant=enseignant.utilisateur join utilisateur on enseignant.utilisateur=utilisateur.id_utilisateur where enseignant=$en ;";
    $result = $db->query($sql);

     while($row =$result->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo '<th scope="row">'.$row["id_cours"].'</th>';
        echo '<td>'.$row['nom_cours'].'</td>';
        echo '<td>'.$row['description'].'</td>';
        echo '<td>'.$row['date_ajout'].'</td>';
     
        echo'<td>'.$row['nom']." ".$row['prenom'].'</td>';
      
        ?>
                      <td>
                <a class="btn btn-sm btn-danger"  href="supprimer_cours.php?id=<?= $row['id_cours'] ?>">supprimer</a>
                <a class="btn btn-sm btn-success"  href="../examen/liste_examen.php?cours_id=<?= $row['id_cours'] ?>">examens</a></td>
                      <?php
        echo'</tr>';
     }
     
echo'</tbody>
</table>';
     $conn = null;
    }
    catch(PDOException $e)
{
    echo "<br> Probleme de requete".$e->getMessage();
}

 ?>
  </tbody>
</table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</body>

</html>