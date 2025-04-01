<?php include_once "controllers/forum.php"; ?>
<div class="forum">
    <h1 class="forum__title">Foro</h1>
    <div class="forum__container">
        <!-- 📌 Columna 1: Categorías -->
        <section class="forum__column forum__categories">
            <h2 class="forum__subtitle">Categorías</h2>
            <ul>
                <?php foreach ($categorias as $categoria): ?>
                    <li>
                        <a href="?pag=forum&&categoria_id=<?= $categoria['id'] ?>">
                            <?= htmlspecialchars($categoria['nombre']) ?>
                        </a>

                      
                    </li>
                    <?php if ($es_admin): ?>
                            <!-- Botón Eliminar Categoría con confirmación -->
                            <form method="POST" action="controllers/eliminar_categoria.php" style="display:inline;">

                                <input type="hidden" name="categoria_id" value="<?= $categoria['id'] ?>">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar Categoría</button>
                            </form>

                            <!-- Botón para Cerrar/Abrir creación de temas -->
                            <form method="POST" action="controllers/toggle_temas.php" style="display:inline;">
                                <input type="hidden" name="categoria_id" value="<?= $categoria['id'] ?>">
                                <button type="submit">
                                    <?= $categoria['permitir_crear_temas'] ? 'Cerrar Temas' : 'Abrir Temas' ?>
                                </button>
                            </form>
                        <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <?php if ($es_admin): ?>
                <form method="POST">
                    <input type="text" name="nueva_categoria" placeholder="Nombre de la categoría" required>
                    <button class="button-success" type="submit">Crear Categoría</button>
                </form>
            <?php endif; ?>
        </section>
        <!-- 📌 Columna 2: Temas -->
        <?php if ($categoria_id): ?>
        <section class="forum__column forum__topics">
           

          
            
                <h2>Temas en la categoría seleccionada</h2>

                <ul>
                <?php if (count($temas) > 0): ?>
                    <?php foreach ($temas as $tema): ?>
                        <li>
                            <a href="?pag=forum&categoria_id=<?= $categoria_id ?>&tema_id=<?= $tema['id'] ?>">
                                <?= htmlspecialchars($tema['titulo']) ?>
                            </a>

                           
                        </li>
                        <?php if ($es_admin): ?>
                                <!-- Botón Eliminar Tema con confirmación -->
                                <form method="POST" action="controllers/eliminar_tema.php" style="display:inline;">
                                    <input type="hidden" name="categora_id" value="<?= $_GET["categoria_id"] ?>">
                                    <input type="hidden" name="tema_id" value="<?= $tema['id'] ?>">
                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este tema?')">Eliminar Tema</button>
                                </form>

                                <!-- Botón para Cerrar/Abrir Publicaciones -->
                                <form method="POST" action="controllers/toggle_publicaciones.php" style="display:inline;">
                                    <input type="hidden" name="categora_id" value="<?= $_GET["categoria_id"] ?>">
                                    <input type="hidden" name="tema_id" value="<?= $tema['id'] ?>">
                                    <button type="submit">
                                        <?= $tema['permitir_publicaciones'] ? 'Cerrar Publicaciones' : 'Abrir Publicaciones' ?>
                                    </button>
                                </form>
                            <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay temas en esta categoría.</p>
                <?php endif; ?>
            </ul>



                <?php if ($permitir_crear_temas): ?>
                    <?php if ($es_admin || ($usuario && $categoria_id && in_array($usuario->get_rol(), ['moderador', 'jugador']))): ?>
                        <form method="POST" action="controllers/add_tema.php">
                            <input type="hidden" name="categoria_id" value="<?= $categoria_id ?>">
                            <input type="text" name="titulo_tema" placeholder="Título del tema" required>
                            <textarea name="contenido" class="textarea" required></textarea>
                            <br>
                            <button class="button-success" type="submit">Crear Tema</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            
        </section>
        <?php endif; ?>
        <!-- 📌 Columna 3: Publicaciones -->

        <?php if ($tema_id): ?>
        <section class="forum__column forum__posts">



           
                <h2 class="forum__subtitle">Publicaciones en el tema seleccionado</h2>

                <?php if ($tema_id): ?>
                    <h2>Contenido del Tema</h2>
                    <p><?= nl2br(htmlspecialchars($tema_contenido)) ?></p>
                <?php endif; ?>

                <ul>
                    <?php if (count($publicaciones) > 0): ?>
                        <?php foreach ($publicaciones as $publicacion): ?>
                            <li>
                                <p><strong><?= htmlspecialchars($publicacion['nombre_usuario']) ?>:</strong> <?= htmlspecialchars($publicacion['contenido']) ?></p>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay publicaciones en este tema.</p>
                    <?php endif; ?>
                </ul>


                <?php if ($usuario && $permitir_publicaciones): ?>
                    <form method="POST" action="controllers/add_publicacion.php">
                        <input type="hidden" name="tema_id" value="<?= $tema_id ?>">
                        <textarea name="contenido" placeholder="Escribe tu respuesta..." required></textarea>
                        <button type="submit">Publicar</button>
                    </form>
                <?php elseif (!$permitir_publicaciones): ?>
                    <p><strong>Las publicaciones en este tema están cerradas.</strong></p>
                <?php endif; ?>
            
        </section>
        <?php endif; ?>
    </div>

</div>
