<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PaymentController extends Controller
{
    public function add_order(Request $request)
    {

        $price = $request->input('price');
        // فرض بر این است که شما ای پی آی درگاه پرداخت خود را دارید
        // در اینجا باید کد مربوط به ارسال درخواست به درگاه پرداخت قرار گیرد

        // برای مثال، می‌توانید از cURL برای ارسال درخواست استفاده کنید
        $url = "https://api.paymentgateway.com/pay"; // آدرس API درگاه پرداخت
        $data = [
            'amount' => $price,
            'currency' => 'IRR',
            // دیگر اطلاعات مورد نیاز
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        curl_close($ch);

        // پردازش پاسخ دریافتی از درگاه پرداخت

    if (isset($response['status_code']) &&
        $response['status_code'] == 200 &&
        $response['status'] == 'success')
    {
        // اگر توکن موجود باشد
        if (isset($response['token'])) {
            // دریافت مقادیر
            $amount = $response['amount'];
            $currency = $response['currency'];
            $orderId = $response['order_id'];
            $token = $response['token'];
            $paymentUrl = $response['payment_url'] + $token;

            // کاربر را به صفحه پرداخت هدایت کنید
            return redirect()->to($paymentUrl);
        } else {
            return redirect()->route('home')->withErrors(['error' => 'توکن پرداخت یافت نشد.']);
        }
    } else {
        return redirect()->route('home')->withErrors(['error' => 'خطا در پردازش پرداخت.']);
    }



    $response = json_decode($responseData, true); // فرض بر این است که $responseData حاوی پاسخ JSON است


        ///////////////////////////////////////////////////////////////////
        //روش دوم از راه ریکوئست اچ تی تی پی


        $price1 = $request->input('price');
        // فرض بر این است که شما API درگاه پرداخت خود را دارید
        $response1 = Http::post('https://api.paymentgateway.com/pay', [
            'amount' => $price1,
            'currency' => 'IRR',
            // دیگر اطلاعات مورد نیاز
        ]);

        if ($response1->successful()) {
            $data1 = $response1->json();
            // بررسی وجود payment_url در پاسخ
            if (isset($data1['payment_url'])) {
                // کاربر را به صفحه پرداخت هدایت کنید
                return redirect()->to($data1['payment_url']);
            } else {
                return back()->withErrors(['error' => 'آدرس پرداخت در پاسخ یافت نشد.']);
            }
        } else {
            return back()->withErrors(['error' => 'خطا در پردازش پرداخت']);
        }

        ////////////////////////////////////////////////////////////////////////

    }


}
