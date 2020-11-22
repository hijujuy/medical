angular.module('historialApp').
	config(['$routeProvider',
		function ($routeProvider) {
			$routeProvider.
				when('/', {
					controller: 'homeController',
					controllerAs: 'vm',
					templateUrl: 'static/templates/historiales-home.html'
					
				}).
				when('/list', {
					controller: 'listController',
					controllerAs: 'vm',
					templateUrl: 'static/templates/historiales-list.html'
				}).
				when('/new', {
					controller: 'newController',
					controllerAs: 'vm',
					templateUrl: 'static/templates/historiales-new.html'
				}).
				when('/edit/:id', {
					controller: 'editController',
					controllerAs: 'vm',
					templateUrl: 'static/templates/historiales-edit.html'
				}).
				otherwise('/');
		}
	]);