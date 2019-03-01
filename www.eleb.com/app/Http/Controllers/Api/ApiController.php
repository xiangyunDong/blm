<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Cart;
use App\Member;
use App\Menu;
use App\MenuCategory;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            return back()->with('danger','验证码错误');
        };
        $this->validate($request, [
            'username' => 'unique:members',
            'tel' => 'unique:members',
            'password' => 'required',
        ]);

        Member::create([
            'username' => $request->username,
            'tel' => $request->tel,
            'password' => Hash::make($request->password),
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
            return back()->with('danger','用户名或密码错误');
        }
    }

    public function addressList(Request$request){
        $addresses=Address::all();

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
           // dd(1),
            'name' => $request->name,
            //dd($request->name),
            'tel' => $request->tel,
            'province'=>$request->provence,
            'city'=>$request->city,
            'county'=>$request->area,
            'address'=>$request->detail_address,
            'is_default'=>0,
        ]);
        //dd($a);
        return["status"=>"true",
      "message"=>"修改成功"];
    }

    public function cart(){
        $goods_list=Cart::where('user_id',Auth::user()->id)->all();
        //return$goods_list;
        $total=0;
        foreach ($goods_list as $goods):
            $good=Menu::where('id',$goods->goods_id)->first();
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
}
