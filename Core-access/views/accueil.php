<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Jeu cartographique</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="bootstrap" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
  </head>
<body>
  <h1>Jeu cartographique</h1>
  
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
  <a href=/test_score>test_score</a>

  <h2>Début du jeu</h2>
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
    $rank = 1;
    foreach ($results as $scores) { ?>
        <tr>
          <td><?= $rank ?></td> <!-- Affiche le rang -->
          <td><?= $scores["value"] ?></td>
          <td><?= htmlspecialchars($scores["pseudo"]) ?></td>
        </tr>
    <?php 
        $rank++;
    } ?>
  </table>
</body>
</html>