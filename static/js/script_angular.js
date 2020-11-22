angular
	.module('myapp',['angularUtils.directives.dirPagination'])	
	.controller('api_historiales', ['$http', apiHistoriales]);


function apiHistoriales($http){
	
	var vm = this;
	
	vm.inicializar = function() {		
		vm.sesion_cerrada = true;
	}
	
	vm.abrir_sesion = function(codigo) {
		if (codigo == "123"){
			vm.sesion_cerrada = false;
			vm.carga_inicial();
		}else{
			alert('El codigo ingresado es erroneo');
			
		}
	}
	
	vm.cerrar_sesion = function() {
		if (vm.ver_paciente == true){
			alert('debe cerrar el historial');
		}else{
			vm.sesion_cerrada = true;
		}
	}
	
	
		
	vm.cerrar_historial = function() {
		vm.ver_paciente = false;
	}
				
	vm.abrir_historial = function(id) {
		vm.historial_id = id;
		vm.ver_paciente = true;
		
		$http.get('http://medical.com/apirest/index.php/historial_controller/index/'+vm.historial_id)
		.success(function(data){
			var paciente	= data.paciente;
			console.log(data);
			vm.nombre		= paciente.nombre;
			vm.dni			= paciente.dni;
			vm.genero		= paciente.genero_id;
			vm.estudios		= paciente.estudio_id;
			vm.domicilio	= paciente.domicilio;
			vm.fecha_nacimiento = paciente.fecha_nacimiento;
			vm.telefono		= paciente.telefono;
			setEdad(paciente.fecha_nacimiento);
			setObraSocial(paciente.obra_social_id);
			setEstadoCivil(paciente.estado_civil_id);
			setLocalidad(paciente.localidad_id);
			setDepartamento(paciente.departamento_id);			
			cargarDiagnosticos(data.diagnosticos);			
			cargarEnfermedadesAsociadas(data.enfermedades_asociadas);			
			cargarFactoresDeRiesgoAsociados(data.factores_de_riesgo_asociados);
			
		});		
	}
	
	vm.createHistorial = function() {
		var url = 'http://medical.com/apirest/index.php/historial_controller/create/';
		var json = {
				hospital_id : "1",
				paciente : {
					dni : vm.dni,
					nombre : vm.nombre,
					fecha_nacimiento : vm.fecha_nacimiento,
					domicilio : vm.domicilio,
					telefono : vm.telefono,
					genero_id : vm.genero,
					estado_civil_id : vm.estado_civil.id,
					obra_social_id : vm.obra_social.id,
					estudio_id : vm.estudios,
					localidad_id : vm.localidad.id,
					departamento_id : vm.departamento.id
				}
		};
		console.log(json);
		$http.post(url, json)
		.success(function(data){
			alert(data.response);
		});
			
	}

	function setEdad(fecha_nacimiento) {
	    var hoy = new Date();
	    var nacimiento = new Date(fecha_nacimiento);
	    var anios = hoy.getFullYear() - nacimiento.getFullYear();
	    var mes = hoy.getMonth() - nacimiento.getMonth();

	    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
	        anios--;
	    }

	    vm.edad = anios;
	}
	
	function setLocalidad(id) {
		for (var i = 0; i < vm.array_localidad.length; i++) {
			if (id == vm.array_localidad[i].id) {
				vm.localidad = vm.array_localidad[i];
			}
		}
	}
	
	function setDepartamento(id) {
		for (var i = 0; i < vm.array_departamento.length; i++) {
			if (id == vm.array_departamento[i].id) {
				vm.departamento = vm.array_departamento[i];
			}
		}
	}
	
	function setEstadoCivil(id) {
		for (var i = 0; i < vm.array_estado_civil.length; i++) {
			if (id == vm.array_estado_civil[i].id) {
				vm.estado_civil = vm.array_estado_civil[i];
			}
		}
	}
	
	function setObraSocial(id) {
		for (var i = 0; i < vm.array_obra_social.length; i++) {
			if (id == vm.array_obra_social[i].id) {
				vm.obra_social = vm.array_obra_social[i];
			}
		}
	}
	
	function gb(control) {
		if (control==0) return false;
		else return true;
	}
	
	function click_chk(control) {
		var estado 
		
		if (control == 0) {
			control = 1;
			estado = true;
		}
		if (control == 1) {
			control = 0;
			estado = false;
		}
		return false;
	}
			
	function cargarDiagnosticos(diagnosticos) {
		vm.glucemia_alterada_en_ayunas = gb(diagnosticos.glucemia_alterada_en_ayunas);
		vm.tolerancia_glucosa_alterada = gb(diagnosticos.tolerancia_glucosa_alterada);
		vm.diabetes = gb(diagnosticos.diabetes);
		if (vm.diabetes){
			vm.diabetes_tiempo_evolucion = diagnosticos.diabetes_tiempo_evolucion;
			vm.diabetes_semanas_gestacion = diagnosticos.diabetes_semanas_gestacion;
		}
		vm.diabetes_tipo = diagnosticos.diabetes_tipo;
		vm.dislipemia = gb(diagnosticos.dislipemia);
		vm.hipertension_arterial = gb(diagnosticos.hipertension_arterial);
		if (vm.hipertension_arterial)
			vm.hipertension_arterial_tiempo_evolucion = diagnosticos.hipertension_arterial_tiempo_evolucion;
	}
	
	function cargarEnfermedadesAsociadas(enfermedades_asociadas) {
		vm.enfermedad_tiroidea = gb(enfermedades_asociadas.enfermedad_tiroidea);
		if (vm.enfermedad_tiroidea)
			vm.enfermedad_tiroidea_tipo = enfermedades_asociadas.enfermedad_tiroidea_tipo;
		vm.enfermedad_reumatica = gb(enfermedades_asociadas.enfermedad_reumatica);
		if (vm.enfermedad_reumatica)
			vm.enfermedad_reumatica_tipo = enfermedades_asociadas.enfermedad_reumatica_tipo;
		vm.enfermedad_celiaca = enfermedades_asociadas.enfermedad_celiaca;
		vm.tbc = enfermedades_asociadas.tbc;
	}
	
	function cargarFactoresDeRiesgoAsociados(array) {
		vm.obesidad = gb(array.obesidad);
		vm.sedentarismo = gb(array.sedentarismo);
		vm.tabaco = gb(array.tabaco);
		vm.alcoholismo = gb(array.alcoholismo);
		vm.anticoagulantes = gb(array.anticoagulantes);
		vm.corticoides = gb(array.corticoides);
		vm.anticonceptivos = gb(array.anticonceptivos);
		vm.menospausia_prematura = gb(array.menospausia_prematura);
	}
	
	function cargarAntecedentesFamiliares(array) {
		
	}
		
}


