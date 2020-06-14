<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\User;
use App\Models\Slide;
use App\Models\Tinh;
use App\Models\Huyen;
use App\Models\Xa;
use App\Models\Comment;
use App\Models\Transaction;
use App\Models\OrderPro;
use App\Models\NeedContact;
use DB;
use Mail;
use Session;
use Cart;
use Hash;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $product = Product::where([['count', '>', 0]])->orderBy('name')->paginate(12);
        $slide = Slide::all();
        $new = Product::orderBy('count', 'desc')->take(8)->get();
        return view('index', [
            'product' => $product,
            'slide' => $slide,
            'new'   => $new
        ]);
    }

    // public function about(){
    // 	return view('about');
    // }
    public function contact(){
    	return view('contact');
    }

    public function product(){
        $product = Product::orderBy('count', 'desc')->paginate(12);
        return view('product_user', ['product' => $product]);
    }
    public function getShopingcart(Request $req){
        $tp = DB::select('select * from tinh');
        $user = Auth::user();
        if(isset($req->ship) && Cart::instance('shopping')->content() !== null) {
            $tinh = Tinh::where('matp', $req->thanh_pho)->first()->name;
            $huyen = Huyen::where('maqh', $req->quan_huyen)->first()->name;
            $xa = Xa::where('xaid', $req->phuong_xa)->first()->name;
            $address = ['tinh'=>$tinh, 'huyen'=>$huyen, 'xa'=>$xa, 'add'=>$req->address];

            $trans = new Transaction();
            $trans->status      =   '0';
            $trans->user_id     =   (isset(Auth::user()->name)) ? Auth::user()->id : 0;
            $trans->user_name   =   $req->name_client;
            $trans->user_email  =   $req->email;
            $trans->user_phone  =   $req->phone_number;
            $trans->amount      =   Cart::instance('shopping')->subTotal(0, '', '');
            $trans->payment     =   ($req->ship == "COD") ? 'none' : 'none';
            $trans->payment_info=   ($req->ship == "COD") ? 'ship COD' : 'thanh toán trực tuyến';
            $trans->message     =   json_encode($address);
            $trans->security    =   $req->_token;
            $trans->createdat   =   date("Y-m-d H:i:s");
            $trans->save();

            $cart = Cart::instance('shopping')->content();

            foreach ($cart as $item) {
                $order = new OrderPro();
                $product = Product::where('id', $item->id)->first();
                $product->count -= $item->qty;
                $product->save();
                $order->transaction_id  =       $trans->id;
                $order->product_id      =       $item->id;
                $order->count           =       $item->qty;
                $order->amount          =       (int)$item->qty * (int)$item->price;
                $order->data            =       json_encode(['size' => $item->options->size, 'color' => $item->options->color]);
                $order->status          =       0;
                $order->createat        =       date("Y-m-d H:i:s");
                $order->save();
            }

            if($req->ship == "PAY") {
                $total = Cart::instance('shopping')->subTotal(0, '', '');
                $redirect = "https://www.nganluong.vn/button_payment.php?receiver=namduong3699@gmail.com&product_name=NamUET&price=" . $total . "&return_url=http://localhost/namshop/checkPayment?payToken=" . $req->_token . "&comments=Thanh toán đơn hàng";
                Cart::instance('shopping')->destroy();
                return redirect($redirect);
            }
            Cart::instance('shopping')->destroy();
        }

        return view('shoping-cart', ['tp' => $tp, 'user' => $user]);
    }

    public function getCheckPayment(Request $req) {
        if(isset($req->payToken)) {
            $transaction = Transaction::where('security', $token)->first();
            $transaction->payment = 'paid';
            $transaction->save();
        }
        return redirect()->back();
    }

    public function blog(){
    	return view('blog');
    }
    public function blogdetail(){
    	return view('blog-detail');
    }
    public function productdetail($id){
     $product = Product::where('id', $id)->first();

     $relatePro = Product::where('catalog_id', $product->catalog_id)->get();

     $catalogPro = Catalog::where('id', $product->catalog_id)->first();

     $product->size= json_decode($product->size,true);
     $product->color= json_decode($product->color,true);
     $comment    =   Comment::where('product_Id', $id)->get();
     $inWish     =   Cart::instance('wishlist')->search(function($cartItem, $rowId) use($id) {
        return $cartItem->id == $id;
    });
     $inWish     =   ($inWish->first() !== null) ? true : false;

     return view('product-detail', [
        'product'   => $product,
        'relatePro' => $relatePro,
        'catalogPro'   => $catalogPro,
        'comment'   => $comment,
        'inWish'    => $inWish
    ]);
 }
 public function catalog($type) {
    $sp_theo_loai = Product::where([
        ['catalog_id', '=', $type]
    ])->orderBy('count', 'desc')->paginate(12);
    return view('product_user', ['product'=> $sp_theo_loai]);
}

public function getAddToCart(Request $req) {
    $id = $req->id;
    $color = $req->color;
    $qty = $req->qty;
    $size = $req->size;
    $product = Product::find($id);
    $s= $product->size;
    $c= $product->color;

    $s=json_decode($s,true);
    $c=json_decode($c,true);

    $nameSize=$s[$size];
    $nameColor = $c[$color];


    Cart::instance('shopping')->add(
        array(
            'id'    => $product->id,
            'name'  => $product->name,
            'qty'   => $qty,
            'price' => $product->price * (100 - $product->discount)/100,
            'options' => [
                'image' => $product->image_link,
                'size'  => $nameSize,
                'color' => $nameColor,
                'folder'=>$product->folder,
                'nameSize' => $nameSize,
                'nameColor' =>  $nameColor
            ],
        )
    );
        // $content = Cart::content();
    return json_encode( Cart::instance('shopping')->content());
}

public function getIncreaseCart(Request $req) {
    if(isset($req->rowId)) {
        Cart::instance('shopping')->update($req->rowId, $req->qty);
        redirect()->back();
    }
}

public function updateCart(Request $req) {

}

public function getSearch(Request $req) {
    $product = Product::where('name', 'like', '%'.$req->key.'%')->orderBy('name')->paginate(12);
    return view('search', ['product' => $product]);
}

public function postModal(Request $req) {
        // dd($req->query);
        // $req->query = 1;
    $product = Product::where('id', $req->query)->first();
    return view('modules/modal', ['product_mod' => $product ]);
}

public function getModal(Request $req) {
        // dd($req->id);
    $product = Product::where('id', $req->id)->first();
        // dd($product);
    return view('modules/modal', ['product_mod' => $product ]);
}

public function getFilter($key) {
    if($key == 'cao-xuong-thap') {
        $products = Product::where([['count', '>', 0]])->orderBy('price', 'desc')->paginate(12);
    }
    if($key == 'thap-len-cao') {
        $products = Product::where([['count', '>', 0]])->orderBy('price')->paginate(12);
    }
    if($key == 'moi-nhat') {
        $products = Product::where([['count', '>', 0]])->orderBy('id', 'desc')->paginate(12);
    }
    if($key == '0-50') {
        $products = Product::where('price', '<', 50000)->paginate(12);
    }
    if($key == '50-100') {
        $products = Product::where([
            ['price', '>=', 50000],
            ['price', '<=', 100000],
            ['count', '>', 0]
        ])->paginate(12);
    }
    if($key == '100-150') {
        $products = Product::where([
            ['price', '>=', 100000],
            ['price', '<=', 150000],
            ['count', '>', 0]
        ])->paginate(12);
    }
    if($key == '150-200') {
        $products = Product::where([
            ['price', '>=', 150000],
            ['price', '<=', 200000],
            ['count', '>', 0]
        ])->paginate(12);
    }
    if($key == '200') {
        $products = Product::where([['price', '>', 200000], ['count', '>', 0]])->paginate(12);
    }
    return view('product_user', ['product' => $products]);
}

public function postContact(Request $request) {
    $input = $request->all();
    $data = [
        'name'      => $input['name'],
        'email'     => $input['email'],
        'content'   => $input['msg']
    ];
    Mail::send('mail', $data, function($message){
        $message->from('namduong3616@gmail.com', 'Cozastore');
        $message->to('namduong3699@gmail.com', 'FeedBack')->subject('Visitor Feedback!');
    });
    return view('contact');
}

public function getInfo(Request $req) {
    if (isset($req->matp)) {
        $qh = DB::select('select * from quanhuyen where matp = ?' ,[$req->matp]);
        foreach ($qh as $quan_huyen) {
            echo "<option value='".$quan_huyen->maqh."'>".$quan_huyen->name."</option>";
        }
    }
    if (isset($req->maqh)) {
        $px = DB::select('select * from xaphuong where maqh = ?' ,[$req->maqh]);
        foreach ($px as $phuong_xa) {
            echo "<option value='".$phuong_xa->xaid."'>".$phuong_xa->name."</option>";
        }
    }
}

public function getAccount() {
    if(!Auth::check()) return redirect('index');
    $user = Auth::user();
    $address = json_decode($user->address, true);
    $tp = DB::select('select * from tinh');
    $trans = Transaction::where('user_id', Auth::user()->id)->orderBy('createdat', 'desc')->get();
    $hist = array();
    foreach ($trans as $tran) {
        $order = OrderPro::where('transaction_id', $tran->id)->get();
        $product = array();
        foreach ($order as $item) {
            $pro = Product::find($item->product_id);
            array_push($product, $pro);
        }
        array_push($hist, array(
            'trans' => $tran,
            'info' => array(
                'order' => $order,
                'pro'   => $product
            )
        ));
    }
    return view('account', [
        'user'      => $user,
        'address'   => $address,
        'tp'        => $tp,
        'history'   => $hist
    ]);
}

public function getAddToWishlist($id) {
    $product = Product::find($id);
    Cart::instance('wishlist')->add(
        array(
            'id'    => $product->id,
            'name'  => $product->name,
            'qty'   => 1,
            'price' => $product->price * (100 - $product->discount)/100,
            'options' => [
                'image' => $product->image_link,
                'folder'=>$product->folder
            ],
        )
    );
    return redirect()->back();
}

public function getDelWishlist(Request $req) {
 if(isset($req->id)) {
    $id = $req->id;
            // Cart::instance('wishlist')->remove($rowId);
    $item=Product::find($id);
    $cart= Cart::instance('wishlist')->search(function($cartItem, $rowId) use($item) {return $cartItem->id == $item->id;})->first();
    if($cart!==null){

        Cart::instance('wishlist')->remove($cart->rowId);
    }
}

}

public function postComment(Request $req) {
    if(isset($req->review)) {
        $comment             = new Comment();
        $comment->product_Id = $req->pro_id;
        $comment->user_Id    = Auth::user()->id;
        $comment->user_name  = Auth::user()->name;
        $comment->content    = $req->review;
        $comment->rate       = $req->rating;
        $comment->time       = date("Y-m-d H:i:s");
        $comment->save();
    }
    return redirect()->back();
}
public function getCheckout(Request $req) {

}

public function getEditAccount(Request $req) {
    $user           = Auth::user();
    if(!empty($req->oldPass)) {
        if(password_verify($req->oldPass, $user->password)) {
            $user->password = Hash::make($req->newPass);
            $user->save();
            return "Bạn đã đổi mật khẩu thành công!";
        } else return "Mật khẩu sai!";
    } else {
        $user->name     = $req->name;
        $user->phone    = $req->phone;
        $tinh = Tinh::where('matp', $req->thanh_pho)->first()->name;
        $huyen = Huyen::where('maqh', $req->quan_huyen)->first()->name;
        $xa = Xa::where('xaid', $req->phuong_xa)->first()->name;
        $address = ['tinh' => $tinh, 'huyen' => $huyen, 'xa' => $xa];
        $user->address  = json_encode($address);
        $user->save();
        $tp             = DB::select('select * from tinh');
        return redirect('account');
    }
}

public function getNeedContact(Request $req) {
    $needcont = new NeedContact();
    $needcont->email = $req->email;
    $needcont->save();
    return redirect()->back();
}
}
