    
    const filtroSelect = document.getElementById('filtro2');
    const filtroInput = document.getElementById('filtro');
    const tabla = document.getElementById('miTabla');
    const filas = tabla.getElementsByTagName('tr');
    
    filtroSelect.addEventListener('change', function() {
        const filtro = filtroSelect.value.toLowerCase();
       
        for (let i = 1; i < filas.length; i++) { // Empezar desde 1 para omitir la fila de encabezado
            const fila = filas[i];
            const celdaNombre = fila.getElementsByTagName('td')[0]; // Primera celda de la fila (columna "Nombre")
            if (celdaNombre) {
                const texto = celdaNombre.textContent.toLowerCase();
                if (texto.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            }
        }
    });

    filtroInput.addEventListener('input', function() {
        const filtro = filtroInput.value.toLowerCase();

        // Iterar a través de las filas de la tabla y mostrar/ocultar según el filtro
        for (let i = 1; i < filas.length; i++) { // Empezar desde 1 para omitir la fila de encabezado
            const fila = filas[i];
            const celdaNombre = fila.getElementsByTagName('td')[0]; // Primera celda de la fila (columna "Nombre")
            if (celdaNombre) {
                const texto = celdaNombre.textContent.toLowerCase();
                if (texto.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            }
        }
    });
