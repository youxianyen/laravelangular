<div ng-controller="SignupController" class="signup container">
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