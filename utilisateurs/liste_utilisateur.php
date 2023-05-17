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
    <!--    naavbar--><link rel="stylesheet" href="../css/nav.css">
<?php  include '../nav.php'?>
    <!----->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://www.usnews.com/dims4/USNEWS/0db25a9/2147483647/crop/2119x1413+1+0/resize/970x647/quality/85/?url=https%3A%2F%2Fwww.usnews.com%2Fcmsmedia%2F23%2F02%2Fa1a88058409d8bc02755e6ae8bfa%2F200825-studyingbook-stock.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello admin </h1>
            <p class="text-white mt-0 mb-5">you can add or change the marks of any of your student down below</p>
            
            <a href="add_student.html" class="btn btn-info">Ajouter utilisateur</a>
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
                  <h3 class="mb-0">liste des utlisateurs</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <?php  require '../config.php' ?>
              <table class=" table-sm  w-100 justify-content" style=" overflow:scroll; border-radious:8px;">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    
                    <th scope="col">nom</th>
                    <th scope="col">prenom</th>
                    <th scope="col">cin</th>
                    <th scope="col"> num-tel</th>
                   
                    <th scope="col"> role</th>
                    <th scope="col"> action</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                
               <?php
              
               try {
                  $query="select * from utilisateur where  role != 'admin'  ";
                  $result = $db->query($query);
              
                   while($row =$result->fetch(PDO::FETCH_ASSOC)){
                      echo '<tr>';
                      echo '<th scope="row">'.$row["id_utilisateur"].'</th>';
                      echo'<td>'.$row['nom'].'</td>';
                      echo'<td>'.$row['prenom'].'</td>';
                      echo '<td>'.$row['cin'].'</td>';
                      echo'<td>'.$row['num_tel'].'</td>';
                    
                      echo'<td>'.$row['role'].'</td>';
              
                      ?>
                      <td><a class="btn btn-sm btn-primary" href="update_utilisateur.php?id=<?=$row['id_utilisateur']?>&role=<?=$row['role']?>">editer</a>
                <a href="removeEmployee.php?id=<?= $row['id_utilisateur'] ?>">supprimer</a></td>
                      <?php
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <div class="copyright">
          <p>Made with <a href="https://www.creative-tim.com/product/argon-dashboard" target="_blank">Argon Dashboard</a> by Creative Tim</p>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>