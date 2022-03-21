
 //alert('Hola Mundo -no quiero quitarlo')
async function obtener_datos_grupo(id_grupo){
    
    var enlace="grupos/obtener_datos_grupo/"+id_grupo;
    var nomP="users";
    var modCont= document.getElementById("contenidoModalGrupo")
    
    
    var modtitle= document.getElementById("ModalTitler")
//window.open(enlace)

        await fetch(enlace)
        .then(response => response.text())
        .then(data => nomP = data)
        .catch( err => console.error(err));




    
    

    var users="";
    nomP[1].forEach(usrr => {
        //console.log(usrr);
         users+=usrr['nombre']+" "+usrr['apellido']+" <a href=\"\" class=\"btn btn-primary\">Disable (WIP)</a><br>";
    });

    modtitle.innerHTML=nomP[0]['nombre'];
    modCont.innerHTML=users;
    
          
};

// to do
    // function close_modal_manually(elementor) {
    //     if (elementor.includes(" ")) {
    //         console.log()
    //     }else {
            
    //     }
    //     var modall = document.getElementById("Modal_Agregar")
    //     var modal = bootstrap.Modal.getInstance(modall)
    //     modal.hide();
    // }



async function cargar_tabla_usuario(){
    var tabla=document.getElementById("tabla_usuarios");
    tabla.innerHTML="";


    var enlace="usuarios/actualizar_tabla/"

    await fetch(enlace)
    .then(response => response.text())
    .then(data => nomP = data)
    .catch( err => {

        alert("Error al actualizar el usuario")
        console.error(err)
        





    });

    //console.log(nomP);
    tabla.innerHTML=nomP;
}



//comprobar correo/dni/cc/telef?/pass/nom apel/



/*
recibe un elemento, normalmente de tipo input y un booleano 

cambia los estilos del elemento para indicar si lo introducido es o no valido (aqui llega el resultado de la comprobacion) 
*/
function change_valid_style(elementor, bol){
    var class_def="form-control form-control-lg";
    var clas_invalid=class_def+" is-invalid";
    var clas_valid=class_def+" is-valid";


    if (bol) {
        elementor.removeAttribute("class")
        var clas_valid=class_def+" is-valid"
        elementor.setAttribute("class",clas_valid)
        return true;
    } else {
        elementor.removeAttribute("class")
        var clas_invalid=class_def+" is-invalid"
        elementor.setAttribute("class",clas_invalid)
        return false;
    }
}




function comprobar_correo(elementor) {
    var class_def="form-control form-control-lg"

    let emailregex=/[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+[.]{1}[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+/
    
    

    return change_valid_style(elementor, emailregex.test(elementor.value))
    
}



//comprueba si la cadena de texto que llega es un dni valido
function valid_dni(dni_comp){
    var letras=['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
    var numdni=dni_comp.substr(0,8);
        var letradni=dni_comp.substr(8,9);
        
        var rest=numdni%23;
        if (letradni == letras[rest]) {
            return true;
        }else{
            return false;
        }
}
//comprueba si la cadena de texto que llega es un nie valido
function valid_nie(dni_comp){
    var letras=['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
    var primera_letra=dni_comp.substr(0,1);
    if (primera_letra == "X") {
        primera_letra="0"
    }else if (primera_letra == "Y") {
        primera_letra="1"
    }else if (primera_letra == "Z") {
        primera_letra="2"
    }

    var numdni=primera_letra+dni_comp.substr(1,8);
    numdni=parseInt(numdni)
    var letradni=dni_comp.substr(8,9);
    
    var rest=numdni%23;
    
    if (letradni == letras[rest]) {
        return true;
    }else{
        return false;
    }
}
//comprueba si la cadena de texto que llega es un cif valido
function valid_cif(cif){
    
	var letters = ['J', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
	var digits = cif.substr(1, cif.length - 2);
	var letter = cif.substr(0, 1);
	var control = cif.substr(cif.length - 1);
	var sum = 0;
    var i;
	var digit;

	for (i = 0; i < digits.length; ++i) {
		digit = parseInt(digits[i]);

		if (isNaN(digit)) {
			return false;
		}

		if (i % 2 === 0) {
			digit *= 2;
			if (digit > 9) {
				digit = parseInt(digit / 10) + (digit % 10);
			}

			sum += digit;
		} else {
			sum += digit;
		}
	}

	sum %= 10;
	if (sum !== 0) {
		digit = 10 - sum;
	} else {
		digit = sum;
	}

	return String(digit) === control || letters[digit] === control;
}

/*
                        !!CAMBIAR NOMBRE!!
*/
function comprobar_dni(elementor) {
    var dni_comp=elementor.value.toUpperCase();
    dni_comp.trim();

    let regex_dni=/[0-9]{8}[A-Z]{1}/;
    let regex_nie=/[X-Z]{1}[0-9]{7}[A-Z]{1}/;
    let regex_cif=/[ABCDEFGHKLMNPQS]{1}[0-9]{7}[A-Z0-9]{1}/;


    

    if (regex_dni.test(dni_comp)) {
        
        
        return change_valid_style(elementor, valid_dni(dni_comp))

    } else if (regex_nie.test(dni_comp) || regex_cif.test(dni_comp)) {
        
        if (valid_nie(dni_comp)) {
            return change_valid_style(elementor, true)

        }else if(valid_cif(dni_comp)){
            return change_valid_style(elementor, true)

        }else{
            return change_valid_style(elementor, false)

        }

    }else{
        return change_valid_style(elementor, false)
    }
  
}


function comprobar_nombres(elementor){
    var nom_comp=elementor.value;
    nom_comp.trim();

    let regex_nom=/^[A-Za-z\s]+$/
    
    return change_valid_style(elementor, regex_nom.test(nom_comp))
}

function comprobar_fecha(elementor){
    var fech_comp=elementor.value;
    
    let regex_fech=/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/
    
    return change_valid_style(elementor, regex_fech.test(fech_comp))
}

function comprobar_telefono(elementor) {
    var telef_comp=elementor.value;
    telef_comp.trim();

    let regex_telef=/[+]?[0-9]{9,}/

    return change_valid_style(elementor, regex_telef.test(telef_comp))
}

/////////

function modulo97(iban) {
    var parts = Math.ceil(iban.length/7);
    var remainer = "";

    for (var i = 1; i <= parts; i++) {
        remainer = String(parseFloat(remainer+iban.substr((i-1)*7, 7))%97);
    }

    return remainer;
}

function getnumIBAN(letra) {
    ls_letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return ls_letras.search(letra) + 10;
}


function validarIBAN(elementor) {
    var IBAN = elementor.value
    IBAN.trim()
    //Se pasa a Mayusculas
    IBAN = IBAN.toUpperCase();
    //Se quita los blancos de principio y final.
    IBAN = IBAN.trim();
    IBAN = IBAN.replace(/\s/g, ""); //Y se quita los espacios en blanco dentro de la cadena

    var letra1,letra2,num1,num2;
    var isbanaux;
    var numeroSustitucion;
    isValid=false
    //La longitud debe ser siempre de 24 caracteres
    if (IBAN.length != 24) {
        isValid=false;
    }

    // Se coge las primeras dos letras y se pasan a números
    letra1 = IBAN.substring(0, 1);
    letra2 = IBAN.substring(1, 2);
    num1 = getnumIBAN(letra1);
    num2 = getnumIBAN(letra2);
    //Se sustituye las letras por números.
    isbanaux = String(num1) + String(num2) + IBAN.substring(2);
    // Se mueve los 6 primeros caracteres al final de la cadena.
    isbanaux = isbanaux.substring(6) + isbanaux.substring(0,6);

    //Se calcula el resto, llamando a la función modulo97, definida más abajo
    
    resto = modulo97(isbanaux);
    if (resto == 1){
        isValid=true
    }
    return change_valid_style(elementor, isValid)
}


function comprobar_select(elementor) {
    var sel_comp=elementor.value; 
    var isValid=false;
    if (sel_comp != "nil") {
        isValid=true;
    }

    return change_valid_style(elementor, isValid)
}




