<?php
include "inc/header.php";

?>

<section class="list-entity container">
    <div class="image">
        <img src="img/clients.jpg" alt="">
    </div>
    <div class="filter">
        <form action="" method="post">
            <input type="radio" name="filter" id="te_gjithe" checked value="tegjitha">
            <label for="te_gjithe">Te gjith | </label>
            <input type="radio" name="filter" value="1">
            <label for="te_gjithe">Staf | </label>
            <input type="radio" name="filter" value="0">
            <label for="te_gjithe">Administratoret</label>
            <input type="submit" name="kerko" class="btn-filtro" value="filtro">
        </form>
    </div>
    <table class="styled-table">
        <thead>
        <tr>
            <th>Emri</th>
            <th>Mbiemri</th>
            <th>Email</th>
            <th>Nr telefonit</th>
            <th>Modifiko</th>
            <th>Fshiej</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        if(isset($_POST['kerko'])) {
            $perdoruesi = $_POST['filter'];
            filtroPerdorues($perdoruesi);
        } else {
            filtroPerdorues("te_gjithe");
        }
        ?>
        
    </table>
    <a href="shto_modifiko_perdorues.php" id="add_entity"><i class="fas fa-plus"></i> Shto Perdorues</a>
</section>


<?php
include "inc/footer.php";

?>