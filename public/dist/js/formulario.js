const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	texto: /^[a-zA-Z0-9\_\-\s]{4,30}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
    precio: /^[0-9]+([.][0-9]+)?$/,
    numeros: /^[1-9]{1,3}$/
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "NombProducto":
            validarCampo(expresiones.texto, e.target, 'NombProducto');
        break;
        case "Precio":
            validarCampo(expresiones.precio, e.target, 'Precio');
        break;
        case "Num_Hab":
            validarCampo(expresiones.numeros,e.target, 'Num_Hab');
        break;

       
    }
}

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.remove('fg-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('fg-correcto');
        // Eliminar icono
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
    }else {
        document.getElementById(`grupo__${campo}`).classList.remove('fg-correcto');
        document.getElementById(`grupo__${campo}`).classList.add('fg-incorrecto');
        // Eliminar icono   
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');

        if (input.value.length === 0){
            document.getElementById(`grupo__${campo}`).classList.remove('fg-incorrecto');
            document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
            document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        }
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
});