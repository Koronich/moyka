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
</style>

<div class="wrap">
	<div class="block">
		<a href="/" style="color: green;">На главную</a>
		<h2>Профиль</h2>
		@foreach($client as $value)
		<p>Имя: {{$value->name}}</p>
		<p>Телефон: {{$value->phone}}</p>
		<a href="{{route('updateclient', $value->id)}}">редактировать профиль</a>
		<h2>Машины клиента</h2>
		@foreach($cars as $car)
		<div class="cars">
			<img src="{{asset('storage/'.$car->photo) }}" width="200px">
			<div style="margin-left: 20px;">
				<a href="{{ route('order', [$value->id ,$car->id] ) }}" style="color: green;">Продолжить работу с этой машиной</a>
				<p>Марка: {{$car->marka}}</p>
				<p>Номер: {{$car->number}}</p>
			</div>
		</div>
		@endforeach
		<a href="{{route('addcar', $value->id)}}" class="link">Добавить машину</a>
		@endforeach
	</div>
</div>
</body>
</html>