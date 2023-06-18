// Función para validar el formulario antes de enviarlo
function validarFormulario(event) {
    event.preventDefault();

    var password = document.getElementById('password').value;

    if (password.length < 4 || password.length > 8) {
        alert("La contraseña debe tener entre 4 y 8 caracteres.");
        return false;
    }

    document.getElementById('registroForm').submit();
}

// Función para limpiar el formulario
function limpiarFormulario() {
    document.getElementById('registroForm').reset();
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('registroForm').addEventListener('submit', validarFormulario);
    document.getElementById('registroForm').addEventListener('reset', limpiarFormulario);
});
