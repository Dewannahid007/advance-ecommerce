<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function front_index(Request $request)
    {
        $result['home_categories'] = DB::table('categories')
            ->where(['status' => 1])
            ->get();

        foreach ($result['home_categories'] as $list) {
            $result['home_categories_product'][$list->id] = DB::table('products')
                ->where(['status' => 1])
                ->where(['category_id' => $list->id])
                ->get();

            foreach ($result['home_categories_product'][$list->id] as $list1) {
                $result['home_product_attr'][$list1->id] = DB::table('products_attr')
                    ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                    ->where(['products_attr.products_id' => $list1->id])
                    ->get();
            }
        }

        $result['home_featured_product'][$list->id] = DB::table('products')
                ->where(['status' => 1])
                ->where(['is_featured' =>1])
                ->get();

            foreach ($result['home_featured_product'][$list->id] as $list1) {
                $result['home_featured_product_attr'][$list1->id] = DB::table('products_attr')
                    ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                    ->where(['products_attr.products_id' => $list1->id])
                    ->get();
            }

            $result['home_tranding_product'][$list->id] = DB::table('products')
                ->where(['status' => 1])
                ->where(['is_tranding' =>1])
                ->get();

            foreach ($result['home_tranding_product'][$list->id] as $list1) {
                $result['home_tranding_product_attr'][$list1->id] = DB::table('products_attr')
                    ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                    ->where(['products_attr.products_id' => $list1->id])
                    ->get();
            }


            $result['home_discounted_product'][$list->id] = DB::table('products')
                ->where(['status' => 1])
                ->where(['is_discounted' =>1])
                ->get();

            foreach ($result['home_discounted_product'][$list->id] as $list1) {
                $result['home_discounted_product_attr'][$list1->id] = DB::table('products_attr')
                    ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                    ->where(['products_attr.products_id' => $list1->id])
                    ->get();
            }


        
             $result['home_brand'] = DB::table('brands')
            ->where(['status'=>1])
            ->get();
            
            

            $result['home_banner']=DB::table('home_banners')
            ->where(['status'=>1])
            ->get();   
  
        return view('front.index', $result);
    }
}
