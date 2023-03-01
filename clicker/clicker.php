<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Clicker Game</title>
  </head>
  <body>
    <?php include('./header.php') ?>
    <div class="padding">
    <div class="container">
    <div class="score">
    <h1 id="score">0</h1>
    <button id="clicker" href="javascript:void(0);">Click me!</button>
    </div>
    </div>
    </div>

    <hr>
    <div class="padding">
    <div class="shop" id="shop">
      <h1>Boutique</h1>
      <button id="buyAutoClicker">Buy Autoclicker (costs 10)</button>
      <button id="buyClickBonus">Buy Click Bonus (costs 50)</button>
    </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>




