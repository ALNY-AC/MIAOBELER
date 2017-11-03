var onAJAX = function(config) {

    var eventName = config.eventName,
        elName = config.elName,
        type = config.type,
        url = config.url,
        fun = config.fun,
        fromName = config.fromName;

    $(document).on(eventName, elName, function() {

        idName = $(this).attr('data-id-name');
        idValue = $(this).attr('data-id-value');
        field = $(this).attr('data-field');
        value = $(this).val();

        var map = {};
        map.data = {};
        map.fromName = fromName;

        map.data[0] = {};
        map.data[0]['id'] = {};
        map.data[0]['id'][idName] = idValue;

        map.data[0]['data'] = {};
        map.data[0]['data'][field] = value;
        //                  field

        if(type == 'post') {

            $.post(url, map, fun != null ? fun : function() {

            })

        }
        if(type == 'get') {
            $.get(url, map, fun != null ? fun : function() {

            })
        }

    })

}

var ajaxOn = function(config) {
    var
        fromName = config.fromName,
        type = config.type,
        url = config.url,
        fun = config.fun,
        idName = config['id-name'],
        idValue = config['id-value'],
        field = config['field'],
        value = config['val'];

    var map = {};
    map.data = {};
    map.fromName = fromName;

    map.data[0] = {};
    map.data[0]['id'] = {};
    map.data[0]['id'][idName] = idValue;

    map.data[0]['data'] = {};
    map.data[0]['data'][field] = value;
    //                  field

    if(type == 'post') {

        $.post(url, map, fun != null ? fun : function() {

        })

    }
    if(type == 'get') {
        $.get(url, map, fun != null ? fun : function() {

        })
    }

}

/**
 * 批量更新
 * 基于layui
 * */
var ajaxAll = function(tableName, idNmae, fromName, url, type, field, fieldValue, fun) {

    var o = table.checkStatus(tableName);

    if(o.data.length <= 0) {
        layer.msg('啥也没选，别点了');
        return;
    }
    var id = '';

    for(var i = 0; i < o.data.length; i++) {
        id += "'" + o.data[i].user_id + "',";
    }
    id = id.substring(0, id.length - 1);
    map = {};
    map.where = idNmae + ' in(' + id + ')';
    map.fromName = fromName;
    map.field = field;
    map.fieldValue = fieldValue;

    if(type == 'post') {

        $.post(url, map, fun != null ? fun : function(result) {
            $('#test').html(result);
        })

    }
    if(type == 'get') {
        $.get(url, map, fun != null ? fun : function(result) {
            $('#test').html(result);
        })
    }

}