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
	<div class="fl">
		<div class="navbar-item brand">暁乎</div>
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
		<a ui-sref="{{url('/logout')}}" class="navbar-item">{{session('username')}}</a>
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
<script type="text/ng-template" id="home.tpl">
	<div class="home container">
		<h1>最新动态</h1>
		<div class="hr"></div>
		<div class="item-set">
			<div class="item">
				<div class="vote"></div>
				<div class="feed-item-content">
					<div class="content-act">xxx赞同了该回答</div>
					<div class="title">哪些瞬间让你发现贫穷限制了你的想象力？</div>
					<div class="content-owner">黄色的
						<span class="desc">h.wei
直男，彩妆，做饭，篮球，短发控。
哪些瞬间让你发现贫穷限制了你的想象力？
之前一个段子:5S刚出来那会，有一次坐地铁，两个大叔在讨论问题，一个大叔说:女儿生日不知道送什么好，另一个说:送4S吧。。。我在旁边听了笑了笑，随手…阅读全文</span>
					</div>
					<div class="content-main">
						h.wei

6.7K
​347 条评论
​分享
​收藏​感谢
​

热门内容, 来自: 
经济学
 孤鸿影
孤鸿影
No fate but we make
东北经济还有救么？
cover
今天微博上看到的视频…阅读全文
2.8K
​291 条评论
​分享
​收藏​感谢
​

热门内容, 来自: 
旅行
 乐乐是朵小太阳
乐乐是朵小太阳
我们可以一起去看星星吗
你被老外问过哪些奇葩问题？
					</div>
					<div class="action-set">
						<div class="comment">评论</div>
						<div class="comment-block">
							<div class="comment-item-set">
								<div class="comment-item clearfix">
									<div class="user">李大妈</div>
									<div class="comment-content">2017年11月21日，习近平总书记给内蒙古苏尼特右旗乌兰牧骑队员回信，指示大力弘扬“红色文艺轻骑兵”精神，吉林省委宣传部迅速下发《中共吉林省委宣传部关于学习贯彻习近平总书记重要指示精神做新时代“红色文艺轻骑兵”的通知》，组建了省、市、县、乡四级新时代“红色文艺轻骑兵”小分队，并与党的十九大精神宣讲相结合，与脱贫攻坚相结合，与吉林新一轮振兴相结合。从2017年12月8日开始，陆续深入到农村、社区、学校、军营等单位的传习所开展形式多样、丰富多彩的文化活动。到2017年12月31日，吉林省、市、县三级各类新时代“红色文艺轻骑兵”小分队已经赴基层开展文化活动近百场，为上万名群众送去文化大餐，进一步丰富城乡群众的精神文化生活，传递党的十九大精神，送去党和政府的温暖。</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
			
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
				       required
				>
			</div>
			<div class="input-group">
				<label>密码</label>
				<input type="password" 
				       ng-model="User.login_data.password" 
				       name="password"
				       required
				>
			</div>
			<div ng-if="User.login_failed" class="input-error-set">
				 用户名或密码错误
			</div>
			<div class="input-group">
				<button class="primary"
				        type="submit"
				        ng-disabled="login_form.username.$error.required || 
				        login_form.password.$error.required">登录</button>
			</div>
		</form>
	</div>
</div>	
</script>

<script type="text/ng-template" id="signup.tpl">
<div ng-controller="SignupController" class="home container">
	<div class="card">
	    <h1>注册</h1>
	    [: User.signup_data :]
	    <form name="signup_form" ng-submit="User.signup()">
	        <div>
	            <label>用户名</label>
	            <input name="username"
	             ng-model="User.signup_data.username" 
	             ng-model-options="{debounce: 300}"
	             ng-minlength="4"
	             ng-maxlength="24"
	             type="text"
	             required></input>
	             <div ng-if="signup_form.username.$touched" class="input-error-set">
	             	<div ng-if="signup_form.username.$error.required">用户名为必填项</div>
	             	<div ng-if="signup_form.username.$error.maxlength || signup_form.username.$error.minlength">用户名长度需在4-24位之间</div>
	             	<div ng-if="User.signup_username_exists">用户名已存在</div>
	             </div>
	        </div>
	        <div>
	            <label>密码</label>
	            <input 
	            ng-model="User.signup_data.password" 
	            name="password" 
	            type="password"
	            ng-minlength="6"
	            ng-maxlength="255"
	            required></input>
	            <div ng-if="signup_form.password.$touched" class="input-error-set">
	             	<div ng-if="signup_form.password.$error.required">密码为必填项</div>
	             	<div ng-if="signup_form.password.$error.maxlength || signup_form.password.$error.minlength">密码长度需在6-255位之间</div>
	             </div>
	        </div>
	    	<button class="primary" type="submit" ng-disabled="signup_form.$invalid">注册</button>
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
					       ng-model="Question.new_question.title" 
					       ng-minlength="2" 
					       ng-maxlength="255"
					       name="title"
					       required
					>
				</div>
				<div class="input-group">
					<label>问题描述</label>
					<textarea type="text" 
					          ng-model="Question.new_question.desc" 
					          name="desc"
					>
					</textarea>
				</div>
				<div class="input-group">
					<button ng-disabled="question_add_form.$invalid" 
					        type="submit"
					        class="primary"
					>提交</button>
				</div>
			</form>
		</div>
	</div>
</script>
</html>