toastr.options.preventDuplicates=true

function registrarContacto(){
    let inpNombre =document.getElementById("txtNombre")
    let inpTel = document.getElementById("txtTelFijo")
    let inpTel2 = document.getElementById("txtTelCel")
    console.log("hola1");
    if(validarNombre(inpNombre, 1 ,40) && validarTelefonos(inpTel, inpTel2, 6,15)){
        //alert("enviando al server")
        console.log("hola2");
        let data = new FormData()
        data.append("pers_nombre", inpNombre.value)
        data.append("tele_fijo", inpTel.value)
        data.append("tele_celular",inpTel2.value)
        console.log("hola3");
        $.ajax({
            url:"http://localhost/AgendaMVC/Persona/registrar",
            data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: res => {

                if(res == 1){
                    toastr.success('Registrado Correctamente','Proceso Exitoso')
                    inpNombre.value=""
                    inpTel.value = ""
                    inpTel2.value = ""
                    llenarTablaContactos()
                }
                else toastr.error(res,"Algo ha salido mal")
            }
        })
    }
}
function llenarTablaContactos(){
    $.ajax({
        url: "http://localhost/AgendaMVC/Persona/obtenerTodo",
        data:{},
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: res =>{
            try{
                let data = JSON.parse(res)
                let tr=""
                data.results.forEach(element => {
                    tr += `
                    <tr>
                        <td>${element.pers_nombre}</td>
                        <td>${element.pers_fijo ? element.pers_fijo : "No tiene"}</td>
                        <td>${element.pers_celular ? element.pers_celular : "No tiene"}</td>
                    </tr>
                    `
                })
                $("#tablaContactos > tr").remove()
                $("#tablaContactos").append(tr)
                } catch (error){
                    toastr.error(error,"Algo ha salido mal")
                }
            }
        });
    }
    $().ready(()=>{
        llenarTablaContactos()
    })
