<?php include 'header.php';?>

<div class="container m-3">
    

<?php
 
$sql = "SELECT * FROM personalitati ORDER BY anul_nasterii ASC LIMIT 1;";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $an_start = $row['anul_nasterii'];
}

 
$sql = "SELECT * FROM personalitati ORDER BY anul_nasterii ASC;";
$result = $conn->query($sql);
$nr_persoane = mysqli_num_rows ( $result );

echo '<h1>Cronologie mărturisitori (' . $nr_persoane . ' de persoane)</h1>';

while($row = $result->fetch_assoc()) {
    
    $id_martir = $row['id'];
    $nume = $row['nume'];
    $prenume = $row['prenume'];
    $anul_nasterii =  $row['anul_nasterii'];
    $anul_mortii = $row['anul_mortii'];
    $varsta = $anul_mortii - $anul_nasterii;
    $lungime_linie = $varsta * 8;
    $margine = ($anul_nasterii - $an_start) * 8;

    echo '<div class="wrapper">';

    echo '<a href="persoana.php?id=' . $id_martir . '"><div class="viata" style="width:' . $lungime_linie . 'px; margin-left:' . $margine . 'px;">

         
    
            <span class="nastere">' . $anul_nasterii . '</span><span class="nume">' . $prenume . ' ' . $nume . ' (' . $varsta . ' ani) ' . "</span>" . '<span class="moarte">' . $anul_mortii . 
        
        '</span></div></a>';

    echo '</div>'; 
} 


?>
</div>

</body>
</html>