historialApp.controller('homeController', ['$location', '$cookieStore', 'homeService',
	function homeController($location, $cookieStore, homeService){
		var vm = this;
		let ok = 200;
		let createOk = 201;
		let forbidden = 400;
		let unauthorized = 401;
		$('#alert-login').hide();
		
		vm.create = function() {
			homeService.create(vm.login_name, vm.login_password).then(
				function(response) {
					if (response.data.ok) {
						setFocusInputData('Usuario creado exitosamente');
						$location.path('/');	
					}
					if (response.status == forbidden) {
						setFocusInputData(response.data.message);
					}
				}
			);
		};

		vm.login = function(){
			homeService.login(vm.login_name, vm.login_password).then(
				function(response){
					if (response.status == ok){
						user = response.data.user;
						$cookieStore.put('id', user.id);
						$cookieStore.put('user', user.email);
						$cookieStore.put('rol', user.rol);
						vm.user = $cookieStore.get('user');
						$location.path('/list');
					}
					if (response.status == unauthorized){
						setFocusInputData(response.data.message);
					}					
				}
			);
		};		

		vm.show_pass = function() {
			let pass = document.getElementById('password');
			if (pass.type == 'password'){
				pass.type = 'text';
				$('#icon-show-pass').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
			}else {
				pass.type = 'password';
				$('#icon-show-pass').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
			}
		}

		function setFocusInputData(message){
			$('#alert-login').html(message);
			$('#alert-login').show('slow')
			setTimeout(function () {
				$('#alert-login').hide('slow');
				$('#password').val('');
				$('#email').val('');
				$('#email').focus();
			}, 5000);
		}
	}
]);