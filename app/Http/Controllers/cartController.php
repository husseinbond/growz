<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use Auth;
use Session;
use App\Coupon;
use App\Jobs\UpdateCoupon;
use Illuminate\Support\Str;
class cartController extends Controller
{



    public function couponsstore(Request $request){
    
  
    
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return back()->withErrors('Invalid coupon code. Please try again.');
        }
        dispatch_now(new UpdateCoupon($coupon));
    
    
    
    
        return back()->with('success_message', 'Coupon has been applied!');
    
     
    }
    

    
public function store(request $request){




    
    $this->validate($request,[
        'quantity' => 'required','numeric',
        'category_id'=>'required',
        'name'=>'required','string',
        'color'=>'required','string',
        'price'=> 'required','numeric',
        'size'=>'required','string',
        'country'=>'required','string',
    ]);

   

$cartlcoker = cart::where('name',$request->name)->where('size',$request->size)->where('color',$request->color)->where('country',$request->country)->get();

if(auth::id() !== null){
    $cartlcoker = $cartlcoker->where('user_id',auth::id());
}

else{
    $session_id = Session::get('session_id');
    if(!isset($session_id)){
        $session_id = str_random(40);
        Session::put('session_id',$session_id);
    }

    $cartlcoker = $cartlcoker->where('session_id',$session_id);
    
}

if($cartlcoker){
    $cart = new cart;

    $cart->Link = $request->Link;
    $cart->category_id = $request->category_id;
    $cart->size = $request->size;
    $cart->price = $request->price;
    $cart->name =$request->name;
    $cart->quantity = $request->quantity;
    $cart->color = $request->color;
    $cart->country = $request->country;
    
    if(!empty(auth::id())){
    
        $cart->user_id = auth::id();
    
    
    }else{
    
    $cart->session_id = $session_id;
    
    }

    
    $cart->save();
    
  
    
    

}






}




public function index(){
    
    
 
    if(auth::id() !== null){

        $cartlcoker = cart::where('user_id',auth::id())->get();
        $price = cart::where('user_id',$session_id)->get()->sum('price');
return view('front.Cart')->with('carts',$cartlcoker)->with('price',$price);



    }


    else{

        $session_id = Session::get('session_id');
        if(!isset($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }
    

        $session_id = Session::get('session_id');
        $cartlcoker = cart::where('session_id',$session_id)->get();
        $total_amount = 0;
        foreach($cartlcoker as $item){
            $total_amount = $total_amount + ($item->price * $item->quantity);
         }


return view('front.Cart')->with('carts',$cartlcoker)->with('price',$total_amount);

    }


}



public function delete($id){

    $cart = cart::where('id',$id)->get()->first();
    if($cart !== null ){

        $cart->delete();

        return redirect()->back()->with('message','done');


    }




}

public function edit(request $request,$id){
dd($request->all());

    $this->validate($request,[
        'quantity' => 'required','numeric',
     
    ]);




    $cart = cart::where('id',$id)->get()->first();

    if($cart !== null){

        $cart->quantity = $request->quantity;
      

        $cart->save();

  


    }


}






}
