<h2>Editar noticia</h2>

<form action="index.php?page=noticias-administracion&action=editarPost"
      method="POST"
      enctype="multipart/form-data"
      class="crear-form">

    <input type="hidden" name="idNoticia" value="<?= $noticia['idNoticia'] ?>">

    <label>Título *</label>
    <input type="text" name="titulo" value="<?= htmlspecialchars($noticia['titulo']) ?>" required>

    <label>Texto *</label>
    <textarea name="texto" required><?= htmlspecialchars($noticia['texto']) ?></textarea>

    <label>Imagen actual:</label>
    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($noticia['imagen']) ?>" width="150">

    <label>Nueva imagen (opcional):</label>
    <input type="file" name="imagen">

    <button class="crear-btn">Guardar cambios</button>
</form>
