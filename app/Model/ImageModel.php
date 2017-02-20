<?php
namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic;

class ImageModel extends AppModel
{
    use SoftDeletes;
    protected $table = "image";
    protected $fillable = [
        'module',
        'user_id',
        "pk_id",
        'pk_type',
        'title',
        "state",
        "type",
        'original',
        'url',
        "size",
        "sort"
    ];
    protected $hidden = [

    ];

    public function thumb($w, $h)
    {
        if ('/' == $this->url[0]) {
            $file = substr($this->url, 1);
        } else {
            $file = $this->url;
        }
        $arr_url = explode(".", $file);
        $thumb_file = $arr_url[0] . "_{$w}_{$h}." . $arr_url[1];
        if (!app("files")->exists($thumb_file)) {
            ImageManagerStatic::make($file)->resize($w, $h)->save($thumb_file);
        }
        $result = "/" . $thumb_file;
        return $result;
    }

    /**
     * @param $blogid
     * @param array $add_ids "1,2,3"
     * @param array $del_ids "1,2,4"
     */
    function modelSave(Request $request, $module, $pk_type)
    {
        $add_ids = $request["info"]["attach_add"];
        $del_ids = $request["info"]["attach_del"];
        $add_ids = $add_ids ? explode(",", $add_ids) : [];
        $del_ids = $del_ids ? explode(",", $del_ids) : [];
        if ($add_ids) {
            ImageModel::whereIn("id", $add_ids)->update(["user_id" => Auth::id(),
                "module" => $module,
                "pk_type" => $pk_type,
                "pk_id" => $request["id"]]);
        }
        if ($del_ids) {
            ImageModel::destroy($del_ids);
        }
    }
}