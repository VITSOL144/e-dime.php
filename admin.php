<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
    require 'db.php';
    session_start();
    if($_SESSION['login']==null){
    	header('Location:enter.php');
    }
?>
<html>
<head>
	<meta charset='utf-8'>
	<title>Админ</title>
	<link href='e-dime.css' rel='stylesheet'>
</head>

<body>
	<header id='ver'>
	<h1>E-DIME (admin)</h1>
	<p>Добро пожаловать, admin!</p>
	</header>
	<nav>
		<ul>
			<li><a href='admin.php?page=comp'>ДОБАВИТЬ СОРЕВНОВАНИЕ</a></li>
			<li><a href='admin.php?page=results'>ДОБАВИТЬ РЕЗУЛЬТАТЫ</a></li>
			<li><a href='admin.php?page=exit'>ВЫХОД</a></li>
			
		</ul>
	</nav>
	<main>
		
		<?php
		$page = htmlspecialchars(addslashes($_GET['page'] ?? 'comp'));

		include($page.'.php');
		?>
		<a style='margin-bottom:15px;'href='#ver'>Наверх</a>
	</main>
	<footer>
		<p>Страничка админа</p>
		<p>&copy; Created and designed by Vitaliy Vitalich. 2021.</p>
	</footer>
    

</body>
</html>