<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $defaultCategoryName = 'Összes Termék';
    private $defaultyCategorySlug = 'osszes-termek';
    public function list($category = 'osszes-termek')
    {
        // Ki lehet vele logolni a lekérdezéseket
        // \DB::enableQueryLog();
        // dd(\DB::getQueryLog());

        $activeCategoryName = $this->defaultCategoryName;
        $activeCategorySlug = $this->defaultyCategorySlug;

        # Csak azokat a termékeket ahol van raktáron
        $productCategories = ProductCategory::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();

        $productCategories = $productCategories->map(function ($productCategory) {
            return [
                'id' => $productCategory->id,
                'name' => $productCategory->name,
                'slug' => $productCategory->slug,
                'product_count' => $productCategory->products->count()
            ];
        });

        $productCategories = $productCategories->prepend([
            'id' => 0,
            'name' => $this->defaultCategoryName,
            'slug' => $this->defaultyCategorySlug,
            'product_count' => Product::where('stock', '>', 0)->count()
        ]);

        $activeProductCategory = $productCategories->filter(function ($productCategory) use ($category) {
            return $productCategory['slug'] == $category;
        })->first();

        if ($activeProductCategory) {
            $activeCategoryName = $activeProductCategory['name'];
            $activeCategorySlug = $activeProductCategory['slug'];
        }

        if ($category == $this->defaultyCategorySlug) {
            $products = Product::where('stock', '>', 0)->orderBy('created_at', 'desc')->get();
        } else {
            $products = Product::where('stock', '>', 0)->where('product_category_id', $activeProductCategory['id'])->orderBy('created_at', 'desc')->get();
        }

        return view('product.list', [
            'page' => 'products',
            'products' => $products,
            'product_categories' => $productCategories,
            'active_category_name' => $activeCategoryName,
            'active_category_slug' => $activeCategorySlug
        ]);
    }
}
