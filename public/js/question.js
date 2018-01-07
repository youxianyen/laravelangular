;(function(){
	'use strict';

	angular.module('question', [])

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
      
      me.read = function (params){
        return $http.post('/api/question/read', params)
          .then(function (r)
          {
            if (r.data.status)
              {
                me.data = angular.merge({}, me.data, r.data.data);
                return r.data.data;  
              }         
              return false; 
          })
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
            else 
            {
            	
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