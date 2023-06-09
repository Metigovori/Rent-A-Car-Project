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
            <th>Emri dhe Mbiemri</th>
            <th>Automobili</th>
            <th>Data e marrjes</th>
            <th>Data e kthimit</th>
            <th>Modifiko</th>
            <th>Fshiej</th>
        </tr>
        </thead>
        <tbody>
            <?php
           $rezervimet=merrRezervimet();
           while ($rezervimi=mysqli_fetch_assoc($rezervimet)) {
            $rid=$rezervimi['rezervimiid'];
            echo "<tr class='active-row'>";
            echo "<td>". $rezervimi['emrimbiemri'] ."</td>";
            echo "<td>". $rezervimi['emri'] ."</td>";
            echo "<td>". $rezervimi['dataemarrjes'] ."</td>";
            echo "<td>". $rezervimi['dataekthimit'] ."</td>";
            echo "<td><a href='shto_modifiko_rezervim.php?rid={$rid}'>
            <i class='fas fa-edit'></i></a></td>";
            echo "<td><a href='fshij_rezervim.php?rid={$rid}'>
            <i class='far fa-trash-alt'></i></a></td>";
            echo "</tr>";
           }
            
            ?>
        </tbody>
    </table>
    <a href="shto_rezervim.php" id="add_entity"><i class="fas fa-plus"></i> Shto Rezervim</a>
</section>

<?php
include "inc/footer.php";

?>
