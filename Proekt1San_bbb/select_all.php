<?php include 'includes/layouts/header.php'; ?>

<div class="container">
	<h2 class="text-center">Информационна система за софтуерна фирма успех</h2>
	
	<div class="container">
		<h3>извеждане на всички данни</h2>    
 
		<table class="table table-bordered col-sm-8">
			<thead>
				<th>Code</th>
				<th>Name</th>
				<th>Kind</th>
				<th>Sum</th>
			</thead>
			
			<tbody>
			<?php
				include 'config.php';
				$i = 0;
				$select_all = mysqli_query($conn,"select * from user");
				while ($row = mysqli_fetch_array($select_all)) {
					$class = ($i == 0) ? "" : "alt";
					
					
					echo "<tr>";
					echo "<td>".$row['Code']."</td>";
					echo "<td>".$row['Name']."</td>";
					
					echo "<td>";
					switch($row['Kind']){
						case 1: 
							echo "Вземане"; 
							break;
						case 2: 
							echo "Даване";
							break;
						default: 
							echo "ERROR";
					}
					echo "</td>";
					
					echo "<td>".$row['Sum']."</td>";
					echo "</tr>";
				}

			?>
			
			</tbody>
		</table>
	
	</div>
</div>
<?php include 'includes/layouts/footer.php'; ?>