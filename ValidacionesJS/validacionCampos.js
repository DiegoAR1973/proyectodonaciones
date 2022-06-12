window.addEventListener("load", function init() {
     // valores por defecto de los check y radio
    document.usuario.persona[0].checked = true
    document.usuario.calseDocumento[0].checked = true
    // fin valores check y radio
   
  
                                // EVENTOS
    document.getElementById('claseDni').addEventListener('click', function (e){              
        document.getElementById("numDoc").addEventListener('blur',formatoDni) // al salir del input dni comprobamos si es un número
        document.getElementById("letraDoc").addEventListener('blur',esLetra) // al salir del input letraDni comprobamos que sea una letra
    })
    document.getElementById('claseNie').addEventListener('click', function (e){
        document.getElementById("numDoc").addEventListener('blur',formatoNie) // al salir del input nie comprobamos que cumpla con el formato del nie
        document.getElementById("letraDoc").addEventListener('blur',esLetra) // al salir del input digito nie comprobamos que se trae de una letra
    })

    document.getElementById('clasePassaporte').addEventListener('click', function (e){
        document.getElementById("numDoc").addEventListener('blur',formatoPasaporte) // al salir del input pasaporte coprobamos que sea váldio el formato
        var letraDocInput = document.getElementById('letraDoc')
        letraDocInput.disabled = true    
    }) 
    document.getElementById('claseNie').addEventListener('click', function(e) {
        var letraDocInput = document.getElementById('letraDoc')
            console.log('Vamos a habilitar el input text')
            letraDocInput.disabled = false            
     })
    document.getElementById('claseDni').addEventListener('click', function(e) {
        var letraDocInput = document.getElementById('letraDoc')
        console.log('Vamos a habilitar el input text')
        letraDocInput.disabled = false 
    })           
     
    
    
    document.getElementById("form_alta_usu").addEventListener('submit', valNombre) // al dar a submit validamos nombre
    document.getElementById("form_alta_usu").addEventListener('submit', valEmail)  // al dar a submit validamos email
    document.getElementById("form_alta_usu").addEventListener('submit', valPersona) // al dar a submit validamos en calidad de que actua, donante, donatario o donante y donatario 
    document.getElementById("form_alta_usu").addEventListener('submit', valPassword) // validamos que el formato del password sea correcto, al menos 1 mays, 1 min, 1 dígito
  
         // fin eventos

                                    // CANCELO EL ENVIO PARA HACER LAS COMPROBACIONES 
    document.getElementById("form_alta_usu").addEventListener("submit", function (e) { 
        e.preventDefault()
        var form = document.getElementById('form_alta_usu') // recojo en la variable el formulario
        var datos = new FormData(form); // recojo los datos del formulario
        var numeroDocumento = document.getElementById('numDoc')
        var menErrNombre = document.getElementById('nomErr')
        var menErrEmail = document.getElementById('emailErr')
        var menErrPassword = document.getElementById('passwordErr')
        var menErrDocumento = document.getElementById('errDoc')
              
        if(valNombre()){
            menErrNombre.innerHTML =""
            if(valEmail()){
                menErrEmail.innerHTML  = ""
                if(valPassword()){
                    menErrPassword.innerHTML  = ""
                    console.log(datos.get('persona')) // devuelve null si no se ha elegido
                    if(datos.get('persona') =='donatario' || datos.get('persona') =='donante_donatario'){ // además si se actua como donatario o donante_donatario tb el dni
                        switch (datos.get('calseDocumento')) {  // en funcion del documento 
                            case('dni'):  // recogida datos identificación dni
                                if(documentoDni()){ 
                                    menErrDocumento.innerHTML  = ""
                                    console.log('TODO OK')
                                    form.submit() // lanzamos el formulario ya que todo ok
                                } else {
                                    console.log("DOCUMENTO inválido")
                                    menErrDocumento.innerHTML  = "Debe introducir un dni válido" 
                                    numeroDocumento.focus()
                                    e.preventDefault()
                                } // fin recogida datos identificación dni
                            break;
                            case ('nie'):  // recogida datos identificación nie
                                if((documentoNie())){ 
                                    menErrDocumento.innerHTML  = ""
                                    console.log('TODO OK')
                                    form.submit() // lanzamos el formulario ya que todo ok
                                } else {
                                    console.log("DOCUMENTO inválido")
                                    menErrDocumento.innerHTML  = "Debe introducir un nie válido"
                                    numeroDocumento.focus() 
                                    e.preventDefault()
                                }   //fin recogida datos identificación nie
                            break;    
                            case ('pasaporte'):// recogida datos ifentificación pasaporte
                                if(formatoPasaporte()){ 
                                    menErrDocumento.innerHTML  = ""
                                    console.log('TODO OK PASAPORTE')
                                    form.submit() 
                                } else {
                                    console.log("DOCUMENTO inválido")
                                    menErrDocumento.innerHTML  = "Debe introducir un pasaporte valido" 
                                    e.preventDefault()
                                    numeroDocumento.focus()
                                } // fin recogida datos identificación pasaporte

                            break;

                        } // fin tipo documento
                    } else {
                        console.log('Es un donante, todo OK')
                        form.submit() 
                    }
                } else {
                    menErrPassword.innerHTML  = "Debe introducir un password válido"
                    alert('El password debe contener al menos: \n un dígito'+
                                                            '\n una letra minúscula'+
                                                            '\n una letra mayuscula'+
                                                            '\n una longitud mínima de 8 caracteres') 
                    document.getElementById('password').focus()
                    e.preventDefault()
                }
                
            } else {
                menErrEmail.innerHTML  = "Debe introducir un email valido" 
                document.getElementById('email').focus()
                e.preventDefault()
            }
          
        } else{
            menErrNombre.innerHTML = "Debe introducir un nombre" 
            document.getElementById('nombre').focus()
            e.preventDefault()
        }

    }) // fin de cancelación del formulario (prevent default)

    
                                    // VALIDACIÓN DEL NOMBRE, NO PUEDE ESTAR VACIO
    function valNombre(){
        var formulario = document.getElementById('form_alta_usu'); // recojo en la variable el formulario
        var datos = new FormData(formulario); // recojo los datos del formulario

        if(datos.get('nombre').trim() ==''){
           return false
        } else {
            return true
        }
    } // fin validación nombre

                                        // VALIDACIÓN EMAIL
    function valEmail(){
        var formulario = document.getElementById('form_alta_usu'); // recojo en la variable el formulario
        var datos = new FormData(formulario); // recojo los datos del formulario
         
        var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g
        if(datos.get('email').trim ===''){
            
            document.getElementById('email').focus()
            return false
        } else {
            if(datos.get('email').match(regex)) {
                menErrEmail = ''
                return true
            } else {
               
                document.getElementById('email').focus()
            }
        }
    } // fin validación email

                            // VALIDAR QUE HA SELECIONADO EN CALIDAD DE QUE ACTUA me sobraría al haber puesto un select por defecto
    function valPersona(){
        var datos_form = document.getElementById('form_alta_usu'); // recojo en la variable el formulario
        var datos = new FormData(datos_form); // recojo los datos del formulario
       
        if(datos.get('persona') ==='null'){
            
            return false
        } else {
            
            return true
        }
    }// fin de validacion en calidad de que actua

                                // COMPROBACIÓN CONDICIONES DE PASSWORD
    function valPassword(){
        var formulario = document.getElementById('form_alta_usu'); // recojo en la variable el formulario
        var datos = new FormData(formulario); // recojo los datos del formulario
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm
        // al menos un digito, una letra minúscula, una letra mayúscula y una longitud mínima de 8 carácteres
        if(datos.get('password').trim ===''){
           
            return false
        } else { 
            if(datos.get('password').match(regex)){
                return true
            } else {
                document.getElementById('password').focus()
                return false
            }
        }
        
    }// fin validación password

                                        // COMPROBACIÓN COMPLETA DEL DNI
    function documentoDni(){
        var formulario = document.getElementById('form_alta_usu')
        var datos = new FormData(formulario) // recojo los datos del formulario
              
            if(datos.get('numDoc').trim() != ''){ // si hay DNI 
                if(formatoDni()){
                    if(letraValida()){
                        console.log('DNI válido')
                        return true
                    } else {
                        console.log('letra del dni inválida')
                        document.getElementById('letraDoc').focus()
                        return false
                        }
                } else {
                    console.log('formato del dni incorrecto')
                    document.getElementById('numDoc').focus()
                    return false
                }
                    
            } else {
                console.log('introduzca un número de dni')
                document.getElementById('numDoc').focus()
                return false
            }
    } // fin validación DNI

                                            // VALIDACIÓN DEL NIE
    function documentoNie(){
        var formulario = document.getElementById('form_alta_usu') // recojo en la variable el formulario
        var datos = new FormData(formulario) // recojo los datos del formulario
        var numeroNie = datos.get('numDoc')
        var primerDigitoNie = (numeroNie.toUpperCase()).charAt(0)
        var digitoIn = datos.get('letraDoc').toUpperCase()
       
        var menErrDigitoNie= document.getElementById('errLetraDoc')
        var menErrNumNie= document.getElementById('errDoc')
        
        if(Boolean(digitoIn)){ // true si se ha introducido algo
            var regex = /^[xyz]{1}[\d]{7}$/gi // formato del nie un caracter x,y,z seguido de 7 dígitos
            if(numeroNie.match(regex)) {  
                var digitoNie = ["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"]
                switch(primerDigitoNie){
                    case ('X'):
                        var CalculoNumeroNie = numeroNie.replace(/x/i,"0")
                        var indexDigitoNie = CalculoNumeroNie % 23
                        
                        if (digitoIn == digitoNie[indexDigitoNie]){  // la letra coincide con el número
                            menErrDigitoNie.innerHTML = ''
                            console.log('letra x, NIE correcto')
                            return true  // nie correcto
                            
                        } else {
                            console.log('letra x, NIE INCORRECTO')
                            menErrDigitoNie.innerHTML = 'el dígito de control es incorrecto'
                            return false
                        }
                        break;
                    case('Y'):
                        var CalculoNumeroNie = numeroNie.replace(/y/i,"1")
                        var indexDigitoNie = CalculoNumeroNie % 23
                        if (digitoIn == digitoNie[indexDigitoNie]){  // la letra coincide con el número
                            menErrDigitoNie.innerHTML = ''
                            console.log('letra y,  NIE correcto')
                            return true  // nie correcto
        
                        } else {
                            console.log('letra y, NIE INCORRECTO')
                            menErrDigitoNie.innerHTML = 'el dígito de control es incorrecto'
                            return false
                        }
                    break;
                    case('Z'):
                        var CalculoNumeroNie = numeroNie.replace(/z/i,"2")
                        var indexDigitoNie = CalculoNumeroNie % 23
                        if (digitoIn == digitoNie[indexDigitoNie]){  // la letra coincide con el número
                            menErrDigitoNie.innerHTML = ''
                            console.log('letra y y NIE correcto')
                            return true  // nie correcto
        
                        } else {
                            console.log('letra z, NIE INCORRECTO')
                            menErrDigitoNie.innerHTML = 'el dígito de control es incorrecto'
                            return false
                        }
                    break;
                    default:
                        console.log('NO ES NINGUNA DE LAS LETRAS X,Y,Z') 
                        menErrDigitoNie.innerHTML = 'el dígito de control es incorrecto'
                        return false
                } // fin de reemplazar valores x, y, z (switch)
                   
            } else {
                console.log('no cumple con el formato')
                menErrNumNie = 'El formato del NIE es incorrecto'
                return false
            }// fin cumple regex
        } else {
            console.log('no ha introducido ningún valor del documento')
            menErrNumNie = 'Debe introducir el NIE'
            return false
        }// fin exite digito del nie        
      
    }// fin comprobación digito de control

                            // VALIDACIÓN FORMATO PRIMERA PARTE DEL NIE
    function formatoNie(){
        var formulario = document.getElementById('form_alta_usu') // recojo en la variable el formulario
        var datos = new FormData(formulario) // recojo los datos del formulario
        var numNie = document.getElementById('numDoc')
        var regex = /^[xyz]{1}[\d]{7}$/gi
        if(!datos.get('numDoc').match(regex)){
            console.log('formato del nie incorrecto')
            numNie.focus()
            return false
        } else {
            console.log('formato del nie CORRECTO')
            return true
            
        }

    }
    
    // validación formato número dni, unicamente digitos y máximo 8
    function formatoDni(){
        var formulario = document.getElementById('form_alta_usu') // recojo en la variable el formulario
        var datos = new FormData(formulario) // recojo los datos del formulario
        var reg = /^[0-9]+$/
        if(datos.get('numDoc').match(reg)){
            console.log('formato DNI CORRECTO')
            return true
        } else {
            console.log('formato DNI incorrecto')
            return false
        }
    }
    
                                  /* VALIDACIÓN DEL FORMATO DEL PASAPORTE 
                      el formato del pasaporte español es de tres letras al principio del número seguido de 6 dígitos */
    function formatoPasaporte(){
                            
        var formulario = document.getElementById('form_alta_usu')
        var datos = new FormData(formulario) // recojo los datos del formulario
        
        var regex = /(^[a-zA-z]{3})+[\d]{6}$/g
        
        if(datos.get('numDoc').match(regex)){
            console.log('El formato del pasaporte es CORRECTO')
            return true
        } else {
            console.log('El formato del pasaporte es incorrecto')
            formulario.focus()
            return false
            
        }
              
    }// fin validación Pasaporte


    // COMPROBACIÓN SOLO LETRA
    function esLetra(){
        var formulario = document.getElementById('form_alta_usu')
        var datos = new FormData(formulario) 
        var errorLetra = document.getElementById('errLetraDoc')
        var letraIn = datos.get('letraDoc')
        console.log('entra en esLetra')
        var reg = /^[a-zA-Z]+$/
        if(datos.get('persona') == 'donatario' || datos.get('persona') == 'donante_donatario'){
            if (/\s/.test(letraIn)){ // si sólo hay espacios en blanco
                
                errorLetra.innerHTML = ' Este campo no puede tener espacios en blanco '
                return false
                        
            }else {
            
                if(letraIn.match(reg)) {
                    errorLetra.innerHTML = ''
                    return true
                } else {
                    if(letraIn === ''){ // si el campo está vacio
                        errorLetra.innerHTML = ' Tiene que introducir obligatoriamente una letra '
                        document.getElementById('letraDoc').focus()
                        return false
                    } else { 
                        errorLetra.innerHTML = ' Solo admite una letra ' 
                        document.getElementById('letraDoc').focus()
                        return false
                    }
                }

            }
        }
      
    }// FIN COMPROBACIÓN LETRA
        



    // COMPROBACIÓN LETRA VÁLIDA DNI
    function letraValida(){
        var formulario = document.getElementById('form_alta_usu') // recojo en la variable el formulario
        var datos = new FormData(formulario) // recojo los datos del formulario
        var letraIn = document.getElementById('letraDoc').value
        if(Boolean(letraIn)){ // true si se ha introducido algo
            var letraDni = ["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"]
            var indexLetraDni = datos.get('numDoc') % 23 // comprobar que el número corresponde con la letra     
            if (datos.get('letraDoc').toUpperCase() == letraDni[indexLetraDni]){ // la letra coincide con el número
                console.log('La letra del DNI ES CORRECTA')
                return true  // dni correcto

            } else {
                console.log('La letra del DNI es incorrecta')
                return false
            }
        }        
        
    }// FIN COMPROBACIÓN LETRA VÁLIDA   
  

}) // FIN INIT