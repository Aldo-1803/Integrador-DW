document.getElementById('formRegistro').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const data = {
        nombre: form.nombre.value,
        apellido: form.apellido.value,
        correo_electronico: form.correo_electronico.value,
        contraseña: form.contraseña.value,
        telefono: form.telefono.value,
        red_social: form.red_social.value,
        fecha_nacimiento: form.fecha_nacimiento.value,
    };

    try {
        const response = await fetch('http://localhost:8000/api/registro', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            document.getElementById('mensaje').textContent = result.mensaje;
        } else {
            document.getElementById('mensaje').textContent = 'Error: ' + JSON.stringify(result);
        }
    } catch (error) {
        document.getElementById('mensaje').textContent = 'Error de conexión con el servidor';
    }
});