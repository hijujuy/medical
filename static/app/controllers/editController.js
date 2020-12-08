historialApp.controller('editController', [
'$http','$scope','$timeout','$location','$routeParams', 
function($http, $scope, $timeout, $location, $routeParams) {
	let id = $routeParams.id;	
	let vm = this;
	let array_updates = [];
	let array_localidad = [];
	let registro = {};
	let urlBase = '/index.php/';
		
	vm.save_updates_disabled = true;
	vm.localidad_disabled = true;
	vm.diabetes_disabled = true;
	vm.diabetes_gestacional_disabled = true;
	vm.hipertension_arterial_disabled = true;
	vm.enfermedad_tiroidea_disabled = true;
	vm.enfermedad_reumatica_disabled = true;
	vm.renal_nefropatia_disabled = true;
	vm.complicaciones_agudas_de_diabetes_tuvo_episodios_disabled = true;
	vm.array_nivel_de_riesgo_cardiovascular_global = [
		{id: 1, intervalo:'menor a 10%'},
		{id: 2, intervalo:'de 10% a menor 20%'},
		{id: 3, intervalo:'de 20% a menor 30%'},
		{id: 4, intervalo:'de 30% a menor 40%'},
		{id: 5, intervalo:'mayor a 40%'}
	];
	vm.laboratorio_observaciones_disabled = true;
	vm.estado_guardar = 1;
	
	loadRegistro(id);
		
	function loadRegistro(idHistorial){
		let params = {};
		params.url = urlBase + 'historial/' + idHistorial;
		params.method = 'GET';
		
		$http(params).then(
			function(response){
				registro = response.data;
				
				vm.array_obra_social = registro.obra_sociales;
				vm.array_estado_civil = registro.estado_civiles;
				vm.array_departamento = registro.departamentos;			
				array_localidad = registro.localidades;
				vm.array_localidad = registro.localidades;
				vm.array_diabetes_tipos = registro.enfermedades[3].tipos;
				vm.array_enfermedad_tiroidea_tipos = registro.enfermedades[1].tipos;
				vm.array_enfermedad_reumatica_tipos = registro.enfermedades[2].tipos;
				
				vm.paciente = registro.paciente;
				vm.max_nacimiento = setMaxFecha();
				vm.edad = setEdad(vm.paciente.fecha_nacimiento);
				localidadChange();
				
				vm.diagnosticos = registro.diagnosticos;
				diabetesChkSet();
				hipertensionArterialChange();
				
				vm.enfermedades_asociadas = registro.enfermedades_asociadas;
				enfermedadTiroideaTipoChange();
				
				vm.factores_de_riesgo_asociados = registro.factores_de_riesgo_asociados;				
				vm.antecedentes_familiares = registro.antecedentes_familiares;				
				vm.odontologia = registro.odontologia;				
				vm.nutricion = registro.nutricion;
				vm.psicologia = registro.psicologia;
				vm.oftalmologia = registro.oftalmologia;
				vm.circulatorio = registro.circulatorio;
				
				vm.renal = registro.renal;
				renalNefropatiaChange();
				
				vm.examen_fisico = registro.examen_fisico;
				vm.complicaciones_agudas_de_diabetes = registro.complicaciones_agudas_de_diabetes;
				tuvoEpisodiosComplicacionesAgudasChange();
				
				vm.laboratorio = registro.laboratorio;
				setIntervaloMicroalbuminuria();
				
				vm.internaciones_relacionadas_con_enfermedad_de_base = registro.internaciones_relacionadas_con_enfermedad_de_base;
				setInitInternacion();
				
				vm.tratamiento_actual = registro.tratamiento_actual;
				vm.tratamiento_conducta_medica = {};
				vm.array_conducta_medica = registro.conducta_medica;
				vm.solicitud_interconsulta = registro.solicitud_interconsulta;
				vm.inmunizaciones = registro.inmunizaciones;
				vm.solicitud_practica = registro.solicitud_practica;				
				vm.seguimientos = registro.seguimientos;
								
				vm.close_disabled = false;
			},function(error){
				return error.status;
			});
	}
	
	vm.enfermedadesAsociadasChanges = function() {
		vm.enfermedades_asociadas_disabled = false;
	};
	
	vm.closeHistorial = function(){
		$location.path('/list');
	};
	
	vm.diabetesChkChange = function() {
		diabetesChkChange();
	};
	
	vm.diabetesTipoChange = function() {
		diabetesTipoChange();
	};
	
	vm.fechaNacimientoChange = function(){
		vm.edad = setEdad(vm.paciente.fecha_nacimiento);
	};
	
	vm.departamentoChange = function(){
		departamentoChange(vm.paciente.departamento_id);
	};
	
	vm.localidadChange = function(){
		localidadChange();
	};
	
	vm.hipertensionArterialChange = function(){
		hipertensionArterialChange();
	};
	
	vm.enfermedadTiroideaTipoChange = function(){
		enfermedadTiroideaTipoChange();
	};
	
	vm.enfermedadReumaticaTipoChange = function(){
		enfermedadReumaticaTipoChange();
	};
	
	vm.renalNefropatiaChange = function(){
		renalNefropatiaChange();
	};
	
	vm.tuvoEpisodiosComplicacionesAgudasChange = function() {
		tuvoEpisodiosComplicacionesAgudasChange();
	};
	
	vm.saveUpdatesRegistro = function(){
		saveUpdatesRegistro();
	};
	
	vm.setIntervaloMicroalbuminuria = function() {
		setIntervaloMicroalbuminuria();
	};
		
	vm.saveAddInternacion = function(){
		addInternacion(vm.laboratorio_new_internacion);
	};
		
	vm.addSeguimiento = function(){		
		let params = {};
		params.url = '/index.php/seguimiento/create/' + id;
		params.method = 'POST';
		
		if (vm.seguimientos === null){
			vm.seguimientos = [];
		}
			
		$http({
			method: params.method,
			url:	params.url
		}).then(
			function(response){
				vm.seguimientos.push(response.data.seguimiento);
				console.log(response.data.seguimiento);
				//vm.seguimiento = vm.seguimientos[vm.seguimientos.length-1];
		},	function(error){
				console.log(error);
		});
	}
	
	
	function setInitInternacion(){
		if (vm.internaciones_relacionadas_con_enfermedad_de_base != null){
			vm.internacion = vm.internaciones_relacionadas_con_enfermedad_de_base[0];	
		}		
	}
		
	function addInternacion(internacion){
		let params = {};
		params.url = '/index.php/internaciones_relacionadas_con_enfermedad_de_base';
		params.method = 'POST';
		params.data = { data :
			{
				fecha: internacion.fecha,
				dias: internacion.dias,
				causas: internacion.causas,
				id_historial: id
			}
		};
			
		$http({
			method: params.method,
			url:	params.url,
			data:	params.data
		}).then(
			function(response){ 
				$(".modal").modal("hide");
				vm.internaciones_relacionadas_con_enfermedad_de_base = response.data;
		},	function(error){
				console.log(error);
		});
	}
	
	/**
	 * 
	 */
	
	vm.setInternacion = function(id) {		
		let internacion = vm.internaciones_relacionadas_con_enfermedad_de_base.filter(function(value){
			return value.id == id;
		});
		vm.internacion = internacion[0];
	};
	
	vm.editInternacion = function(id) {
		let internacion = vm.internaciones_relacionadas_con_enfermedad_de_base.filter(function(value){
			return value.id == id;
		});
		vm.form_edit = internacion[0];
	};
	
	vm.saveEditInternacion = function(){
		let params = {};
		params.url = '/index.php/internaciones_relacionadas_con_enfermedad_de_base/'+vm.form_edit.id;
		params.method = 'POST';
		params.data = { data :
			{
				fecha: vm.form_edit.fecha,
				dias: vm.form_edit.dias,
				causas: vm.form_edit.causas,
				id_historial : id
			}
		};
		
		console.log(params);
			
		$http({
			method: params.method,
			url:	params.url,
			data:	params.data
		}).then(
			function(response){ 
				$(".modal").modal("hide");
				vm.internaciones_relacionadas_con_enfermedad_de_base = response.data; 
		},	function(error){
				console.log(error);
		});
	};
	
	vm.setIdBeforeDelete = function(id) {
		vm.id_delete = id;
	};
	
	vm.deleteInternacion = function() {
		let params = {};
		params.url = '/index.php/internaciones_relacionadas_con_enfermedad_de_base/delete';
		params.method = 'POST';
		params.data = { data : 
			{
				id : vm.id_delete,
				id_historial : id 
			}
		};
		
		console.log(params);
			
		$http({
			method: params.method,
			url:	params.url,
			data:	params.data
		}).then(
			function(response){ 
				$(".modal").modal("hide");
				vm.internaciones_relacionadas_con_enfermedad_de_base = response.data; 
		},	function(error){
				console.log(error);
		});
	};
	
	vm.cancelEditInternacion = function() {
		vm.form_edit = {};
	};
	
	vm.saveAddConductaMedica = function() {
		let params = {};
		params.url = '/index.php/conducta_medica';
		params.method = 'POST';
		params.data = { data :
			{
				fecha: vm.tratamiento_conducta_medica.fecha,
				observacion: vm.tratamiento_conducta_medica.observacion,
				id_historial: id
			}
		};
			
		$http({
			method: params.method,
			url:	params.url,
			data:	params.data
		}).then(
			function(response){ 
				$(".modal").modal("hide");
				vm.array_conducta_medica = response.data;
				vm.tratamiento_conducta_medica.fecha = "";
				vm.tratamiento_conducta_medica.observacion = "";
		},	function(error){
				console.log(error);
		});
	};
	
	vm.editConductaMedica = function(id, fecha, observacion) {
		vm.tratamiento_conducta_medica.id = id;
		vm.tratamiento_conducta_medica.fecha = fecha;
		vm.tratamiento_conducta_medica.observacion = observacion;
	};
	
	vm.saveEditConductaMedica = function() {
		let params = {};
		params.url = '/index.php/conducta_medica/'+ vm.tratamiento_conducta_medica.id;
		params.method = 'POST';
		params.data = { data :
			{
				fecha: vm.tratamiento_conducta_medica.fecha,
				observacion: vm.tratamiento_conducta_medica.observacion,
				id_historial : id
			}
		};
		
		console.log(params);
			
		$http({
			method: params.method,
			url:	params.url,
			data:	params.data
		}).then(
			function(response){ 
				$(".modal").modal("hide");
				vm.array_conducta_medica = response.data;
				vm.tratamiento_conducta_medica.id = null;
				vm.tratamiento_conducta_medica.fecha = "";
				vm.tratamiento_conducta_medica.observacion = ""; 
		},	function(error){
				console.log(error);
		});
	};
	
	vm.cancelEditConductaMedica = function() {
		vm.tratamiento_conducta_medica.id = null;
		vm.tratamiento_conducta_medica.fecha = "";
		vm.tratamiento_conducta_medica.observacion = "";
	};
	
	function departamentoChange(id){			
		vm.array_localidad = array_localidad.filter(function(value){
			return value.departamento_id == id;
		});
		vm.localidad_disabled = false;
		vm.paciente.localidad_id = vm.array_localidad[0].id;
		setCodigoPostal(vm.array_localidad[0].codigo_postal)
	}
	
	function localidadChange(){
		var id = vm.paciente.localidad_id;
		localidad = array_localidad.filter(function(value){
			return value.id == id;
		});
		setCodigoPostal(localidad[0].codigo_postal);
	};		
	
	function setCodigoPostal(codigo_postal){
		vm.codigo_postal = codigo_postal;
	}
		
	function setMaxFecha(){
		var today = new Date();
		year = today.getFullYear();
		month = today.getMonth()+1;
		day = today.getDate();
		if (month < 10) 
			month = '0'+month;
		if (day < 10) 
			day = '0'+day;
		return [year, month, day].join('-');
	};
		
	function setEdad(fecha){
		var nacimiento = new Date(fecha);
		var hoy = new Date();			
		var edad = hoy.getFullYear() - nacimiento.getFullYear();
		if (hoy.getMonth() < nacimiento.getMonth()){
			edad -= 1;
		}else if (hoy.getMonth() == nacimiento.getMonth()){
			if (hoy.getDate() < nacimiento.getDate()){
				edad -= 1;
			}
		}						
		
		return edad;
	};
	
	function diabetesChkSet(){
		if (vm.diagnosticos.diabetes == 1){
			vm.diabetes_disabled = false;
			let value = vm.diagnosticos.diabetes_tipo;
			if (value == "8" || value == "9"){
				vm.diabetes_gestacional_disabled = false;
			}
		}
	}
	
	function diabetesChkChange(){
		if (vm.diagnosticos.diabetes == 1){
			vm.diabetes_disabled = false;
		}else if(vm.diagnosticos.diabetes == 0){
			//almacenar valores en un historial de diabetes
			vm.diagnosticos.diabetes_tiempo_evolucion = 0;
			vm.diagnosticos.diabetes_tipo = 1;
			vm.diagnosticos.diabetes_semanas_gestacion = 0;
			vm.diabetes_gestacional_disabled = true;
			vm.diabetes_disabled = true;
		}
	}
	
	function diabetesTipoChange(){
		let value = vm.diagnosticos.diabetes_tipo;
		if (value == "8" || value == "9"){
			vm.diabetes_gestacional_disabled = false;
		}else{
			vm.diabetes_gestacional_disabled = true;
		}
	}
	
	function hipertensionArterialChange(){
		let control = vm.diagnosticos.hipertension_arterial;
		if (control == 1){ vm.hipertension_arterial_disabled = false;}
		if (control == 0){ 
			vm.hipertension_arterial_disabled = true;
			vm.diagnosticos.hipertension_arterial_tiempo_evolucion = 0;
		}
	}
	
	function enfermedadTiroideaTipoChange(){
		let control = vm.enfermedades_asociadas.enfermedad_tiroidea;
		if (control == 1){
			vm.enfermedad_tiroidea_disabled = false;			
		}
		if (control == 0){
			vm.enfermedad_tiroidea_disabled = true;
		}
	}
	
	function enfermedadReumaticaTipoChange(){
		let control = vm.enfermedades_asociadas.enfermedad_reumatica;
		if (control == 1){
			vm.enfermedad_reumatica_disabled = false;			
		}
		if (control == 0){
			vm.enfermedad_reumatica_disabled = true;
		}
	}

	function renalNefropatiaChange() {
		let control = vm.renal.nefropatia;
		if (control == 1){
			vm.renal_nefropatia_disabled = false;			
		}
		if (control == 0){
			vm.renal_nefropatia_disabled = true;
		}
	}
	
	function tuvoEpisodiosComplicacionesAgudasChange() {
		let control = vm.complicaciones_agudas_de_diabetes.tuvo_episodios;
		if (control == 1){
			vm.complicaciones_agudas_de_diabetes_tuvo_episodios_disabled = false;
		}
		if (control == 0){
			vm.complicaciones_agudas_de_diabetes_tuvo_episodios_disabled = true;
		}
	}
	
	vm.cantidadEpisodiosChange = function() {
		/*let hipoglucemias = parseInt(vm.complicaciones_agudas_de_diabetes.hipoglucemia_severas);
		let cetoacidosis = parseInt(vm.complicaciones_agudas_de_diabetes.cetoacidosis);
		let result = hipoglucemias + cetoacidosis;
		vm.complicaciones_agudas_de_diabetes.cantidad_episodios_ultimo_anio = result;*/ 
	};
	
	vm.pushArrayUpdates = function(pcontrol, pcampo, nuevo_valor, pcontrol_id){
		pushArrayUpdates(pcontrol, pcampo, nuevo_valor, pcontrol_id);
	}
	
	function pushArrayUpdates(pcontrol, pcampo, nuevo_valor, pcontrol_id){
		let registro = array_updates.find(update => update.control == pcontrol);
		if (registro == undefined){
			let campos = [];
			campos.push({campo: pcampo, valor: nuevo_valor, control_id: pcontrol_id});
			registro = { control:pcontrol, campos:campos };
			array_updates.push(registro);
		}else{
			let subregistro = registro.campos.find(data => data.campo == pcampo);
			if (subregistro == undefined){
				registro.campos.push({campo: pcampo, valor: nuevo_valor, control_id: pcontrol_id});
			}else{
				subregistro.valor = nuevo_valor;
				subregistro.control_id = pcontrol_id;
			}
		}
		vm.save_updates_disabled = false;
		if (array_updates.length > 0){
			vm.estado_guardar = 2;
		}
	}
		
	function saveUpdatesRegistro(){		
		array_updates.forEach(registro => saveUpdatesCampos(registro));
		array_updates = [];
		vm.save_updates_disabled = true;
	}
	
	function saveUpdatesCampos(registro){
		registro.campos.forEach(subregistro => updateHistorial(registro.control,subregistro.campo,subregistro.valor, subregistro.control_id));
	}
	
	function setIntervaloMicroalbuminuria() {
		let value = vm.laboratorio.microalbuminuria;
		if (value < 30){ 
		    vm.laboratorio_intervalo_microalbuminuria = 'menor a 30 mg/dl';
		}
		if (value >= 30 && value <= 300){ 
		    vm.laboratorio_intervalo_microalbuminuria = 'de 30 a 300 mg/dl';
		}
		if (value > 300){ 
		    vm.laboratorio_intervalo_microalbuminuria = 'mayor a 300 mg/dl';
		    
		}	
	}
	
	vm.cancelEditSeguimiento = function(){
		vm.seguimiento = null;
	}
	
	vm.editSeguimiento = function(seguimiento_id){
		vm.seguimiento = vm.seguimientos.find(seguimiento => seguimiento.id == seguimiento_id);
	}
	
	vm.saveEditSeguimiento = function(){
		vm.saveUpdatesRegistro();
		vm.seguimiento = null;
		$(".modal").modal("hide");
	}
	
	vm.cancelEditDatosClinicos = function(){
		vm.datos_clinicos = null;
	}
	
	vm.editDatosClinicos = function(seguimiento_id){
		seguimiento = vm.seguimientos.find(seguimiento => seguimiento.id == seguimiento_id);
		vm.datos_clinicos = seguimiento.datos_clinicos;
	}
	
	vm.saveEditDatosClinicos = function(){
		vm.saveUpdatesRegistro();
		vm.datos_clinicos = null;
		$(".modal").modal("hide");
	}
	
	vm.cancelEditDatosLaboratorio = function(){
		vm.datos_laboratorio = null;
	}
	
	vm.editDatosLaboratorio = function(seguimiento_id){
		seguimiento = vm.seguimientos.find(seguimiento => seguimiento.id == seguimiento_id);
		vm.datos_laboratorio = seguimiento.datos_laboratorio;
	}
	
	vm.saveEditDatosLaboratorio = function(){
		vm.saveUpdatesRegistro();
		vm.datos_laboratorio = null;
		$(".modal").modal("hide");		
	}
	
	vm.cancelEditMedicamentos = function(){
		vm.medicamentos = null;
	}
	
	vm.editMedicamentos = function(seguimiento_id){
		seguimiento = vm.seguimientos.find(seguimiento => seguimiento.id == seguimiento_id);
		vm.medicamentos = seguimiento.medicamentos;
	}
	
	vm.saveEditMedicamentos = function(){
		vm.saveUpdatesRegistro();
		vm.medicamentos = null;
		$(".modal").modal("hide");	
	}
	
	function updateHistorial(control, campo, nuevo_valor, control_id){
		$scope.vm.close_disabled = true;
		vm.estado_guardar = 3;
		var params = {};
		params.url = '/index.php/'+control+'/'+ control_id;
		
		params.method = 'POST';
		params.params = {};
		params.data = { data :{
			campo: campo,
			nuevo_valor: nuevo_valor
			}				
		};
		
		$http({
			method: params.method,
			url:	params.url,
			data:	params.data
		}).then(
			function(response){
				console.log(response);
				$timeout(function(){
					vm.estado_guardar = 1;
					$scope.vm.close_disabled = false;
				}, 1000);
				$timeout(function(){
					$scope.vm.mensajes = '';
				}, 2000);
			},function(response){
				console.log(response.data.error);
		});			
	}

	vm.templates = [
		'/static/templates/sections/personal.html',
		'/static/templates/sections/diagnosticos.html',
		'/static/templates/sections/controles_clinicos.html',
		'/static/templates/sections/laboratorio.html',
		'/static/templates/sections/tratamiento.html',
		'/static/templates/sections/seguimiento.html',
	];
	vm.template = vm.templates[0];	
			
	vm.activeTemplate = function(index){ 
		vm.template = vm.templates[index];
	}; 
	
	$scope.$watch('vm.paciente.nombre', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}		
		pushArrayUpdates('pacientes', 'nombre', newValue, id);			
	});
	
	$scope.$watch('vm.paciente.dni', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'dni', newValue, id);			
	});
	

	$scope.$watch('vm.paciente.genero_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'genero_id', newValue, id);			
	});

	$scope.$watch('vm.paciente.estudio_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'estudio_id', newValue, id);
	});
	

	$scope.$watch('vm.paciente.domicilio', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'domicilio', newValue, id);
	});
	
	$scope.$watch('vm.paciente.fecha_nacimiento', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'fecha_nacimiento', newValue, id);
	});		

	$scope.$watch('vm.paciente.obra_social_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'obra_social_id', newValue, id);
	});
	
	$scope.$watch('vm.paciente.estado_civil_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'estado_civil_id', newValue, id);
	});
	
	$scope.$watch('vm.paciente.estado_civil_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'estado_civil_id', newValue, id);
	});

	$scope.$watch('vm.paciente.departamento_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'departamento_id', newValue, id);
	});
	
	$scope.$watch('vm.paciente.localidad_id', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'localidad_id', newValue, id);
	});
	
	$scope.$watch('vm.paciente.telefono', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('pacientes', 'telefono', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.glucemia_alterada_en_ayunas', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'glucemia_alterada_en_ayunas', newValue, id);
	});
		
	$scope.$watch('vm.diagnosticos.tolerancia_glucosa_alterada', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'tolerancia_glucosa_alterada', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.diabetes', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'diabetes', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.diabetes_tiempo_evolucion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'diabetes_tiempo_evolucion', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.diabetes_tipo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'diabetes_tipo', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.diabetes_semanas_gestacion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'diabetes_semanas_gestacion', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.dislipemia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'dislipemia', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.hipertension_arterial', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'hipertension_arterial', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.hipertension_arterial_tiempo_evolucion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'hipertension_arterial_tiempo_evolucion', newValue, id);
	});
	
	$scope.$watch('vm.diagnosticos.preclasificacion_rcvg', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('diagnosticos', 'preclasificacion_rcvg', newValue, id);
	});
		
	$scope.$watch('vm.enfermedades_asociadas.enfermedad_tiroidea_tipo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermedades_asociadas', 'enfermedad_tiroidea_tipo', newValue, id);
	});
	
	$scope.$watch('vm.enfermedades_asociadas.enfermedad_tiroidea', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermedades_asociadas', 'enfermedad_tiroidea', newValue, id);
	});
	
	$scope.$watch('vm.enfermedades_asociadas.enfermedad_reumatica', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermedades_asociadas', 'enfermedad_reumatica', newValue, id);
	});
	
	$scope.$watch('vm.enfermedades_asociadas.enfermedad_reumatica_tipo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermedades_asociadas', 'enfermedad_reumatica_tipo', newValue, id);
	});
	
	$scope.$watch('vm.enfermedades_asociadas.enfermedad_celiaca', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermedades_asociadas', 'enfermedad_celiaca', newValue, id);
	});
	
	$scope.$watch('vm.enfermedades_asociadas.tbc', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermedades_asociadas', 'tbc', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.obesidad', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'obesidad', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.sedentarismo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'sedentarismo', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.tabaco', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'tabaco', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.alcoholismo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'alcoholismo', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.anticoagulantes', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'anticoagulantes', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.corticoides', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'corticoides', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.anticonceptivos', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'anticonceptivos', newValue, id);
	});
	
	$scope.$watch('vm.factores_de_riesgo_asociados.menospausia_prematura', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('factores_de_riesgo_asociados', 'menospausia_prematura', newValue, id);
	});
	
	$scope.$watch('vm.antecedentes_familiares.hta', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('antecedentes_familiares', 'hta', newValue, id);
	});
	
	$scope.$watch('vm.antecedentes_familiares.iam', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('antecedentes_familiares', 'iam', newValue, id);
	});
	
	$scope.$watch('vm.antecedentes_familiares.acv_ait', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('antecedentes_familiares', 'acv_ait', newValue, id);
	});
	
	$scope.$watch('vm.antecedentes_familiares.dislipemia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('antecedentes_familiares', 'dislipemia', newValue, id);
	});
	
	$scope.$watch('vm.antecedentes_familiares.diabetes', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('antecedentes_familiares', 'diabetes', newValue, id);
	});
	
	$scope.$watch('vm.antecedentes_familiares.enf_celiaca', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('antecedentes_familiares', 'enf_celiaca', newValue, id);
	});
	
	$scope.$watch('vm.odontologia.control_odontologico', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('odontologia', 'control_odontologico', newValue, id);
	});
	
	$scope.$watch('vm.odontologia.enfermedad_periodontal', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('odontologia', 'enfermedad_periodontal', newValue, id);
	});
	
	$scope.$watch('vm.odontologia.flemones', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('odontologia', 'flemones', newValue, id);
	});
		
	$scope.$watch('vm.psicologia.realizo_entrevista', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('psicologia', 'realizo_entrevista', newValue, id);
	});
	
	$scope.$watch('vm.psicologia.asiste_a_terapia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('psicologia', 'asiste_a_terapia', newValue, id);
	});
	
	$scope.$watch('vm.enfermeria.consejeria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermeria', 'consejeria', newValue, id);
	});
	
	$scope.$watch('vm.enfermeria.curaciones', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('enfermeria', 'curaciones', newValue, id);
	});
	
	$scope.$watch('vm.oftalmologia.examen_actual', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'examen_actual', newValue, id);
	});
	$scope.$watch('vm.oftalmologia.fondo_de_ojos', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'fondo_de_ojos', newValue, id);
	});
	$scope.$watch('vm.oftalmologia.amaurosis', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'amaurosis', newValue, id);
	});
	$scope.$watch('vm.oftalmologia.cataratas', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'cataratas', newValue, id);
	});
	
	$scope.$watch('vm.oftalmologia.glaucoma', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'glaucoma', newValue, id);
	});
	
	$scope.$watch('vm.oftalmologia.maculopatia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'maculopatia', newValue, id);
	});
	
	$scope.$watch('vm.oftalmologia.retinopatia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'retinopatia', newValue, id);
	});
	
	$scope.$watch('vm.oftalmologia.proliferativa', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'proliferativa', newValue, id);
	});
	
	$scope.$watch('vm.oftalmologia.no_proliferativa', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('oftalmologia', 'no_proliferativa', newValue, id);
	});
		
	$scope.$watch('vm.examen_fisico.peso', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('examen_fisico', 'peso', newValue, id);
	});
	
	$scope.$watch('vm.examen_fisico.talla', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('examen_fisico', 'talla', newValue, id);
	});
	
	$scope.$watch('vm.examen_fisico.perimetro_cintura', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('examen_fisico', 'perimetro_cintura', newValue, id);
	});
	
	$scope.$watch('vm.examen_fisico.imc', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('examen_fisico', 'imc', newValue, id);
	});
	
	$scope.$watch('vm.examen_fisico.ta_sistolica', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('examen_fisico', 'ta_sistolica', newValue, id);
	});
	
	$scope.$watch('vm.examen_fisico.ta_diastolica', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('examen_fisico', 'ta_diastolica', newValue, id);
	});
		
	$scope.$watch('vm.complicaciones_agudas_de_diabetes.tuvo_episodios', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('complicaciones_agudas_de_diabetes', 'tuvo_episodios', newValue, id);
	});
	
	$scope.$watch('vm.complicaciones_agudas_de_diabetes.hipoglucemia_severas', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('complicaciones_agudas_de_diabetes', 'hipoglucemia_severas', newValue, id);
	});
	
	$scope.$watch('vm.complicaciones_agudas_de_diabetes.cetoacidosis', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('complicaciones_agudas_de_diabetes', 'cetoacidosis', newValue, id);
	});
		
	$scope.$watch('vm.nutricion.tiene_conocimientos_basicos', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('nutricion', 'tiene_conocimientos_basicos', newValue, id);
	});
	$scope.$watch('vm.nutricion.asiste_control', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('nutricion', 'asiste_control', newValue, id);
	});
	$scope.$watch('vm.nutricion.cumple_plan_de_alimentacion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('nutricion', 'cumple_plan_de_alimentacion', newValue, id);
	});
		
	$scope.$watch('vm.circulatorio.acv_ait', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('circulatorio', 'acv_ait', newValue, id);
	});
	
	$scope.$watch('vm.circulatorio.aim', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('circulatorio', 'aim', newValue, id);
	});
	
	$scope.$watch('vm.circulatorio.angioplastia_bypass', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('circulatorio', 'angioplastia_bypass', newValue, id);
	});
	
	$scope.$watch('vm.circulatorio.ecg', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('circulatorio', 'ecg', newValue, id);
	});
	
	$scope.$watch('vm.circulatorio.ecodoppler', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('circulatorio', 'ecodoppler', newValue, id);
	});
		
	$scope.$watch('vm.renal.nefropatia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('renal', 'nefropatia', newValue, id);
	});
	
	$scope.$watch('vm.renal.nefropatia_tipo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('renal', 'nefropatia_tipo', newValue, id);
	});
	
	$scope.$watch('vm.renal.dialisis', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('renal', 'dialisis', newValue, id);
	});
	
	$scope.$watch('vm.renal.transplante', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('renal', 'transplante', newValue, id);
	});
	
	$scope.$watch('vm.renal.ecografia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('renal', 'ecografia', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.glucemia_en_ayunas', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'glucemia_en_ayunas', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.ptog_desde', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'ptog_desde', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.ptog_hasta', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'ptog_hasta', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.hba1c', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'hba1c', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.clearence_de_creatinina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'clearence_de_creatinina', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.colesterol_total', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'colesterol_total', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.got', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'got', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.gpt', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'gpt', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.fal', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'fal', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.proteinuria_creatininuria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'proteinuria_creatininuria', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.trigliceridos', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'trigliceridos', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.colesterol_hdl', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'colesterol_hdl', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.colesterol_ldl', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'colesterol_ldl', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.creatinina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'creatinina', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.fg', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'fg', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.iga_total', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'iga_total', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.antitransglutaminasa', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'antitransglutaminasa', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.proteinuria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'proteinuria', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.urea', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'urea', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.microalbuminuria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'microalbuminuria', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.nivel_de_riesgo_cardiovascular_global', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'nivel_de_riesgo_cardiovascular_global', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.observaciones', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'observaciones', newValue, id);
	});
	
	$scope.$watch('vm.laboratorio.participacion_talleres_autocuidado', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('laboratorio', 'participacion_talleres_autocuidado', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.insulina_nph', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'insulina_nph', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.metformina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'metformina', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.glibenclamida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'glibenclamida', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.enalapril', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'enalapril', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.atenolol', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'atenolol', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.furosemida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'furosemida', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.insulina_rapida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'insulina_rapida', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.hidroclorotiazida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'hidroclorotiazida', newValue, id);
	});
	

	$scope.$watch('vm.tratamiento_actual.aas', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'aas', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.simvastatina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'simvastatina', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.fenofibrato', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'fenofibrato', newValue, id);
	});
	
	$scope.$watch('vm.tratamiento_actual.automonitoreo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('tratamiento_actual', 'automonitoreo', newValue, id);
	});
   
	$scope.$watch('vm.solicitud_interconsulta.cardiologia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'cardiologia', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_interconsulta.endocrinologia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'endocrinologia', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_interconsulta.nefrologia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'nefrologia', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_interconsulta.nutricion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'nutricion', newValue, id);
	});
	

	$scope.$watch('vm.solicitud_interconsulta.odontologia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'odontologia', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_interconsulta.oftalmologia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'oftalmologia', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_interconsulta.psicologia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_interconsulta', 'psicologia', newValue, id);
	});
	
	$scope.$watch('vm.inmunizaciones.antigripal', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('inmunizaciones', 'antigripal', newValue, id);
	});
	
	$scope.$watch('vm.inmunizaciones.antineumococo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('inmunizaciones', 'antineumococo', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_practica.laboratorios', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_practica', 'laboratorios', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_practica.laboratorios_observacion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_practica', 'laboratorios_observacion', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_practica.otros_estudios', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_practica', 'otros_estudios', newValue, id);
	});
	
	$scope.$watch('vm.solicitud_practica.otros_estudios_observacion', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('solicitud_practica', 'otros_estudios_observacion', newValue, id);
	});
		  
	$scope.$watch('vm.seguimiento.fecha', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('seguimiento', 'fecha', newValue, vm.datos_laboratorio.id);
	});
	$scope.$watch('vm.seguimiento.adherencia_al_tratamiento', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('seguimiento', 'adherencia_al_tratamiento', newValue, vm.seguimiento.id);
	});

	$scope.$watch('vm.seguimiento.ecg', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('seguimiento', 'ecg', newValue, vm.seguimiento.id);
	});
	
	$scope.$watch('vm.seguimiento.riesgo_cardiovascular', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('seguimiento', 'riesgo_cardiovascular', newValue, vm.seguimiento.id);
	});

	$scope.$watch('vm.seguimiento.automonitoreo', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('seguimiento', 'automonitoreo', newValue, vm.seguimiento.id);
	});

	$scope.$watch('vm.datos_clinicos.tabaco', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_clinicos', 'tabaco', newValue, vm.datos_clinicos.id);
	});
	
	$scope.$watch('vm.datos_clinicos.peso', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_clinicos', 'peso', newValue, vm.datos_clinicos.id);
	});

	$scope.$watch('vm.datos_clinicos.imc', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		
		
		pushArrayUpdates('datos_clinicos', 'imc', newValue, vm.datos_clinicos.id);
	});
	
	$scope.$watch('vm.datos_clinicos.tension_arterial', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_clinicos', 'tension_arterial', newValue, vm.datos_clinicos.id);
	});

	$scope.$watch('vm.datos_clinicos.perimetro_cintura', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_clinicos', 'perimetro_cintura	', newValue, vm.datos_clinicos.id);
	});
	
	$scope.$watch('vm.datos_clinicos.examen_pies', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_clinicos', 'examen_pies', newValue, vm.datos_clinicos.id);
	});
	
	$scope.$watch('vm.datos_laboratorio.glucemia', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'glucemia', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.hba1c', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'hba1c', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.got', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'got', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.gpt', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'gpt', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.fal', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'fal', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.colesterol_total', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'colesterol_total', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.hdl', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'hdl', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.ldl', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'ldl', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.trigliceridos', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'trigliceridos', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.clearence_de_creatinina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'clearence_de_creatinina', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.creatinina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'creatinina', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.estadio', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'estadio', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.proteinuria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'proteinuria', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.creatininuria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'creatininuria', newValue, vm.datos_laboratorio.id);
	});

	$scope.$watch('vm.datos_laboratorio.microalbuminuria', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('datos_laboratorio', 'microalbuminuria', newValue, vm.datos_laboratorio.id);
	});

		
	$scope.$watch('vm.medicamentos.insulina_nph', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'insulina_nph', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.insulina_rapida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'insulina_rapida', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.metformina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'metformina', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.glibenclamida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'glibenclamida', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.enalapril', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'enalapril', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.atenolol', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'atenolol', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.hidroclorotiazida', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'hidroclorotiazida', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.aas', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'aas', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.simvastatina', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'simvastatina', newValue, vm.medicamentos.id);
	});

	$scope.$watch('vm.medicamentos.fenofibrato', function(newValue, oldValue){
		if (newValue === oldValue || newValue === undefined || oldValue === undefined){
			return;
		}
		pushArrayUpdates('medicamentos', 'fenofibrato', newValue, vm.medicamentos.id);
	});

}]);
