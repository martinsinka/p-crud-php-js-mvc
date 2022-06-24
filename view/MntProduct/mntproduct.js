var  tabla;

function init(){

}

$(document).ready(function(){
    tabla=$('#product_data').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
        "ajax":{
            url: '../../controller/product.php?op=listar',
            type : "get",
            dataType : "json",   //  SI NO DEVUELVE UN ARRAY DE ARRAY O ARRAY DE OBJETOS USAR LA SIGUIENTE LINEA DE CODIGO
            //"dataSrc": "",
            error: function(e){
                console.log(e.responseText);	
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
	    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
		}
	}).DataTable();
});

function edit(productId){
    console.log(productId);
}

function remove(productId){
    Swal.fire({
        title: "CRUD",
        text: "Esta seguro de eliminar el registro?",
        icon: "error",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Si",
        cancelButtonText: "No",
        reverseButtons: true
    }).then((result) => {
        if(result.isConfirmed){
            $.post("../../controller/product.php?op=remove", {productId: productId}, function(data){

            });
            $('#product_data').DataTable( ).ajax.reload(null, false);
            Swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
    
    

    
}

($document).on("click", "#btnNuevo", function(){
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalMantenimiento').modal('show');
});

init();