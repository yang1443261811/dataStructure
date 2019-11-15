**0\. 通用规则**
--------------------------------  
* 接口域名：`http://luandou.gamemorefun.net`

-  接口状态码说明
````
    200: `请求成功`
    401: `授权失败，这意味着需要用户重新登录`,
    500: `服务器错误,这属于后端错误由后端人员解决`,
````
- 接口响应示例
        
````
  { 
     "success": true,         // 成功时取值为true失败时取值为false 
     "msg": "执行成功！ ",     // 错误信息 
     "data": {...},           // 附加数据 
  }
````        


- 特别说明

>接口采用的是JWT登陆认证,在用户登陆成功后会返回 token 做为登陆认证的凭证,  
>在接下来的所有接口请求中,都需要携带token, 服务端会对token的有效性进行验证,
>在验证失败时接口会抛出401错误.前端请求中如果捕获到接口状态码为401时
>需要跳转到登陆界面让用户重新登陆

**1\. 用户登陆接口**
-------------------------------------------------------------------
- ##### API :  http://luandou.gamemorefun.net/api/login

- ##### HTTP请求方式 : `POST`

- ##### 请求参数 

    |参数|说明|
    |:-----|-----                                   |
    |account    |用户的账号                        |
    |password   |用户的密码                            |
    |type       |登陆方式,三个取值:FaceBook  Google  MBean |

- 返回字段  

    |返回字段|说明                              |
    |:-----   |:-----------------------------   |
    |success  |返回结果状态。true：成功；false：失败。   |
    |msg      | 提示信息                      |
    |data     |需要返回的数据                         |

- 接口示例
````
var params = {account: 'lucky5566', password: 'l123456', type: 'MBean'};
axios
  .post('/api/login', params)
  .then((result) => {
    console.log(result.data);
    //接口请求成功后将重要的参数持久化保存起来
    localStorage.token = result.data.data['token'];
    localStorage.uuid =  result.data.data['uuid'];
  })
  .catch((error) => {
    console.log(error.response);
  })

````
- 返回数据示例
````
   { 
       "success": true, 
       "msg": "登陸成功！", 
       "data": {
           "app_id": "equn5r",
           "platform": "android",
           "register_time": "2019-08-07 10:36:48",
           "user_id": 4870908,
           "user_name": "lucky5566",
           "uuid": "c98c24864891475c9f394737ed0d17f9",
           "wallet": "0.00",
           "signature": "62185d42801b9cf3a1dfb63a0198d973",
           "token": "eyJ0eXBlIjoiSldUIiwiYWxnIjoic2hhMjU2In0.eyJpYXQiOjE1NzM3OTE5MDUsIm5hbWUiOiJ5YW5ncWltIiwic3ViIjoibHVja3k1NTY2In0.KhVZbeXRtwPDu6_buH8jDlh1d8_GgI9fjb8H2BgCHzM"
           "role":[
               {
                   "ServerId": "6999",
                   "ServerName": "sosc",
                   "RoleId": "69990001000224",
                   "RoleName": "沉默的若筠"
               },
               {
                   "ServerId": "7085",
                   "ServerName": "智勇超群",
                   "RoleId": "70850001000133",
                   "RoleName": "空蟬"
               },
               {
                   "ServerId": "7146",
                   "ServerName": "學富五車",
                   "RoleId": "71460001000126",
                   "RoleName": "都會減肥減肥"
               },
             ]      
        },          
    }
````

**2\. 获取中奖名单接口**
----------------------------------------------------------------
- ##### API:  http://luandou.gamemorefun.net/api/winners

- ##### HTTP请求方式 :  `GET`

- ##### 请求参数

    |参数|说明|
    |:-----|-----                                   |
    |account    |用户的账号                        |
    |password   |用户的密码                            |
    |type       |登陆方式,三个取值:FaceBook  Google  MBean |

- ###### 接口示例(`后面的接口都参考这个例子,将不再详细说明`)
````
//特别注意这里的token是登陆时返回的token,我们将他放在header里面作为登陆的凭证
axios.defaults.headers.common['Authorization'] = localStorage.token;
axios
  .get('/api/winners')
  .then((result) => {
    console.log(result.data)
  })
  .catch((error) => {
    //当错误状态码为401时表示token认证失败,
    if (error.response.status === 401) {
      //跳转到登陆页面让用户重新登陆
    }
  })
````

**3\. 记录用户分享接口**
----------------------------------------------
- ##### API: http://luandou.gamemorefun.net/api/share/store

- ##### HTTP请求方式:  `POST`

 - ##### 请求参数
    |参数|说明|
    |:-----|-----                                 |
    |uuid    |用户uuid                            |
    |role_id   |角色ID                            |
    |role_name       |角色名称 |

- ###### 接口示例
````
axios.defaults.headers.common['Authorization'] = localStorage.token;
var params = {
  uuid: localStorage.uuid,
  role_id: localStorage.role_id,
  role_name: localStorage.role_name,
}
axios
  .post('/api/share/store')
  .then((result) => {
    console.log(result.data)
  })
  .catch((error) => {
    if (error.response.status === 401) {
      //跳转到登陆页面让用户重新登陆
    }
  })
````

**4\. 获取用户分享奖励记录接口**
-----------------------------------------------------------
- ##### API : http://luandou.gamemorefun.net/api/share/getRewardLog

- ##### HTTP请求方式 : GET

- ##### 请求参数
    |参数|说明|
    |:-----|-----                                 |
    |uuid    |用户uuid                            |
    |role_id   |角色ID                            |


**5\. 获取分享奖励接口**
----------------------------
- ##### API : http://luandou.gamemorefun.net/api/share/getShareReward

- ##### HTTP请求方式 : GET

 - ##### 请求参数
    |参数|说明|
    |:-----|-----                                 |
    |uuid    |用户uuid                            |
    |role_id   |角色ID                            |


**6\. 获取弹幕接口**
-----------------------------------------------
- ##### API : http://luandou.gamemorefun.net/api/barrage/get

- ##### HTTP请求方式: GET

- ##### 特别说明: `获取弹幕的接口不需要登陆凭证,因为弹幕在用户未登陆的情况下也应该是可以获取到的`


**7\. 保存弹幕接口**
-------------------------------------------------
- ##### API : http://www.api.com/api/barrage/store

- ##### HTTP请求方式 : POST

- ##### 请求参数
    |参数|说明|
    |:-----|-----                                 |
    |uuid    |用户uuid                            |
    |role_id   |角色ID                            |
    |role_name   |角色名                           |
    |msg   |弹幕内容                               |
