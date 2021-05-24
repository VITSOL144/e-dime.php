<?php
    require 'db.php';
?>
<html>
<head>
	<meta charset='utf-8'>
	<title>E-DIME: Восстановление пароля</title>
    <link href='e-dime.css' rel='stylesheet'>
</head>
<body>
    <main>
	<h1>E-DIME</h1>
	<h2>Восстановление пароля</h2>
    <script>
        function show(){
            alert('Здесь бы хорошо проверить, что логин принадлежит этому пользователю, но я не умею отправлять смски на номер:)');
        }
    </script>
    <button onclick='show()'>Информация для Виктора Владимировича</button>

    <form method='post' action=''>
    	<p>Введите логин <input type='text' name='login'></p>
    	<p>Введите пароль <input type='password' name='password'></p>
    	

    <?php
    $login = htmlspecialchars(addslashes($_POST['login']));
    $password = md5(md5(htmlspecialchars(addslashes($_POST['password']))));
    
    $q = mysqli_query($db,"SELECT * FROM users WHERE login = '$login'");
    if ( mysqli_num_rows($q)>0 ){
        $q = mysqli_query($db,"UPDATE users SET password = '$password' WHERE login = '$login'");
        if (mysqli_errno($db)==0){
            header('Location: enter.php');
        }
    } elseif ($login != null) {
        echo '<b>Такого логина не существует</b><br>';
    }
    ?>
    <p><input type='submit' value='Изменить пароль'></p>
    </form>
</main>
</body>
</html>