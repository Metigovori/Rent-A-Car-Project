<?php

include "inc/header.php";

if (isset($_GET['rid'])) {
    $kategoriaid = $_GET['rid'];
    $kategoria = merrKategoriId($kategoriaid);
    // print_r($rezervimi);
    if ($kategoria) {
        $kategoria = mysqli_fetch_assoc($kategoria);
        $kateid = $kategoria['kategoriaid'];
        $kateemri = $kategoria['kemri'];
        $katekostoja=$kategoria['kostoja'];
        $kategoriapershkrimi=$kategoria['pershkrimi'];
   }
}
if (isset($_POST['modifikokategori'])) {
    modifikoKategori(
        $_POST['kategoriaid'],
        $_POST['kemri'],
        $_POST['kostoja'],
        $_POST['pershkrimi']
    );
}
?>

<section class="section-shto-modifiko container">
    <div class="image">
        <img src="img/car9.jpg" alt="" >
    </div>
    <div class="forma">
        <br>
        <br>
        <h1>Forma per shtimin/editimin e Kategorive</h1>
        <br>
        <form method="POST">
            <div class="inputAndLabels">
                <input type="hidden" name="kategoriaid" value="<?php if(!empty($kateid)) echo $kateid ?>"
                <label for="kategorit">Kategorit</label> <br>

                <select id="kemri" name="kemri">
                    <?php
                    //echo $_GET['rid'];
                    if (isset($_GET['rid'])) {
                        echo "<option value='$kateemri'>$kateemri</option>";
                    } else {
                        echo "<option value=''>Zgjedh kategorin </option>";
                    }
                    $kategorit = merrKategorit();
                    while ($kategoria = mysqli_fetch_assoc($kategorit)) {
                        $kategoriaid = $kategoria['kategoriaid'];
                        $kategoriaemri = $kategoria['kemri'];
                        if (!empty($kateid)) {
                            if ($kateid != $kategoriaid) {
                                echo "<option value='$kategoriaemri'> $kategoriaemri</option>";
                            }
                        } else {
                            echo "<option value='$kategoriaemri'> $kategoriaemri</option>";
                        }
                        
                    }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="kostoja">Kostoja</label> <br>
                <select id="kostoja" name="kostoja">
                    <?php
                    //echo $_GET['rid'];
                    if (isset($_GET['rid'])) {
                        echo "<option value='$kategoriaid'>$katekostoja</option>";
                    } else {
                        echo "<option value=''>Zgjedh Kategorin </option>";
                    }
                    $kategorit = merrKategorit();
                    while ($kategoria = mysqli_fetch_assoc($kategorit)) {
                        $kategoriaid = $kategoria['kategoriaid'];
                        $kategoriakostoja = $kategoria['kostoja'];
                        if (!empty($kategoriaid)) {
                            if ($kategoriid != $kategoriaid) {
                                echo "<option value='$kategoriakostoja'> $kategoriakostoja</option>";
                            }
                        } else {
                            echo "<option value='$kategoriakostoja'> $kategoriakostoja</option>";
                        }
                    }
                    ?>
                </select>
            </div>
                <label for="">Pershkrimit</label> <br>
                <input type="text" id="pershkrimi" name="pershkrimi"
                value="<?php if(!empty($pershkrimi)) echo $pershkrimi ?>">
         
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if (!isset($_GET['rid'])) {
                        echo "<input id='shtokategori' type='submit'
                            name='shtokategori' class='shtoModifiko' value='Shto Kategori'>";
                    } else {
                        echo "<input id='modifikokategori' type='submit'
                            name='modifikokategori' class='shtoModifiko' value='Modifiko Kategori'>";
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