historialApp.controller('userController', ['$http','$location', 'userService',
	function userController($http, $location, userService) {
		let vm = this;
		//$('#alert-new-user').hide();
		
		userService.users().then(
			function(response){
				vm.users = response.data.users;
			},
			function(error){
				vm.error = error;
			}
		);
				
		vm.volver = function(){
			$location.path('/list');
		};

		vm.cancel = function() {
			$location.path('/users');
		}
		
        vm.create = function() {
			userService.create(vm.name, vm.password, vm.rol).then(
				function(response) {
					if (response.status == 200) {
						$location.path('/users');						
					}
					if (response.status == 401) {
						vm.mensaje = response.data.message;
					}
				}
			);
		};

}]);