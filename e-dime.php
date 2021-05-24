<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
    require 'db.php';
    session_start();
    $u_login = $_SESSION['login'];
    if($u_login == null){
    	header('Location: enter.php');
    }
    $u_id = mysqli_fetch_assoc(mysqli_query($db,"SELECT id FROM users WHERE login = '$u_login'"))['id'];
    
?>
<html>
<head>
	<meta charset='utf-8'>
	<title>E-DIME</title>
	<link href='e-dime.css' rel='stylesheet'>
</head>
<body>
	<header id='v'>
		<h1>E-DIME</h1>
		<p>Добро пожаловать в мир лыжного спорта!</p>
		<img src='1.jpg'>
	</header>
	<nav>
		<ul>
			<li><a href='e-dime.php?page=index'>ГЛАВНАЯ</a></li>
			<li><a href='e-dime.php?page=lk'>ЛИЧНЫЙ КАБИНЕТ</a></li>
			<li><a href='e-dime.php?page=comp_user'>СОРЕВНОВАНИЯ</a></li>
			<li><a href='e-dime.php?page=result_user'>РЕЗУЛЬТАТЫ</a></li>
			<li><a href='e-dime.php?page=shop'>МАГАЗИН</a></li>
			<li><a href='e-dime.php?page=info'>ИНФОРМАЦИЯ</a></li>
			<li><a href='e-dime.php?page=exit'>ВЫХОД</a></li>
		</ul>
	</nav>

	<main>
		<?php
		$q3 = mysqli_query($db,"SELECT * FROM users WHERE id = '$u_id'");
		$arr = mysqli_fetch_assoc($q3);
		$page = htmlspecialchars(addslashes($_GET['page'] ?? 'index'));
 		include($page.'.php');
		?>
		<p><a href='#v'>Наверх</a></p>
	</main>

	<footer>
		<a href='https://reg.o-time.ru'>Официальный сайт</a><br>
		<a href='https://vk.com/vit_or'>Мы Вконтакте</a>
		<p>Сайт создан исключительно в образовательных целях.<br>Все совпадения с реально существующими сервисами считать больной фантазией разработчика.</p>
		<p>&copy; Created and designed by Vitaliy Vitalich. 2021.</p>
	</footer>
    

</body>
</html>