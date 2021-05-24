<section>
<h2>Личный кабинет</h2>
<?php
$u_q_id = $arr['qual_id'];
$q4 = mysqli_query($db,"SELECT qual FROM qual WHERE id='$u_q_id'");
$aqual = mysqli_fetch_assoc($q4);
echo '<h3>Пользователь id-'.$u_id.'</h3>
<div class="tour">';
echo '
<h4>Мои данные</h4>';
$ava = mysqli_fetch_assoc(mysqli_query($db,"SELECT filename FROM files WHERE users_id='$u_id'"))['filename'];
echo '<img style="margin-right:15px; float:left;"class="avatar" src="avatar/'.$ava.'">';
echo '
<span>
<p>ФИ: '.$arr['name'].'</p>
<p>Телефон: '.$arr['phone'].'</p>
<p>Дата рождения: '.$arr['birth'].'</p>
<p>Место рождения: '.$arr['place'].'</p>
<p>Разряд: '.$aqual['qual'].'</p>
<p>Логин: '.$arr['login'].'</p></span>';


?>

</div>
<div class='tour'>
	<h4>Предстоящие и текущие соревнования</h4>
	<p>Здесь отображаются соревнования, на которые вы зарегистрировались, либо в которых участвуете сейчас.</p>
	<p>Когда вы финишируете, ваше время вносится в систему и вы можете видеть его ниже.</p>
	<p>После финиша всех участников ваш результат сохранится у вас в <a href='e-dime.php?page=lk'>Личном кабинете</a>, а также в протоколе в разделе <a href='e-dime.php?page=result_user'>Результаты</a>.</p>
	<table>
		<tr>
			<td><b>Название</b></td>
			<td><b>Дата</b></td>
			<td><b>Время</b></td>
			<td><b>Место проведения</b></td>
			<td><b>Дистанция</b></td>
			<td><b>Результат (для текущих)</b></td>
			<td><b>Доп. функция</b></td>
		</tr>
	<?php
	$q = mysqli_query($db,"SELECT * FROM comp INNER JOIN part ON comp.id = part.comp_id WHERE part.users_id = '$u_id' and status = '0';");
	for($i=0;$i<mysqli_num_rows($q);$i++){
		$res = mysqli_fetch_assoc($q);
		$id = $res['comp_id'];
		?>
		<tr>
			<td><?php echo $res['name']; ?></td>
			<td><?php echo $res['date']; ?></td>
			<td><?php echo $res['time']; ?></td>
			<td><?php echo $res['place']; ?></td>
			<td><?php echo $res['dist'].' км'; ?></td>
			<td><?php echo $res['result']; ?></td>
			<td>
				<form method='post'>
					<?php echo '<input type="submit" value="Соскочить" name="'.$id.'">'; ?>
				</form>
			</td>
		</tr>
		<?php 
		if(isset($_POST[$id])){
			if($res['result']==null){
				mysqli_query($db,"DELETE FROM part WHERE users_id='$u_id' and comp_id='$id'");
				if(mysqli_errno($db)==0){
					echo '<script>alert("Вы соскочили с соревнований `'.$res['name'].'`");</script>';
				} else {
					echo '<script>alert("Ошибка SQL запроса\n id соревнований '.$id.' id пользователя '.$u_id.'");</script>';
				}
			} else {
				echo '<script>alert("Опаньки! Соскочить не удастся! Вы уже финишировали!");</script>';
			} 
		}
	}
	
	?>
	</table>
</div>
<div class='tour'>
	<h4>Прошедшие соревнования</h4>
	<table>
		<tr>
			<td><b>Название</b></td>
			<td><b>Дистанция</b></td>
			<td><b>Результат</b></td>
			<td><b>Место</b></td>
		</tr>
	<?php
	$q = mysqli_query($db,"SELECT * FROM comp INNER JOIN part ON comp.id = part.comp_id WHERE part.users_id = '$u_id' and status = '1'");

	for($i=0;$i<mysqli_num_rows($q);$i++){
		$res = mysqli_fetch_assoc($q);
		?>
		<tr>
			<td><?php echo $res['name']; ?></td>
			<td><?php echo $res['dist'].' км'; ?></td>
			<td><?php echo $res['result']; ?></td>
			<td>
				<?php
				$id = $res['comp_id'];
				$q1 = mysqli_query($db,"SELECT result FROM part WHERE comp_id = '$id' ORDER BY result ASC ");
				$q2 = mysqli_query($db,"SELECT result FROM part WHERE comp_id = '$id' and users_id='$u_id'");
				$my_result = mysqli_fetch_assoc($q2)['result'];
				$place=0;
				for ($j=0;$j<mysqli_num_rows($q1);$j++){
					$res_places = mysqli_fetch_assoc($q1);
					if($res_places['result']!=null){
						$place+=1;
						if($res_places['result']==$my_result){
							echo $place;
							break;
						}
					}
				}
				?>
			</td>
		</tr>
		<?php
	}
	
	?>
</table>
</div>
<div class='tour'>
	<h4>Удаление аккаунта</h4>
	<form method='post'>
		<input type='submit' name='destroy' value='Удалить аккаунт'>
	</form>
	<?php
	if(isset($_POST['destroy'])){
		mysqli_query($db,"DELETE FROM users WHERE id='$u_id'");
		header('Location:e-dime.php?page=exit');
	}
	?>
</div>

</section>