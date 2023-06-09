<?php
include "inc/header.php";

?>

<section class="list-entity container">
    <div class="image">
        <img src="img/car8.jpg" alt="">
    </div>
    <table class="styled-table">
        <thead>
        <tr>
            <th>Kategorit</th>
            <th>Kostoja</th>
            <th>Përshkrimi</th>
            <th>Edito</th>
            <th>Fshij</th>
        </tr>
        </thead>
        <tbody>
            <?php
           $kategorit=merrKategorit();
           while ($kategoria=mysqli_fetch_assoc($kategorit)) {
            $rid=$kategoria['kategoriaid'];
            echo "<tr class='active-row'>";
            echo "<td>". $kategoria['kemri'] ."</td>";
            echo "<td>". $kategoria['kostoja'] ."</td>";
            echo "<td>". $kategoria['pershkrimi'] ."</td>";
            echo "<td><a href='shto_modifiko_kategori.php?rid={$rid}'>
            <i class='fas fa-edit'></i></a></td>";
            echo "<td><a href='fshij_kategori.php?rid={$rid}'>
            <i class='far fa-trash-alt'></i></a></td>";
            echo "</tr>";
           }
            
            ?>
        </tbody>
    </table>
    <a href="shto_kategori.php" id="add_entity"><i class="fas fa-plus"></i> Shto Kategori</a>
</section>

<?php
include "inc/footer.php";

?>