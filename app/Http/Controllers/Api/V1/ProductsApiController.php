<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\ProductResource;
use App\Http\Services\Keys;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Slider;
use http\Client\Response;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    //
    /**
     * @OA\Get(
     ** path="/api/v1/most_sold_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function most_sold_products()
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::brands =>Brand::getBrands(),
                Keys::most_seller_products =>ProductRepository::getMostSellerProducts()->response()->getDate(true),
                ]
        ],200);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/most_viewed_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function most_viewed_products()
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::brands =>Brand::getBrands(),
                Keys::most_viewed_products =>ProductRepository::getMostViewedProducts()->response()->getDate(true),
            ]
        ],200);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/newest_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function newest_products()
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::brands =>Brand::getBrands(),
                Keys::newest_products =>ProductRepository::getNewestProducts()->response()->getDate(true),
            ]
        ],200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/cheapest_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function cheapest_products()
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::brands =>Brand::getBrands(),
                Keys::cheapest_products =>ProductRepository::getCheapestProducts()->response()->getDate(true),
            ]
        ],200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/most_expensive_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/


    public function most_expensive_products()
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::brands =>Brand::getBrands(),
                Keys::most_expensive_products =>ProductRepository::getMostExpensiveProducts()->response()->getDate(true),
            ]
        ],200);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/products_by_category/{id}",
     *  tags={"Products Page"},
     *  description="get products data by category id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function productsByCategory($id)
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                //Keys::brands =>Brand::getBrands(),
                Keys::products_by_category =>ProductRepository::getProductsByCategory($id)->response(),//->getDate(true),
            ]
        ],200);
    }



    /**
     * @OA\Get(
     ** path="/api/v1/products_by_brand/{id}",
     *  tags={"Products Page"},
     *  description="get products data by category id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function productsByBrand($id)
    {
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::brands =>Brand::getBrands(),
                Keys::products_by_brand =>ProductRepository::getProductsByBrand($id)->response()->getDate(true),
            ]
        ],200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/product_details/{id}",
     *  tags={"Product Details"},
     *  description="get product details data by product id",
     *     @OA\Parameter(
     *         description="product id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productDetail($id)
    {
        $product = Product::query()->find($id);
        $product->increment('review');
        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                new ProductResource($product),
            ]
        ],200);
    }






    /**
     * @OA\Post(
     ** path="/api/v1/save_product_comment",
     *  tags={"Product Details"},
     *   security={{"sanctum":{}}},
     *  description="save user comment for product",
     * @OA\RequestBody(
     *    required=true,
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="product_id",
     *                  description="product id",
     *                  type="integer",
     *               ),
     *     *           @OA\Property(
     *                  property="parent_id",
     *                  description="product id",
     *                  type="integer",
     *               ),
     *          @OA\Property(
     *                  property="body",
     *                  description="user comment text",
     *                  type="string",
     *               ),
     *           ),
     *       )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Data saved",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/



    public function saveComment(Request $request)
    {
        $user = auth()->user();
        $comment = Comment::query()->create([
            'body'=>$request->input('body'),
            'parent_id'=>$request->input('parent_id',null),
            'user_id'=>$user->id,
            'product_id'=>$request->input('product_id'),
        ]);
        $product = Product::query()->find($request->product_id);

        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                new ProductResource($product)
            ]
        ]);

    }



    /**
     * @OA\Post(
     ** path="/api/v1/search_product",
     *  tags={"Products Page"},
     *  description="search product",
     *    @OA\RequestBody(
     *    required=true,
     *          @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="search",
     *                  description="product name searched"
     *                  type="string",
     *               ),
     *     )
     *   )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/

    public function searchProduct(Request $request)
    {

        return Response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data'=>[
                Keys::searched_product =>ProductRepository::getSearchedProduct($request->input('search'))->response() , //->getDate(true),
            ]
        ],200);
    }








}
