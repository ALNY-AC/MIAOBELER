//  ========== 
//  = class = 
//  ========== 

$(document).on('click', '.class-item', function () {
    //切换标签页
    $('.class-item').removeClass('active');
    $(this).addClass('active');
    console.log(1);
});

class1App = new Vue({
    el: '#class1App',
    data: {
        xxID: '',
        list: []
    },
    methods: {
        update: function () {
            var _this = this;
            $.get(config.url + 'Class/getClassList1', function (result) {

                result = JSON.parse(result);
                if (result.result == 'success') {
                    _this.list = result.message;
                }

            });

        },
        save: function (index, title) {
            var _this = this;
            var list = _this.list[index];
            $.post(config.url + 'Class/edit', {
                'class_id': list.class_id,
                'title': title,
            }, function (result) {
                result = JSON.parse(result);
                showToastr(result, '修改成功', '修改失败');
            });
        },
        del: function (index) {
            var _this = this;
            var list = _this.list[index];

            $.post(config.url + 'Class/remove', {
                'class_id': list.class_id,
            }, function (result) {
                result = JSON.parse(result);
                showToastr(result, '删除成功', '删除失败');
                _this.update();
            });
        },
        add: function () {
            var _this = this;
            var item = {
                class_id: getRandom(9),
                super_id: '',
                title: '待输入',
            };
            item.sort = this.list.length;

            $.post(config.url + 'Class/add', {
                'addDate': item
            }, function (result) {

                result = JSON.parse(result);
                showToastr(result, '添加成功', '添加失败');
                _this.update();

            });
        },
        saveSort: function () {
            var _this = this;
            var arr = {};

            $('.class-item1').each(function (i, em) {

                var id = $(em).attr('data-id');
                arr[id] = {};
                arr[id].sort = i;

            });
            for (var x in this.list) {

                var id = this.list[x].class_id;
                this.list[x].sort = arr[id].sort;
            }

            $.post(config.url + 'Class/sortList', {
                list: this.list
            }, function (result) {

                result = JSON.parse(result);

                if (showToastr(result, '排序成功', '排序失败')) {
                    _this.update();
                }
            })

        },
        setXXID: function (index) {
            this.xxID = this.list[index].class_id;
        },
        show: function (index) {
            class2App.update();

        }
    }
});
class1App.update();

//  ========== 
//  = class2 = 
//  ========== 

class2App = new Vue({
    el: '#class2App',
    data: {
        list: []
    },
    methods: {
        update: function () {
            var _this = this;
            $.get(config.url + 'Class/getClassList2', {
                super_id: class1App.xxID // class1App.xxID
            }, function (result) {

                result = JSON.parse(result);

                if (result.result == 'success') {
                    _this.list = result.message;

                    if (upload != null) {

                        //添加类别图
                        upload.render({
                            elem: '.up-class-img', //绑定元素
                            url: config.url + 'UpFile/up', //上传接口
                            done: function (res, index, upload) {
                                //上传完毕回调

                                var class_id = $(this.item).attr('data-class-id')

                                class2App.saveImg(class_id, res.data.src);

                            },
                            error: function (index, upload) {
                                //请求异常回调
                                console.log(index);
                                console.log(upload);

                            }
                        });
                    }
                }

            });

        },
        save: function (index, title) {
            var _this = this;
            _this.list[index].title = title;
            var list = _this.list[index];

            $.post(config.url + 'Class/edit', {
                'class_id': list.class_id,
                'title': title,
            }, function (result) {
                result = JSON.parse(result);
                showToastr(result, '修改成功', '修改失败');
            });
        },
        saveImg: function (class_id, imgSrc) {

            var _this = this;

            $.post(config.url + 'Class/saveImg', {
                'class_id': class_id,
                'img': imgSrc,
            }, function (result) {
                result = JSON.parse(result);
                showToastr(result, '图片修改成功', '图片修改失败');
                _this.update();
            });

        },
        del: function (index) {
            var _this = this;
            var list = _this.list[index];

            $.post(config.url + 'Class/remove', {
                'class_id': list.class_id,
            }, function (result) {
                result = JSON.parse(result);
                showToastr(result, '删除成功', '删除失败');
                _this.update();
            });
        },
        add: function () {
            var _this = this;
            var item = {
                class_id: getRandom(9),
                super_id: class1App.xxID,
                title: '待输入',
                level: 2
            };
            item.sort = this.list.length;

            $.post(config.url + 'Class/add', {
                'addDate': item
            }, function (result) {

                result = JSON.parse(result);
                showToastr(result, '添加成功', '添加失败');
                _this.update();

            });
        },
        saveSort: function () {
            var _this = this;
            var arr = {};

            $('.class2-item').each(function (i, em) {

                var id = $(em).attr('data-id');
                arr[id] = {};
                arr[id].sort = i;

            });
            for (var x in this.list) {

                var id = this.list[x].class_id;
                this.list[x].sort = arr[id].sort;
            }

            $.post(config.url + 'Class/sortList', {
                list: this.list
            }, function (result) {

                result = JSON.parse(result);

                if (showToastr(result, '排序成功', '排序失败')) {
                    _this.update();
                }
            })

        }
    }
});
class2App.update();