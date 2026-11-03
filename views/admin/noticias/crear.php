<h2>Crear noticia</h2>

<form action="index.php?page=noticias-administracion&action=crearPost"
      method="POST"
      enctype="multipart/form-data"
      class="crear-form">

    <label>Título *</label>
    <input type="text" name="titulo" required>

    <label>Texto *</label>
    <textarea name="texto" required></textarea>

    <label>Imagen *</label>
    <input type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" required>

    <button class="crear-btn">Publicar noticia</button>
</form>
