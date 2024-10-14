<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Départements</title>

  </head>
  <body>
    <h1>Les départements !!</h1>

    <form action="/departements" method="get">
        <select name="reg">
            <?php
                foreach($region as $r){
                    if(isset($_GET["reg"])){
                        if ($r['insee']==$_GET["reg"]){
                            echo "<option value='".$r['insee']."' selected>".$r['nom']."</option>";
                        }else{
                            echo "<option value='".$r['insee']."'>".$r['nom']."</option>";
                        }
                        
                    }else{
                        echo "<option value='".$r['insee']."'>".$r['nom']."</option>";
                    }
                    
                }
            ?>
        </select>
        <input type="submit" value="GO">
    </form>






    <!-- <form action="/departements" method="get">
        <select name="reg">
        <?php
            // foreach ($region as $result) {
            //     // $result est un tableau associatif
            //     echo "<option value=".$result["insee"].">".$result["nom"]."</option>";
            // }
        ?>
        </select>
        <input type="submit" value="Go">
    </form> -->
    <?php
        

        echo "<table>";
        if(isset($depart)){
            foreach ($depart as $result) {
                // $result est un tableau associatif
                echo "<tr><td>".$result["nom"]."</td><td>".$result["insee"]."</td></tr>";
            }
        }
        
        echo "</table>";
    ?>
  </body>
</html>