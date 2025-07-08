document.addEventListener("DOMContentLoaded", async () => {
    const usuarioId = localStorage.getItem("usuario_id");
    const nombre = localStorage.getItem("usuario_nombre");

    const bienvenida = document.getElementById("bienvenida");
    const listaTurnos = document.getElementById("listaTurnos");

    if (!nombre || !usuarioId) {
        alert("Sesión expirada. Por favor, iniciá sesión nuevamente.");
        window.location.href = "iniciarSesion.html";
        return;
    }

    // Mostrar saludo
    bienvenida.textContent = `Bienvenido/a ${nombre}`;

    // Funciones de navegación
    window.irASolicitarTurno = () => window.location.href = "solicitarTurno.html";
    window.irACatalogo = () => window.location.href = "catalogo.html";
    window.cerrarSesion = () => {
        localStorage.clear();
        window.location.href = "iniciarSesion.html";
    };

    // Obtener turnos pendientes del backend
    try {
        const res = await fetch(`http://localhost:8000/api/turnos/${usuarioId}`);
        const turnos = await res.json();

        if (res.ok && Array.isArray(turnos) && turnos.length > 0) {
            turnos.forEach(turno => {
                const li = document.createElement("li");
                li.textContent = `${turno.fecha} - ${turno.hora}hs - ${turno.servicio.nombre}`;
                listaTurnos.appendChild(li);
            });
        } else {
            listaTurnos.innerHTML = "<li>No tenés turnos pendientes.</li>";
        }
    } catch (error) {
        listaTurnos.innerHTML = "<li>Error al cargar los turnos.</li>";
        console.error("Error al obtener turnos pendientes:", error);
    }
});
