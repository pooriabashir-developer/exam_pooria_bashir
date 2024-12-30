<?php



//pooria bashir//



namespace App\Http\Controllers;

use App\Http\Requests\CheckProductRequest;
use App\Http\Requests\ProductOtpRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductOtpResource;
use App\Http\Resources\ProductResource;
use App\Models\product;
use App\Models\Product_Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function product(ProductRequest $productRequest)
    {
        $productss = product::create($productRequest->all());

        if ($productRequest->hasFile('image')) {
            $url_image = Storage::putFile('product', $productRequest->file('image'));
            $productss->update(['image' => $url_image]);
            return response()->json([
                'message' => "وارد شد",
            ], 200);
        }
    }

    public function CeckProduct(ProductOtpRequest $productOtpRequest)
    {
        $productss= product::where('mobile',$productOtpRequest->mobile)->first();
        if ($productss) {

            $product_otp=Product_Otp::create([
                'code'=>mt_rand(111111,999999),
                'mobile'=>$productss->mobile
            ]);
            return response()->json([
                'message'=>'کاربر پیدا شد و کد ارسال شد',
                'data'=> new ProductOtpResource($product_otp)
            ],200);
        }
        else{
            return response()->json([
                'message'=>'کاربر پیدا نشد'
            ],318);
        }
    }


    public function CheckOtpProduct(CheckProductRequest $checkProductRequest)
    {
        $chk_exsit_otp=Product_Otp::where('mobile',$checkProductRequest->mobile)->where('code',$checkProductRequest->code)->first();
        if($chk_exsit_otp){
            $chk_exsit_otp->delete();
            $user=product::where('mobile',$chk_exsit_otp->mobile)->first();
            $token=$user->createToken('Login' .$user-> name);
            return response()->json([
                'message'=>'کاربر با موفقیت وارد شد',
                'data'=> new ProductResource($user),
                'token'=>$token->plainTextToken
            ],200);
        }
        else
        {
            return response()->json([
                'message'=>'کد وارد شده نامعتبر میباشد',

            ],318);
        }
    }

    public function InformationProduct(product $product)
    {

        return response()->json([
            'message'=>'اطلاعات کاربر پیدا شد',
            'data'=> new ProductResource($product)
        ],200);
    }
}
