;(function(){
	'use strict';

	angular.module('answer', [])

	.service('AnswerService', [
		'$http', 
		function($http)
		{
			var me = this;
			me.data = {};
			/**
			***@answers array 用于统计票数的数据
			此数据可以是问题也可以是回答
			如果是问题将会跳过统计
			*/
			me.count_vote = function (answers)
			{
				/*迭代所有的数据*/
				for (var i = answer.length; i >= 0; i--) 
				{
					/*如果单个数据*/
					var votes, item = answer[i];
					/*如果不是回答也没有users元素说明本条不是回答或
					*回答没有任何票数
					*/
					if (!item['question_id'] || item['pivot']) 
						continue;
					/*每条回答的赞同票和反对票都为零*/
					item.upvote_count = 0;
					item.downvote_count = 0;
					/*users是所有投票用户的用户信息*/
					votes = item['users'];
					if (votes) 
					for (var j = 0; j < votes.length; i++)
					{
						var v = votes[j];
						/*获取pivot元素中的用户投票信息
						**如果是1，将增加1赞同票
						**如果是2，将增加1反对票
						*/
						if (v['pivot'].vote === 1) 
						{
							item.upvote_count++;
						}
						if (v['pivot'].vote === 2) 
						{
							item.downvote_count++;
						}
					}
				}
				return answers;
			}
			
			me.vote = function(conf)
			{
				if (!conf.id || !conf.vote) 
				{
					console.log('id and vote are require');
					return;
				}

				return $http.post('api/answer/vote')
				  .then(
				  	function(r)
				  	{
				  		if(r.data.status)
				  			return true;
				  		return false;
				  	}, function()
				  	{
				  		return false;
				  	})
			}

			me.update_data = function(id)
			{
				/*if (angular.isNumberic(input)) 
					var id = input;
				if (angular.isArray(input)) 
					var id_set = input;*/
				return $http.post('/api/answer/read', {id: id})
				  .then(
				  	function(r)
				  	{
				  	me.data[id] = r.data.data;
				  }, function(){

				  })
			}

		}])
})();