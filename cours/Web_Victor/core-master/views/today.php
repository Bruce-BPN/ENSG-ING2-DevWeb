<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
  </head>
  <body>
    <h1>bonjour</h1>
    <?php
        $today = date('j-m-y');

        echo "<p>Bonjour, nous sommes le : ".$today."</p>";

        $moisFr = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        
        echo "<p>Bonjour, nous sommes le : ".date('d')." ".$moisFr[date("m") -1 ]." ".date("y")."</p>";

        $joursFr = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        echo "<table><tr>";
        foreach ($moisFr as $mois) {
            echo"<td>".$mois."</td>";
        }
        echo "</tr><tr>";
        foreach ($joursFr as $jour) {

            if (array_search($jour, $joursFr)==$dateJour-1){
                echo"<td style='color:red;'>".$jour."</td>";
            } else{
                echo"<td>".$jour."</td>";
            }
            
        }
        echo "</tr></table>";
        print_r($_GET);

    ?>
    <p>Date d’aujourd’hui: <?= $dateJour ?></p>

    <form action="/aujourdhui" method="get">
      <p>Prénom<input type="text" name="prenom" placeholder="prénom" autofocus></p>
      <fieldset>
        <legend>Identité</legend>
        <p><label>Homme<input type="radio"></label><label>Femme<input type="radio"></label></p>
        <p><label>Nom: <input type="text" name="toto"></label></p>
        <p><label>Prénom: <input type="text"></label></p>
        <input type="submit" value="OK">
      </fieldset>
    </form> 
  </body>
</html>