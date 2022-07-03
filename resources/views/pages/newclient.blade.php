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
		<h2>Добавить клиента</h2>
		<form class="find-client" action="{{route('newclientpost')}}" method="POST">
			@csrf
			<p>Имя</p>
			<input type="text" name="name" placeholder="Имя">
			<p>Телефон</p>
			<input type="text" name="phone" placeholder="Телефон"><br><br>
			<button type="submit">Добавить</button>
		</form>
	</div>
</div>
</body>
</html>