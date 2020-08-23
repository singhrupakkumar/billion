<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $guarded = []; 

    public function categoryChildren() {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    public static function checkLevel($level = 0) {
        $string = '';
        for ($i = 1; $i <= $level; $i++) {
            $string .= '-';
        }
        return $string;
    }

    public static function treeView($added_parent = 0, $selectName) {
        $level = 1;
        $Categorys = Category::where('parent_id', '=', 0)->get();
        $tree = '<select id="' . $selectName . '" name="' . $selectName . '" class="form-control select2 filetree"><option value="0">Select...</option>';
        foreach ($Categorys as $Category) {
            if ($added_parent == $Category->id) {
                $tree .= '<option class="tree-view parent" selected value="' . $Category->id . '">' . $Category->name . '';
            } else {
                $tree .= '<option class="tree-view parent" value="' . $Category->id . '">' . $Category->name . '';
            }

            if (count($Category->categoryChildren)) {
                $tree .= \App\Category::childView($Category, $added_parent, $level + 1);
            }
        }
        $tree .= '<select>';
        // return $tree;
        return $tree;
    }


    public static function childView($Category, $added_parent = 0, $level) {
        $html = '';
        foreach ($Category->categoryChildren as $arr) {
            if (count($arr->categoryChildren)) {

                if ($added_parent == $arr->id) {
                    $html .= '<option class="tree-view child" selected value="' . $arr->id . '">' . \App\Category::checkLevel($level) . $arr->name . '';
                } else {
                    $html .= '<option class="tree-view child" value="' . $arr->id . '">' . \App\Category::checkLevel($level) . $arr->name . '';
                }

                $html .= \App\Category::childView($arr, $added_parent, $level + 1);
            } else {
                if ($added_parent == $arr->id) {
                    $html .= '<option class="tree-view subchild" selected  value="' . $arr->id . '">' . \App\Category::checkLevel($level) . $arr->name . '';
                } else {
                    $html .= '<option class="tree-view subchild" value="' . $arr->id . '">' . \App\Category::checkLevel($level) . $arr->name . '';
                }

                $html .= "</option>";
            }
        }

        $html .= "";
        return $html;  
    }

    public static function parentCategory() {  
        return Category::with('categoryChildren')->where(['status' => 0, 'parent_id' => 0])->limit(100)->get();
    } 

    public function products() {
        return $this->hasMany('App\Product','category_id');  
    } 

    public static function boot() {  
        parent::boot();

        static::deleting(function($cat) { // before delete() method call this
            $cat->categoryChildren()->delete();
            $cat->products()->delete(); 
            // do the rest of the cleanup...
        });
 

        static::saving(function($model) {
            $slug = str_slug($model->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            // if other slugs exist that are the same, append the count to the slug
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
            return true;
        });
    }
}
