<?php
require_once __DIR__ . '/conexion.php';
$sql = 'SELECT id, nombre, apellido,
dni, email, fecha_registro
FROM estudiantes
ORDER BY id DESC';
$consulta = $conexion->query($sql);
$estudiantes = $consulta->fetchAll(
PDO::FETCH_ASSOC
);

require_once __DIR__ . '/conexion.php';
try {
$sql = 'SELECT id, nombre, apellido,
dni, email, fecha_registro
FROM estudiantes
ORDER BY id DESC';
$consulta = $conexion->query($sql);
$estudiantes = $consulta->fetchAll(
PDO::FETCH_ASSOC
);
} catch (PDOException $e) {
error_log($e->getMessage());
http_response_code(500);
exit('No se pudieron consultar
los estudiantes.');
}
function escaparListado(string $v): string {
return htmlspecialchars(
$v, ENT_QUOTES, 'UTF-8'
);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de estudiantes</title>
</head>
<body><main>
<h1>Listado de estudiantes</h1>
<p><strong>Total:</strong>
<?= count($estudiantes) ?></p>
<?php if (empty($estudiantes)): ?>
<p>No hay estudiantes registrados.</p>
<?php else: ?>
<table>
<thead><tr>
<th>ID</th><th>Nombre</th>
<th>Apellido</th><th>DNI</th>
<th>Email</th><th>Fecha</th>
</tr></thead>
<tbody>
<?php foreach ($estudiantes
as $estudiante): ?>
<tr>
<td><?= escaparListado(
(string)$estudiante['id']
) ?></td>
<td><?= escaparListado(
$estudiante['nombre']
) ?></td>
<td><?= escaparListado(
$estudiante['apellido']
) ?></td>
<td><?= escaparListado(
$estudiante['dni']
) ?></td>
<td><?= escaparListado(
$estudiante['email']
) ?></td>
<td><?= escaparListado(
$estudiante['fecha_registro']
) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
<footer>Profesor Alan Acosta |
<a href="https://alanacosta.site">
alanacosta.site</a>
</footer>
</main></body></html>