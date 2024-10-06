window.onload = function() {
    cargarProductos();
};

function cargarProductos() {
    const catalogoDiv = document.getElementById('catalogo');
    
    // Llamada AJAX para cargar los productos
    fetch('productos.php')
        .then(response => response.json())
        .then(productos => {
            productos.forEach(producto => {
                const prodDiv = document.createElement('div');
                prodDiv.classList.add('producto');
                prodDiv.innerHTML = `
                    <img src="${producto.imagen}" alt="${producto.nombre}">
                    <h2>${producto.nombre}</h2>
                    <p>${producto.descripcion}</p>
                    <p>Precio: $${producto.precio}</p>
                    <button onclick="agregarCarrito(${producto.id})">Agregar al carrito</button>
                `;
                catalogoDiv.appendChild(prodDiv);
            });
        });
}

function agregarCarrito(productoId) {
    alert(`Producto ${productoId} agregado al carrito.`);
}
