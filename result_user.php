



<section>
<h2>Результаты соревнований</h2>
<?php
$q = mysqli_query($db,"SELECT * FROM comp WHERE status ='1'");
for($i=0;$i<mysqli_num_rows($q);$i++){
	$res=mysqli_fetch_assoc($q);
	$id = $res['id'];
	?>
	<div class='tour'>
		<h3><?php echo $res['name']; ?></h3>
		<p><?php echo $res['date'].' '.$res['time'].' '.$res['place']; ?></p>
		<p>Дистанция <?php echo $res['dist']; ?> км</p>
		<table>
			<tr>
				<td><b>Место</b></td>
				<td><b>ФИ</b></td>
				<td><b>Дата рождения</b></td>
				<td><b>Результат</b></td>
			</tr>
		<?php
		$q2 = mysqli_query($db,"SELECT * FROM users INNER JOIN part ON part.users_id = users.id WHERE comp_id = '$id' ORDER BY result ASC");
		$last_result=0;
		$place = 0;
		$not_finished = [];
		for($j=0;$j<mysqli_num_rows($q2);$j++){
			$res2=mysqli_fetch_assoc($q2);
			if(($res2['result']!=null)&&($res2['result']!="00:00:00")){
				?>
				<tr>
					<td><?php 
					if($res2['result']==$last_result){
						$place+=0; echo $place;
					} else {
						$place+=1; echo $place; 
					}

					?></td>
					<td><?php echo $res2['name']; ?></td>
					<td><?php echo $res2['birth']; ?></td>
					<td><?php 

					echo $res2['result']; 
					$last_result = $res2['result'];
					?></td>
				</tr>
				<?php
			} elseif(($res2['result']==null)||($res2['result']=='00:00:00')) {

				$at1 = $res2['name'];
				$at2 = $res2['birth'];
				$array_this = [$at1,$at2];
				array_push($not_finished,$array_this);
			}
		}
		for($j=0;$j<count($not_finished);$j++){
			?>
			<tr>
				<td>-</td>
				<td><?php echo $not_finished[$j][0]; ?></td>
				<td><?php echo $not_finished[$j][1]; ?></td>
				<td>не финишировал</td>
			</tr>
			<?php
		}
		?>
		</table>
	</div>
	<?php
}
?>

</section>