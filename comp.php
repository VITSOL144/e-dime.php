<section>
	<h2>Добавить соревнование</h2>


	<div class='tour'>
	<form method='post' action=''>
		<p>Название <input required type='text' name='name'></p> 
		<p>Дата <input required type='date' name='date'></p>
		<p>Время <input required type='time' name='time'></p>
		<p>Место <input required type='text' name='place'></p>
		<p>Дистанция <input required type='text' name='dist'></p>
		<p><input type='submit' value='Создать соревнование'></p>
	</form>

	<?php
	require 'db.php';
	$name = htmlspecialchars(addslashes($_POST['name']));
	$date = htmlspecialchars(addslashes($_POST['date']));
	$time = htmlspecialchars(addslashes($_POST['time']));
	$place = htmlspecialchars(addslashes($_POST['place']));
	$dist = htmlspecialchars(addslashes($_POST['dist']));
	if($name!=null && $date!=null && $time!=null && $place!=null){
		mysqli_query($db,"INSERT INTO `comp` (`name`,`place`,`date`,`time`,`dist`) VALUES ('$name','$place','$date','$time','$dist') ");

		if (mysqli_errno($db) == 0){
			?><script>alert('Соревнование успешно добавлено!');</script>
			<?php
		} else {
			?><script>alert('Ошибка добавления соревнования');</script>
			<?php
		}
	} else {
		echo '<p>Заполните все поля!</p>';
	}
	?>
	</div>
</section>