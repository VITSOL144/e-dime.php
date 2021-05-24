<?php
    require 'db.php';
?>
<html>
<head>
	<meta charset='utf-8'>
	<title>E-DIME: Регистрация</title>
    <link href='e-dime.css' rel='stylesheet'>
</head>
<body>
	<main>
    <h1>E-DIME</h1>
	<h2>Регистрация</h2>
    <form method='post' action='' enctype='multipart/form-data'>
    	<p>Имя и фамилия <input required type='text' name='name'></p>
    	<p>Логин (придумайте любой) <input required type='text' name='login'></p>
    		<?php 
    		$l = htmlspecialchars(addslashes($_POST['login']));

	    	function checkLogin(string $login){
	    		global $db;

		    	$q = mysqli_query($db,"SELECT login FROM users where login = '$login'");
		    	
	    		return mysqli_num_rows($q) === 0 ? true : false;
	    	}
	    	
	    	if (!empty($l) && checkLogin($l)){
	    		$login = $l;
	    	}
	    	?>
    	<p>Пароль (придумайте любой) <input required type='password' name='password'></p>
        <p>Телефон <input required type='text' name='phone'></p>
    	<p>Дата рождения <input required type='date' name='birth'></p>
    	<p>Город <input required type='text' name='place'></p>
    	<p>Разряд/звание <br>
    		<label><input type='radio' name='qual' value='6'> 1 взрослый</label><br>
    		<label><input type='radio' name='qual' value='7'> 2 взрослый</label><br>
    		<label><input type='radio' name='qual' value='8'> 3 взрослый</label><br>
    		<label><input type='radio' name='qual' value='9'> 1 юношеский</label><br>
    		<label><input type='radio' name='qual' value='10'> 2 юношеский</label><br>
    		<label><input type='radio' name='qual' value='11'> 3 юношеский</label>
            <label><input type='radio' name='qual' value='12'> нет разряда</label>
    	</p>
        <p>Загрузить аватарку (квадратное фото): <input type='file' name='avatar'></p>
    	<input type='submit' value='Создать аккаунт'>
    </form>
    <?php
    $name = htmlspecialchars(addslashes($_POST['name']));
    $password = md5(md5(htmlspecialchars(addslashes($_POST['password']))));
    $phone = htmlspecialchars(addslashes($_POST['phone']));
    $birth = htmlspecialchars(addslashes($_POST['birth']));
    $place = htmlspecialchars(addslashes($_POST['place']));
    $qual_id = htmlspecialchars(addslashes($_POST['qual']));

    $avatar = $_FILES['avatar'];
    if(is_uploaded_file($avatar['tmp_name'])){
        move_uploaded_file($avatar['tmp_name'], "C:/xampp/htdocs/e-dime/avatar/".$avatar['name']);
        $filename = $avatar['name'];
    }

    if(($l != null && $login==null)||($login=='admin')){
        echo '<p>Ошибка. Такой логин уже занят.</p>';
    } elseif ($l==null){
        echo '<p>Поля "логин" и "пароль" обязательны для заполнения!</p>';
    } elseif($qual_id==null){
        echo '<p>Поле "разряд" обязательно для заполнения!</p>';
    } else {
        
    mysqli_query($db,"INSERT INTO `users` (`name`,`login`,`password`,`phone`,`birth`,`place`,`qual_id`) VALUES ('$name','$login','$password','$phone','$birth','$place','$qual_id')");
    $id=mysqli_fetch_assoc(mysqli_query($db,"SELECT id FROM users WHERE login='$login'"))['id'];
    mysqli_query($db,"INSERT INTO `files` (`users_id`,`filename`) VALUES ('$id','$filename')");
    header('Location: enter.php');
    
    }
 	
    ?>
</main>
</body>
</html>