<?php
namespace App\Module\Web\Controllers;
use App\Http\Controllers\Controller;
use App\Module\Blog\Model\BlogCategoryModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class WebController extends Controller{
    public function __construct()
    {
        
        $blog_category = BlogCategoryModel::where(["parentid"=>0,"module"=>"blog"])->get();
        view()->share('blog_category', $blog_category);
    }

}