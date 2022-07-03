<!DOCTYPE html>
<html>
<head>
	<title>Старт</title>
</head>
<body>
<style>
	body {
		margin: 0;
		padding: 0;
		font-family: 'Arial', sans-serif;
	}
	.wrap {
		display: flex;
		justify-content: center;
		width: 100vw;
		min-height: 100vh;
	}
	.block {
		background:white;
		width: 80%;
		height: auto;
		padding: 30px;
	}
	.block a {
		color: black;
		border: 1px solid black;
		padding: 10px 20px;
		border-radius: 5px;
	}
	.find-client {
		margin-bottom: 250px;
	}
	a {
		color: black !important;
	}
</style>

<div class="wrap">
	<div class="block">
		<a href="/" style="color: red">На главную</a>
		<h2>Добавить машину</h2>
		<form action="{{route('addcarpost')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="client_id" value="{{$client_id}}">
			<p>Номер</p>
			<input type="text" name="number" placeholder="Номер">
			<p>Марка</p>
			<input type="text" name="marka" placeholder="Марка">
			<p>Фото</p>
			<input type="file" name="image">
			<p>Тип</p>
			<select name="type">
				<option value="Первая">Первая</option>
				<option value="Вторая">Вторая</option>
				<option value="Третья">Третья</option>
				<option value="Четыре">Четыре</option>
				<option value="Четыре +">Четыре +</option>
			</select>
			<br><br>
			<button type="submit">Добавить</button>
		</form>
	</div>
</div>
</body>
</html>