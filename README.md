area_php

根据用户访问IP,返回用户所在区域信息 【php语言版本】
*ip库信息识别借用 github.com/ipipdotnet/ipdb-php*


目录结构及文件说明
*本项目由原生php自主进行了简单封装,没有使用框架（因为要实现的功能比较单一所以没有必要使用框架增加程序运行的负载）*

```
src // 资源目录
src/common //公用函数库目录
src/common/config //公共配置目录
src/common/utils //工具函数目录
src/common/Functions.php 公共工具函数
src/ipip //ipdb的类库
index.php //入口函数 具体业务逻辑也写在这里
ipfunction.php //获取客户ip的方法函数
ipip.class.php //获取IP库的方法类
cityfree.ipdb //IP库不要管除非要替换更好高级的版本，离线看可以在[IPIP](https://www.ipip.net/product/ip.html)购买 

```

TIPS

1.  *php7.2版本*

2.  *windows 用phpstudy运行就好*
3.  *项目运行后直接访问根目录即可*
4.  *接口响应示例：*
```
{
  "local": "area:中国广东广州",
  "localArr": [
    "中国",
    "广东",
    "广州"
  ],
  "areaKey": 0,
  "ip": "xx.xx.xx.82"
}
```
5.  *执行到这里项目就允许成功了~*




