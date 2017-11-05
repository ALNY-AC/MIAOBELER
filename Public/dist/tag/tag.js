tagApp = new Vue({
    el: '#tagApp',
    data: {
        list: []
    },
    methods: {

        update: function() {

            var _this = this;

            $.get('/index.php/Admin/Tag/getList', function(result) {

                result = JSON.parse(result);
                _this.list = result.message;

            });
        },
        add: function() {
            var _this = this;
            var _this = this;
            $.post('/index.php/Admin/Tag/add', {
                id: getRandom(9),
                title: '待输入'
            }, function(result) {

                result = JSON.parse(result);
                showToastr(result, '添加成功', '添加失败');
                _this.update();

            });

        },
        save: function(index, title) {
            var _this = this;
            var id = this.list[index].id;
            this.list[index].title = title;

            $.post('/index.php/Admin/Tag/save', {
                id: id,
                title: title
            }, function(result) {

                result = JSON.parse(result);
                showToastr(result, '修改成功', '修改失败');
            });

        },
        del: function(index) {
            var _this = this;
            var id = this.list[index].id;

            $.post('/index.php/Admin/Tag/del', {
                id: id,
            }, function(result) {
                result = JSON.parse(result);
                showToastr(result, '删除成功', '删除失败');
                _this.update();
            });

        }

    }
});
tagApp.update();