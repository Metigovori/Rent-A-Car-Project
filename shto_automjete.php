<?php

include "inc/header.php";
if (isset($_POST['shtoautomjet'])) {
    shtoAutomjet(
        $_POST['emri'],
        $_POST['kategoriaid'],
        $_POST['nrregjistrimi'],
        $_POST['pershkrimi']
    );
}
if (isset($_GET['aid'])) {
    $automjetiid = $_GET['aid'];
    $automjeti = merrAutomjetetId($automjetiid);
    // print_r($rezervimi);
    if ($automjeti) {
        $automjeti = mysqli_fetch_assoc($automjeti);
        $autoid = $automjeti['automjetiid'];
        $autoemri = $automjeti['emri'];
        $kateid = $automjeti['kategoriaid'];
        $kateemri = $automjeti['kemri'];
        $nrregjistrimi=$automjeti['nrregjistrimi'];
        $pershkrimi=$automjeti['pershkrimi'];
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
        <input type="hidden" name="kategoriaid" value="<?php if(!empty($kateid)) echo $kateid ?>">
                <label for="kategorit">Kategorit</label> <br>

                <select id="kategoriaid" name="kategoriaid">
                    <?php
                    //echo $_GET['rid'];
                    if (isset($_GET['aid'])) {
                        echo "<option value='$kategoriaid'>$kateemri</option>";
                    } else {
                        echo "<option value=''>Zgjedh kategorin </option>";
                    }
                    $kategorit = merrKategorit();
                    while ($kategoria = mysqli_fetch_assoc($kategorit)) {
                        $kategoriaid = $kategoria['kategoriaid'];
                        $kategoriaemri = $kategoria['kemri'];
                        if (!empty($kateid)) {
                            if ($kateid != $kategoriaid) {
                                echo "<option value='$kategoriaid'> $kategoriaemri</option>";
                            }
                        } else {
                            echo "<option value='$kategoriaid'> $kategoriaemri</option>";
                        }
                        
                    }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
            <input type="hidden" name="automjetiid" value="<?php if(!empty($autoid)) echo $autoid ?>">
                <label for="">Emri i automjetit</label> <br>
                <input type="text" id="emri" name="emri"
                value="<?php if(!empty($autoemri)) echo $autoemri ?>">
             <br>
             <br>
            </div>
            <label for="">Numri i regjistrimi</label> <br>
                <input type="text" id="nrregjistrimi" name="nrregjistrimi"
                value="<?php if(!empty($nrregjistrimi)) echo $nrregjistrimi ?>">
             <br>
             <br>
       
            <label for="">Pershkrimit</label> <br>
                <input type="text" id="pershkrimi" name="pershkrimi"
                value="<?php if(!empty($pershkrimi)) echo $pershkrimi ?>">
         
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if (!isset($_GET['aid'])) {
                        echo "<input id='shtoautomjet' type='submit'
                            name='shtoautomjet' class='shtoModifiko' value='Shto Automjet'>";
                    } else {
                        echo "<input id='modifikoautomjet' type='submit'
                            name='modifikoautomjet' class='shtoModifiko' value='Modifiko Automjet'>";
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