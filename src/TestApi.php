<?php
/**
 * Created by PhpStorm.
 * User: melody
 * Date: 2020-08-04
 * Time: 17:51
 */
namespace Apidoc;
require_once "vendor/autoload.php";

class TestApi
{
    /**
     * @ApiDescription(section="relize", description="description")
     * @ApiMethod(type="post")
     * @ApiRoute(name="relize/index")
     * @param int $a
     * @param int $b
     * @ApiParams(name="a", type="int", nullable=false, description="yoyoyo")
     * @ApiParams(name="b", type="object", nullable=true, description="yoyoyo1")
     * @ApiParams(name="c", type="int", nullable=false, description="yoyoyo2")
     * @return string
     * @ApiReturn(type="object")
     */
    public function relize($a=1,$b=1){
        return '1';
    }

    /**
     * @ApiDescription(section="getUser", description="description")
     * @ApiMethod(type="post")
     * @ApiRoute(name="api/getUser")
     * @param int $a
     * @param int $b
     * @ApiParams(name="", type="", nullable=false, description="")
     * @return int
     * @ApiReturn(type="object")
     */
    public function getUser($a=2,$b=1)
    {
        return 2;
    }
}
