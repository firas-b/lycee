<?php  
 session_start();  
require'config.php';
 try  
 {  
     
     
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT *  FROM utilisateur WHERE prenom = :username AND mdp = :password";  
                $statement = $db->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  

                );  
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $result['prenom'].' '.$result['nom'] ;  
                     $_SESSION["id_utilisateur"] = $result['id_utilisateur'];
                     $_SESSION['role']=$result['role'];
                     
                     switch ($result['role']) {
                         case 'admin':
                             header('Location: utilisateurs/liste_utilisateur.php');
                             break;
                         case 'eleve':
                             header('Location: notes/notes_eleves.php');
                             break;
                         case 'enseignant':
                             header('Location: cours/liste_cours.php');
                             break;
                     }
                }  
                else  
                {  
                     $message = '<label>verfier vos données</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>

<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | PHP Login Script using PDO</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 >Authentification</h3><br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  





 