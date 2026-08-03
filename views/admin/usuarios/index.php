<h2>Lista de usuarios</h2>
<div class="crear-usuario-container">
    <a class="crear-usuario-btn" 
       href="index.php?page=usuarios-administracion&action=crear">
        Crear usuario
    </a>
</div>


<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($u = $usuarios->fetch_assoc()): ?>
            
        <tr>
            <td><?= $u['idUser'] ?></td>
            <td><?= htmlspecialchars($u['nombre']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['rol']) ?></td>
            <td>
                <a class="btn-small" href="index.php?page=usuarios-administracion&action=editar&id=<?= $u['idUser'] ?>">Editar</a>
                <a class="btn-small eliminar-btn" href="index.php?page=usuarios-administracion&action=borrar&id=<?= $u['idUser'] ?>">Borrar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
  

</table>
