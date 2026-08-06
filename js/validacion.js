document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.querySelector('form');

    if (formulario) {
        formulario.addEventListener('submit', function (e) {
            const comentario = document.querySelector('[name="comentario"]').value.trim();

            if (comentario.length < 10) {
                e.preventDefault(); 
                alert('Por favor, escribe un comentario de al menos 10 caracteres.');
            }
        });
    }
});