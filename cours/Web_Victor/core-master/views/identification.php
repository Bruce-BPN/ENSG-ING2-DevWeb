<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
  </head>
  <body>
    <?php
        if (isset($user['log']) and !empty($user['log'])){
            // echo $user['log'];            
            if($user['pass']=='admin'){
                echo "<p>Bonjour ".$user['log']."</p>";
                echo "<a href='/logout'>Disconnect</a>";
            }else {
                echo '<form action="/ident" method="post">
                    <p><label>Login : <input type="text" name="log"></label></p>
                    <p><label>Mdp : <input type="password" name="pass"></label></p> 
                    <input type="submit" value="Go !">';
            }
               
        } else {
            echo '<form action="/ident" method="post">
                <p><label>Login : <input type="text" name="log"></label></p>
                <p><label>Mdp : <input type="password" name="pass"></label></p> 
                <input type="submit" value="Go !">

            </form>';
        }
    ?>
    
  </body>
</html>