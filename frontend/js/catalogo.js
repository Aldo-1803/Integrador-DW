document.addEventListener('DOMContentLoaded', async () => {
    const contenedor = document.getElementById('listaProductos');

    try {
        const res = await fetch('http://localhost:8000/api/productos');
        const productos = await res.json();

        if (res.ok && Array.isArray(productos)) {
            if (productos.length === 0) {
                contenedor.innerHTML = '<p>No hay productos cargados.</p>';
                return;
            }

            productos.forEach(producto => {
                const div = document.createElement('div');
                div.className = 'producto';
                div.innerHTML = `
                    <h3>${producto.nombre}</h3>
                    <p>${producto.descripcion}</p>
                    <p><strong>Precio:</strong> $${producto.precio}</p>
                    <p><strong>Stock:</strong> ${producto.stock} unidades</p>
                `;
                contenedor.appendChild(div);
            });
        } else {
            contenedor.innerHTML = '<p>No se pudo cargar el catálogo.</p>';
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        contenedor.innerHTML = '<p>Error al conectar con el servidor.</p>';
    }
});
