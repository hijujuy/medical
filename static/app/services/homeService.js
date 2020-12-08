historialApp.service('homeService', ['$http', 
	function homeService($http) {
		this.login = function(username, password) {
			datos = { email: username, password: password};
			return $http({
				url:'/index.php/usuario', 
				method:'POST',
				data: datos
			}).then(
				function(data){
					return data;
				},
				function(error){
					return error;
				}
			);
		};
	}	
]);