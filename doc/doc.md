# 接口文档



> 一切接口参数均为json型



## 1、 登录相关功能接口



### 1.1、获取验证码

| url      | /User/Public/captcha |
| -------- | -------------------- |
| 格式       | json                 |
| HTTP请求方式 | POST                 |
| 调用权限     | public               |

直接返回图片文件



### 1.2、登录接口

#### 1.2.1、接口说明

| url      | /User/Public/checkLogin |
| -------- | ----------------------- |
| 格式       | json                    |
| HTTP请求方式 | post                    |
| 调用权限     | public                  |



#### 1.2.2、参数说明

| 参数名       | 必选   | 类型及范围  | 说明     |
| --------- | ---- | ------ | ------ |
| user_id   | true | String | 用户的手机号 |
| user_pwd  | true | String | 用户的密码  |
| user_code | true | String | 用户的验证码 |



#### 1.2.3、登录成功返回结果

> 当用户账户信息和验证码信息都对的情况下，返回：

| 参数名     | 类型     | 说明     |
| ------- | :----- | ------ |
| result  | String | 结果代码信号 |
| message | String | 信息     |

````json
{
    "result":"success",
  	"message":"login true"
}
````



#### 1.2.4、错误返回结果

| 参数名  | 类型     | 表示       |    
| ---- | ------ | -------- | 
| message | String | -997用户名或密码错误 |     
| message | String | -998用户未注册    |     
| message | String | -999验证码错误    |     



