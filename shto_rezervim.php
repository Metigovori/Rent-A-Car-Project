<?php

include "inc/header.php";
if (isset($_POST['shtorezervim'])) {
    shtoRezervim(
        $_POST['klientiid'],
        $_POST['automjetiid'],
        $_POST['datamarrjes'],
        $_POST['datakthimit']
    );
}
if (isset($_GET['rid'])) {
    $rezervimiid = $_GET['rid'];
    $rezervimi = merrRezervimId($rezervimiid);

    // print_r($rezervimi);
    if ($rezervimi) {
        $rezervimi = mysqli_fetch_assoc($rezervimi);
        $autoid = $rezervimi['automjetiid'];
        $autoemri = $rezervimi['emri'];
        $klintid = $rezervimi['klientiid'];
        $klintemrimbiemri = $rezervimi['emrimbiemri'];
        $dataemarrjes=$rezervimi['dataemarrjes'];
        $dataemarrjes=date("Y-m-d",strtotime($dataemarrjes));
        $dataekthimit=$rezervimi['dataekthimit'];
        $dataekthimit=date("Y-m-d",strtotime($dataekthimit));
   }
}

?>

<section class="section-shto-modifiko container">
    <div class="image">
        <img src="img/car9.jpg" alt="" >
    </div>
    <div class="forma">
        <br>
        <br>
        <h1>Forma per shtimin/editimin e Rezervimit</h1>
        <br>
        <form method="POST">
            <div class="inputAndLabels">
                <input type="hidden" name="rezervimiid" value="<?php if(!empty($rezervimiid)) echo $rezervimiid ?>">
                <input type="hidden" name="klientiid" value="<?php if(!empty($klintid)) echo $klintid ?>">
                <label for="klienti">Klienti</label> <br>

                <select  id="klientiid" name="klientiid">
                    <?php
                    //echo $_GET['rid'];
                    if (isset($_GET['rid'])) {
                        echo "<option value='$klintid'>$klintemrimbiemri</option>";
                    } else {
                        echo "<option value=''>Zgjedh klientin </option>";
                    }
                    $klientet = merrKlientet();
                    while ($klienti = mysqli_fetch_assoc($klientet)) {
                        $klientiid = $klienti['klientiid'];
                        $klientiemrimbiemri = $klienti['emri'] . " " . $klienti['mbiemri'];
                        if (!empty($klintid)) {
                            if ($klintid != $klientiid) {
                                echo "<option value='$klientiid'> $klientiemrimbiemri</option>";
                            }
                        } else {
                            echo "<option value='$klientiid'> $klientiemrimbiemri</option>";
                        }
                        
                    }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
            <input type="hidden" name="automjetiid" value="<?php if(!empty($autoid)) echo $autoid ?>">
                <label for="automjeti">Automjeti</label> <br>
                <select id="automjetiid" name="automjetiid">
                    <?php
                    //echo $_GET['rid'];
                    if (isset($_GET['rid'])) {
                        echo "<option value='$autoid'>$autoemri</option>";
                    } else {
                        echo "<option value=''>Zgjedh automjetin </option>";
                    }
                    $automjetet = merrAutomjetet();
                    while ($automjeti = mysqli_fetch_assoc($automjetet)) {
                        $automjetiid = $automjeti['automjetiid'];
                        $automjetiemri = $automjeti['emri'];
                        if (!empty($autoid)) {
                            if ($autoid != $automjetiid) {
                                echo "<option value='$automjetiid'> $automjetiemri</option>";
                            }
                        } else {
                            echo "<option value='$automjetiid'> $automjetiemri</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="datamarrjes">Data e marrjes</label> <br>
                <input  type="date" id="datamarrjes" name="datamarrjes"
                value="<?php if(!empty($dataemarrjes)) echo $dataemarrjes ?>">
            </div>
            <div class="inputAndLabels">
                <label for="datakthimit">Data e kthimit</label> <br>
                <input  type="date" id="datakthimit" name="datakthimit"
                value="<?php if(!empty($dataekthimit)) echo $dataekthimit ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if (!isset($_GET['rid'])) {
                        echo "<input id='shtorezervim' type='submit'
                            name='shtorezervim' class='shtoModifiko' value='Shto Rezervim'>";
                    } else {
                        echo "<input id='fshijrezervim' type='submit'
                            name='fshijrezervim' class='shtoModifiko' value='Fshij Rezervim'>";
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</section>

<footer class="main-footer">
    <div class="main-footer-content container">
        <div>
            <p>&copy; Rent a Car 2021. All rights reserved.</p>
        </div>
        <div class="social-media">
            <div>
                <a href="#"><i class="fab fa-facebook"></i></a>
            </div>
            <div>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <div>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>