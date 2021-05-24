<section>
<h2>Соревнования  (открытые)</h2>
<p>Эти соревнования ожидаются либо проходят сейчас</p>
<p>Если соревнование идет в данный момент вы можете посмотреть вносимые результаты ниже</p>
<p>После закрытия соревнования вы можете скачать итоговый протокол в разделе <a href='e-dime.php?page=result_user'>Результаты</a></p>
<?php
$q7 = mysqli_query($db,"SELECT * FROM comp WHERE status = 0");
for ($a=0;$a<mysqli_num_rows($q7);$a++){
	$arr = mysqli_fetch_assoc($q7);
	
	?>
	<div class='tour'>
		<h3><?php echo $arr['name']; ?></h3>
		<p><?php echo $arr['date'].' '.$arr['time'].' '.$arr['place']; ?></p>
		<p>Дистанция <?php echo $arr['dist']; ?> км</p>
		<?php $id = $arr['id']; 
		
		$is_reg=mysqli_query($db,"SELECT * FROM part WHERE users_id='$u_id' and comp_id='$id'");

		if(mysqli_num_rows($is_reg)==0){
			echo '<form method="post"><input type="submit" value="Зарегистрироваться" name="'.$id.'"></form>';
		} else {
			echo '<form method="post"><input disabled type="submit" value="Зарегистрироваться" name="'.$id.'"></form>';
		}
		
		if(isset($_POST[$id])){
			if(mysqli_num_rows($is_reg)==0){
				mysqli_query($db,"INSERT INTO `part` (`users_id`,`comp_id`) VALUES ('$u_id','$id')");
				if(mysqli_errno($db)==0){
					echo '<script>alert("Вы зарегистрировались на соревнования `'.$arr['name'].'`");</script>';
				} else {
					echo '<script>alert("Ошибка SQL запроса");</script>';
				}
			} else {
				echo '<script>alert("Вы уже зарегистрировались на эти соревнования");</script>';
			}
		}
			$q9 = mysqli_query($db,"SELECT * FROM part INNER JOIN users ON part.users_id=users.id WHERE comp_id='$id'");
			echo '<p>Участники: '.mysqli_num_rows($q9).'</p>';
		
		
		?>
		<div id="participants">
			<table>
				<tr>
					<td>ФИ</td>
					<td>Дата рождения</td>
					<td>Результат</td>
				</tr>
				<?php
				
				for ($x=0;$x<mysqli_num_rows($q9);$x++){
					$rq9 = mysqli_fetch_assoc($q9);
					echo '<tr>
						<td>'.$rq9['name'].'</td>
						<td>'.$rq9['birth'].'</td>
						<td>'.$rq9['result'].'</td>
					</tr>';

					/*echo '<tr><td>'.$rq9['name'].'</td>';
					echo '<td>'.$rq9['name'].'</td>';
					echo '<td>'.$rq9['name'].'</td></tr>';*/
				}
				?>
			</table>
		</div>
	</div>
	<?php
}


?>
</section>