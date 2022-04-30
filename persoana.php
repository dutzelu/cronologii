<?php include 'header.php';


if (isset($_GET['id'])) {
    $id_martir = $_GET['id'];
    $sql = "SELECT * FROM jsn_marturisitori WHERE mID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_martir);
    $result = $stmt->execute();
    $result = $stmt->get_result();
          
    while ($row = mysqli_fetch_assoc($result)) { 
        $prefix = $row['mPrefix'];
        $nume = $row['mNume'];
        $prenume = $row['mPrenume'];
        $data_nasterii = "'" . $row['mDataNastere'] . "'";
        $data_mortii = "'" . $row['mDataAdormire'] . "'";
        $anul_nasterii = date('Y', strtotime($row['mDataNastere']));
        $anul_mortii = date('Y', strtotime($row['mDataAdormire']));
        $an_start = 1860;
        $varsta = $anul_mortii - $anul_nasterii;
        $lungime_linie = $varsta * 8;
        $margine = ($anul_nasterii - $an_start) * 8;
    }
}

?>


<div class="container m-3">

    <h1>Cronologie mărturisitori</h1>

    <div class="wrapper">

        <div class="viata" style="width:<?php echo $lungime_linie;?>px; margin-left:<?php echo $margine;?>px;">
        
                <span class="nastere"> <?php echo $anul_nasterii;?> </span>
                <span class="nume"> <?php echo $prefix . ' ' . $prenume . ' ' . $nume . ' (' . $varsta . ' ani) ' . "</span>" . '<span class="moarte">' . $anul_mortii;?></span>
        </div>

    </div>




    <?php

    $query = "
        SELECT * FROM jsn_marturisitori A 
        WHERE (A.mDataAdormire >=  $data_nasterii AND mDataNastere <= $data_mortii) AND (mDataNastere IS NOT NULL AND mDataAdormire IS NOT NULL) ORDER BY mDataNastere ASC ;
    
    ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $nr_persoane = mysqli_num_rows ( $result );
 
    echo '<p class="m-3">Este contemporan cu: ' . $nr_persoane . ' de persoane</p>';

 
    while($row = $result->fetch_assoc()) {
        
        $id_martir = $row['mID'];
        $prefix = $row['mPrefix'];
        $nume = $row['mNume'];
        $prenume = $row['mPrenume'];
        $anul_nasterii = date('Y', strtotime($row['mDataNastere']));
        $anul_mortii = date('Y', strtotime($row['mDataAdormire']));
        $varsta = $anul_mortii - $anul_nasterii;
        $lungime_linie = $varsta * 8;
        $margine = ($anul_nasterii - $an_start) * 8;
    
        echo '<div class="wrapper">';
    
        echo '<a href="persoana.php?id=' . $id_martir . '"><div class="viata" style="width:' . $lungime_linie . 'px; margin-left:' . $margine . 'px;">
    
             
        
                <span class="nastere">' . $anul_nasterii . '</span><span class="nume">' . $prefix . ' ' . $prenume . ' ' . $nume . ' (' . $varsta . ' ani) ' . "</span>" . '<span class="moarte">' . $anul_mortii . 
            
            '</span></div></a>';
    
        echo '</div>'; 
    } 
    ?>



</div>

</body>
</html>