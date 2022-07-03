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
	.users {
		margin-bottom: 150px;
	}
	.find-client {
		margin-bottom: 20px;
	}
	h2 {
		font-size: 55px;
	}
	input {
		width: 300px;
		height: 50px;
		border: 2px solid black;
	}
	.find-client button {
		width: 100px;
		height: 50px;
	}
</style>

<div class="wrap">
	<div class="block">
		<a href="/" style="color: greenyellow;">На главную</a>
		<h2>Найти клиента</h2>
		<form class="find-client">
			@csrf
			<input type="text" name="name" placeholder="Имя" class="name"><br>
			<input type="text" name="name" placeholder="Номер машины" class="number">
			<button>Найти</button>
		</form>
		<div class="users"></div>
		<a href="{{route('newclient')}}" class="link">Добавить нового клиента</a>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});
		$('.find-client').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url:'/find',
				type:'POST',
				data: {
					name: $('.name').val(),
					number: $('.number').val()
				},
				success: function(response) {
					if (response != '') {
						$('.users').html(response);
					} else {
						$('.users').html('Клиент не найден');
					}
				},
				error: function() {
					alert('Произошла ошибка')
				}
			});
		})
	});
</script>
</body>
</html>