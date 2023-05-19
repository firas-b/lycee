<?php
session_start();
if ($_SESSION['role']!= 'eleve') { header('Location: ../login.php'); }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>

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
            <h2 class="display-2 text-white"> Bonjour  <?php  echo $_SESSION ['username']?>  </h2><br>
          

         

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row justify-content-center">
        
        <div class="col-xl-10 order-xl-1">
          <div class="card  bg-secondary shadow">
            <div class="card-header pb-0 bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h2 class="mb-0">Mes notes</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body pt-0" style="background-color:white;">
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
    $eleve=$_SESSION['id_utilisateur'];

    $sql = "SELECT (SUM(note) / COUNT(note)) AS moy FROM notes WHERE eleve = :eleve";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':eleve', $eleve);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $moy = $result['moy'];
    echo "moyenne [temp] : ".$moy;
    
 
  $query = " SELECT id_note,nom,prenom , matricule,nom_examen ,nom_cours , note FROM notes join examen on notes.examen=examen.id_examen join eleve on notes.eleve =eleve.utilisateur join utilisateur on eleve.utilisateur=utilisateur.id_utilisateur join cours on examen.cours=cours.id_cours where eleve.utilisateur =$eleve ;";
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