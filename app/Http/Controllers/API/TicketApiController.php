<?php


namespace App\Http\Controllers\API;


use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketApiController extends BaseController
{
    function couponDay(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator, 'User login failed.');
        }
        $customer=User::query()->find($request->user_id);
        if (is_null($customer)){
            return $this->sendError('User not found','User not found');
        }
        if ($customer->sold<500){
            return $this->sendError('Coupon not found','User date expire');
        }
        $coupons=Ticket::query()->where('date','=',$request->date)->orderByDesc("created_at")->get();
        $data=[];
        foreach ($coupons as $coupon){
            $data[]=[
                'id'=>$coupon->id,
              "image"=>$coupon->image,
              'image_result'=>$coupon->image_result,
              'coupon'=>$coupon->numero,
              'date'=>$coupon->date,
            ];
        }
        return $this->sendResponse($data, 'coupons successfully.');
    }
    function couponLastDay(Request $request)
    {
        $offset = $request->get("offset");
        if (!isset($offset)) {
            $offset = 0;
        }
        $limit = $request->get('limit');
        if (!isset($limit)) {
            $limit = 20;
        }
        $date=date("Y-m-d");
        $coupons=Ticket::query()->where('date','<',$date)->orderByDesc("created_at")->paginate($limit)->appends($date);
        $data=[];
        foreach ($coupons as $coupon){
            $data[]=[
                'id'=>$coupon->id,
                "image"=>$coupon->image,
                'image_result'=>$coupon->image_result,
                'coupon'=>$coupon->numero,
                'date'=>$coupon->date,
            ];
        }
        return $this->sendResponse($data, 'coupons successfully.');
    }
}
