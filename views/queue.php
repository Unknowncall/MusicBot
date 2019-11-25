<div class="container">
    <h2 style="padding:5px; text-align:center;">Current Queue</h2>
    <center>
	    <table>
	    <?php
	        $sql = "SELECT * FROM `queue` ORDER BY `queue_position` ASC";
	        $result = getAllRecords($sql, $db, null);
	        $counter = 1;
	        foreach ($result as $row) {
	        	echo "<tr><td>{$counter}. <a target='_blank' href='https://www.youtube.com/watch?v={$row['youtube_url']}'/>https://www.youtube.com/watch?v={$row['youtube_url']}</td></tr>";
	        	$counter++;
	        }

	    ?>
		</table>
	</center>
</div>