CREATE TABLE `mia_admin` (
  `admin_id` varchar(32) NOT NULL,
  `admin_pwd` varchar(32) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `mia_class` (
  `class_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '类别的id',
  `super_id` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT '上级分类的id，一般是二级分类才有',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序id，用于显示',
  `level` int(2) NOT NULL DEFAULT '1' COMMENT '级别，默认是一级，也就是1',
  `title` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '类别标题',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_collect` (
  `collect_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '收藏id',
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '此收藏所属用户的id',
  `add_time` int(11) NOT NULL COMMENT '收藏时间',
  `goods_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '收藏的商品id',
  PRIMARY KEY (`collect_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_comment` (
  `comment_id` varchar(32) NOT NULL COMMENT '评论id',
  `dynamic_id` varchar(32) NOT NULL COMMENT '评论的哪条动态',
  `user_id` varchar(32) NOT NULL COMMENT '此条评论的用户id',
  `content` varchar(255) NOT NULL COMMENT '评论的内容',
  `good_count` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `add_time` int(11) NOT NULL COMMENT '评论添加时间',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `mia_dynamic` (
  `dynamic_id` varchar(32) NOT NULL COMMENT '动态id',
  `user_id` varchar(32) NOT NULL COMMENT '发表此动态的用户',
  `forward_user_id` varchar(32) DEFAULT NULL COMMENT '如果是转发的，转发谁这里就是谁的id',
  `good_count` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `add_time` int(11) NOT NULL COMMENT '发布这条动态的时间',
  PRIMARY KEY (`dynamic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `mia_goods` (
  `goods_id` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '商品id',
  `str_price` int(11) NOT NULL COMMENT '原价',
  `price` int(11) NOT NULL COMMENT '现价',
  `title` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '商品标题',
  `info_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '商品详情id，在创建商品的时候分配',
  `class_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '商品的分类',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL COMMENT '最后修改时间 ',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '商品的积分',
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_goods_info` (
  `info_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '商品的id，仅限此表使用',
  `goods_info_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '商品详情id，在创建商品的时候分配，存在多个相同的',
  `content` text COLLATE utf8_bin NOT NULL COMMENT '详情内容',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL COMMENT '最后修改时间',
  PRIMARY KEY (`info_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_opinion` (
  `opinion_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '意见id',
  `content` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '意见的内容',
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '提交意见的用户',
  `add_time` int(11) NOT NULL COMMENT '提交意见的时间',
  `state` int(2) NOT NULL DEFAULT '1' COMMENT '状态\r\n1：待处理\r\n2：正在处理\r\n3：处理完成',
  `info` varchar(255) CHARACTER SET utf8 DEFAULT '待处理' COMMENT '处理结果',
  PRIMARY KEY (`opinion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_order` (
  `order_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '订单号',
  `goods_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '此订单的商品id',
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '添加此订单的用户',
  `num` int(11) NOT NULL COMMENT '此订单的商品数量',
  `money` int(11) NOT NULL COMMENT '此订单的总价',
  `add_time` int(11) NOT NULL COMMENT '订单创建的时间',
  `edit_time` int(11) NOT NULL COMMENT '修改时间',
  `payment_method` int(2) NOT NULL COMMENT '支付方式\r\n1：微信\r\n2：支付宝',
  `state` int(2) NOT NULL COMMENT '此订单的状态，\r\n1：待付款\r\n2：待发货\r\n3：待收货\r\n4：完成\r\n5：售后处理（退换货）\r\n',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_shopping_bag` (
  `bag_id` varchar(32) NOT NULL COMMENT '购物袋商品id',
  `goods_id` varchar(32) NOT NULL COMMENT '商品id',
  `num` int(11) NOT NULL COMMENT '数量',
  `user_id` varchar(32) NOT NULL COMMENT '此商品的用户id',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL COMMENT '最后一次修改时间',
  PRIMARY KEY (`bag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `mia_token` (
  `token` varchar(32) NOT NULL COMMENT '令牌_id',
  `user_id` varchar(32) NOT NULL COMMENT '拥有此令牌的用户',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `edit_time` int(11) NOT NULL COMMENT '最后一次修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `mia_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '用户的手机号，必须唯一',
  `user_pwd` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT '用户的密码',
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '用户的昵称，可以修改。',
  `user_info` text COLLATE utf8_bin COMMENT '个性签名',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `consume_count` int(11) NOT NULL DEFAULT '0' COMMENT '累计消费',
  `head_img_url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '头像地址',
  `add_time` int(11) NOT NULL COMMENT '注册时间',
  `last_time` int(11) NOT NULL COMMENT '最后一次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `mia_nav` (
  `id` varchar(32) NOT NULL COMMENT '导航id',
  `title` varchar(255) DEFAULT NULL COMMENT '导航标题',
  `goods_name` varchar(255) DEFAULT NULL COMMENT '商品关键字',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

