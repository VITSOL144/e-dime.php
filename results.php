<section>
	<h2>Результаты соревнований</h2>
	
	<?php
	require 'db.php';
	$q = mysqli_query($db,'SELECT * FROM comp WHERE status = 0');

	for($i=0;$i<mysqli_num_rows($q);$i++){
		$res = mysqli_fetch_assoc($q);
		$id = $res['id'];
		$name = $res['name'];
		$place = $res['place'];
		$date = $res['date'];
		$time = $res['time'];
		$dist = $res['dist'];
		?>
		<div class='tour'>
			<?php echo '<h3 id="'.$id.'">'.$name.'</h3>';?>
			<p><?php echo $date.' '.$time.' '.$place; ?></p>
			<p>Дистанция <?php echo $dist; ?> км</p>
			
			<?php
			
			echo '<form method="post" action="">';
			$stop = $id.'stop';
			echo '<input type="submit" name="'.$stop.'" value="Закончить соревнование" style="margin-right:10px;">';
			if (isset($_POST[$stop])){
				mysqli_query($db,"UPDATE comp SET status = 1 WHERE id = '$id'");
				if(mysqli_errno($db)==0){
					echo
					'<script>
						alert("Соревнования `'.$name.'` закончены");
					</script>';
				} else {
					echo
					'<script>
						alert("Ошибка SQL запроса");
					</script>';
				}
			}
			$delet = $id.'delet';
			
			echo '<input type="submit" name="'.$delet.'" value="Отменить соревнование" style="margin-right:10px;">';
			if (isset($_POST[$delet])){
				mysqli_query($db,"DELETE FROM comp WHERE id = '$id'");
				if(mysqli_errno($db)==0){
					echo
					'<script>
						alert("Соревнования `'.$name.'` отменены");
					</script>';
				} else {
					echo
					'<script>
						alert("Ошибка SQL запроса");
					</script>';
				}	
			}

			echo '</form>';
			
			$np = mysqli_query($db,"SELECT count(id) FROM part WHERE comp_id = '$id'");
			$res1 = mysqli_fetch_assoc($np);
			$np = $res1['count(id)'];
			?>

			<!--Таблица участников-->
			<div class="dart">
				<p>Участники: <?php echo $np; ?></p>
				<?php
				$q1 = mysqli_query($db,"SELECT * FROM part WHERE comp_id = '$id'");
				
				?>
				<table id='results'>
					<tr>
						<td>ФИ</td>
						<td>Добавить результат</td>
						<td>Результат</td>
					</tr>
					<?php
					
					
					for($j=0;$j<mysqli_num_rows($q1);$j++){
						$res2 = mysqli_fetch_assoc($q1);
						$users_id = $res2['users_id'];
						$nme = mysqli_fetch_assoc(mysqli_query($db,"SELECT name FROM users WHERE id = '$users_id'"))['name'];
						$input_name = $id.$users_id.'result';
						?>

						<tr>
							<td><?php echo $nme; ?></td>
							<td>
								<form method='post' action=''>
									<?php echo '<input type="time" name="'.$input_name.'" step="1">'; ?>
									<a href=<?php echo '"#'.$id.'"';?>><input type='submit' value='Добавить результат'></a>
								</form>
								<?php
								$result = htmlspecialchars(addslashes($_POST[$input_name]));
								
								if ($result != null){
									mysqli_query($db,"UPDATE part SET result = '$result' WHERE comp_id = '$id' and users_id = '$users_id '");
									?>

									<?php
									
								}
								?>
							</td>
							<td>
								<?php
								$q7=mysqli_query($db,"SELECT result FROM part WHERE users_id='$users_id' and comp_id='$id'");
								$res_db = mysqli_fetch_assoc($q7)['result'];
								echo $res_db;
								?>
							</td>
						</tr>
						<?php
					}
					?>	
				</table>
				

			</div>
			
		</div>
	<?php 
		} 
	?>
</section>