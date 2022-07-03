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
		align-items: center;
		width: 100vw;
		min-height: 100vh;
		background: grey;
	}
	.wrap a {
		border: 2px solid white;
		color: white;
		padding: 20px 40px;
		border-radius: 5px;
		outline: none;
	}
</style>

<div class="wrap">
	<a href="{{route('choose')}}">Начать работу</a>
</div>
</body>
</html>