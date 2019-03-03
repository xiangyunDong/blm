<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Cart;
use App\Member;
use App\Menu;
use App\MenuCategory;
use App\Order;
use App\OrderDetail;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;

class ApiController extends Controller
{
    public function businessList(Request$request){
        $wheres[]=['status',1];
        if($request->keyword){
            $keyword=$request->keyword;
            $wheres[]=['shop_name','like',"%$keyword%"];
            $shops=Shop::where($wheres)->get();
        }else{
            $shops=Shop::all();
            $keyword='';
        }
        return $shops;
    }


    public function business(Request$request){
        $id=$request->id;
        $shops=Shop::find($id);
        $wheres[]=['shop_id','=',$id];
        $menucategories=MenuCategory::where($wheres)->get();

        foreach ($menucategories as $menucategory):
            $menucategory['goods_list']=Menu::where('category_id',$menucategory->id)->get();
            foreach ($menucategory['goods_list'] as $good):
                $good['goods_id']=$good->id;
            endforeach;
        endforeach;
        $shops["commodity"]=$menucategories;
        return $shops;
    }

    public function sms(Request$request){
        // 短信应用SDK AppID
        $appid = 1400189719; // 1400开头

// 短信应用SDK AppKey
        $appkey = "7571e72a66c0d376d93346d2ce7fb416";

// 需要发送短信的手机号码
        $phoneNumber =$request->tel;
        //dd($phoneNumber);

// 短信模板ID，需要在短信应用中申请
        $templateId = 285069;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "陈贸生活记录"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [mt_rand(1000,9999),5];

          $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");
            Redis::set($phoneNumber,$params[0]);
        } catch(\Exception $e) {
            var_dump($e);
        }
    }

    public function regist(Request$request)
    {
        if(!Redis::get($request->tel)==$request->sms){
            return ["status" => "false", "message" => "注册失败"];
        };
        $this->validate($request, [
            'username' => 'unique:members',
            'tel' => 'unique:members',
            'password' => 'required',
        ]);

        Member::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
            'rememberToken'=>0,
        ]);
        return ["status" => "true", "message" => "注册成功"];

    }

    public function login(Request$request){

        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt([
            'username'=>$request->name,
            'password'=>$request->password,

        ],$request->has('rememberMe'))){
            return ["status"=>"true",
                "message"=>"登录成功",
                "user_id"=>Auth::user()->id,
                "username"=>Auth::user()->username];
        }else{
            return ["status"=>"false",
                "message"=>"登录失败",];
        }
    }

    public function addressList(Request$request){
        $addresses=Address::where('user_id',Auth::user()->id)->get();

        return$addresses;


    }


    public function addAddress(Request$request){
        //dd(Auth::user()->id);
        $this->validate($request,[
            'name'=>'required',
            'tel'=>'required',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
        ]);
        $user_id=Auth::user()->id;
        Address::create([
            'user_id'=>$user_id,
            'name' => $request->name,
            'tel' => $request->tel,
           'province'=>$request->provence,
            'city'=>$request->city,
            'county'=>$request->area,
            'address'=>$request->detail_address,
            'is_default'=>0,
        ]);
        return[
             "status"=>"true",
            "message"=>"添加成功"
    ];
    }

    public function address(Request$request){
        $address=Address::where('id',$request->id)->first();
        $address['provence']=$address->province;
        $address['area']=$address->county;
        $address['detail_address']=$address->address;
        return $address;
    }

    public function editAddress(Request$request,Address$address){
        $this->validate($request,[
            'name'=>'required',
            'tel'=>'required',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
        ]);

        $address->where('id',$request->id)->update([
            'name' => $request->name,
            'tel' => $request->tel,
            'province'=>$request->provence,
            'city'=>$request->city,
            'county'=>$request->area,
            'address'=>$request->detail_address,
            'is_default'=>0,
        ]);
        return["status"=>"true",
      "message"=>"修改成功"];
    }

    public function cart(){
        $goods_list=Cart::where('user_id',Auth::user()->id)->get();
        //return$goods_list;
        $total=0;
        foreach ($goods_list as $goods):
            $good=Menu::where('id',$goods->goods_id)->first();
        //var_dump($good);exit;
            $goods['goods_name']=$good->goods_name;
            $goods['goods_img']=$good->goods_img;
            $goods['goods_price']=$good->goods_price;
            $total+=$goods->amount * $good->goods_price;
            endforeach;

        return ["goods_list"=>$goods_list,"totalCost"=>$total];
    }


    public function addCart(Request$request)
    {
        $goodslist=$request->goodsList;
        //dd($goodslist[0]);
        $goodscount=$request->goodsCount;
        //dd($goodscount[0]);
        for($i=0;$i<count($request->goodsList);$i++):
            //dd(count($request->goodsList));
        Cart::create([
            'user_id'=>Auth::user()->id,
            'goods_id'=>$goodslist[$i],
            'amount'=>$goodscount[$i]
        ]);
        endfor;
        return["status"=>"true",
      "message"=> "添加成功"];
    }


    public function addOrder(Request$request){
        DB::beginTransaction();
        $total=0;
        $goods=Cart::first();
        $shop=Menu::where('id',$goods->goods_id)->first();
        $address=Address::where('id',$request->address_id)->first();
        $carts=Cart::where('user_id',Auth::user()->id)->get();
      foreach ($carts as $cart):
          $good=Menu::where('id',$cart->goods_id)->first();
      $goods_price=$good->goods_price;
      $amount=$cart->amount;
      $total+=$goods_price*$amount;
      endforeach;
      //dd($total);
    $order=new Order();
        $order->user_id=Auth::user()->id;
        $order->shop_id=$shop->shop_id;
        $order->sn=date("Y-m-d H:m:s");
        $order->province=$address->province;
        $order->city=$address->city;
        $order->county=$address->county;
        $order->address=$address->address;
        $order->tel=$address->tel;
        $order->name=$address->name;
        $order->total=$total;
        $order->status=0;
        $order->out_trade_no=rand('0000000','9999999');
        $a=$order->save();
//订单详情表
        foreach($carts as $cart):
            $order_detail=new OrderDetail();
                $order_detail->order_id=$order->id;
                $order_detail->goods_id=$cart->goods_id;
                $order_detail->amount=$cart->amount;
                $goods=Menu::where('id',$order_detail->goods_id)->first();
            $order_detail->goods_name=$goods->goods_name;
            $order_detail->goods_img=$goods->goods_img;
            $order_detail->goods_price=$goods->goods_price;
            $b=$order_detail->save();
        endforeach;
        if ($a&&$b){
            DB::commit();
            return[
                "status"=>"true",
                "message"=>"添加成功",
                "order_id"=>$order_detail->order_id];
        }else{
            DB::rollBack();
            return[
                "status"=>"false",
                "message"=>"添加失败"];
        }


    }

    public function Order(Request$request){
        $orders=Order::where('id',$request->id)->first();
        //dd($orders->shop_id);
        $shop=Shop::where('id',$orders->shop_id)->first();
        $orders["shop_name"]=$shop->shop_name;
        $orders["shop_img"]=$shop->shop_img;
        $order_detail=OrderDetail::where('order_id',$orders->id)->get();
        //dd($order_detail);
        $orders["goods_list"]=$order_detail;
        $orders["order_price"]=$orders->total;
        $orders["order_address"]=$orders->address;
        $orders["order_code"]=$orders->sn;
        $orders["order_birth_time"]=substr($orders->created_at,0,16);
        if($orders->status==-1){
            $status="已取消";
        }elseif($orders->status==0){
            $status="待支付";
        }elseif($orders->status==1){
            $status = "待发货";
        }elseif($orders->status==2){
            $status = "待确认";
        }else{
            $status = "完成";
        }
        $orders["order_status"]=$status;
        return $orders;
    }

    public function OrderList(){
        $orders=Order::where('user_id',Auth::user()->id)->get();
        foreach ($orders as $order):
            $shop=Shop::where('id',$order->shop_id)->first();
            $order["shop_name"]=$shop->shop_name;
            $order["shop_img"]=$shop->shop_img;
            $order_detail=OrderDetail::where('order_id',$order->id)->get();
            //dd($order_detail);
            $order["goods_list"]=$order_detail;
            $order["order_price"]=$order->total;
            $order["order_address"]=$order->address;
            $order["order_code"]=$order->sn;
            $order["order_birth_time"]=substr($order->created_at,0,16);
            if($order->status==-1){
                $status="已取消";
            }elseif($order->status==0){
                $status="待支付";
            }elseif($order->status==1){
                $status = "待发货";
            }elseif($order->status==2){
                $status = "待确认";
            }else{
                $status = "完成";
            }
            $order["order_status"]=$status;
        endforeach;
        return $orders;
    }

    public function changePassword(Request$request){
        $oldpassword=$request->oldPassword;
        $newpassword=$request->newPassword;

        $this->validate($request,[
            'oldPassword'=>'required',
            'newPassword'=>'required',
        ]);

        if (Hash::check($oldpassword,Auth::user()->password)) {
            Auth::user()->password=Hash::make($newpassword);
            Auth::user()->save();
            return ["status"=>"true",
                    "message"=>"修改成功"];
        }else{
            return ["status"=>"false",
                "message"=>"修改失败"];
        }
    }

    public function forgetPassword(Request$request){
        if(!Redis::get($request->tel)==$request->sms){
            return ["status" => "false", "message" => "验证码错误"];
        };
        $members=Member::where('tel',$request->tel)->first();
        $members->password=Hash::make($request->password);
        $members->save();
        return ["status" => "true", "message" => "修改密码成功"];
    }
}
