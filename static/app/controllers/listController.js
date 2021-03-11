
angular.module('historialApp').controller('listController', ['$http','$location',
	function listController($http, $location){
		var vm = this;
		getPacientes().then(function(data){
			vm.pacientes = data;
		});		
		
		vm.open = function(id) {
			$location.path('/edit/'+id);
		};
		
		vm.exit = function(){			
			$location.path('/');
		};
		
		function getPacientes(){			
			return $http({url:'/index.php/pacientes', method:'GET'}).then(
				function(response){
					return response.data.pacientes;
				},
				function(error){
					return error.status;
				}
			);
		};	
			
}]); 
