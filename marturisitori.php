<?php include 'header.php';?>

<div class="container m-3">
    

<?php
 
$sql = "SELECT * FROM jsn_marturisitori WHERE mDataNastere IS NOT NULL ORDER BY mDataNastere ASC LIMIT 1;";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $an_start = date('Y', strtotime($row['mDataNastere']));
}

 
$sql = "SELECT * FROM jsn_marturisitori WHERE mDataNastere IS NOT NULL AND mDataAdormire IS NOT NULL ORDER BY mDataNastere ASC;";
$result = $conn->query($sql);
$nr_persoane = mysqli_num_rows ( $result );

echo '<h1>Cronologie mărturisitori (' . $nr_persoane . ' de persoane)</h1>';

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