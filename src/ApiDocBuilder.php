<?php
/**
 * Created by PhpStorm.
 * User: melody
 * Date: 2020-08-04
 * Time: 17:51
 */
namespace ApiDoc;

/**
 * @title
 * @description 需要实现的功能
 * 1.用户写了函数注释后，用户通知指定的url格式访问到指定的函数文档
 * 2.提供一个集成的接口文档
 * @group
 * Class ApiDocBuilder
 * @package ApiDoc
 */
class ApiDocBuilder
{
    /**
     * @ApiDescription(section="创建API文档", description="创建API文件页面")
     * @ApiMethod(type="post")
     * @ApiRoute(name="buildApiDoc")
     * @param array $classes 类命名空间数组
     * @param string $output_dir 生成的api文档html存放目录
     * @param string $title API页面标题
     * @param string $output_file 文件名
     * @param string $detail_url_domain 详情页面的域名目录
     * @return bool
     */
    public function buildApiDoc(array $classes,string $output_dir, string $title ,string $output_file,string $detail_url_domain){
        try {
            $builder = new Builder($classes, $output_dir, $title,$output_file, null,$detail_url_domain);
            $builder->generate();
            return true;
        } catch (\Exception $e) {
            echo 'There was an error generating the documentation: ', $e->getMessage();
        }
        return false;
    }
}
