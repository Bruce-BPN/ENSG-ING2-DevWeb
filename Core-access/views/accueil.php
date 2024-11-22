<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Jeu cartographique</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="bootstrap" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
  </head>
<body>
  <h1>Début du jeu</h1>
  <p>Viens à la découverte du secret de l'université Gustave Eiffel, qui contrairement aux apparences renferme des pouvoirs magiques.</p>
  <a href="/carte" title="Démarrer">Démarrer</a>
  <h2>Hall of fame</h2>
  <table>
    <tr>
      <th>Classement</th>
      <th>Score</th>
      <th>Nom</th>
    </tr>
    <?php
    foreach ($results as $scores) { ?>
        <tr>
          <td><?= $scores["id"] ?></td>
          <td><?= $scores["value"] ?></td>
          <td><?= $scores["pseudo"] ?></td>
        </tr>
    <?php } ?>
  </table>

</body>
</html>