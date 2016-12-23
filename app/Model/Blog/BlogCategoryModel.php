<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    protected $table = "blog_category";
    protected $fillable = [
        'name', 'parent_id', 'parent_ids', 
    ];
    protected $hidden = [

    ];
}
