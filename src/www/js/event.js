function eliminarJugador(nombre) {
  if (confirm(`¿Seguro que quieres eliminar a ${nombre}?`)) {
    fetch("controllers/eliminar_jugador.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `nombre=${encodeURIComponent(nombre)}`,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
        location.reload();
      })
      .catch((error) => console.error("Error:", error));
  }
}

function eliminarEvento(eventoId) {
  if (confirm("¿Seguro que quieres eliminar este evento?")) {
    fetch("controllers/eliminar_evento.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${eventoId}`,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data);
        window.location.href = "index.php?pag=show_events"; // Redirigir a la página principal
      })
      .catch((error) => console.error("Error:", error));
  }
}
