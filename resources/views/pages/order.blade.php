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
		min-height: 100vh;
		height: 100vh;
	}
	.block {
		background:white;
		width: 80%;
		height: auto;
		padding: 30px;
	}
	.link {
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
	.cars {
		border: 1px solid black;
		margin-bottom: 20px;
		display: flex;
	}
	select {
		width: 250px;
		height: 50px;
		border-radius: 5px;
	}
	.btn {
		border: none;
		background: white;
		border: 1px solid black;
		border-radius: 10px;
		padding: 20px 40px;
		color: black;
		margin-top: 30px;
		cursor: pointer;
	}
</style>

<div class="wrap">
	<div class="block">
		<a href="/" style="color: red">На главную</a>
		<h2>Заказ</h2>
		<form action="{{route('makeorder')}}" method="POST">
		@csrf
		<input type="hidden" name="id" value="{{$id}}">
		<input type="hidden" name="car" value="{{$car}}">
		<h3>Выбор услуги</h3> 
		@foreach($uslugi as $value)
			<p><input type="checkbox" name="usluga_{{$value->id}}"> {{$value->name}}</p>
		@endforeach

		<h3>Выбор сотрудника</h3>	
		<select name="woker">
		@foreach($wokers as $value)
			<option value="{{$value->id}}">{{$value->name}}</option>
		@endforeach
		</select>
		<h3>Выбор прайса</h3>


		<!-- РЕДАКТИРОВАТЬ ТОЛЬКО ТУТ -->
		<select name="type">
			<option value="1">Общий</option>
			<option value="2">Красный Крест</option>
			<option value="3">Вася пупкин</option>
			 <!-- <option value="4"></option> -->
			<!-- <option value="5"></option> -->
		</select><br>

		<button type="submit" class="btn">Начать</button>
		</form>
	</div>
</div>
</body>
</html>