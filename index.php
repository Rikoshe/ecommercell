<!-- Template loading -->
<?php
require "template/nav.php";
require "template/header.php";
?>

<!-- Main Content -->
<main class="container my-5">
<h2>Home</h2>
<hr>         
<?php
            
?>

<!-- pour accéder à la bdd -->
<?php
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');
}

catch(Exception $e)
{
  die('Erreur = ' .$e->getMessage());
} 
?>

<!--  get access to products database -->

<?php
$req = $bdd->query('SELECT id, name, price, stock, description, category, made_in FROM products ORDER BY category');
while($donnees = $req->fetch())
{
// check availability in stock
if ($donnees['stock'] == 1)
{
?>
  <?php $donnees['stock'] = ' Available!';?>
<?php
}
else 
{
?>
 <?php $donnees['stock'] = ' Sorry! this product is not in stock anymore';
}
?>

<!-- check availability in stock -->
<div class="container d-flex"> 
  <div class= "col-sm item-box bgColor-BleuNuit m-3">
    <a href="single.php"> 
      <h3 class="color-BleuClair">
        <?php 
        echo ($donnees['name']);
        ?>
        <em>from category <?php echo $donnees['category'];?> / Price : <?php echo $donnees['price'];?>$</em>
      </h3>
    </a>

    <a href="single.php"><div class="picture-box"></div></a>

    <br/>
    <p class="color-BleuCyan">
      <?php
      echo nl2br(htmlspecialchars($donnees ['description']));
      ?>
    </p>
    <br/>
    <em class="color-BleuClair mb-3">Availability:<?php echo $donnees['stock']; ?></em>
  </div>
</div>

<!-- Close query -->
<?php
}
$req->closeCursor();
?>
</main>

<!-- Footer loading -->
<?php
    require "template/footer.php";
?>
