<?php
/**
 * Created by PhpStorm.
 * User: melody
 * Date: 2020-08-04
 * Time: 17:51
 */
namespace ApiDoc;

use Crada\Apidoc\Builder;
use Crada\Apidoc\Exception;

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

    public function buildApiDoc($classes, $output_dir, $title ,$output_file,$detail_url_domain){
        try {
            $builder = new Builder($classes, $output_dir, $title,$output_file, null,$detail_url_domain);
            $builder->generate();
        } catch (\Exception $e) {
            echo 'There was an error generating the documentation: ', $e->getMessage();
        }
    }
}
