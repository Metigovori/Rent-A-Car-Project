<?php
session_start();
$dbconn;
dbConnection();
function dbConnection(){
    global $dbconn;
    $dbconn=mysqli_connect("localhost",'root','','rentacar');
    if(!$dbconn){
        die("Deshtoi lidhja me DB".mysqli_error($dbconn));
    }
}

function login($email,$fjalekalimi){
    global $dbconn;
    $sql="SELECT perdoruesiid, emri, mbiemri, email, telefoni,role FROM perdoruesit";
    $sql.=" WHERE email='$email' AND fjalekalimi='$fjalekalimi'";
    $res=mysqli_query($dbconn,$sql);
    
    if(mysqli_num_rows($res)==1){
        $user_data=mysqli_fetch_assoc($res);
        $user=array();
        $user['perdoruesiid']=$user_data['perdoruesiid'];
        $user['emrimbiemri']=$user_data['emri']. " " . $user_data['mbiemri'];
        $user['role']=$user_data['role'];
        $_SESSION['user']=$user;
        header("Location: index.php");
    }else{
        echo "Nuk ka perdorues me keto shenime";
    }
}
/** Perdoruesit */
function merrPerdoruesit(){
    global $dbconn;
    $sql="SELECT perdoruesiid, emri, mbiemri, email, telefoni FROM perdoruesit";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i perdoruesve " . mysqli_error($dbconn);
    }
}
function merrPerdoruesId($perdoruesiid){
    global $dbconn;
    $sql="SELECT perdoruesiid, emri, mbiemri, email, telefoni,nrpersonal,role,fjalekalimi FROM perdoruesit";
    $sql.=" WHERE perdoruesiid=$perdoruesiid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return mysqli_fetch_assoc($res);
    }else{
        echo "Nuk po arrihet listimi i perdoruesve " . mysqli_error($dbconn);
    }
}
function shtoPerdorues($emri,$mbiemri,$role,$nrpersonal,$telefoni,$email,$fjalekalimi){
    global $dbconn;
    $sql="INSERT INTO perdoruesit(emri, mbiemri, email, telefoni,role,nrpersonal,fjalekalimi)";
    $sql.=" VALUES ('$emri','$mbiemri','$email','$telefoni',$role,$nrpersonal,'$fjalekalimi')";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['mesazhi']="Perdoruesi u regjistrua me sukses";
        header("Location: perdoruesit.php");
    }else{
        echo "Nuk po arrihet shtimi i perdoruesve " . mysqli_error($dbconn);
    }
}
function modifikoPerdorues($perdoruesiid,$emri,$mbiemri,$role,$nrpersonal,$telefoni,$email,$fjalekalimi){
    global $dbconn;
    $sql="UPDATE perdoruesit SET emri='$emri', mbiemri='$mbiemri', email='$email'";
    $sql.=", telefoni='$telefoni',role=$role,nrpersonal=$nrpersonal,fjalekalimi='$fjalekalimi'";
    $sql.=" WHERE perdoruesiid=$perdoruesiid ";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['mesazhi']="Perdoruesi u modifkua me sukses";
        header("Location: perdoruesit.php");
    }else{
        echo "Nuk po arrihet modifikimi i perdoruesve " . mysqli_error($dbconn);
    }
} 

function fshijPerdorues($perdoruesiid){
    global $dbconn;
    $sql="DELETE FROM perdoruesit WHERE perdoruesiid=$perdoruesiid ";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        $_SESSION['mesazhi']="Perdoruesi u fshij me sukses";
        header("Location: perdoruesit.php");
    }else{
        echo "Nuk po arrihet fshirja i perdoruesve " . mysqli_error($dbconn);
    }
}

function filtroPerdorues($perdoruesi) {
    global $dbconn;
    $sql = "SELECT * FROM perdoruesit";
     if ($perdoruesi == "1") {
        $sql .= " WHERE role = 0";
    } else if ($perdoruesi == "0") {
        $sql .= " WHERE role = 1";
    }
    $result = mysqli_query($dbconn, $sql);
    if(mysqli_num_rows($result) > 0) {
    while ($perdoruesi = mysqli_fetch_assoc($result)) {
        $pid = $perdoruesi['perdoruesiid'];
        echo "<tr class='active-row'>";
        echo "<td>". $perdoruesi['emri'] . "</td>";
        echo "<td>". $perdoruesi['mbiemri'] . "</td>";
        echo "<td>". $perdoruesi['email'] . "</td>";
        echo "<td>". $perdoruesi['telefoni'] . "</td>";
        echo "<td><a href='shto_modifiko_perdorues.php?pid={$pid}'>
        <i class='fas fa-edit'></i></a></td>";
        echo "<td><a href='fshij_perdorues.php?pid={$pid}'>
        <i class='far fa-trash-alt'></i></a></td>";
        echo "</tr>";
    }
  }else{
    echo "Nuk u gjet asnje rezultat";
  }
}

/** Funksionet per rezervimet */
function merrRezervimet(){
    global $dbconn;
    $sql="SELECT r.rezervimiid, a.emri, CONCAT(k.emri,' ', k.mbiemri)as emrimbiemri, r.dataemarrjes, r.dataekthimit";
    $sql.=" FROM rezervimet r INNER JOIN automjetet a ON r.automjetiid=a.automjetiid INNER JOIN klientet k  ON r.klientiid=k.klientiid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i perdoruesve " . mysqli_error($dbconn);
    }
}

function merrRezervimId($rezervimiid){
    global $dbconn;
    $sql="SELECT r.rezervimiid,a.automjetiid,k.klientiid, a.emri, CONCAT(k.emri,' ', k.mbiemri)as emrimbiemri, r.dataemarrjes, r.dataekthimit";
    $sql.=" FROM rezervimet r INNER JOIN automjetet a ON r.automjetiid=a.automjetiid INNER JOIN klientet k  ON r.klientiid=k.klientiid WHERE r.rezervimiid = $rezervimiid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i perdoruesve " . mysqli_error($dbconn);
    }
}


function modifikoRezervim( $rezervimiid, $klienti, $automjeti, $dataemarrjes, $dataekthimit){
    global $dbconn;
    $sql = "UPDATE rezervimet r
            INNER JOIN klientet k ON r.klientiid=k.klientiid
            INNER JOIN automjetet a ON r.automjetiid=a.automjetiid 
            SET r.dataemarrjes='$dataemarrjes', 
                r.dataekthimit='$dataekthimit', 
                k.klientiid=$klienti, 
                a.emri='$automjeti' 
            WHERE r.rezervimiid=$rezervimiid";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "Rezervimi u modifikua me sukses";
        header("Location: rezervimet.php");
    } else {
        echo "Nuk po arrihet modifikimi i rezervimit " . mysqli_error($dbconn);
    }
}

function shtoRezervim($klientiid, $automjetiid, $dataemarrjes, $dataekthimit) {
    global $dbconn;

    // Check if the provided klientiid and automjetiid exist in their respective tables
    $check_sqlK = "SELECT klientiid FROM klientet WHERE klientiid='$klientiid'";
    $check_sqlA = "SELECT automjetiid FROM automjetet WHERE automjetiid='$automjetiid'";
    $check_resK = mysqli_query($dbconn, $check_sqlK);
    $check_resA = mysqli_query($dbconn, $check_sqlA);

    if (mysqli_num_rows($check_resK) > 0 && mysqli_num_rows($check_resA) > 0) {
        // The provided klientiid and automjetiid exist, so we can proceed with the reservation

        // Set the perdoruesiid to 0 (since it's not provided in the function parameters)
        $perdoruesiid = 0;

        // Insert the reservation into the "rezervimet" table
        $sql = "INSERT INTO rezervimet (klientiid, automjetiid, perdoruesiid, dataemarrjes, dataekthimit)
                VALUES ('$klientiid', '$automjetiid', '$perdoruesiid', '$dataemarrjes', '$dataekthimit')";
        $res = mysqli_query($dbconn, $sql);

        if ($res) {
            $_SESSION['mesazhi'] = "Rezervimi u shtua me sukses";
            header("Location: rezervimet.php");
        } else {
            echo "Nuk po arrihet shtimi i rezervimit: " . mysqli_error($dbconn);
        } 
    } else {
        // Reject the reservation since the provided klientiid or automjetiid does not exist
        echo "Klienti ose automjeti nuk ekziston";
    }
}





function fshijRezervim($rezervimiid){
    global $dbconn;
    $sql = "DELETE  FROM rezervimet WHERE rezervimiid=$rezervimiid";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "Rezervimi u fshij me sukses";
        header("Location: rezervimet.php");
    } else {
        echo "Nuk po arrihet fshirja e rezervimit " . mysqli_error($dbconn);
    }
}


// Funksionet per automjetet //

function merrAutomjetet(){
    global $dbconn;
    $sql="SELECT a.automjetiid,a.emri, k.kemri, a.nrregjistrimi,a.pershkrimi, k.kostoja  FROM automjetet a ";
    $sql .=" INNER JOIN kategorit k ON a.kategoriaid=k.kategoriaid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i automjeteve " . mysqli_error($dbconn);
    }
}

function merrAutomjetetId($autoid){
    global $dbconn;
    $sql="SELECT a.automjetiid,a.emri,k.kategoriaid, k.kemri, a.nrregjistrimi,a.pershkrimi, k.kostoja  FROM automjetet a ";
    $sql .=" INNER JOIN kategorit k ON a.kategoriaid=k.kategoriaid WHERE a.automjetiid=$autoid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i automjeteve " . mysqli_error($dbconn);
    }
}

function modifikoAutomjet($automjetiid,$emri,$kategoriaid,$kemri, $nrregjistrimi, $pershkrimi){
    global $dbconn;
    $sql = "UPDATE automjetet a INNER JOIN kategorit k ON a.kategoriaid=k.kategoriaid SET a.emri='$emri', k.kategoriaid=$kategoriaid,k.kemri='$kemri', a.nrregjistrimi='$nrregjistrimi', a.pershkrimi='$pershkrimi' WHERE a.automjetiid=$automjetiid";

    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "automjeti u modifikua me sukses";
        header("Location: automjetet.php");
    } else {
        echo "Nuk po arrihet modifikimi i automjetit " . mysqli_error($dbconn);
    }
}

function fshijAutomjet($automjetiid){
    global $dbconn;
    $sql = "DELETE  FROM automjetet WHERE automjetiid=$automjetiid";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "automjeti u fshij me sukses";
        header("Location: automjetet.php");
    } else {
        echo "Nuk po arrihet fshirja e automjetit " . mysqli_error($dbconn);
    }
}

function shtoAutomjet($emri, $kategoriaid, $nrregjistrimi, $pershkrimi) {
    global $dbconn;
    
    // Check if the new kategoriaid exists in the primary key table
    $check_sql = "SELECT kategoriaid FROM kategorit WHERE kategoriaid = '$kategoriaid'";
    $check_res = mysqli_query($dbconn, $check_sql);
    if (mysqli_num_rows($check_res) > 0) {
        // Update the kategoriaid value in the automjetet table
        $sql = "INSERT INTO automjetet(kategoriaid,emri,nrregjistrimi,pershkrimi) VALUES  ('$kategoriaid','$emri','$nrregjistrimi','$pershkrimi')";
        $res = mysqli_query($dbconn, $sql);
        if($res) {
            $_SESSION['mesazhi'] = "automjeti u modifikua me sukses";
            header("Location: automjetet.php");
        } else {
            echo "Nuk po arrihet modifikimi i automjetit " . mysqli_error($dbconn);
        }
    } else {
        // Reject the update or insert the new kategoriaid value into the primary key table before updating the automjetet table
        echo "Kategoria e re nuk ekziston";
    }
}




// Funksionet per klientet //

function merrKlientet(){
    global $dbconn;
    $sql="SELECT klientiid, emri, mbiemri, email, telefoni FROM klientet";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i klienteve " . mysqli_error($dbconn);
    }
}

// Funksionet per kategorit //

function merrKategorit(){
    global $dbconn;
    $sql="SELECT kategoriaid, kemri, kostoja, pershkrimi FROM kategorit";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i kategorive " . mysqli_error($dbconn);
    }
}

function merrKategoriId($kategoriaid){
    global $dbconn;
    $sql="SELECT kategoriaid,kemri,kostoja,pershkrimi FROM kategorit";
    $sql.=" WHERE kategoriaid = $kategoriaid";
    $res=mysqli_query($dbconn,$sql);
    if($res){
        return $res;
    }else{
        echo "Nuk po arrihet listimi i kategorive " . mysqli_error($dbconn);
    }
}

function modifikoKategori( $kategoriaid, $kemri, $kostoja, $pershkrimi){
    global $dbconn;
    $sql = "UPDATE kategorit SET kemri='$kemri', kostoja='$kostoja', pershkrimi='$pershkrimi' WHERE kategoriaid=$kategoriaid";

    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "Kategoria u modifikua me sukses";
        header("Location: kategorit.php");
    } else {
        echo "Nuk po arrihet modifikimi i kategoris " . mysqli_error($dbconn);
    }
}

function fshijKategori($kategoriaid){
    global $dbconn;
    $sql = "DELETE  FROM kategorit WHERE kategoriaid=$kategoriaid";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "Kategoria u fshij me sukses";
        header("Location: kategorit.php");
    } else {
        echo "Nuk po arrihet fshirja e Kategoris " . mysqli_error($dbconn);
    }
}

function shtoKategori(  $kemri, $kostoja, $pershkrimi){
    global $dbconn;
    $sql = "INSERT INTO kategorit(kemri,kostoja,pershkrimi) VALUES ('$kemri', $kostoja, '$pershkrimi') ";
    $res = mysqli_query($dbconn, $sql);
    if($res){
        $_SESSION['mesazhi'] = "Kategoria u modifikua me sukses";
        header("Location: kategorit.php");
    } else {
        echo "Nuk po arrihet modifikimi i kategoris " . mysqli_error($dbconn);
    }
}



?>