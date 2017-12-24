<!DOCTYPE html>
<html lang="zh" ng-app="xiaohu">
<head>
	<meta charset="utf-8">
	<title>晓乎</title>
	<link rel="stylesheet" type="text/css" href="/node_modules/normalize-css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<script type="text/javascript" src="/node_modules/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="/node_modules/angular/angular.js"></script>
	<script type="text/javascript" src="/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
	<script type="text/javascript" src="/js/base.js"></script>
</head>
<body>
<div class="navbar clearfix">
<div class="container">
	<div class="fl">
		<div class="navbar-item brand">晓乎</div>
			<form ng-submit="Question.go_add_question()" id="quick_ask" ng-controller="QuestionAddController">
				<div class="navbar-item">
			        <input ng-model="Question.new_question.title" type="text" name="">			        			
				</div>
                <div class="navbar-item">
			        <button type="submit">提问</button>			        			
				</div>
			</form>
	</div>
	<div class="fr">
		<a ui-sref="home" class="navbar-item">首页</a>
		@if(is_logged_in())
		<a ui-sref="{{url('/logout')}}" class="navbar-item">{{session('username')}}</a>
		<a href="{{url('api/logout')}}" class="navbar-item">登出</a>
		@else
		<a ui-sref="login" class="navbar-item">登录</a>
		<a ui-sref="signup" class="navbar-item">注册</a>
		@endif
	</div>
</div>
</div>

<div class="page">
	<div ui-view></div>
</div>

</body>
<!-- .page .home -->
<script type="text/ng-template" id="home.tpl">
<div ng-controller="HomeController" class="home card container">	
	<h1>最近动态</h1>
	<div class="hr"></div>
	<div class="item-set">
		<div class="item">
			<div class="vote"></div>
			<div class="feed-item-content">
				<div class="content-act">猪八戒赞同了该回答</div>
				<div class="title">哪个瞬间让你觉得读书很有用？</div>
				<div class="content-owner">子墨子</div>
				<div class="content-main">
					(CNN)Santa Claus is coming to town -- or so about 85% of young American children believe.

In interviews, 85% of 4-year-olds said that they believed in Santa, 65% of 6-year-olds said that they believed, and 25% of 8-year-olds said that they believed. Those numbers were published in a small study in the American Journal of Orthopsychiatry in 1978.
But researchers say those percentages of young children who believe in jolly old Saint Nick seem to have remained steady over the years.
				</div>
				<div class="action-set">
					<div class="comment">评论</div>
				</div>
				<div class="comment-block">
					<div class="hr"></div>
                    <div class="comment-item-set">
                    	<div class="rect"></div>
                    	<div class="comment-item clearfix">
                            <div class="user">李明</div>
                            <div class="comment-content">But researchers say those percentages of young children who believe in jolly old Saint Nick seem to have remained steady over the years.
                            </div>
                    	</div>
                    	<div class="comment-item clearfix">
                            <div class="user">李明</div>
                            <div class="comment-content">But researchers say those percentages of young children who believe in jolly old Saint Nick seem to have remained steady over the years.
                            </div>
                    	</div>
                    	<div class="comment-item clearfix">
                            <div class="user">李明</div>
                            <div class="comment-content">But researchers say those percentages of young children who believe in jolly old Saint Nick seem to have remained steady over the years.
                            </div>
                    	</div>
                    </div>
				</div>
			</div>			
		</div>
		<div class="hr"></div>


	</div>
</div>	

</script>

<script type="text/ng-template" id="signup.tpl">
<div ng-controller="SignupController" class="signup container">
	<div class="card">
		<h1>注册</h1>
		<!-- [: User.signup_data :] -->
		<form name="signup_form" ng-submit="User.signup()">
			<div class="input-group">
				<label>用户名</label>
			    <input type="text" 
			    ng-minlength="4" 
			    ng-maxlength="24" 
			    name="username" 
			    ng-model="User.signup_data.username" 
			    ng-model-options="{debounce: 500}"
			    required>
			    <div ng-if="signup_form.username.$touched" class="input-error-set">
			    	<div ng-if="signup_form.username.$error.required">
			    	用户名为必填项
			        </div>
			        <div ng-if="signup_form.username.$error.maxlength || signup_form.username.$error.minlength">
			        	用户名长度需要在4-24位之间
			        </div>
			        <div ng-if="User.signup_username_exists">
			        	用户名已存在
			        </div>
			    </div>
			</div>
			<div class="input-group">
				<label>密码</label>
			    <input name="password" 
			    type="password" 
			    ng-minlength="6" 
			    ng-maxlength="255" 
			    ng-model="User.signup_data.password" 
			    required>
			    <div ng-if="signup_form.password.$touched" class="input-error-set">
			    	<div ng-if="signup_form.password.$error.required">
			    	密码为必填项
			        </div>
			        <div ng-if="signup_form.password.$error.maxlength || signup_form.password.$error.minlength">
			        	用户名长度需要在6-255位之间
			        </div>
			    </div>
			</div>
			<button class="primary" type="submit" ng-disabled="signup_form.$invalid">注册</button>
		</form>
	</div>
</div>
</script>

<script type="text/ng-template" id="login.tpl">
<div ng-controller="LoginController" class="login container">
    <div class="card">
    	<h1>登录</h1>
    	<form name="login_form" ng-submit="User.login()">    
    	<div class="input-group">
    		<label>用户名</label>
    		<input type="text" 
    		ng-model="User.login_data.username" 
    		name="username" 
    		required>
    	</div>	
    	<div class="input-group">
    		<label>密码</label>
    		<input type="password"
    		 ng-model="User.login_data.password" 
    		 name="password" 
    		 required>
    	</div>		
    	<div ng-if="User.login_failed" class="input-error-set">
    		用户名和密码有误
    	</div>
    	<div class="input-group">
    		<button type="submit" 
    		        class="primary"
    		        ng-disabled="login_form.username.$error.required || 
    		        login_form.password.$error.required">登录</button>
    	</div>		
    	</form>
    </div>
</div>
</script>

<script type="text/ng-template" id="question.add.tpl">
<div ng-controller="QuestionAddController" class="question-add container">
	<div class="card">
		<form name="question_add_form" ng-submit="Question.add()">
			<div class="input-group">
				<label>问题标题</label>
				<input type="text"
				 ng-minlength="5"
				 ng-maxlength="255"
				 ng-model="Question.new_question.title" 
				 name="title" 
				 required
				>
			</div>
			<div class="input-group">
				<label>问题描述</label>
				<textarea type="textarea" 
				name="desc" 
				ng-model="Question.new_question.desc" 
				>
				</textarea>
			</div>
			<div class="input-group">
				<button type="submit" 
    		        class="primary"
    		        ng-disabled="question_add_form.$invalid"
    		    >提交</button>				
			</div>
		</form>
	</div>
</div>
</script>
</html>