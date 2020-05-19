<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;
use App\Suppliers;
use App\Colors;

class ProductsPageController extends Controller
{
    function __construct()
    {
        $products = Products::all();
        $categories = Categories::all();
        $suppliers = Suppliers::all();
        $colors = Colors::all();

        $randomProductsArea = Products::all()->random(4);

        view()->share('products', $products);
        view()->share('categories', $categories);
        view()->share('suppliers', $suppliers);
        view()->share('colors', $colors);

        view()->share('randomProductsArea', $randomProductsArea);
    }

    function index()
    {
        $products = new Products();

        if (request()->has('search')) {
            // $products = $products->orWhereHas('categories', function ($query) {
            //     $query->Where("categories.name", "LIKE", "%" . request('search') . "%");
            // })->orWhereHas('suppliers', function ($query) {
            //     $query->Where('suppliers.name', 'LIKE', '%' . request('search') . '%');
            // })->orWhere('products.name', 'LIKE', '%' . request('search') . '%');
            $products = $products->orWhere('products.name', 'LIKE', '%' . request('search') . '%');
        }
        if (request()->has('categories')) {
            $products = $products->Where('category_id', request('categories'));
        }

        if (request()->has('suppliers')) {
            $products = $products->where('supplier_id', request('suppliers'));
        }

        if (request()->has('colors') && !empty(request('colors'))) {
            $products = $products->whereHas('colors', function ($query) {
                $query->where('colors.id', request('colors'));
            });
        }

        if (request()->has('screen-size') && !empty(request('screen-size'))) {
            switch (request('screen-size')) {
                case '1':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->where('info_products.screen_size', '<', 5);
                    });
                    break;
                case '2':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->whereBetween('info_products.screen_size', [5, 5.5]);
                    });
                    break;
                case '3':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->whereBetween('info_products.screen_size', [5.5, 6]);
                    });
                    break;
                case '4':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->where('info_products.screen_size', '>', 6);
                    });
                    break;
                default:
                    break;
            }
        }

        if (request()->has('battery') && !empty(request('battery'))) {
            switch (request('battery')) {
                case '1':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->where('info_products.battery', '<', 2000);
                    });
                    break;
                case '2':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->whereBetween('info_products.battery', [2000, 3000]);
                    });
                    break;
                case '3':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->whereBetween('info_products.battery', [3000, 4000]);
                    });
                    break;
                case '4':
                    $products = $products->whereHas('info_products', function ($query) {
                        $query->where('info_products.battery', '>', 4000);
                    });
                    break;
                default:
                    break;
            }
        }

        if (request()->has('ram') && !empty(request('ram'))) {
            $products = $products->whereHas('info_products', function ($query) {
                $query->where('info_products.ram', request('ram'));
            });
        }

        if (request()->has('memory') && !empty(request('memory'))) {
            $products = $products->whereHas('info_products', function ($query) {
                $query->where('info_products.memory', request('memory'));
            });
        }

        if (request()->has('os') && !empty(request('os'))) {
            $products = $products->whereHas('info_products', function ($query) {
                $query->where('info_products.os', request('os'));
            });
        }

        if (request()->has('sort') && !empty(request('sort'))) {
            switch (request('sort')) {
                case 'trending':
                    break;
                case 'rating':
                    $products = $products->orderBy('rate', 'desc');
                    break;
                case 'asc':
                    $products = $products->orderBy('price', 'asc');;
                    break;
                case 'desc':
                    $products = $products->orderBy('price', 'desc');;
                    break;
                default:
                    break;
            }
        }

        if (request()->has('price_from') && request()->has('price_to')  && !empty(request('price_from')) && !empty(request('price_to'))) {
            $products = $products->whereBetween('price', [request('price_from'), request('price_to')]);
        }



        $resultProducts = $products->get();

        $productsPagination = $products->paginate(9)->appends([
            'categories' => request('categories'),
            'suppliers' => request('suppliers'),
            'colors' => request('colors'),
            'screen-size' => request('screen-size'),
            'battery' => request('battery'),
            'ram' => request('ram'),
            'memory' => request('memory'),
            'os' => request('os'),
            'sort' => request('sort')
        ]);
        // return $productsPagination;

        // return $products->get();
        return view('Pages.Products', ['productsPagination' => $productsPagination, 'resultProducts' => $resultProducts]);
    }

    function getProductById($id)
    {
        if (!is_null($id)) {
            $product = Products::find($id);
        } else
            return null;
    }

    function getProductsByIdCategory($id)
    {
        if (!is_null($id)) {
            $productsPagination = Products::where('category_id', $id)->paginate(9);
            return view('Pages.Products')->with(['productsPagination' => $productsPagination]);
        } else
            return null;
    }
}
