<?php
include "inc/header.php";
?>


<section class="list-entity container">
    <div class="image">
        <img src="img/car7.jpg" alt="">
    </div>
   
    <table class="styled-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Kategoria</th>
            <th>Numri i regjistrimit</th>
            <th>Pershkrimi</th>
            <th>Kostoja</th>
            <th>Modifiko</th>
            <th>Fshiej</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $automjetet=merrAutomjetet();
            while ($automjeti=mysqli_fetch_assoc($automjetet)) {
                $automjetiid=$automjeti['automjetiid'];
                echo "<tr class='active-row'>";
                echo "<td>".$automjeti['emri'] . "</td>";
                echo "<td>".$automjeti['kemri'] . "</td>";
                echo "<td>".$automjeti['nrregjistrimi'] . "</td>";
                echo "<td>".$automjeti['pershkrimi'] . "</td>";
                echo "<td>".$automjeti['kostoja'] . "</td>";
                echo "<td><a href='shto_modifiko_automjet.php?aid=$automjetiid'>
                <i class='fas fa-edit'></i></a></td>";
                echo "<td><a href='fshij_automjet.php?aid=$automjetiid'>
                <i class='far fa-trash-alt'></i></a></td>";
                echo "</tr>";
            }
        ?>
        
        </tbody>
    </table>
    <a href="shto_automjete.php" id="add_entity"><i class="fas fa-plus"></i> Shto Automjet</a>
</section>

<?php
include "inc/footer.php";

?>
