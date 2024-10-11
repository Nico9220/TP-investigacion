// Método personalizado para verificar que la contraseña no sea igual al usuario
$.validator.addMethod("distintoA", function (value, element, param) {
    return this.optional(element) || value !== $(param).val();
});

// Método personalizado para verificar que el input solo contenga letras y números
$.validator.addMethod("letrasNumeros", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
});

// Método personalizado para verificar que el input respete el formato de fecha (AAAA-MM-DD)
$.validator.addMethod("formatoFecha", function (value, element) {
    return this.optional(element) || /^\d{4}-\d{2}-\d{2}$/.test(value);
});

// Método personalizado para verificar que el input respete el formato de teléfono (000-000000...)
jQuery.validator.addMethod("formatoTelefono", function (value, element) {
    return this.optional(element) || /^(\d{3})-(\d{1,16})$/.test(value);
});

// Método personalizado para verificar que el input de teléfono solo permita ingresar números y guión alto
jQuery.validator.addMethod("caracteresPermitidos", function (value, element) {
    return this.optional(element) || /^[\d-]+$/.test(value);
});

// Método personalizado para verificar que el input solo permita ingresar letras
$.validator.addMethod("soloLetras", function (value, element) {
    return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
});

// Método personalizado para validar que la fecha exista y respete los años bisiestos
$.validator.addMethod("fechaReal", function (value, element) {
    var esValida = false;
    // Convierto la cadena de la fecha a un objeto Date
    var convertirFecha = new Date(value);
    // Verifico si la fecha es válida
    if (Object.prototype.toString.call(convertirFecha) === "[object Date]" && !isNaN(convertirFecha.getTime())) {
        esValida = true;
    }
    return this.optional(element) || esValida;
});

// Método personalizado para validar que la fecha sea menor a la fecha actual
$.validator.addMethod("fechaNacValida", function (value, element) {
    // Obtengo fecha actual
    var fechaActual = new Date();
    // Extraigo fecha ingresada
    var fechaIngresada = new Date(value);

    // Verifico si la fecha ingresada es menor
    return this.optional(element) || fechaIngresada < fechaActual;
});

// Método personalizado para validar que el formato de la patente ingresada
$.validator.addMethod("formatoPatente", function (value, element) {
    var formato = /^[A-Za-z]{3} [0-9]{3}$/;
    return this.optional(element) || formato.test(value);
});

// Método personalizado para validar que solo se ingresen letras, números y tildes
$.validator.addMethod("formatoDomicilio", function (value, element) {
    var formato = /^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]+$/;
    return this.optional(element) || formato.test(value);
});

$(function () {

    $("#form").validate({
        rules: {
            //Reglas de validación
            numero: {
                required: true,
            },
            edad: {
                required: true,
                digits: true,
                min: 0,
                max: 120
            },
            nombre: {
                required: true,
                maxlength: 50,
                soloLetras: true,
            },
            apellido: {
                required: true,
                maxlength: 50,
                soloLetras: true,
            },
            direccion: {
                required: true,
            },
            estudios: {
                required: true,
            },
            hsLunes: {
                required: true,
                min: 0,
                max: 24
            },
            hsMartes: {
                required: true,
                min: 0,
                max: 24
            },
            hsMiercoles: {
                required: true,
                min: 0,
                max: 24
            },
            hsJueves: {
                required: true,
                min: 0,
                max: 24
            },
            hsViernes: {
                required: true,
                min: 0,
                max: 24
            },
            usuario: {
                required: true,
            },
            pass: {
                required: true,
                letrasNumeros: true,
                minlength: 8,
                distintoA: "#usuario"
            },
            archivo: {
                required: true,
            },
            patente: {
                required: true,
                maxlength: 10,
                formatoPatente: true,
            },
            dniDuenio: {
                required: true,
                digits: true,
                min: 8,
                maxlength: 10,
            },
            nroDni: {
                required: true,
                digits: true,
                min: 8,
                maxlength: 10,
            },
            fechaNac: {
                required: true,
                formatoFecha: true,
                fechaReal: true,
                fechaNacValida: true,
            },
            telefono: {
                required: true,
                maxlength: 20,
                formatoTelefono: true,
                caracteresPermitidos: true,
            },
            domicilio: {
                required: true,
                maxlength: 200,
                formatoDomicilio: true,
            },
            marca: {
                required: true,
                maxlength: 50,
            },
            modelo: {
                required: true,
                digits: true,
                min: 2,
                maxlength: 4,
            }
        },
        //Mensajes de error
        messages: {
            numero: {
                required: "<p class='text-danger'>Debe ingresar un número</p>",
            },
            edad: {
                required: "<p class='text-danger'>Debe ingresar una edad</p>",
                digits: "<p class='text-danger'>Ingrese números enteros</p>",
                min: "<p class='text-danger'>Ingrese una edad válida</p>",
                max: "<p class='text-danger'>Ingrese una edad válida</p>",
            },
            nombre: {
                required: "<p class='text-danger'>Debe ingresar un nombre</p>",
                maxlength: "<p class='text-danger'>Máximo 50 caracteres</p>",
                soloLetras: "<p class='text-danger'>Ingrese un nombre válido</p>",
            },
            apellido: {
                required: "<p class='text-danger'>Debe ingresar un apellido</p>",
                maxlength: "<p class='text-danger'>Máximo 50 caracteres</p>",
                soloLetras: "<p class='text-danger'>Ingrese un apellido válido</p>",
            },
            direccion: {
                required: "<p class='text-danger'>Debe ingresar una dirección</p>",
            },
            estudios: {
                required: "<p class='text-danger'>Seleccione una opción</p>",
            },
            hsLunes: {
                required: "<p class='text-danger'>Complete el campo</p>",
                min: "<p class='text-danger'>Ingrese horas válidas</p>",
                max: "<p class='text-danger'>Máximo 24 horas</p>",
            },
            hsMartes: {
                required: "<p class='text-danger'>Complete el campo</p>",
                min: "<p class='text-danger'>Ingrese horas válidas</p>",
                max: "<p class='text-danger'>Máximo 24 horas</p>",
            },
            hsMiercoles: {
                required: "<p class='text-danger'>Complete el campo</p>",
                min: "<p class='text-danger'>Ingrese horas válidas</p>",
                max: "<p class='text-danger'>Máximo 24 horas</p>",
            },
            hsJueves: {
                required: "<p class='text-danger'>Complete el campo</p>",
                min: "<p class='text-danger'>Ingrese horas válidas</p>",
                max: "<p class='text-danger'>Máximo 24 horas</p>",
            },
            hsViernes: {
                required: "<p class='text-danger'>Complete el campo</p>",
                min: "<p class='text-danger'>Ingrese horas válidas</p>",
                max: "<p class='text-danger'>Máximo 24 horas</p>",
            },
            usuario: {
                required: "<p class='text-danger'>Campo requerido</p>"
            },
            pass: {
                required: "<p class='text-danger'>Campo requerido</p>",
                letrasNumeros: "<p class='text-danger'>Ingrese solo números y letras</p>",
                minlength: "<p class='text-danger'>La contraseña debe tener mínimo 8 caracteres</p>",
                distintoA: "<p class='text-danger'>La contraseña no debe coincidir con el nombre de usuario</p>"
            },
            archivo: {
                required: "<p class='text-danger'>Suba un archivo</p>",
            },
            patente: {
                required: "<p class='text-danger'>Campo requerido</p>",
                maxlength: "<p class='text-danger'>Máximo 10 caracteres</p>",
                formatoPatente: "<p class='text-danger'>Respete el formato (3 letras, espacio, 3 números)</p>",
            },
            dniDuenio: {
                required: "<p class='text-danger'>Campo requerido</p>",
                digits: "<p class='text-danger'>Ingrese números</p>",
                min: "<p class='text-danger'>Mínimo 8 números</p>",
                maxlength: "<p class='text-danger'>Máximo 10 números</p>",
            },
            nroDni: {
                required: "<p class='text-danger'>Campo requerido</p>",
                digits: "<p class='text-danger'>Ingrese solo números</p>",
                min: "<p class='text-danger'>Mínimo 8 números</p>",
                maxlength: "<p class='text-danger'>Máximo 10 números</p>",
            },
            fechaNac: {
                required: "<p class='text-danger'>Campo requerido</p>",
                formatoFecha: "<p class='text-danger'>Respete el formato AAAA-MM-DD</p>",
                fechaReal: "<p class='text-danger'>La fecha ingresada no existe</p>",
                fechaNacValida: "<p class='text-danger'>La fecha de nacimiento no puede ser mayor que la actual</p>",
            },
            telefono: {
                required: "<p class='text-danger'>Campo requerido</p>",
                maxlength: "<p class='text-danger'>Máximo 20 números</p>",
                formatoTelefono: "<p class='text-danger'>Por favor, ingresa un número de teléfono en el formato xxx-xxxxx...</p>",
                caracteresPermitidos: "<p class='text-danger'>Ingrese un número de teléfono válido</p>",
            },
            domicilio: {
                required: "<p class='text-danger'>Campo requerido</p>",
                maxlength: "<p class='text-danger'>Máximo 200 caracteres</p>",
                formatoDomicilio: "<p class='text-danger'>Utilice solo letras, números y tildes</p>",
            },
            marca: {
                required: "<p class='text-danger'>Campo requerido</p>",
                maxlength: "<p class='text-danger'>Máximo 50 caracteres</p>",
            },
            modelo: {
                required: "<p class='text-danger'>Campo requerido</p>",
                digits: "<p class='text-danger'>Ingrese solo números</p>",
                min: "<p class='text-danger'>Mínimo 2 números</p>",
                maxlength: "<p class='text-danger'>Máximo 4 números</p>",
            }
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
            $(element).removeClass("is-valid");
            $(element).css("border-color", "red");
        },
        unhighlight: function (element) {
            $(element).addClass('is-valid');
            $(element).removeClass("is-invalid");
            $(element).css("border-color", "");
        },
        errorPlacement: function (error, element) {
            // Inserta el mensaje de error en el contenedor .mensaje-error
            error.appendTo(element.closest('.mb-1').find('.mensaje-error'));
        }
    });
});
