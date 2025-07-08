document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const data = {
        correo_electronico: form.correo_electronico.value,
        contraseña: form.contraseña.value
    };

    try {
        const respuesta = await fetch("http://localhost:8000/api/login", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data) 
        });

        const json = await respuesta.json();

        if (respuesta.ok) {
            // Guardar nombre e ID en localStorage
            localStorage.setItem("usuario_nombre", json.usuario.nombre);
            localStorage.setItem("usuario_id", json.usuario.id);

            // Redirigir al panel
            window.location.href = "panel.html";
        } else {
             document.getElementById("mensajeLogin").textContent = json?.mensaje || "Error al iniciar sesión";
        }
    } catch (error) {
        document.getElementById("mensajeLogin").textContent = "Error de conexión con el servidor";
    }
});