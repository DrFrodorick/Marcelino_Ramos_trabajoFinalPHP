<?php if (isset($_GET["msg"]) && $_GET["msg"] === "creado_ok"): ?>
    <p class="alerta-ok">✔ Noticia creada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "editado_ok"): ?>
    <p class="alerta-ok">✔ Noticia editada correctamente.</p>
<?php endif; ?>

<?php if (isset($_GET["msg"]) && $_GET["msg"] === "borrado_ok"): ?>
    <p class="alerta-ok">✔ Noticia eliminada correctamente.</p>
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
