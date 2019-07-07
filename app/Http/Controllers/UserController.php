<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Catalog;
use App\Product;
use App\User;
use App\Slide;
use App\Tinh;
use App\Huyen;
use App\Xa;
use App\Comment;
use App\Transaction;
use App\OrderPro;
use DB;
use Mail;
use Session;
use Cart;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $product = Product::paginate(12);
        $slide = Slide::all();
        $new = Product::orderBy('id', 'desc')->take(8)->get();

        return view('index', [
            'product' => $product, 
            'slide' => $slide,
            'new'   => $new
        ]);
    }

    public function about(){
    	return view('about');
    }
    public function contact(){
    	return view('contact');
    }
    
    public function product(){
        $product = Product::paginate(12);
        return view('product_user', ['product' => $product]);
    }
    public function getShopingcart(Request $req){
        $tp = DB::select('select * from tinh');
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
                $redirect = "https://www.nganluong.vn/button_payment.php?receiver=namduong3699@gmail.com&product_name=Cozastore&price=" . $total . "&return_url=http://localhost/namshop/checkPayment?payToken=" . $req->_token . "&comments=Thanh toán đơn hàng";
                return redirect($redirect);
            }

        }

        return view('shoping-cart', ['tp' => $tp]);
    }

    public function getCheckPayment(Request $req) {
        if(isset($req->payToken)) {
            $transaction = Transaction::where('security', $token)->first();
            $transaction->payment = 'paid';
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
        $product    =   Product::where('id', $id)->first();
        $relatePro  =   Product::where('catalog_id', $product->catalog_id)->get();
        $catalogPro =   Catalog::where('id', $product->catalog_id)->first();
        $comment    =   Comment::where('product_Id', $id)->get();
        $inWish     =   Cart::instance('wishlist')->search(function($cartItem, $rowId) use($id) {
            return $cartItem->id == $id;
        });
        $inWish     =   ($inWish->first() !== null) ? true : false;
        
        return view('product-detail', [
            'product'   => $product, 
            'relatePro' => $relatePro,
            'catalogPro'=> $catalogPro,
            'comment'   => $comment,
            'inWish'    => $inWish
        ]);
    }
    public function catalog($type) {
        $sp_theo_loai = Product::where('catalog_id', $type)->paginate(12);
        return view('product_user', ['product'=> $sp_theo_loai]);
    }

    public function getAddToCart(Request $req) {
        $id = $req->id;
        $color = $req->color;
        $qty = $req->qty;
        $size = $req->size;
        $product = Product::find($id);
        Cart::instance('shopping')->add(
            array(
                'id'    => $product->id, 
                'name'  => $product->name, 
                'qty'   => $qty, 
                'price' => $product->price * (100 - $product->discount)/100, 
                'options' => [
                    'image' => $product->image_link,
                    'size'  => $size,
                    'color' => $color
                ],
            )
        );
        $content = Cart::content();
        // dd($content);
        // DB::update('update `users` set inbag = ' +$cart_json+ ' where id = ?', [13]);
        return redirect()->back();
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
        $product = Product::where('name', 'like', '%'.$req->key.'%')->paginate(12);
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
            $products = Product::orderBy('price', 'desc')->paginate(12);
        }
        if($key == 'thap-len-cao') {
            $products = Product::orderBy('price')->paginate(12);
        }
        if($key == 'moi-nhat') {
            $products = Product::orderBy('id', 'desc')->paginate(12);
        }
        if($key == '0-50') {
            $products = Product::where('price', '<', 50000)->paginate(12);   
        }
        if($key == '50-100') {
            $products = Product::where([
                ['price', '>=', 50000],
                ['price', '<=', 100000]
            ])->paginate(12);   
        }
        if($key == '100-150') {
            $products = Product::where([
                ['price', '>=', 100000],
                ['price', '<=', 150000]
            ])->paginate(12);   
        }
        if($key == '150-200') {
            $products = Product::where([
                ['price', '>=', 150000],
                ['price', '<=', 200000]
            ])->paginate(12);   
        }
        if($key == '200') {
            $products = Product::where('price', '>', 200000)->paginate(12);   
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
        $user = Auth::user();
        $address = json_decode($user->address, true);
        return view('account', ['user' => $user, 'address' => $address]);
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
                ],
            )
        );
        return redirect()->back();
    }

    public function getDelWishlist(Request $req) {
        if(isset($req->rowId)) {
            $rowId = $req->rowId;
            Cart::instance('wishlist')->remove($rowId);
        }
        
    }

    public function postComment(Request $req) {
        if(isset($req->review)) {
            $comment = new Comment();
            $comment->product_Id = $req->pro_id;
            $comment->user_Id = Auth::user()->id;
            $comment->user_name = Auth::user()->name;
            $comment->content = $req->review;
            $comment->rate = $req->rating;
            $comment->time = date("Y-m-d H:i:s");
            $comment->save();
        }
        return redirect()->back();
    }
    public function getCheckout(Request $req) {

    }
}
