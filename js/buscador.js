document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('buscador');
    if (!input) return;

    const tarjetas = document.querySelectorAll('.tarjeta');
    const sinResultados = document.getElementById('sinResultados');

    input.addEventListener('keyup', function () {
        const texto = input.value.toLowerCase().trim();
        let visibles = 0;

        tarjetas.forEach(function (tarjeta) {
            const contenido = tarjeta.getAttribute('data-buscar').toLowerCase();
            if (contenido.includes(texto)) {
                tarjeta.style.display = '';
                visibles++;
            } else {
                tarjeta.style.display = 'none';
            }
        });

        sinResultados.style.display = visibles === 0 ? 'block' : 'none';
    });
});