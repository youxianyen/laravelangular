;(function(){
	'use strict';

	angular.module('user', [
    'answer'
    ])

	.service('UserService', [
    '$state',
    '$http',
    function($state, $http)
    {
      var me = this;
      me.signup_data = {};
      me.login_data = {};
      me.data = {};

      me.read = function (param) 
      {
        return $http.post('/api/user/read', param)
          .then(
            function (r) 
            {
              if (r.data.status) 
              {
                me.current_user = r.data.data;
                me.data[param.id] = r.data.data;               
              }
              else 
              {
                if (r.data.msg == 'login required')                 
                  $state.go('login');                
              }
            })
      }

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
          .then(
            function(r)
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

      $scope.$watch(function () {  //监控数据,返回内容
        return UserService.signup_data;
      }, function (n, o) {  //监控数据发生变化
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

  .controller('UserController', [
    '$scope', 
    '$stateParams',
    'AnswerService',
    'QuestionService', 
    'UserService',
    function($scope, $stateParams, AnswerService, QuestionService, UserService)
    {
      $scope.User = UserService;
      console.log('stateParams', $stateParams);
      UserService.read($stateParams);
      AnswerService.read({user_id: $stateParams.id})
        .then(
          function (r)
          {
            if (r)
              UserService.his_answers = r;
          })

      QuestionService.read({user_id: $stateParams.id})
        .then(
          function (r)
          {
            if (r)
              UserService.his_questions = r;
          })
    }])

})();