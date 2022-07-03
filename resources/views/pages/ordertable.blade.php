<!DOCTYPE html>
<html>
<head>
	<title>Отчет</title>
	<script src="{{asset('storage/assets/jquery.js') }}"></script>
	<script src="{{asset('storage/assets/jjj.js') }}"></script>
        <link rel="stylesheet" href="{{asset('storage/assets/css.css') }}">
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
    	dateFormat: "dd-mm-yy",
    });
    $( "#datepicker2" ).datepicker({
    	dateFormat: "dd-mm-yy",
    });
  } );
  </script>
</head>
<body>
<style>
	body {
		margin: 0;
		padding: 0;
		font-family: 'Roboto', sans-serif;
	}
	.wrap {
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: center;
		width: 100vw;
		min-height: 100vh;
		background: white;
	}
	form {
		margin: 50px 0;
	}
	#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  color: grey;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>


<div class="wrap">
	<a href="/admin">Назад</a>
	<form action="" method="GET">
	Работник
	<select name="woker">
		<option value="">Не выбрано</option>
		@foreach($wokers as $woker) 
			<option value="{{$woker->id}}">{{$woker->name}} {{$woker->surname}}</option>
		@endforeach	
	</select>
	Клиент
	<select name="client">
		<option value="">Не выбрано</option>
		@foreach($clients as $client) 
			<option value="{{$client->id}}">{{$client->name}}</option>
		@endforeach	
	</select>
	От
	<input type="text" name="time_1" id="datepicker" value="<?php
	if(isset($_GET['time_1'])) {
		echo $_GET['time_1'];
	}?>">
	До
	<input type="text" name="time_2" id="datepicker2" value="<?php
	if(isset($_GET['time_2'])) {
		echo $_GET['time_2'];
	}?>">
	Смена:
	<select name="time"> 
		<option value="">Не выбрано</option>
		<option value="дневная">Дневная</option>
		<option value="ночная">Ночная</option>
	</select>
	<button type="submit">Фильтр</button>
	</form>
	<table id="customers">
		<tr>
			<th>Коммент</th>
			<th>Время</th>
			<th>Цена</th>
			<th>Смена</th>
			<th>Время окончания заказа</th>
			<th>Тип прайса</th>
			<th>Машина</th>
			<th>Клиент</th>
			<th>Услуги</th>
			<th>Работник</th>
			<th>Редактировать</th>
			<th>Удалить</th>
		</tr>
		@foreach($orders as $order)
		<tr>
			<td>{{$order->comment}}</td>
			<td>{{$order->time}}</td>
			<td>{{$order->price}}</td>
			<td>{{$order->day}}</td>
			<td>{{$order->created_at}}</td>
			<td>{{$order->type}}</td>
			<td>
			@foreach($cars as $car) 
			@if($car->id == $order->car_id)
			{{$car->marka}}
			@endif
			@endforeach	
			</td>
			<td>
			@foreach($clients as $client) 
			@if($client->id == $order->client_id)
			{{$client->name}}
			@endif
			@endforeach
			</td>
			<td>	
			<?php
			$data = unserialize($order->usluga);
			?>
			@foreach($uslugis as $usluga) 
			@foreach($data as $val)
			@if($val == $usluga->id)
			{{$usluga->name}}<br>
			@endif
			@endforeach
			@endforeach
			</td>
			<td>	
			@foreach($wokers as $woker) 
			@if($woker->id == $order->work_id)
			{{$woker->name}} {{$woker->surname}}
			@endif
			@endforeach
			</td>
			<td><a style="color: green" href="/admin/orders/{{$order->id}}/edit" target="_blank">Редактировать</a></td>
			<td><a style="color: red" href="{{route('deleteorder', $order->id)}}">Удалить</a></td>	
		</tr>
		@endforeach
		<tr>
			<th>Общая сумма</th>
			@if($price_woker != 0)
			<th>Заработок работника</th>
			@endif
		</tr>
		<tr>
			<td>{{$price}}</td>
			@if($price_woker != 0)
			<td>{{$price_woker}}</td>
			@endif
		</tr>
	</table>
</div>
</body>
</html>