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
				@if(!is_logged_in())
				<div class="input-error-set">
	             	<div class="primary">请先登录</div>
	            </div>
	            @endif
				<div class="input-group">
					<button ng-disabled="question_add_form.$invalid" 
					        type="submit"
					        class="primary"
					>提交</button>
				</div>
			</form>
		</div>
	</div>