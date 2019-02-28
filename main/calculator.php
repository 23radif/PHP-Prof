<?php
function index() {
	$var1 = (int)$_POST["var1"];
	$var2 = (int)$_POST["var2"];
	$select = $_POST["select"];

	$result = mathOperation($var1, $var2, $select);

	$content = <<<php
<form action="" method="post">
	<input type="text" name="var1" placeholder="1 переменная" style='width:89px; margin:1px'>
	<input type="text" name="var2" placeholder="2 переменная" style='width:89px; margin:1px'><br>
	<select name ="select" id ="" style='width:94px'>
		<option value="sum">Сложение</option>
		<option value="sub">Вычитание</option>
		<option value="mult">Умножение</option>
		<option value="div">Деление</option>
	</select>
	<input type="submit" value="Вычислить" style='margin:1px'><br>
	
	<input type="submit" name="select" value="sum">
	<input type="submit" name="select" value="sub">
	<input type="submit" name="select" value="mult">
	<input type="submit" name="select" value="div">
</form>
<p>Результат: {$result}</p>
php;
    fileLog('-calculator');
    $_SESSION['title'] = 'Калькулятор';
	return $content;
}

function mathOperation($var1, $var2, $select) {
	if ($var2 == 0 && $select == "div") {
		$result = "На ноль делить нельзя!";
	} else {
		switch($select) {
			case "sum":
				$result = $var1 + $var2;
				break;
			case "sub":
				$result = $var1 = $var2;
				break;
			case "mult":
				$result = $var1 * $var2;
				break;
			case "div":
				$result = $var1 / $var2;
				break;
		}
	}
	return $result;
}






