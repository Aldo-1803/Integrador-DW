document.addEventListener('DOMContentLoaded', async function () {
    const selectServicio = document.getElementById('servicio');
    const formulario = document.getElementById('turnoForm');
    const mensaje = document.getElementById('mensajeTurno');

    // Cargar servicios desde la API
    try {
        const res = await fetch('http://localhost:8000/api/servicios');
        const servicios = await res.json();

        if (res.ok && Array.isArray(servicios)) {
            servicios.forEach(servicio => {
                const option = document.createElement('option');
                option.value = servicio.id;
                option.textContent = `${servicio.nombre} (${servicio.duracion_estimada} min)`;
                selectServicio.appendChild(option);
            });
        } else {
            mensaje.textContent = "No se pudieron cargar los servicios.";
        }
    } catch (error) {
        mensaje.textContent = "Error de conexión al cargar servicios.";
        console.error(error);
    }

    // Envío del formulario
    formulario.addEventListener('submit', async function (e) {
        e.preventDefault();

        const usuarioId = localStorage.getItem('usuario_id');

        if (!usuarioId) {
            mensaje.textContent = "No se encontró el usuario. Por favor, iniciá sesión.";
            return;
        }

        const data = {
            usuario_id: usuarioId,
            servicio_id: selectServicio.value,
            fecha: formulario.fecha.value,
            hora: formulario.hora.value
        };

        try {
            const res = await fetch('http://localhost:8000/api/turno', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const contentType = res.headers.get('content-type');

            // Verificar si la respuesta es JSON
            if (!contentType || !contentType.includes('application/json')) {
                const text = await res.text();  // leer como texto
                console.error("Respuesta inesperada del servidor:", text);
                mensaje.textContent = "⚠️ El servidor respondió con un formato no válido.";
                return;
            }

            const json = await res.json(); // ahora sí podemos parsear

            if (res.ok) {
                mensaje.textContent = "✅ Turno solicitado con éxito.";
                formulario.reset();
            } else {
                mensaje.textContent = json?.mensaje || "Error al solicitar el turno.";
            }
        } catch (error) {
            mensaje.textContent = "Error de conexión con el servidor.";
            console.error(error);
        }
    });
});