
<!DOCTYPE html>
<html>
<head>
  <title></title>
<script src="../assets/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/profile.css">



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
            <h1 class="display-2 text-white">Bonjour <?php  echo $_SESSION ['username']?>  </h1>

            <a href="ajouter_examen.php" class="btn btn-info">Ajouter examen</a>

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
                  <h3 class="mb-0">Mes notes</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body" style="background-color:white;">
            <?php  require '../config.php' ?>
           
<table  class=" table-sm mx-auto w-75 justify-content" style="overflow:scroll;">
  <thead>
    <tr>
      <th scope="col">#</th>
      
      <th scope="col">eleve</th>

      <th scope="col">matricule</th>
      <th scope="col">examen</th>
      <th scope="col"> cours</th>
      <th scope="col"> note</th>
      
    </tr>
  </thead>
  <tbody class="table-group-divider">
  
 <?php

 try {
 
  $query = "SELECT id_note,nom,prenom , matricule,nom_examen ,nom_cours , note FROM notes join examen on notes.examen=examen.id_examen join eleve on notes.eleve =eleve.utilisateur join utilisateur on eleve.utilisateur=utilisateur.id_utilisateur join cours on examen.cours=cours.id_cours where eleve.utilisateur = 1;";
    $result = $db->query($query);

     while($row =$result->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
   
        echo '<td>'.$row['id_note'].'</td>';
        echo'<td>'.$row['nom']." ".$row['prenom'].'</td>';
        echo '<td>'.$row['matricule'].'</td>';
        echo'<td>'.$row['nom_examen'].'</td>';
        echo'<td>'.$row['nom_cours'].'</td>';
        echo'<td>'.$row['note'].'</td>';

        ?>
       
     </tr>
        <?php
     }
     
echo'</tbody>
</table>';
    
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