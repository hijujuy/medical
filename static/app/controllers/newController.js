
angular.module('historialApp').controller('newController', ['$http','$location',
	function newController($http, $location){
		var vm = this;
		vm.paciente = {};
		var array_localidad = [];
		
		getArrayObraSocial().then(
				function(data){ 
					vm.array_obra_social = data;
		});
		getArrayEstadoCivil().then(
				function(data){ 
					vm.array_estado_civil = data;
		});
		getArrayDepartamento().then(
				function(data){ 
					vm.array_departamento = data;
		});
		getArrayLocalidad().then(
				function(data){ 
					array_localidad = data;
		});
				
		/*
		 * Metodo del controlador, crea un historial
		 */
		vm.cancel = function(){
			vm.paciente = {}; //vaciar objeto paciente
			$location.path('/list');
		}		
		
		vm.save = function(){
			var params = {};
			params.url = '/index.php/historial';
			params.method = 'POST';
			params.params = {};
			params.data = {
					hospital_id: 1,
					paciente: vm.paciente
			};
			
			$http({
				method: params.method,
				url:	params.url,
				data:	params.data
			}).then(function(response){
				alert('save ok');
				var id = response.data.id;
				$location.path('/edit/'+id);
				console.log(response.data.id);
			}, function(error){
				alert('save cant do');
				console.log(error);
			});
						
		}
		
		function getArrayObraSocial(){
			var params = {};
			params.url = '/index.php/obra_social';
			params.method = 'GET';
			
			return $http(params).then(
				function(response){					
					return response.data.obra_social;
				},
				function(error){
					return error.status;
				}
			);
		}
		
		function getArrayEstadoCivil(){
			var params = {};
			params.url = '/index.php/estado_civil';
			params.method = 'GET';
			
			return $http(params).then(
				function(response){					
					return response.data.estado_civil;
				},
				function(error){
					return error.status;
				}
			);
		}
		
		function getArrayDepartamento(){
			var params = {};
			params.url = '/index.php/departamento';
			params.method = 'GET';
			
			return $http(params).then(
				function(response){					
					return response.data.departamento;
				},
				function(error){
					return error.status;
				}
			);
		}
		
		vm.departamento_change = function(){
			var id = vm.paciente.departamento_id;
			vm.array_localidad = array_localidad.filter(function(value){
				return value.departamento_id == id;
			});			
		}
		
		function getArrayLocalidad(){
			var params = {};
			params.url = '/index.php/localidad';
			params.method = 'GET';
			
			return $http(params).then(
				function(response){					
					return response.data.localidad;
				},
				function(error){
					return error.status;
				}
			);
		}
		
		vm.localidad_change = function(){
			var id = vm.paciente.localidad.id;
			var localidad = {};
			localidad = vm.array_localidad.filter(function(value){
				return value.id == id;
			});
			vm.paciente.codigo_postal = localidad[0].codigo_postal;
		}
	
}]);
