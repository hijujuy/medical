
angular.module('historialApp').controller('homeController', ['$location', 
	function homeController($location){
		var vm = this;
		
		vm.usuario = 'invitado';
		vm.usuarios = getUsuarios();
		
		vm.login = function(){
			if (validarUsuario(vm.login_name, vm.login_password)){
				$location.path('/list');
			}else{
				vm.login_name = "";
				vm.login_password = "";
				alert('Datos incorrectos, intente nuevamente.');				
			}
		};
		
		function validarUsuario(name, password){
			var valido = false;
			vm.usuarios.forEach(function(user){
				if ((user.name == name)&&(user.password == password)){
					valido = true;
				}
			});
			
			return valido;
		}
				
		function getUsuarios() {
			return usuarios = [
				{'name':'juan', 'password':'123'},
				{'name':'monica', 'password':'123'},
				{'name':'luz', 'password':'456'},
				{'name':'ivana', 'password':'789'}
			];
		}
}]);
