<!DOCTYPE html>
<html>
<head>
	<title>Старт</title>
<script src="{{asset('storage/assets/jquery.js') }}"></script>
	 <meta name="csrf-token" content="{{ csrf_token() }}" />
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
		max-width: 500px;
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
	.finish {
		float: right;
		background:green;
		border: none;
		padding: 20px 40px;
		color: white;
		font-size: 25px;
		cursor: pointer;
	}
	.price {
		font-size: 25px;
		color: green;
		float: right;
	}
</style>

<div class="wrap">
	<div class="block">
		<a href="/" style="color: red">На главную</a>
		<h2>Заказ</h2>
		<h2>Информация</h2>
		<p><b>Клиент: </b></p>
		<p>{{$client->name}}<br> {{$client->phone}}</p>
		<p><b>Машина: </b></p>
		<div class="cars">
			<img src="{{asset('storage/'.$car->photo) }}" width="200px">
			<div style="margin-left: 20px;">
				<p>Марка: {{$car->marka}}</p>
				<p>Номер: {{$car->number}}</p>
			</div>
		</div>
		<p><b>Кто моет: </b> {{$woker->name}}</p>
		<p><b>Услуги: </b>
		 	@foreach($usluga as $usl) 
			<i>{{$usl->name}}</i>
			@endforeach
		</p>
		<p><b>Начало работы: </b> <i>{{$time}}</i></p>
		<p><b>Смена: </b> <i>{{$day}}</i></p>
		<p><b>Комментарий</b></p>	
		<textarea class="comment" rows="10" cols="45">
			
		</textarea>

		<span class="price" style="display: none;">
			Заказ оформлен<br>
			Цена:
			{{$price}}
			<br>
			Прошло времени: 
			<span class="timef"></span><br>
			<a href="/">Вернуться на главную</a>
		</span>
		<button class="finish">Завершить</button>

		<input type="hidden" class="day" value="{{$day}}">
		<input type="hidden" class="usluga" value="{{$arr_usl}}">
		<input type="hidden" class="car" value="{{$car->id}}">
		<input type="hidden" class="woker" value="{{$woker->id}}">
		<input type="hidden" class="type" value="{{$type}}">
		<input type="hidden" class="time" value="{{$time}}">
		<input type="hidden" class="client" value="{{$client->id}}">
		<input type="hidden" class="price_val" value="{{$price}}">


		<script type="text/javascript">
			$('.finish').on('click', function () {
				$(this).fadeOut(400);
				$('.comment').attr('disabled','true');
				setTimeout(function() {
					$('.price').fadeIn(400);
				},400);
				 $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    	});
				$.ajax({
					url: '/finishpost',
					type: 'GET',
					data: {
						day: $('.day').val(),
						usluga: $('.usluga').val(),
						car: $('.car').val(),
						woker: $('.woker').val(),
						type: $('.type').val(),
						time: $('.time').val(),
						client: $('.client').val(),
						price: $('.price_val').val(),
						comment: $('.comment').val(),
					},
					success: function(response) {
						$('.timef').html(response);
					}, 
					error: function() {
						alert('Произошла ошибка')
					}
				});
			})
		</script>
	</div>
</div>
</body>
</html>