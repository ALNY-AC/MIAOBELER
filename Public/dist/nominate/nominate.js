var nominateToolGoodsApp = new Vue({

    el: '#nominateToolGoodsApp',
    data: {
        addID: null,
        list: [],
    },
    methods: {
        del: function(index) {
            var _this = this;

            $.post('/index.php/Admin/Nominate/del', {
                id: _this.list[index].id,
            }, function(result) {

                result = JSON.parse(result);

                if(showToastr(result, '删除成功', '删除失败')) {

                    _this.update();

                }

            });

        },
        add: function() {
            var _this = this;

            if(_this.addID != null && _this.addID.length > 0) {
                $.post('/index.php/Admin/Nominate/add', {
                    'goods_id': _this.addID,
                }, function(result) {

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

                    switch(result.message) {
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
        update: function() {
            //'t1.* as recommend_id,t2.goods_id,t2.head_img,t2.title'
            var _this = this;

            $.get('/index.php/Admin/Nominate/get', function(result) {
                result = JSON.parse(result);
                if(result.result == 'success') {
                    _this.list = result.message;
                    nominateApp.update();
                }
            });

        },
        saveSort: function() {

            var _this = this;

            var arr = {};

            $('.nominate-goods-sort').each(function(i, em) {

                var id = $(em).attr('data-id');
                arr[id] = {};
                arr[id].sort = i;

            });

            for(var x in this.list) {
                var id = this.list[x].id;
                this.list[x].sort = arr[id].sort;
            }

            $.post('/index.php/Admin/Nominate/sortList', {
                list: this.list
            }, function(result) {

                result = JSON.parse(result);

                if(showToastr(result, '排序成功', '排序失败')) {
                    _this.update();
                }
            })

        }
    }

});
nominateToolGoodsApp.update();

//nominateApp

nominateApp = new Vue({

    el: '#nominateApp',
    data: {
        addID: null,
        list: [],
    },
    methods: {

        update: function() {
            var _this = this;

            $.get('/index.php/Admin/Nominate/get', function(result) {
                result = JSON.parse(result);
                if(result.result == 'success') {
                    _this.list = result.message;
                }
            });

        }
    }

});
