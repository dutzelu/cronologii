<?php include 'header.php';

    $sql = "SELECT * FROM voievozi ORDER BY domnie_start DESC;";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    $result = $stmt->get_result();
        

?>


 
<section class="experience  pb-100" id="experience">

		<div class="container">

			<div class="row">
				<div class="col-xl-8 mx-auto text-center">
					<div class="section-title">
						<h4>Conducătorii României</h4>
						<p>voievozi, domnitori, regi, președinți</p>
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
                        $link_imagine = $row['link_imagine'];
                        $varsta_preluarea_puterii = $data_nasterii->diff($domnie_start);

                        echo '<li>';
                            echo '<div class="timeline_content">';
                                echo '<p><span class="ani_domnie">' . date('Y', strtotime($row['domnie_start'])) . " - " . date('Y', strtotime($row['domnie_final'])) . '</span><br>' . $ani_de_domnie->y . ' ani și ' . $ani_de_domnie->m . ' luni de domnie </p>';
                                echo '<p><img class="poza_domnitor" src=" ' . $link_imagine . '"/></p>';
                                echo '<h4>' . $tip_conducator . ' ' . $nume . '</h4>';
                                echo '<p>' . $observatii . '</p>';
                                echo '<p>Vârsta la preluarea puterii: ' . $varsta_preluarea_puterii->y . ' ani' ;
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