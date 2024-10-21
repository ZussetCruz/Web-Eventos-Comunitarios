<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Eventos Comunitarios</title>
	<link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>

<?php
include('config.php');

$SqlEventos   = ("SELECT * FROM eventoscalendar");
$resulEventos = mysqli_query($con, $SqlEventos);
?>
<div class="mt-5"></div>

<div class="container">
	<div class="row">
		<div class="col-md-12 mb-3 text-right">
			<a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
			<a href="info.php" class="btn btn-info">Más Información</a>
			<a href="contacto.php" class="btn btn-info">Contacto</a>
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col msjs">
			<?php include('msjs.php'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 mb-3">
			<h3 class="text-center" id="title">Eventos Comunitarios</h3>
		</div>
	</div>
</div>

<div id="calendar"></div>

<!-- Formulario para agregar comentario -->
<div class="container mt-5">
    <h4>Deja tu comentario:</h4>
    <form action="procesar_comentario.php" method="POST">
        <div class="form-group">
            <label for="comentario">Comentario:</label>
            <textarea name="comentario" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar comentario</button>
    </form>
</div>

<!-- Mostrar comentarios -->
<div class="container mt-5">
    <h4>Comentarios:</h4>
    <?php
    $sqlComentarios = "SELECT c.comentario, c.fecha, u.nombre
                       FROM comentarios c
                       JOIN usuarios u ON c.id_usuario = u.id
                       ORDER BY c.fecha DESC";
    $resultComentarios = mysqli_query($con, $sqlComentarios);

    if (mysqli_num_rows($resultComentarios) > 0) {
        while ($comentario = mysqli_fetch_assoc($resultComentarios)) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$comentario['nombre']}</h5>";
            echo "<p class='card-text'>{$comentario['comentario']}</p>";
            echo "<p class='card-text'><small class='text-muted'>Comentado el {$comentario['fecha']}</small></p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay comentarios aún. Sé el primero en comentar!</p>";
    }
    ?>
</div>


<!-- Modal para mostrar información del evento y registrar al usuario -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Información del Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="eventName"></span></p>
                <p><strong>Fecha de Inicio:</strong> <span id="eventStart"></span></p>
                <p><strong>Fecha de Fin:</strong> <span id="eventEnd"></span></p>
                <p><strong>Ubicación:</strong> <span id="eventLocation"></span></p>

				<p><strong>Registrados:</strong></p>
				<ul id="usuariosRegistrados"></ul>

                <!-- Formulario para registrarse en el evento -->
                <form action="registrar_evento.php" method="POST">
                    <input type="hidden" name="id_evento" id="id_evento" value="">
                    <button type="submit" class="btn btn-primary mt-3">Registrarse en el Evento</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/fullcalendar.min.js"></script>
<script src='locales/es.js'></script>

<script type="text/javascript">
$(document).ready(function() {
	$("#calendar").fullCalendar({
		header: {
			left: "prev,next today",
			center: "title",
			right: "month,agendaWeek,agendaDay"
		},
		locale: 'es',
		defaultView: "month",
		navLinks: true,
		editable: false,
		eventLimit: true,
		selectable: false,

		events: [
			<?php while ($dataEvento = mysqli_fetch_array($resulEventos)) { ?>
				{
					_id: '<?php echo $dataEvento['id']; ?>',
					title: '<?php echo $dataEvento['evento']; ?>',
					start: '<?php echo $dataEvento['fecha_inicio']; ?>',
					end: '<?php echo $dataEvento['fecha_fin']; ?>',
					color: '<?php echo $dataEvento['color_evento']; ?>',
					ubicacion: '<?php echo $dataEvento['ubicacion']; ?>'
				},
			<?php } ?>
		],

		eventClick: function(event) {
			$('#eventName').text(event.title);
			$('#eventStart').text(event.start.format('DD-MM-YYYY'));
			$('#eventEnd').text(event.end.format('DD-MM-YYYY'));
			$('#eventLocation').text(event.ubicacion);
			$('#id_evento').val(event._id);

			// Mostrar usuarios registrados
			$.ajax({
        	url: 'obtener_registrados.php',
        	type: 'POST',
        	data: { id_evento: event._id },
        	success: function(data) {
            $('#usuariosRegistrados').html(data);}
			});

    		// Debugging: Verificar el ID del evento
    		console.log("ID del Evento:", event._id);

			$('#eventModal').modal('show');
		}
	});

	setTimeout(function () {
		$(".alert").slideUp(300);
	}, 3000);
});
</script>
</body>
</html>
