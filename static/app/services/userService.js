historialApp.service('userService', ['$http', 
	function homeService($http) {
		this.users = function() {
			return $http({
				url:'/index.php/usuario', 
				method:'GET'
			}).then(
				function(data){
					return data;
				},
				function(error){
					return error;
				}
			);
		};

		this.create = function(username, password, rol) {
			datos = { email: username, password: password, rol: rol };
			return $http({
				url: '/index.php/create_user',
				method: 'POST',
				data: datos
			}).then(
				function(data) {
					return data;
				},
				function(error) {
					return error;
				}
			);
		};
	}	
]);