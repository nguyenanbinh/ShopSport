<?php

namespace App\Repositories\Eloquent;

use App\Category;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends EloquentRepository
{
    public function getModel()
    {
        return  Category::class;
    }

    public function deleteX($id)
    {
        $category = $this->find($id);

        if (!$category->parent_id) {

            $children =  $this->find($id)->load('children')->children;

            foreach ($children as $child) {
                // dd($child->toArray());
                $categoryId =  $this->find($child->id);
                // dd($categoryId);
                $categoryId->delete();
                foreach ($categoryId->products as $product) {
                    $product->delete();
                }
            }
        } else {
            $category->products()->delete();
        }
        $category->delete();
    }


    public function cate_parent($data, $parent_id = 0, $str = "", $select = 0)
    {
        $string = "";
        foreach ($data as $value) {
            $id = $value['id'];
            $name = $value['name'];
            if ($value['parent_id'] == $parent_id) {
                if ($select != 0 && $id = $select) {
                    $string.= "<option value='$id' selected>$str $name</option>";
                } else {
                    $string.= "<option value='$id'>$str $name</option>";
                }
                $string.=$this->cate_parent($data, $id, $str . "--");
            }
        }
       return $string;
    }

   


}
