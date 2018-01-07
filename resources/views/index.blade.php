<!DOCTYPE html>
<html lang="zh" ng-app="xiaohu" user-id="{{session('user_id')}}">
<head>
	<meta charset="utf-8">
	<title>晓乎</title>
	<link rel="stylesheet" type="text/css" href="/node_modules/normalize-css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<script type="text/javascript" src="/node_modules/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="/node_modules/angular/angular.js"></script>
	<script type="text/javascript" src="/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
	<script type="text/javascript" src="/js/base.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/user.js"></script>
	<script type="text/javascript" src="/js/question.js"></script>
	<script type="text/javascript" src="/js/answer.js"></script>
</head>
<body>
<div class="navbar clearfix">
	<div class="fl">
		<div ur-sref="home" class="navbar-item brand">暁乎</div>
		<form ng-submit="Question.go_add_question()" id="quick_ask" ng-controller="QuestionAddController">
			<div class="navbar-item">				
					<input ng-model="Question.new_question.title" type="text"></input>
			</div>
			<div class="navbar-item">				
					<button type="submit">提问</button>
			</div>
		</form>
	</div>
	<div class="fr">
		<a ui-sref="home" class="navbar-item">首页</a>
		@if(is_logged_in())		
		<a ur-sref="login" class="navbar-item">{{session('username')}}</a>
		<a href="{{url('/api/logout')}}" class="navbar-item">登出</a>
		@else
		<a ui-sref="login" class="navbar-item">登录</a>
		<a ui-sref="signup" class="navbar-item">注册</a>
		@endif
	</div>
</div>
<div class="page">
	<div ui-view></div>
</div>
</body>
</html>