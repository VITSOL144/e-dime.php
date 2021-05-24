<?php
    require 'db.php';
?>
<html>
<head>
	<meta charset='utf-8'>
	<title>E-DIME: Вход</title>
    <link href='e-dime.css' rel='stylesheet'>
</head>
<body>
    <main>
	<h1>E-DIME</h1>
	<h2>Вход</h2>
    <form method='post' action=''>
    	<p>Введите логин <input type='text' name='login'></p>
    	<p>Введите пароль <input type='password' name='password'></p>
    	

    <?php
    $login = htmlspecialchars(addslashes($_POST['login']));
    $password = md5(md5(htmlspecialchars(addslashes($_POST['password']))));
    
    $q = mysqli_query($db,"SELECT password FROM users WHERE login = '$login' and password = '$password'");

    if ( mysqli_num_rows($q)>0 ){
        
        session_start();
        $_SESSION['login'] = $login;
        header('Location: e-dime.php');
    } elseif ($login == 'admin' && $password == md5(md5('admin2005'))){
        session_start();
        $_SESSION['login'] = $login;
        header('Location: admin.php');
    } elseif ($login != 'admin' && $login != null) {
        echo '<b>Логин или пароль неверный</b><br>';
    }
    ?>
    <p><input type='submit' value='Войти'></p>
    <script>
        function admin(){
            alert('Логин админа: admin\nПароль админа: admin2005');
        }
    </script>
    <button onclick='admin()'>Информация для Виктора Владимировича</button>
    </form>
    <p>Еще нет аккаунта? Создайте его <a href='reg.php'>здесь</a></p>
    <p>Забыли пароль? Создайте новый <a href='remake.php'>здесь</a></p>
</main>
</body>
</html>



