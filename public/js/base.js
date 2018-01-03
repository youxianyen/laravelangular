;(function(){
	'use strict';
	
	angular.module('xiaohu', [
    'ui.router',
    ])
  .config([
    '$interpolateProvider',
    '$stateProvider',
    '$urlRouterProvider', 
    function($interpolateProvider, 
             $stateProvider, 
             $urlRouterProvider)
    {
      $interpolateProvider.startSymbol('[:');
      $interpolateProvider.endSymbol(':]');
  
      $urlRouterProvider.otherwise('/home');
  
      $stateProvider
         .state('home', {
            url: '/home',
            templateUrl: 'home.tpl'
         })
         .state('signup', {
            url: '/signup',
            templateUrl: 'signup.tpl'
         })
         .state('login', {
            url: '/login',
            templateUrl: 'login.tpl'
         })
         .state('question', {
            abstract: true,
            url: '/question',
            template: '<div ui-view></div>'
         })
         .state('question.add', {
            url: '/add',
            templateUrl: 'question.add.tpl'
         })
    }])

  .service('UserService', [
    '$state',
    '$http',
    function($state, $http)
    {
      var me = this;
      me.signup_data = {};
      me.login_data = {};
      me.signup = function ()
      {
        $http.post('/api/signup', me.signup_data)
          .then(function(r){
            if (r.data.status) 
            {
              me.signup_data = {};    //清空数据
              $state.go('login');
            }
          }, function(e){
            console.log('e', e);
          })
      } 

      me.login = function ()
      {
        $http.post('/api/login', me.login_data)
          .then(function(r)
          {
            if (r.data.status) 
            {
              //$state.go('home');
              location.href = '/';
            }
            else 
            {
              me.login_failed = true;
            }
          }, function()
          {
          })
      }

      me.username_exists = function()
      {
        $http.post('/api/user/exist', 
          {username: me.signup_data.username}) 
          .then(function(r){  //执行成功返回第一个function
            me.signup_username_exists = false;
            if (r.data.status && r.data.data.count) 
            {
              me.signup_username_exists = true;
            }
            else 
            {
              me.signup_username_exists = false;
            }
          }, function(e){  //执行失败返回第二个function
            console.log('e', e);
          });
      }
    }])

  .controller('SignupController', [
    '$scope',
    'UserService',
    function ($scope, UserService)  
    {
      $scope.User = UserService;
      $scope.$watch(function(){  //监控数据,返回内容
        return UserService.signup_data;
      }, function(n, o){  //监控数据发生变化
        if (n.username != o.username) 
        {
          UserService.username_exists();
        }
      }, true);  //加入第三个参数true，递归的检查每一组数据
    }
    ])

  .controller('LoginController', [
    '$scope',
    'UserService', 
    function ($scope, UserService){
      $scope.User = UserService;
    }
    ])

  .service('QuestionService', [
    '$http', 
    '$state', 
    function($http, $state)
    {
      var me = this;
      me.new_question = {};

      me.go_add_question = function()
      {
        $state.go('question.add');
      }
      
      me.add = function ()
      {
        if (!me.new_question.title)
          return;
        $http.post('/api/question/add', me.new_question)
          .then(function(r)
          {

            if (r.data.status) 
            {
              me.new_question = {};    //重置
              $state.go('home');
            }
          }, function(e)
          {

          })
      }
    }])

  .controller('QuestionAddController', [
    '$scope',
    'QuestionService', 
    function($scope, QuestionService){
      $scope.Question = QuestionService;
    }])
})();