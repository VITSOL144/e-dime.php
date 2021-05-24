<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>
<section>
<h2>Магазин</h2>
<div class='tour'>
	<h3>Корзина (пользователь id-<?php echo $u_id; ?>)</h3>
	<p>Перед заказом обновите страницу!</p>
	<table>
		<tr>
			<td><b>Наименование</b></td>
			<td><b>Цена</b></td>
			<td><b>Доп. функция</b></td>
		</tr>
	<?php
	$q7 = mysqli_query($db,"SELECT * FROM shop INNER JOIN basket ON basket.shop_id=shop.id WHERE basket.users_id='$u_id';");
	if (mysqli_num_rows($q7)==0){
		echo '<p>Корзина пуста</p><p>Выберите товары ниже</p>';
	} else {
		for ($i=0;$i<mysqli_num_rows($q7);$i++){
			$res = mysqli_fetch_assoc($q7);
			$id = $res['id'];
			$shop_id = $res['shop_id'];
			?>
			<tr>
				<td><?php echo $res['name']; ?></td>
				<td><?php echo $res['cost']; ?></td>
				<td>
					<form method='post'>
					<?php
					echo '<input type="submit" value="Удалить из корзины" name="'.$id.'">';
					?>
					</form>
					<?php
					if(isset($_POST[$id])){
						mysqli_query($db,"DELETE FROM basket WHERE shop_id='$shop_id' and users_id='$u_id'");
					}
					?>
				</td>
			</tr>
			
			<?php
		}
	}
	
	?>
</table>
<?php
$q8 = mysqli_query($db,"SELECT SUM(cost) FROM shop INNER JOIN basket ON basket.shop_id=shop.id WHERE basket.users_id='$u_id';");
$arr=mysqli_fetch_assoc($q8);
$sum=$arr['SUM(cost)'];
if ($arr['SUM(cost)']==0){
	$sum = 0;
}
echo '<h4>Итог: '.$sum.' рублей</h4>';
if(mysqli_num_rows($q7)>0){
?>
<form method='post'>
	<p><input name='pay' value='Заказать' type='submit'></p>
	<p><input name='bin' value='Очистить корзину' type='submit'></p>
</form>
<?php
} else {
?>
<form method='post'>
	<p><input disabled name='pay' value='Заказать' type='submit'></p>
	<p><input disabled name='bin' value='Очистить корзину' type='submit'></p>
</form>
<?php
}


if (isset($_POST['pay'])){
	mysqli_query($db,"DELETE FROM basket WHERE users_id='$u_id'");
	?>
	<span>
		<p>
			Спасибо за заказ! Номер вашего заказа - 
			<?php
			echo time();
			?>
		</p>
		<p>Для определения удобного для вас способа получения и оплаты заказа мы свяжемся с вами по телефону в течение двух рабочих дней.</p>
		<button onclick='info()'>Информация для Виктора Владимировича</button>
		<script>
			function info(){
				alert('На этом работа с заказом оканчивается. При желании можно сделать отправку звонок по телефону, форму оплаты на сайте и так далее, но мои полномочия здесь всё... окончены...');
			}
		</script>
	</span>
	<?php
}
if (isset($_POST['bin'])){
mysqli_query($db,"DELETE FROM basket WHERE users_id='$u_id'");
}
?>
</div>

<a href='#classic'>Товары для подготовки классических лыж</a><br>
<a href='#skate'>Товары для подготовки коньковых лыж</a>

<div class='tour' id='classic' style='height: 750px;margin-top:20px;'>
	<h3>Товары для подготовки классических лыж</h3>
	<?php
	$q7 = mysqli_query($db,"SELECT * FROM shop WHERE skate = '0' or skate = '2'");

	for($i=0;$i<mysqli_num_rows($q7);$i++){
		$res = mysqli_fetch_assoc($q7);
		$shop_id = $res['id'];
		$name_id=$shop_id;
		if($res['skate']==2){
			$name_id=$shop_id.'2-classic';
		}
		?>
		<div class='product'>
			<figure>
				<?php echo '<img class="paint" src="shop/'.$res['picture'].'">'; ?>
				<figcaption>
					<h4><?php echo $res['name']; ?></h4>
					<p><?php echo $res['cost']; ?> руб.</p>
					<form method='post' action=''>
					<?php echo '<p><input type="submit" name="'.$name_id.'" value="В корзину""></p>'; ?>
					</form>
					<?php
					if(isset($_POST[$name_id])){
						mysqli_query($db,"INSERT INTO `basket` (`id`,`shop_id`,`users_id`) VALUES (NULL,'$shop_id','$u_id')");
						
					}
					?>
				</figcaption>
			</figure>
		</div>
		<?php
	}
	?>
</div>
<div class='tour' id='skate' style='height: 1100px;'>
	<h3>Товары для подготовки коньковых лыж</h3>
	<?php
	$q7 = mysqli_query($db,"SELECT * FROM shop WHERE skate = '1' or skate = '2'");

	for($i=0;$i<mysqli_num_rows($q7);$i++){
		$res = mysqli_fetch_assoc($q7);
		$shop_id = $res['id'];
		$name_id=$shop_id;
		if($res['skate']==2){
			$name_id=$shop_id.'2-skate';
		}
		?>
		<div class='product'>
			<figure>
				<?php echo '<img class="paint" src="shop/'.$res['picture'].'">'; ?>
				<figcaption>
					<h4><?php echo $res['name']; ?></h4>
					<p><?php echo $res['cost']; ?> руб.</p>
					<form method='post' action=''>
					<?php echo '<p><input type="submit" name="'.$name_id.'" value="В корзину""></p>'; ?>
					</form>
					<?php
					if(isset($_POST[$name_id])){
						mysqli_query($db,"INSERT INTO `basket` (`id`,`shop_id`,`users_id`) VALUES (NULL,'$shop_id','$u_id')");
						
					}
					?>
				</figcaption>
			</figure>
		</div>
		<?php
	}
	?>
</div>
</section>