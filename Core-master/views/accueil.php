<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>ENSGéoGame</title>
    <link rel="icon" href="./assets/images/images.jfif">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/accueil.css">
    <link rel="bootstrap" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    
  </head>
  <body>
    <!-- <h1>ENSGéoGame</h1> -->
    <div class='TitleBox'>ENSGéoGame</div>
    <p>Un jeu créé par Vivien Boucher et Bruce Pourny, étudiants en ING2 à l'ENSG.</p>
    <?php if (!empty($pseudo)) { ?>
        <!-- Si le pseudo est défini -->
        <p>Bienvenue, <strong><?= htmlspecialchars($pseudo) ?></strong> !</p>
    <?php } else { ?>
        <!-- Si le pseudo n'est pas encore défini -->
        <form action="/api/set_pseudo" method="POST">
            <label for="pseudo">Entrez votre pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required>
            <button type="submit">Enregistrer</button>
        </form>
    <?php } ?>

    <h2>Début du jeu</h2>
    <p>Viens à la découverte du secret de l'université Gustave Eiffel, qui contrairement aux apparences renferme des pouvoirs magiques.</p>
    <a href="/carte" title="Démarrer">Démarrer</a>

    <div class='HFbox'>Hall of Fame</div>
    <table>
      <tr>
        <th></th>
        <th id='tableIntitule'>Nom</th>
        <th>Score</th>
        
      </tr>
      <?php 
      $rank = 1;
      foreach ($results as $scores) { ?>
          <tr>
            <td><?= $rank ?></td> <!-- Affiche le rang -->
            <td id='tableNom'><?= htmlspecialchars($scores["pseudo"]) ?></td>
            <td><?= $scores["value"] ?></td>
          </tr>
      <?php 
          $rank++;
      } ?>
    </table>
  </body>
</html>