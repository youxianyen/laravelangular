;(function () {
    'use strict';

    angular.module('answer',[])
    
        .service('AnswerService',[
            '$http',
            function ($http) {
                var me = this;
                me.data = {};
                /*
                * @answers array 用于统计票数的数据
                *此数据可以是问题也可以是回答
                *如果是问题将会跳过统计
                * */
                me.count_vote = function (answers) {
                    /*迭代所有的数据*/
                    for(var i = 0;i<answers.length;i++){
                        var votes, item = answers[i];
                        /*如果不是回答也么有users元素说明本条不是回答或
                        **回答没有任何票数*/
                        if(!item['question_id'])
                            continue;

                        me.data[item.id] = item;

                        if(!item['users'])
                            continue;

                        /*每条回答的默认赞同票和反对票对为零*/
                        item.upvote_count = 0;
                        item.downvote_count = 0;

                        /*users 是所有投票用户的用户信息*/
                        votes = item['users'];
                        if(votes){
                            for(var j=0; j<votes.length; j++){
                                var v = votes[j];
                                if(v['pivot'].vote === 1){
                                    item.upvote_count++;
                                }
                                if(v['pivot'].vote === 2){
                                    item.downvote_count++;
                                }
                            }
                        }
                    }
                    return answers;
                }
                
                me.vote = function (conf) {
                    if(!conf.id || !conf.vote){
                        console.log('id and vote are required');
                        return;
                    }

                    var answer = me.data[conf.id];
                    var users = answer.users || [];
                    /*判断当前用户是否已经投过相同的票*/
                    for(var i = 0; i < users.length; i++)
                    {
                        if(users[i].id == his.id && conf.vote == users[i].pivot.vote)
                            conf.vote = 3;
                    }

                    return $http.post('api/answer/vote',conf)
                        .then(function (r) {
                            if(r.data.status){
                                console.log(r.data.status);
                                return true;
                            }
                            console.log(r.data.status);
                            return false;
                        }, function () {
                            console.log('api/answer/vote error');
                            return false;
                        })
                }
                
                me.update_data = function (id) {
                    return $http.post('/api/answer/read',{id:id})
                        .then(function (r) {
                            me.data[id] = r.data.data;
                        })
                    //if(angular.isNumeric(input)) {
                    //    var id = input;
                    //}
                    //if(angular.isArray(input)){
                    //    var id_set = input;
                    //}
                }

                me.read = function (params)
                {
                    return $http.post('/api/answer/read', params)
                      .then(
                        function (r)
                      {
                        if (r.data.status)                         
                            me.data = angular.merge({}, me.data, r.data.data);
                        return r.data.data;                        
                      })
                }
            }
        ])
})();