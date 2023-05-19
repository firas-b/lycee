<?php
session_start();
if ($_SESSION['role']!= 'enseignant') { header('Location: ../login.php'); }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>

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
            <h1 class="display-2 text-white">Bonjour <?php  echo $_SESSION['username']?>  </h1>

          

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
                  <h3 class="mb-0">Ajout des notes</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body" style="background-color:white;">
            <?php  require '../config.php' ?>
            <form method ="POST"> 
<input style="width:110px;"  type="submit" name="submit" class="btn btn-primary  " value="Enregistrer"></div>

<table class=" table-sm  w-100 justify-content" style=" overflow:scroll;">
  <thead>
    <tr>
      <th scope="col">#</th>
      
      <th scope="col">nom</th>
      <th scope="col">prenom</th>
      <th scope="col">cin</th>
      <th scope="col"> num-tel</th>

      <th scope="col"> noter</th>
    </tr>
  </thead>
  
  <tbody class="table-group-divider">
  
 <?php
 
 try {
    $stmt = $db->prepare("SELECT * FROM utilisateur where role= 'eleve'");

$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

 foreach ($contacts as $contact): ?>
    <tr>
        <td><?=$contact['id_utilisateur']?></td>
        <td><?=$contact['nom']?></td>
        <td><?=$contact['prenom']?></td>
        <td><?=$contact['cin']?></td>
        <td><?=$contact['num_tel']?></td>
        <td><input class="form-control" type ="number"   min="0"  max="20" style="width:100px;" name="<?php  echo $contact['id_utilisateur']?>"></td>
       
    </tr>
    <?php endforeach; 
    echo'</tbody>
    </table>';
 $conn = null;
     }
     
 
    
    catch(PDOException $e)
{
    echo "<br> Probleme de requete".$e->getMessage();
}
 //insertion de note 
if (isset($_POST['submit'])){
   $examen=$_GET['id'];
    foreach ($contacts as $contact):
        $id =$contact['id_utilisateur'];
        $note =$_POST[$id];
        $query ="INSERT INTO notes  VALUES(NULL,'$examen','$id','$note')";
        $db->exec($query);
        
    endforeach;
    echo '<script type="text/javascript">
    alert("succés de suppression!");
    window.location.href = "../examen/liste_examen.php?examen_id='.$examen.'";
</script>';

}
 
 ?>
 </form>
  

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</body>

</html>