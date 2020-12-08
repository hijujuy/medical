
historialApp.controller('listController', ['$http','$location', '$cookieStore',
	function listController($http, $location, $cookieStore){
		var vm = this;
		$('#btn-user').hide();
		if ($cookieStore.get('rol') == 'admin') {
			$('#btn-user').show();
		}

		getPacientes().then(function(data){			
			vm.pacientes = data;
		});		
		
		vm.open = function(id) {
			$location.path('/edit/'+id);
		};
		
		vm.exit = function(){
			$cookieStore.remove('id', user.id);
			$cookieStore.remove('user', user.email);
			$cookieStore.remove('rol', user.rol);
			$location.path('/');
		};
		
		function getPacientes(){
			urlpacientes = '/index.php/pacientes/'+$cookieStore.get('id');
			return $http({url: urlpacientes, method:'GET'}).then(
				function(response){
					return response.data.pacientes;
				},
				function(error){
					return error.status;
				}
			);
		};	
}]); 
