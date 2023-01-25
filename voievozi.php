<?php include 'header.php';

    $sql = "SELECT * FROM voievozi ORDER BY domnie_start DESC;";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    $result = $stmt->get_result();


    $formatter_zi_luna =new IntlDateFormatter(
        "ro_RO", IntlDateFormatter::SHORT, 
        IntlDateFormatter::NONE, 
        'Europe/Bucharest', 
        IntlDateFormatter::GREGORIAN,
        'dd MMM');

    $formatter_luna_zi =new IntlDateFormatter(
        "ro_RO", IntlDateFormatter::SHORT, 
        IntlDateFormatter::NONE, 
        'Europe/Bucharest', 
        IntlDateFormatter::GREGORIAN,
        'MMM dd');
   

    $formatter_an =new IntlDateFormatter(
        "ro_RO", IntlDateFormatter::SHORT, 
        IntlDateFormatter::NONE, 
        'Europe/Bucharest', 
        IntlDateFormatter::GREGORIAN,
        'Y');
   

    $formatter =new IntlDateFormatter(
        "ro_RO", IntlDateFormatter::SHORT, 
        IntlDateFormatter::NONE, 
        'Europe/Bucharest', 
        IntlDateFormatter::GREGORIAN,
        'd MMMM Y');
   
    

?>


 
<section class="presedinti  pb-100" id="experience">

    <div class="container">

        <div class="row">
            <div class="mx-auto text-center">
                <div class="section-title">
                    <h4>Lista conducătorilor de stat ai României (1859 - prezent)</h4>
                    <p><img height="200px" src="https://www.presidency.ro/files/userfiles/Stema_Oficiala_a_Romaniei_din_2016.png" /></p>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12">
                <ul class="timeline-list">
                    <!-- Single Experience -->
            <?php
                    while ($row = mysqli_fetch_assoc($result)) { 
                    $nume = $row['nume'];
                    $domnie_start = new DateTime($row['domnie_start']);
                    $domnie_final = new DateTime($row['domnie_final']);
                    $ani_de_domnie = $domnie_start->diff($domnie_final);
                    $locul_domniei = $row['locul_domniei'];
                    $tip_conducator = $row['tip_conducator'];
                    $data_nasterii = new DateTime($row['data_nasterii']);
                    $data_mortii = new DateTime($row['data_mortii']);
                    $observatii = $row['observatii'];
                    $tag = $row['tag'];
                    
                        if ($tag == "democrație") {$culoare = "#0d6efd";}
                        if ($tag == "comunism") {$culoare = "#ff3636";}
                        if ($tag == "monarhie") {$culoare = "orange";}
                        if ($tag == "monarhie" ) {$culoare = "purple";}

                    $link_imagine = $row['link_imagine'];
                    $link_detalii = $row['link_detalii'];
                    $varsta_preluarea_puterii = $data_nasterii->diff($domnie_start);

                    echo '<li>';

                        echo '<div class="timeline_content">';

                            echo '<div class="perioada_domnie">' 

                                    .'<div class="data_domnie">'
                                            . $formatter_zi_luna->format($domnie_start) 
                                            . ' <span class="ani_domnie">' .  $formatter_an->format($domnie_start) . '</span> ' 
                                    .'</div>

                                    <div class="data_domnie">'
                                            . $formatter_zi_luna->format($domnie_final) 
                                            .' <span class="ani_domnie">' .  $formatter_an->format($domnie_final) . '</span>  
                                    </div>

                                 </div>';

                                 
                                 echo '<p><img class="poza_domnitor" src=" ' . $link_imagine . '"/></p>';
                                 echo '<a role="button" class="detalii btn btn-outline-primary" target="_blank" href="' . $link_detalii . '">' . $tip_conducator . ' ' . $nume . '</a>';
                                 echo '<p>Născut: ' . $formatter->format($data_nasterii) . '<br>';
                                 echo 'Decedat: ';
                                    if($row['data_mortii'] !== NULL) {
                                        echo $formatter->format($data_mortii);
                                    }  else {echo '-';}
                                    echo '</p>';
                                 echo '<p><b>Vârsta la preluarea puterii: </b>' . $varsta_preluarea_puterii->y . ' ani' ;
                                 
                                echo '<p class="longevitate"><b>A condus țara: </b>';
                                 
                                     if ($ani_de_domnie->y !== 0) {
                                         echo $ani_de_domnie->y . ' ani, ';
                                     } 
                                     
                                     if ($ani_de_domnie->m !== 0) {
                                         echo $ani_de_domnie->m;
                                         if ($ani_de_domnie->m > 1){
                                             echo ' luni, ';
                                         } else {echo ' lună, ';}
                                     } 
                                     
                                     if ($ani_de_domnie->d !== 0) {
                                         echo  $ani_de_domnie->d . ' zile ';
                                     } 
                                 
                                 echo ' </p>';
                                 
                                 

                                 echo '<p>' . $observatii . '</p>';
                                 echo '<div class="tags" style="background:' . $culoare .'">' . $tag . '</div>';

                       
                            echo '</div>';
                        
                    echo '</li>'; 

                }
                ?>
                
                    
                </ul>
            </div>
        </div>
    </div>
</section>


 

</body>
</html>