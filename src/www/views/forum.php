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
                                    <?= htmlspecialchars("(" . $tema['nombre_usuario']) . ")" ?>

                                </a>


                            </li>

                            <?php if ($es_admin || $es_moderador || $usuario->get_nombre_usuario() === $tema['nombre_usuario']): ?>
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


                <!-- aqui tiene que ser el titulo del post -->

                <h2 class="forum__subtitle"> <?= $tema_titulo ?> </h2>

                <?php if ($tema_id): ?>
                    <h2>Autor: <?= $nombre_usuario ?></h2>
                    <p class="forum__post__descripcion"><?= nl2br(htmlspecialchars($tema_contenido)) ?></p>
                <?php endif; ?>

                <ul>
                    <?php if (count($publicaciones) > 0): ?>
                        <?php foreach ($publicaciones as $publicacion): ?>
                            <li>
                                <p class="forum__post__descripcion"><strong><?= htmlspecialchars($publicacion['nombre_usuario']) ?>:</strong> <?= htmlspecialchars($publicacion['contenido']) ?></p>


                            </li>

                          
                            <!-- Botón Me gusta con icono de Font Awesome -->
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="publicacion_id" value="<?= $publicacion['id'] ?>">
                                <?php
                                $stmt = $pdo->prepare("SELECT * FROM me_gustas WHERE publicacion_id = :publicacion_id AND usuario_id = :usuario_id");
                                $stmt->execute([
                                    ':publicacion_id' => $publicacion['id'],
                                    ':usuario_id' => $usuario->get_id()
                                ]);
                                $me_gusta = $stmt->fetch();
                                ?>
                                <?php if ($me_gusta): ?>
                                    <button type="submit" name="dar_me_gusta" class="button--dislike">
                                        <i class="fas fa-heart"></i> Ya no me gusta
                                    </button>
                                <?php else: ?>
                                    <button type="submit" name="dar_me_gusta" class="button--like">
                                        <i class="far fa-heart"></i> Me gusta
                                    </button>
                                <?php endif; ?>
                            </form>
                                <!-- boton para eliminar -->

                                <?php if ($es_moderador || $es_admin || $publicacion["nombre_usuario"] === $usuario->get_nombre_usuario()): ?>
                                <form method="POST" action="controllers/delete_publicacion.php" style="display:inline;">
                                    <input type="hidden" name="categoria_id" value="<?= $_GET["tema_id"] ?>">
                                    <input type="hidden" name="tema_id" value="<?= $_GET["tema_id"] ?>">
                                    <input type="hidden" name="publicacion_id" value="<?= $publicacion['id'] ?>">
                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?')">Eliminar</button>
                                </form>
                            <?php endif; ?>

                            <?php
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM me_gustas WHERE publicacion_id = :publicacion_id");
                            $stmt->execute([':publicacion_id' => $publicacion['id']]);
                            $me_gustas_count = $stmt->fetchColumn();
                            ?>
                            <p class="forum__post__descripcion"><?= $me_gustas_count ?> <i class="fas fa-heart" style="color: var(--button-bg-color-danger);"></i></p>

                        



                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay publicaciones en este tema.</p>
                    <?php endif; ?>
                </ul>


                <?php if ($usuario && $permitir_publicaciones): ?>
                    <?php if (!$es_visitante): ?>
                        <form method="POST" action="controllers/add_publicacion.php">
                            <input type="hidden" name="tema_id" value="<?= $tema_id ?>">
                            <textarea name="contenido" placeholder="Escribe tu respuesta..." required></textarea>
                            <button type="submit">Publicar</button>
                        </form>
                    <?php endif; ?>
                <?php elseif (!$permitir_publicaciones): ?>
                    <p><strong>Las publicaciones en este tema están cerradas.</strong></p>
                <?php endif; ?>

            </section>
        <?php endif; ?>
    </div>

</div>