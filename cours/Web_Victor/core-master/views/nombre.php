<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>JavaScript</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

  </head>
  <body>
    

    <div id="app">
      <h1 id="titre">JavaScript</h1>
      <form action="" @submit.prevent="hello">
          <textarea v-model="text"></textarea>
          <p v-if="change" style="color:red;">{{nombreRestants}}</p>
          <p v-else="change">{{nombreRestants}}</p>
          <button v-if="change" disabled>Tweet</button>
          <button v-else="change">Tweet</button>
          <input id="photo" type="checkbox" v-model="photo">
          <label for="photo" v-if="photo">✓ Photo ajoutée</label>
          <label for="photo" v-else="photo">Pas de photo</label>
      </form>
      <ul>
        <li v-for="item in tweets">
          {{item[0]}}
          <img v-bind:src="item[1]" alt="">
        </li>
      </ul>

      <!-- <ul>
        <li v-for="item in tweets">
          {{ item[0] }}
          <img v-bind:src="item[1]" alt="">
        </li>
      </ul> -->
    </div>
    
    

    <script src="../assets/javascript.js"></script>
  </body>
</html>