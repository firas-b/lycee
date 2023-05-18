<?php

session_start();
if ($_SESSION['role']!= 'enseignant') { header('Location: ../login.php'); }

require '../config.php' ;

try {
    
    if (isset($_POST['submit'])) {
        $cours= $_POST['cours'];
        $nomexamen=$_POST['nomexamen'];
     
        $date = $_POST['date'];
       
        $stmt = $db->prepare("INSERT INTO examen  (nom_examen, cours, date ) VALUES (:nomexamen, :cours , :date)");

        $stmt->bindValue(':nomexamen', $nomexamen);
        $stmt->bindValue(':cours', $cours);
        $stmt->bindValue(':date', $date);
        $stmt->execute();
        echo '<script type="text/javascript">
        alert("succés !");
        window.location.href = "liste_examen.php";
    </script>';
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

   <div class="card mx-3 mt-n5 shadow-lg" style="border-radius: 10px; border-left:8px #00ff99 solid; border-right: none; border-top:none; border-bottom:none">
    <div class="card-body">
      <h4 class="card-title mb-3 text-primary text-uppercase">Ajout examen </h4>      
      <form method="post">
        <div class="row">
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="nomexamen" id="floatingTextInput1" placeholder="John">
              <label for="floatingTextInput1">nom examen</label>
            </div>
          </div>
          <div class="col">
          
 
            <div class="form-floating mb-3">
                                        <?php
                                        if ( isset($_GET['id'])){$id=$_GET['id'];}
                                        
                          
                            include("fetch-data.php");
                            ?>

                            <select   class="form-select" name="cours">
                           <?php if (isset($id))  ?> <option  value=" <?php echo $id;?>" >ce cours</option><? php ?>
                           <?php
                            foreach ($options as $option) {
                            ?>
                                <option  value="<?php  echo $option['id_cours']?>"><?php echo $option['nom_cours']; ?> </option>
                                <?php 
                                }
                            ?>
                            </select>
              <label for="floatingTextInput2">description</label>
            </div>
          </div>
        </div>
        <div class="form-floating mb-3">
          <input type="date" class="form-control" name="date" id="floatingEmailInput" placeholder="name@example.com">
          <label for="floatingEmailInput">datet</label>
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