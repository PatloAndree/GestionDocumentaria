function tamaño(){
	// alert("Hola manos");
	persona_tipodocumento='DNI';
	persona_numerodocumento=$('#registros-documento').val();

	if(persona_tipodocumento=='DNI' && persona_numerodocumento.length==8){
		$('#registros-documento').attr('readonly',true);
		$.ajax({
			url: site_url+'panel/registros/getDataDocumento/'+persona_tipodocumento+'/'+persona_numerodocumento,
			type:"POST",
			data:{},
			dataReturn:"JSON",
			dataType: "json",
			success:function(data){
                // incidenciasHtml='';
                // sugerenciasHtml='';
				// $("#clientefrecuente").addClass("d-none");
				if(data.valor!="1"){
					Lobibox.notify('error',{
						iconSource: "fontAwesome",
						title:'Ocurrio un problema',
						sound:false,
						rouded:false,
						delay:3000,
						position:'center bottom',
						msg:data.datos
					});
					$('#registros-documento').attr('readonly',false);
				}else{
					alert("hola chicos");
					
					document.getElementById("registros-nombre").value = data.datos;
					// if(data.cliente_frecuente>0){
					//     $("#clientefrecuente").removeClass("d-none");
					// }
					
					// incidencias=data.incidencias;
					// if(incidencias.length>0){
					    
					//     incidencias.forEach(function(element){
					//         incidenciasHtml+= `<tr>
					//             <td>${element.reserva_ingreso}</td>
    				// 	        <td>${element.incidencia}</td>
    				// 	    </tr>`;
					//     });
					// }
					
					// sugerencias=data.sugerencias
					// if(sugerencias.length>0){
					//     sugerencias.forEach(function(element){
                    //         sugerenciasHtml+= `<tr>
                    //             <td>${element.reserva_ingreso}</td>
                    //             <td>${element.sugerencia}</td>
                    //         </tr>`;
					//     });
					// }
					
				}
				// $("#table-incidencia").html(incidenciasHtml);
				// $("#table-sugerencia").html(sugerenciasHtml);
			}
		});	
	}
	var nombres = persona_numerodocumento , persona_tipodocumento;
	//remover atributo document.getElementById("persona_numerodocumento").removeAttribute("readonly");
}

$('#registros-tipodocumento').click(function(){
	document.getElementById("registros-documento").value='';
	document.getElementById("registros-nombre").value='';
	$('#registros-documento').attr('readonly',false);
	// alert("hola p");
});