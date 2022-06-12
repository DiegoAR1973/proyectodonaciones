window.addEventListener("load", function init() {

    document.getElementById("form_alta_usu").addEventListener("submit", function (e) { // cancelo el envio del formulario para hacer las comprobaciones necesarias
        e.preventDefault()   
   
        var form = document.getElementById('form_alta_usu'); // recojo en la variable el formulario
        var datos = new FormData(form); // recojo los datos del formulario

        
        var menErrDni = document.getElementById('dniErr')
        var menErrLetraDni = document.getElementById('letraDniErr')
        var menErrClaseDocumento = document.getElementById('claseErr')
        var lugarErrDni = ""
        console.log("devuelto por letraDni: "+datos.get('letraDni'))
        if(datos.get('numDni') == '' || datos.get('numDni') == ' '){
            menErrDni.innerHTML = "debe introducir un DNI"
        } else {
            if(datos.get('letraDni') == '' || datos.get('letraDni') == ' '){
                console.log("debería pasar por aqui")
                menErrLetraDni.innerHTML = 'debe introducir una letra'
            } else {
                if(datos.get('calseDocumento') == null){
                    menErrClaseDocumento.innerHTML = 'debe seleccionar una de las opciones'
                } else {
                                        
                    switch (valorClaseDocumento(form)){
                        case ('dni'):
                            var letraDni = ["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"]
                            console.log("indice 0 letraDni "+letraDni[0])
                            console.log("indice 22 letraDni "+letraDni[22])
                            console.log('letra introducida en mayustculas: '+datos.get('letraDni').toUpperCase())
                            
                            
                                if(esNumero(datos.get('numDni'))){
                                    if(datos.get('numDni').length>8){
                                        menErrDni.innerHTML = "El DNI no puede tener más de 8 dígitos"
                                        return false
                                    } else {
                                        var indexLetraDni = datos.get('numDni') % 23
                                        console.log('Index del dni: '+indexLetraDni)
                                        menErrDni.innerHTML = ""
                                        if (datos.get('letraDni').toUpperCase() == letraDni[indexLetraDni]){
                                            console.log('todo correcto')
                                            menErrDni.innerHTML = ""
                                            menErrLetraDni.innerHTML = ""
                                            menErrClaseDocumento.innerHTML = ""

                                            return true
    
                                        } else {
                                            menErrLetraDni.innerHTML = 'la letra introducida no coincide, vuelva a intentarlo'
                                            return false
                                        }
                                    }
                                } else {
                                    menErrDni.innerHTML = "debe introducir únicamente digitos"
                                    return false
                                    }
                                

                            console.log("es un dni")
                        break;
                        case ('nie'):
                            console.log("es un nie")
                        break;
                        case ('pasaporte'):
                            console.log("es un pasaporte")    
                        break;
                        // no hay default ya que son los únicos tres posibles valores devueltos
                    }
                }
            }
        }


    })

    function valorClaseDocumento(formulario){
        for(i=0;i<formulario.length;i++)
        if(formulario[i].checked) return formulario[i].value;

    }

    function esNumero(dato){
        var reg = /^[0-9]+$/
        if(dato.match(reg)) {
            return true
        } else {
            return false
        }

    }

    function esLetra(dato){
        var reg = /^[a-zA-Z]+$/
        if(dato.match(reg)) {
            return true
        } else {
            return false
        }

    }

})
/*Pruebas
nada en ningún sitio -> marca error en el num dni OK
nada en el tipo documento 	si en dni 	si en letra	-> marca error en tipo documento OK
si tipo documento	no dni		si en letra	-> marca error en num dni OK
si tipo documento	si dni		no en letra	-> marca error en letra OK
si tipo documento	si dni		si en letra valida-> todo OK
si tipo documento	si dni invalido + largo		si en letra -> marca error en num dni OK
si tipo documento	si dni invalido tb letra	si en letra -> marca error en num dni indica solo números OK
si tipo documento	si dni valido	si letra no coincidente -> marca error en letra indica que no coincide OK */