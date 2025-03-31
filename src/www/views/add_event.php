<div class="form-card form-card--add_event">
          <div class="form-card__left">
            <img
              src="./assets/images/eventos.jpg"
              alt="Img del evento"
              class="card__image"
              id="preview"
            />
            <div class="button_container">
                <button
              class="card__button"
              type="button"
              onclick="document.getElementById('imageUpload').click(); return false;"
            >
              Seleccionar Imagen
            </button>

            <button class="card__button" type="button" onclick="resetForm()">
              Volver a Imagen Predeterminada
            </button>
            </div>
            
          </div>
          <div class="form-card__right">
            <form
              action="controllers/creat_event_save.php"
              method="POST"
              enctype="multipart/form-data"
            >
              <input
                type="hidden"
                name="imageReset"
                id="imageReset"
                value="0"
              />

              <input
                type="file"
                id="imageUpload"
                name="image"
                accept="image/png, image/jpeg"
                style="display: none"
                onchange="previewImage(event)"
              />

              <input
                type="text"
                name="title"
                class="card__input"
                placeholder="Título"
                required
              />
              <textarea
                name="description"
                class="card__input"
                placeholder="Descripción"
                required
              ></textarea>
              <input
                type="text"
                name="master"
                class="card__input"
                placeholder="organizador"
                required
              />
              <input
                type="number"
                name="players"
                class="card__input"
                placeholder="Número de asistentes"
                required
              />
              <input type="date" name="date" class="card__input" required />
              <div class="card__time-container">
                <label>
                  Inicio
                  <input type="time" name="time" class="card__input" required />
                </label>
                <label>
                  Fin
                  <input
                    type="time"
                    name="end_time"
                    class="card__input"
                    required
                  />
                </label>
              </div>
              <select
                name="mode"
                class="card__input"
                id="mode"
                onchange="toggleLocationField()"
              >
                <option value="online">Online</option>
                <option value="presencial">Presencial</option>
              </select>
              <input
                type="text"
                name="location"
                class="card__input"
                id="location"
                placeholder="Ubicación"
                style="display: none"
              />
              <label class="card__label">
                <input type="checkbox" name="adults" /> Para mayores de 18 años
              </label>
              <button type="submit" class="card__button">Enviar</button>
            </form>
          </div>
        </div>
        <script src="js/add_event.js"></script>