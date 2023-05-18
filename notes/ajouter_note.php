<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

<script src="../assets/fontawesome.js"></script>
</head>
<body>

<div class="container-fluid ">
  <div class="row justify-content-center">
<?php  require '../config.php' ?>
<div class="row w-75 ">
    <form method ="POST"> 
<input style="width:110px;"  type="submit" name="submit" class="btn btn-primary  " value="Enregistrer"></div>

<table class=" table-sm  w-75 justify-content" style=" overflow:scroll;">
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
        <td><input type ="number" style="width:100px;" name="<?php  echo $contact['id_utilisateur']?>"></td>
       
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

}
 
 ?>
 </form>
  


</body>
</html>