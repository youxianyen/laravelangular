;(function(){
	'use strict';
	
	angular.module('xiaohu', [
		'ui.router',
		])
	.config(function($interpolateProvider, 
		              $stateProvider, 
		              $urlRouterProvider)
	{
        $interpolateProvider.startSymbol('[:');
        $interpolateProvider.endSymbol(':]');

        $urlRouterProvider.otherwise('/home');

        $stateProvider
          .state('home', {
          	url: '/home',
          	templateUrl: "home.tpl"
          })
          .state('signup', {
          	url: '/signup',
          	templateUrl: "signup.tpl"
          })
          .state('login', {
          	url: '/login',
          	templateUrl: "login.tpl"
          })
	})
	
  .service('UserService', [
    'http',
    function($http){
      var me = this;
      me.signup_data = {};
      me.signup = function()
      {
        
      }
      me.username_exists = function()
      {
        $http.post('api/user/exists', 
          {username: me.signup_data.username})
        .then(function(r){
          console.log('r', r); 
          }, function(e){
          console.log('e', e); 
          })
      }
    }])

  .controller('SignupController', [
        '$scope', 
        'UserService',
        function($scope, UserService)
        {
            $scope.User = UserService;

            $scope.$watch(function(){
              return UserService.signup_data;
            }, function(n, o){
              
              if (n.username != o.username) //监控修改了username
              {
                UserService.username_exists(); //执行
              }
            }, true);

        }])
})();