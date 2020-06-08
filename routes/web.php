<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Catalog;
use App\User;
use App\Product;
use App\Transaction;
use App\Comment;
use App\OrderPro;
use App\NeedContact;


Route::get('/countprice', function(){
	if (Cart::instance('shopping')->content()){ return  Cart::instance('shopping')->subtotal(0);}
	else return 0;
});

Route::get('delete-cart/{id}',function($id){

	$item=Product::find($id);
    $cart= Cart::instance('shopping')->search(function($cartItem, $rowId) use($item) {return $cartItem->id == $item->id;})->first();
    if($cart!==null){

        Cart::instance('shopping')->remove($cart->rowId);
        }
    return Cart::instance('shopping')->count();

});

Route::get('confirmuser/{code}', 'RegisterController@confirmUser');

Route::get('/', 'UserController@index');
Route::get('/index', 'UserController@index');
Route::get('/home', 'UserController@index');
// Route::get('/about', 'UserController@about');
Route::get('/contact', 'UserController@contact');
Route::post('/contact/send', 'UserController@postContact');
Route::get('/product', 'UserController@product');
Route::get('/shoping-cart', 'UserController@getShopingcart');
Route::get('/blog', 'UserController@blog');
Route::get('/blog-detail', 'UserController@blogdetail');
Route::get('/product-detail/{id}', 'UserController@productdetail');
Route::get('/product/{type}', 'UserController@catalog');
Route::get('/productshow/{id}',function($id){
	$data =  DB::select("select * from product where id = ?",[$id]);
	$data[0]->image_list = json_decode($data[0]->image_list,true);
	$data[0]->size = json_decode($data[0]->size,true);
	$data[0]->color = json_decode($data[0]->color,true);
	echo json_encode($data);
});
Route::get('account', 'UserController@getAccount');
Route::post('comment', 'UserController@postComment');
Route::get('editAccount', 'UserController@getEditAccount');
Route::get('needContact', 'UserController@getNeedContact');
Route::get('confirm', function(){
	return view('confirm_email');
});
Route::post('/password_reset','RegisterController@passwordForget');


Route::get('confirmuser/{code}', 'RegisterController@confirmUser');


Route::get('/resetpassword',function(){
		return view('resetpassword');
	});

Route::post('/resetpassword','RegisterController@postReset');




/*
* Login
*/
Route::get('/login', 'LoginController@getLogin')->name('loginG');
Route::post('/login', 'LoginController@postLogin')->name('login');

Route::get('/auth/facebook', "SocialAuthController@redirectFB");
Route::get('/auth/facebook/callback', "SocialAuthController@callbackFB");

Route::get('/auth/google', "SocialAuthController@redirectGG");
Route::get('/auth/google/callback', "SocialAuthController@callbackGG");

/*
* Logout
*/
Route::post('/logout', function(){
	DB::table('shoppingcart')->where('identifier', '=', Auth::user()->id)->delete();
	DB::table('shoppingcart')->where('identifier', '=', Auth::user()->email)->delete();
	Cart::instance('shopping')->store(Auth::user()->id);
	Cart::instance('wishlist')->store(Auth::user()->email);
	Cart::instance('shopping')->destroy();
	Cart::instance('wishlist')->destroy();
	Auth::logout();
	return redirect('/');
})->name('logout');

Route::get('/logout',function(){
	DB::table('shoppingcart')->where('identifier', '=', Auth::user()->id)->delete();
	DB::table('shoppingcart')->where('identifier', '=', Auth::user()->email)->delete();
	Cart::instance('shopping')->store(Auth::user()->id);
	Cart::instance('wishlist')->store(Auth::user()->email);
	Auth::logout();
	Cart::instance('shopping')->destroy();
	Cart::instance('wishlist')->destroy();
	return redirect()->back();
});

/*
* Register
*/
Route::get('register', 'RegisterController@getRegister');
Route::post('register', 'RegisterController@postRegister');


/*
* Cart
*/
Route::get('add-to-cart', [
	'as' => 'add-to-cart',
	'uses' => 'UserController@getAddToCart'
]);
Route::get('add-to-cart/add', 'UserController@getIncreaseCart');
Route::get('add-to-wishlist/{id}', 'UserController@getAddToWishlist');
Route::get('delete-wishlist', 'UserController@getDelWishlist');

/*
* Search
*/
Route::get('search', 'UserController@getSearch');

/*
* Modal
*/
Route::get('modal', 'UserController@getModal');
Route::post('modal', 'UserController@postModal');

/*
* Filter Product
*/
Route::get('filter/{key}', 'UserController@getFilter');

/*
* Don vi hanh chinh
*/
Route::get('getInfo', 'UserController@getInfo');

/*
* Checkout
*/
Route::get('checkout', 'UserController@getCheckout');
Route::post('checkout', 'UserController@postCheckout');
Route::get('checkPayment', 'UserController@getCheckPayment');

/*
* ADD-WISH
*/
Route::get('add-wish', function(){
	return json_encode(Cart::instance('wishlist')->content());
});
/*
* ADMIN
*/


Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function(){

	Route::get('/', function () {
		$catalogQty = Catalog::count();
		$userQty = User::count();
		$productQty = Product::count();
		$transactionQty = Transaction::count();
		$newComment = Comment::orderBy('id', 'desc')->take(10)->get();
		$orderPro = OrderPro::all();
		$needContact = NeedContact::orderBy('id', 'desc')->take(10)->get();
		return view('admin.admin', [
			'catalogQty' 	 => $catalogQty,
			'userQty' 		 => $userQty,
			'productQty' 	 => $productQty,
			'transactionQty' => $transactionQty,
			'newComment' 	 => $newComment,
			'orderPro'		 => $orderPro,
			'needContact'	 => $needContact
		]);
	});
	Route::get('/index', function () {
		return view('admin.admin');
	});
	Route::get('/general', function () {

		return redirect('/');
	});
	//**********catalog***********//
	Route::get('/catalog','HomeController@catalogView');

	Route::get('/catalog/edit/{id}','HomeController@catalogEdit');

	Route::post('/catalog/update','HomeController@catalogUpdate')->name('updatecatalog');

	Route::get('/catalog/delete/{id}','HomeController@catalogDelete');

	Route::post('/addCatalog','HomeController@catalog')->name('addcatalog');
	//**********product***********//

	Route::get('/product','HomeController@productView');

	Route::post('/addProduct','HomeController@product')->name('addproduct');

	Route::get('/product/edit/{id}','HomeController@productEdit');

	Route::post('/product/update','HomeController@productUpdate')->name('updateproduct');

	Route::get('/product/delete/{id}','HomeController@productDelete');

	//**********product***********//
	Route::post('/deleteall','HomeController@deleteAll')->name('deleteall');
	//**********delete all**********//
	Route::get('/transaction', 'HomeController@getTransaction')->name('transaction');
	Route::get('/order', 'HomeController@getOrder')->name('order');
	//**********users***********//
	Route::get('/userManagement', 'HomeController@userManagement');
	//***********slide**********//
	Route::get('/slide', 'HomeController@slideView');

	Route::post('/addSlide','HomeController@slide')->name('addslide');

	Route::get('/slide/edit/{id}','HomeController@slideEdit');

	Route::post('/slide/update','HomeController@slideUpdate')->name('updateslide');

	Route::get('/slide/delete/{id}','HomeController@slideDelete');

	Route::get('/comment','HomeController@getComment');
	Route::get('/comment/delete/{id}',function($id){
		Comment::find($id)->delete();
		return redirect()->back();
	});

});