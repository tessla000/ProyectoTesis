<!DOCTYPE html>
<html>

<head>
    <title>Mensaje Recibido</title>
</head>

<body>
    <p>Recibiste un mensaje de: {{ $msg['nombre'] }} - {{ $msg['email'] }} - {{ $msg['telefono'] }}</p>
    <p><strong>Asunto:</strong>{{ $msg['asunto'] }}</p>
    <p><strong>Contenido: </strong>{{ $msg['mensaje'] }}</p>
</body>

</html>
