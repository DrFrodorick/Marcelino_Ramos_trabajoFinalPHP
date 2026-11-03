<?php if (isset($_GET["msg"]) && $_GET["msg"] === "creado_ok"): ?>
    <p class="alerta-ok">✔ Noticia creada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "editado_ok"): ?>
    <p class="alerta-ok">✔ Noticia editada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "borrado_ok"): ?>
    <p class="alerta-ok">✔ Noticia eliminada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "error_imagen"):
    $motivos = [
        "tamano"  => "La imagen pesa más de 2 MB.",
        "tipo"    => "El archivo no es una imagen válida (solo JPG, PNG, WebP o GIF).",
        "guardar" => "El servidor no pudo guardar la imagen en la carpeta uploads.",
    ];
    $motivo = $_GET["motivo"] ?? "";
    $texto = $motivos[$motivo] ?? "Error al subir el archivo (código: " . htmlspecialchars($motivo) . ").";
?>
    <p class="mensaje-error">✖ No se pudo guardar la noticia. <?= $texto ?></p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "error_crear"): ?>
    <p class="mensaje-error">✖ No se pudo crear la noticia. Comprueba que el título no esté repetido.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "error_editar"): ?>
    <p class="mensaje-error">✖ No se pudo editar la noticia.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "error_borrar"): ?>
    <p class="mensaje-error">✖ No se pudo eliminar la noticia.</p>
<?php endif; ?>

<div class="crear-usuario-container">
    <a class="crear-usuario-btn"
       href="index.php?page=noticias-administracion&action=crear">
        Crear noticia
    </a>
</div>

<h2>Lista de noticias</h2>

<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Fecha</th>
            <th>Autor</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($n = $noticias->fetch_assoc()): ?>
        <tr>
            <td><?= $n['idNoticia'] ?></td>
            <td><?= htmlspecialchars($n['titulo']) ?></td>
            <td><?= htmlspecialchars($n['fecha']) ?></td>
            <td><?= htmlspecialchars($n['idUser']) ?></td>

            <td>
                <a href="index.php?page=noticias-administracion&action=editar&id=<?= $n['idNoticia'] ?>"
                   class="btn-small">Editar</a>

                <a href="index.php?page=noticias-administracion&action=borrar&id=<?= $n['idNoticia'] ?>"
                   class="btn-small eliminar-btn">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
