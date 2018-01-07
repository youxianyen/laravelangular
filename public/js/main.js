
// 因为angular和laravel和模板中的变量冲突
// 配置
;(function () {
    'use strict';
    angular.module('xiaohu', [
        'ui.router',
        'user', 'question', 'common', 'answer'
    ]).config(['$interpolateProvider', '$stateProvider', '$urlRouterProvider',
            function ($interpolateProvider, $stateProvider, $urlRouterProvider) {
            $interpolateProvider.startSymbol('[:');
            $interpolateProvider.endSymbol(':]');

            $urlRouterProvider.otherwise('/home');
            $stateProvider.state('home', {
                url: '/home',
                templateUrl: 'tpl/home'
            }).state('login', {
                url: '/login',
                templateUrl: 'tpl/login'
            }).state('signup', {
                url: '/signup',
                templateUrl: 'tpl/signup'
            }).state('question', {
                abstract: true,     //这里是抽象的路由，不可直接访问
                url: '/question',
                template: '<div ui-view></div>',
                controller: 'QuestionController'
            }).state('question.add', {
                url: '/question/add',
                templateUrl: 'tpl/question_add'
            }).state('question.detail', {
                url: '/question/detail/:id?answer_id',
                templateUrl: 'tpl/question_detail'
            }).state('user', {
                url: '/user/:id',
                templateUrl: 'tpl/user'
            });
        }]);

})();