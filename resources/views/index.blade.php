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
		<div class="navbar-item">
        <input type="text" name="">
		</div>
	</div>
	<div class="fr">
		<a ui-sref="home" class="navbar-item">首页</a>
		<a ui-sref="login" class="navbar-item">登录</a>
		<a ui-sref="signup" class="navbar-item">注册</a>
	</div>
</div>
</div>

<div class="page">
	<div ui-view></div>
</div>

</body>
<!-- .page .home -->
<script type="text/ng-template" id="home.tpl">
<div class="home container">
	首页
	(CNN)The United Nations voted overwhelmingly to condemn President Donald Trump's decision to recognize Jerusalem as the capital of Israel despite threats from the US to pull funding from the world body.

Some 128 countries voted for the resolution, while nine voted "no," and 35 nations abstained, including Canada, Mexico and Australia.
The vote came after US Ambassador to the UN Nikki Haley issued a direct threat, saying that the US will think twice about funding the world body if it voted to condemn Trump's decision.
</div>	
<div class="home container">
	首页
	(CNN)The United Nations voted overwhelmingly to condemn President Donald Trump's decision to recognize Jerusalem as the capital of Israel despite threats from the US to pull funding from the world body.

Some 128 countries voted for the resolution, while nine voted "no," and 35 nations abstained, including Canada, Mexico and Australia.
The vote came after US Ambassador to the UN Nikki Haley issued a direct threat, saying that the US will think twice about funding the world body if it voted to condemn Trump's decision.
</div>	
<div class="home container">
	首页
	(CNN)The United Nations voted overwhelmingly to condemn President Donald Trump's decision to recognize Jerusalem as the capital of Israel despite threats from the US to pull funding from the world body.

Some 128 countries voted for the resolution, while nine voted "no," and 35 nations abstained, including Canada, Mexico and Australia.
The vote came after US Ambassador to the UN Nikki Haley issued a direct threat, saying that the US will think twice about funding the world body if it voted to condemn Trump's decision.
</div>	
<div class="home container">
	首页
	(CNN)The United Nations voted overwhelmingly to condemn President Donald Trump's decision to recognize Jerusalem as the capital of Israel despite threats from the US to pull funding from the world body.

Some 128 countries voted for the resolution, while nine voted "no," and 35 nations abstained, including Canada, Mexico and Australia.
The vote came after US Ambassador to the UN Nikki Haley issued a direct threat, saying that the US will think twice about funding the world body if it voted to condemn Trump's decision.
</div>	
<div class="home container">
	首页
	(CNN)The United Nations voted overwhelmingly to condemn President Donald Trump's decision to recognize Jerusalem as the capital of Israel despite threats from the US to pull funding from the world body.

Some 128 countries voted for the resolution, while nine voted "no," and 35 nations abstained, including Canada, Mexico and Australia.
The vote came after US Ambassador to the UN Nikki Haley issued a direct threat, saying that the US will think twice about funding the world body if it voted to condemn Trump's decision.
</div>	
</script>

<script type="text/ng-template" id="signup.tpl">
<div ng-controller="SignupController" class="signup container">
	<div class="card">
		<h1>注册</h1>
		[: User.signup_data :]
		<form name="signup_form" ng-submit="User.signup()">
			<div class="input-group">
				<label>用户名</label>
			    <input type="text" ng-minlength="4" ng-maxlength="24" name="username" ng-model="User.signup_data.username" ng-model-option="{updateOn: 'blur'}" required="">
			    <div ng-if="signup_form.username.$touched" class="input-error-set">
			    	<div ng-if="signup_form.username.$error.required">
			    	用户名为必填项
			        </div>
			        <div ng-if="signup_form.username.$error.maxlength || signup_form.username.$error.minlength">
			        	用户名长度需要在4-24位之间
			        </div>
			    </div>
			</div>
			<div class="input-group">
				<label>密码</label>
			    <input name="password" type="password" ng-minlength="6" ng-maxlength="255" ng-model="User.signup_data.password" required="">
			    <div ng-if="signup_form.password.$touched" class="input-error-set">
			    	<div ng-if="signup_form.password.$error.required">
			    	密码为必填项
			        </div>
			        <div ng-if="signup_form.password.$error.maxlength || signup_form.password.$error.minlength">
			        	用户名长度需要在6-255位之间
			        </div>
			    </div>
			</div>
			<button type="submit" ng-disabled="signup_form.$invalid">注册</button>
		</form>
	</div>
</div>
</script>

<script type="text/ng-template" id="login.tpl">
<div class="home container">
	登录
	The European dream
One of them is 17-year-old Becky, who set off for Europe from Nigeria's Edo State when she was 15. An orphan raised by a foster family, Becky worked as a maid for a wealthy woman in Nigeria, but dreamed of becoming a doctor. Her boss's daughter lived in Europe and Becky was charmed with stories of a better life there.
"She told me, when you come to Europe you'll have opportunity, you will go to school, everything is going to be OK for you," Becky says, sitting on the edge of a bed in a shelter in northern Italy for trafficked female migrants.
</div>
<div class="home container">
	登录
	The European dream
One of them is 17-year-old Becky, who set off for Europe from Nigeria's Edo State when she was 15. An orphan raised by a foster family, Becky worked as a maid for a wealthy woman in Nigeria, but dreamed of becoming a doctor. Her boss's daughter lived in Europe and Becky was charmed with stories of a better life there.
"She told me, when you come to Europe you'll have opportunity, you will go to school, everything is going to be OK for you," Becky says, sitting on the edge of a bed in a shelter in northern Italy for trafficked female migrants.
</div>
<div class="home container">
	登录
	The European dream
One of them is 17-year-old Becky, who set off for Europe from Nigeria's Edo State when she was 15. An orphan raised by a foster family, Becky worked as a maid for a wealthy woman in Nigeria, but dreamed of becoming a doctor. Her boss's daughter lived in Europe and Becky was charmed with stories of a better life there.
"She told me, when you come to Europe you'll have opportunity, you will go to school, everything is going to be OK for you," Becky says, sitting on the edge of a bed in a shelter in northern Italy for trafficked female migrants.
</div>
</script>
</html>