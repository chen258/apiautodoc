# apiautodoc
> php自动生成api文档，无需依赖任何framework(基于crada/php-apidoc改动).提供了查看某个API的页面，访问所有API需提供密码才能查看.

> Generate documentation for php API based application. No dependency. No framework required.(base crada/php-apidoc)
## Requirements
PHP >= 7.1
## Installation
- 添加至composer.json
- The recommended installation is via composer. Just add the following line to your composer.json:
```
composer require melody-chen/api-auto-doc
```
## Usage/使用示例
- 函数注释文档示例/Example of function comment documentation
```
<?php

namespace Some\Namespace;

class User
{
    /**
     * @ApiDescription(section="User", description="Get information about user")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/user/get/{id}")
     * @ApiParams(name="id", type="integer", nullable=false, description="User id")
     * @ApiParams(name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *  'transaction_id':'int',
     *  'transaction_status':'string'
     * }")
     */
    public function get()
    {

    }
}
```
- 创建执行生成API文档/Create an apidoc.php file in your project root folder as follow:
```
# apidoc.php
<?php

require_once "vendor/autoload.php";

$api = new \ApiDoc\ApiDocBuilder();
//第一个参数为当前需要生成文档的类地址
//第二个参数为生成的API文件目录
//第三个参数为当前文件生成后的标题
//第四个参数为API文件名需加上后缀
//第五个参数为API文件的访问完整域名
//第六个参数为查看全部API的密码
$api->buildApiDoc(['ApiDoc\TestApi'],__DIR__ . '/apidocs/','测试API平台','api.html','apidocs/api.html','hello');
echo '创建完成';
```
- 然后执行创建API文档文件/Then, execute it via CLI
```
$ php apidoc.php
```
## 函数注释/Available Methods

- @ApiDescription(section="...", description="...")
- @ApiMethod(type="(get|post|put|delete|patch")
- @ApiRoute(name="...")
- @ApiParams(name="...", type="...", nullable=..., description="...", [sample=".."])
- @ApiHeaders(name="...", type="...", nullable=..., description="...")
- @ApiReturnHeaders(sample="...")
- @ApiReturn(type="...", sample="...")
- @ApiBody(sample="...")

ps:放不了图片，示例就不展示了。无论是tp还是laravel等等都可以使用该框架，这套我的主要用于做开放平台使用

