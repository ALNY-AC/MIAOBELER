
//编辑div提示
editel.config.endFunction = function ($em) {

    if ($em.hasClass('nav-name')) {

        var id = $em.attr('nav-id');
        navTopHomeApp.list[id] = $em.text();
        navTopHomeApp.save(id);

    }

    if ($em.hasClass('class-item1')) {
        var index = $em.attr('data-index');
        var title = $em.text();
        if (title.length <= 0) {
            class1App.del(index);
        } else {
            class1App.save(index, title);
        }
    }
    if ($em.hasClass('class2-item-tite')) {
        var index = $em.attr('data-index');
        var title = $em.text();
        if (title.length <= 0) {
            class2App.del(index);
        } else {
            class2App.save(index, title);
        }
    }

    if ($em.hasClass('tag-item')) {
        var index = $em.attr('data-index');
        var title = $em.text();
        if (title.length <= 0) {
            tagApp.del(index);
        } else {
            tagApp.save(index, title);
        }
    }

}

//导航
var navTopHomeApp = new Vue({
    el: '#navTopHomeApp',
    data: {
        list: [],
    },
    methods: {
        save: function (index) {

            $.post(config.url + 'Nav/add', {

                id: index,
                title: this.list[index],

            }, function (result) {

                result = JSON.parse(result);

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-left",
                    "onclick": null,
                    "showDuration": "1",
                    "hideDuration": "1",
                    "timeOut": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                if (result.result == 'success') {

                    toastr['success']("修改成功~")
                    navTopHomeApp.update();
                } else {
                    toastr['error']("修改失败~")
                }

            });

        },
        update: function () {
            var _this = this;
            $.get(config.url + 'Nav/get', function (result) {

                result = JSON.parse(result);
                if (result.result == 'success') {
                    _this.list = result.message;
                }

            });

        }

    }

});
navTopHomeApp.update();

//carousel_id
//img
//a_url
//轮播
carouselApp = new Vue({
    el: '#carouselApp',
    data: {
        list: []
    },
    methods: {
        update: function () {
            var _this = this;
            $.get(config.url + 'Carousel/get', function (result) {

                result = JSON.parse(result);
                if (result.result == 'success') {
                    _this.list = result.message;

                    setTimeout(function () {
                        carouselIns.reload();
                    }, 500)

                }

            });

        },
        postDateOne: function (index) {
            var _this = this;

            $.post(config.url + 'Carousel/save', {
                carousel_id: this.list[index].carousel_id,
                a_url: this.list[index].a_url,
                img: this.list[index].img
            }, function (result) {
                result = JSON.parse(result);
                showToastr(result, '修改成功', '修改失败');
            });
        }

    }
});
carouselApp.update();
//轮播工具
var carouselToolApp = new Vue({
    el: '#carouselToolApp',
    data: {
        list: [],
    },
    methods: {
        del: function (index) {
            var _this = this;

            $.post(config.url + 'Carousel/del', {
                carousel_id: _this.list[index].carousel_id,
            }, function (result) {

                result = JSON.parse(result);

                if (showToastr(result, '删除成功', '删除失败')) {

                    carouselApp.update();
                    _this.update();

                }

            });

        },
        add: function (src) {
            var _this = this;
            $.post(config.url + 'Carousel/add', {
                a_url: null,
                img: src
            }, function (result) {

                result = JSON.parse(result);

                if (showToastr(result, '添加成功', '添加失败')) {

                    carouselApp.update();
                    _this.update();

                }

            })

        },
        update: function () {

            var _this = this;

            $.get(config.url + 'Carousel/get', function (result) {

                result = JSON.parse(result);
                if (result.result == 'success') {
                    _this.list = result.message;
                }

            });

        },
        saveSort: function () {
            var _this = this;

            $.post(config.url + 'Carousel/sortList', {
                list: this.list
            }, function (result) {

                result = JSON.parse(result);

                if (showToastr(result, '排序成功', '排序失败')) {
                    _this.update();
                    carouselApp.update();
                }
            })

        }

    }

});
carouselToolApp.update();

goodsHomeApp = new Vue({

    el: '#goodsHomeApp',
    data: {
        addID: null,
        list: [],
    },
    methods: {
        del: function (index) {
            var _this = this;

            $.post(config.url + 'Recommend/del', {
                id: _this.list[index].id,
            }, function (result) {

                result = JSON.parse(result);

                if (showToastr(result, '删除成功', '删除失败')) {
                    _this.update();
                }

            });

        },
        add: function () {
            var _this = this;

            if (_this.addID != null && _this.addID.length > 0) {
                $.post(config.url + 'Recommend/add', {
                    'goods_id': _this.addID,
                }, function (result) {

                    //              $('#test').html(result);
                    result = JSON.parse(result);

                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "onclick": null,
                        "showDuration": "1",
                        "hideDuration": "1",
                        "timeOut": "1000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    switch (result.message) {
                        case 'add true':
                            toastr['success']("添加成功~");
                            _this.update();
                            break;
                        case 'goods not null':
                            toastr['warning']("这个商品已存在~");
                            break;
                        case 'goods_id false':
                            toastr['warning']("没有这个商品~");
                            break;
                        default:
                            toastr['error']("添加失败！");
                            break;
                    }

                    _this.addID = null;
                })
            }

        },
        update: function () {
            //'t1.* as recommend_id,t2.goods_id,t2.head_img,t2.title'
            var _this = this;

            $.get(config.url + 'Recommend/get', function (result) {
                result = JSON.parse(result);
                if (result.result == 'success') {
                    _this.list = result.message;
                    goodsRecommendApp.update();

                }
            });

        },
        saveSort: function () {
            var _this = this;

            $.post(config.url + 'Recommend/sortList', {
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
goodsHomeApp.update();

goodsRecommendApp = new Vue({

    el: '#goodsRecommendApp',
    data: {
        addID: null,
        list: [],
    },
    methods: {

        update: function () {
            var _this = this;

            $.get(config.url + 'Recommend/get', function (result) {
                result = JSON.parse(result);
                if (result.result == 'success') {
                    _this.list = result.message;
                }
            });

        }
    }

});
goodsRecommendApp.update();

function showToastr(result, successTitle, errorTitle) {

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "onclick": null,
        "showDuration": "1",
        "hideDuration": "1",
        "timeOut": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    if (result.result == 'success') {
        toastr['success'](successTitle != null ? successTitle : result.message);
        return true;
    } else {
        toastr['error'](errorTitle != null ? errorTitle : result.message);
        return false;

    }
}

function getRandom(length) {

    var str = '';

    for (var i = 1; i <= length; i++) {
        str += String.fromCharCode(97 + parseInt(Math.random() * 25));
    }
    var time = '' + new Date().getTime();

    time = time.substr(time.length - 5, time.length);

    return str + time;

}