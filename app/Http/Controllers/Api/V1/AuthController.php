<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     ** path="/api/v1/send_sms",
     *  tags={"Auth Api"},
     *  description="use for send verification sms to user",
     * @OA\RequestBody(
     *    required=true,
     * *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="mobile",
     *                  description="Enter mobile number",
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


    public function sendSms(Request $request)
    {
        $mobile = $request->input('mobile');
        $checkLastSms = SmsCode::checkTwoMinute($mobile);
        if (!$checkLastSms){
            ///////////////////////////////////////////////////////////////////////if 2 minute check
            $code = rand(1111, 9999);
            $user = User::query()->where('mobile',$mobile)->first();
            $mobile_entered_before =  SmsCode::query()->where('mobile',$mobile)->first();
            if (!isset($mobile_entered_before) && !isset($user)){
                ////////////////////////////////
                SmsCode::createSmsCode($mobile,$code);
                return Response()->json([
                    'result'=>true,
                    'message'=>"send sms is done",
                    'data'=>[
                        'mobile'=>$mobile,
                        'code'=>$code,
                        '$user'=>$user
                    ]
                ],201);
                ///////////////////////////////////
            }else
            {
                if($user){
                    return Response()->json([
                        'result'=>false,
                        'messages'=>"mobile has been entered before",
                        'data'=>[
                            'mobile'=>$mobile,
                            '$user'=>$user
                        ]
                    ],202);
                }else{
                    return Response()->json([
                        'result'=>false,
                        'messages'=>"mobile exists but user not regirtered",
                        'data'=>[
                            'mobile'=>$mobile,
                            '$user'=>$user
                        ]
                    ],202);
                }
            }
            /////////////////////////////////////////////////////////////////////////////////////if 2 minute check
        }else{
            return Response()->json([
                'result'=>false,
                'message'=>"retry 2 minutes later",
                'data'=>[]
            ],403);
        }

    }


    /**
     * @OA\Post(
     ** path="/api/v1/verify_sms_code",
     *  tags={"Auth Api"},
     *  description="use for send verification sms to user",
     * @OA\RequestBody(
     *    required=true,
     * *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="mobile",
     *                  description="User mobile number",
     *                  type="string",
     *               ),
     *      @OA\Property(
     *                  property="code",
     *                  description="Recieved sms code",
     *                  type="string",
     *               ),
     *
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


    public function verifySms(Request $request)
    {
        $mobile = $request->input('mobile');
        $code = $request->input('code');
        $check = SmsCode::checkSent($mobile,$code);
        if ($check){
            $user = User::query()->where('mobile',$mobile)->first();
            if ($user){

                return Response()->json([
                    'result'=>true,
                    'message'=>'user has been registered before',
                    'data'=>[
                        'id'=>$user->id,
                        'name'=>$user->name,
                        'token'=>$user->createToken("new Token")->plainTextToken
                    ]
                ],201);

            }else{

                $user = User::query()->create([
                    'mobile'=>$mobile,
                    'password'=> \Hash::make(rand(1111,9999))
                ]);
                return Response()->json([
                    'result'=>true,
                    'message'=>'new user created',
                    'data'=>[
                        'id'=>$user->id,
                        'name'=>$user->name,
                        'token'=>$user->createToken("new Token")->plainTextToken
                    ]
                ],201);

            }

        }

    }

}
