<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\User;
use App\Models\Slide;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Comment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function catalog(Request $request)
    {
        $addT = new Catalog();
        if(!empty($request->name))
        {
            $addT->name=$request->name;
            $addT->save();
            return redirect('admin/catalog')->with('add','<span>Thêm thành công<span>');
        }else{
            return redirect('admin/catalog')->with('add','<span>Thêm thất bại<span>');
        }

    }
    public function catalogView()
    {
        $addT = new Catalog();
        $data= $addT::all();
        return view('admin.catalog',['data'=>$data]);
    }
    public function catalogDelete($id)
    {
        $addT = new Catalog();
        $addT::find($id)->delete();
        return redirect('admin/catalog');
    }

    public function catalogEdit($id)
    {
        $addT = new Catalog();
        $data=$addT::find($id);
        return view('admin.catalogedit',['data'=>$data]);
    }
    public function catalogUpdate(Request $request)
    {
        $addT = new Catalog();
        $data = $addT::find($request->id);
        $data->name= $request->name;
        $data->save();
        return redirect('admin/catalog');
    }
    //**********catalog***********//
    public function productView()
    {
        $addT = new Product();
        $data= $addT::all();
        $add= new Catalog();
        $dataC= $add::all();
        return view('admin.product',['data'=>$data,'dataCatalog'=>$dataC]);
    }

    public function product(Request $request)
    {
        if(empty($request->name)||empty($request->size)||empty($request->price)||empty($request->count)||empty($request->color)){
            return redirect('admin/product')->with('add','<span>Thêm thất bại<span>');
        }
        $addT = new Product();
        $addT->name=$request->name;
        $addT->catalog_id=$request->catalog_id;
        $addT->price=$request->price;
        $addT->discount = (empty($request->discount)) ? 0 : $request->discount;
        $addT->count=$request->count;

        $size = explode(',', $request->size);
        $color = explode(',', $request->color);

        $addT->size= json_encode($size);
        $addT->color=json_encode($color);

        $addT->description=$request->description;
        $link=array();

        if($request->hasFile('image')){
            $folder=str_random(10);
            $check=false;
            foreach ($request->file('image') as $value) {
                if(substr($value->getClientMimeType(), 0,5)=='image'){
                    $name=str_random(20).$value->getClientOriginalName();
                    $value->move('public/images/'.$folder, $name);
                    $link[]=$name;
                    $check=true;
                }
            }
            if($check){
                $addT->folder=$folder;
                $json = json_encode($link);
                $addT->image_link =$link[0];
                $addT->image_list =$json;
            }
        }
        $addT->save();

        $addC= new Catalog();
        $dataC= $addC::find($request->catalog_id);
        $dataC->count=$dataC->count+1;
        $dataC->save();
        return redirect('admin/product')->with('add','<span>Thêm thành công<span>');
    }
    public function productEdit($id)
    {
        $addT = new Product();
        $data= $addT::find($id);


        $size_j= json_decode($data->size,true);
        $color_j= json_decode($data->color,true);

        $size= implode(',', $size_j);
        $color= implode(',', $color_j);

        $data->size=$size;
        $data->color=$color;

        $add= new Catalog();
        $dataC= $add::all();
        return view('admin.productEdit',['data'=>$data,'dataCatalog'=>$dataC]);
    }
    public function productUpdate(Request $request)
    {
        $addT = new Product();
        $data = $addT::find($request->id);
        $data->name=$request->name;
        $data->catalog_id=$request->catalog_id;
        // $data->size=$request->size;
        $data->price=$request->price;
        $data->discount=$request->discount;
        $data->count=$request->count;
        // $data->color=$request->color;

        $size = explode(',', $request->size);
        $color = explode(',', $request->color);

        $data->size= json_encode($size);
        $data->color=json_encode($color);

        $data->description=$request->description;

        if($request->hasFile('image')){
            $folder=$data->folder;
            if(empty($folder)){
                $folder=str_random(10);
            }
            $check=false;
            foreach ($request->file('image') as $value) {
                if(substr($value->getClientMimeType(), 0,5)=='image'){
                    $name=str_random(20).$value->getClientOriginalName();
                    $value->move('public/images/'.$folder, $name);
                    $link[]=$name;
                    $check=true;
                }
            }
            if($check){
                $data->folder=$folder;
                $json = json_encode($link);
                $data->image_link =$link[0];
                $data->image_list =$json;
            }
        }
        $data->save();
        if($request->catalog_id!=$request->catalog_id_old){
            $addC= new Catalog();
            $dataC= $addC::find($request->catalog_id);
            $dataC->count=$dataC->count+1;
            $dataC->save();

            $dataC= $addC::find($request->catalog_id_old);
            $dataC->count=$dataC->count-1;
            $dataC->save();
        }
        return redirect('admin/product');
    }

    public function cancelTransaction(Request $request)
    {
        $transaction = Transaction::findOrFail($request->id);
        $transaction->is_cancelled = true;
        $transaction->save();

        return redirect('admin/transaction');
    }

    public function transactionDetailt(Request $request)
    {
        $transaction = Transaction::findOrFail($request->id);

        return view('admin.transaction-detail', ['transaction' => $transaction]);
    }

    public function productDelete($id)
    {
        // $addT = new Product();
        // $addC= new Catalog();


        // $data = $addT::find($id);
        // $path = 'images/'.$data->folder;

        // $dataC = $addC::find($data->catalog_id);
        // $dataC->count=$dataC->count-1;
        // $dataC->save();

        $product = Product::findOrFail($id);
        $catalog = $product->catalog;
        $catalog->count = $catalog->count - 1;
        $catalog->save();

        $product->delete();


        // if(!empty($data->folder)){
        //     $fl = scandir($path);
        //     if ($fl) {
        //         foreach ($fl as $key => $value) {
        //             if ($key>1) {
        //                 unlink($path.'/'.$value);
        //             }
        //         }
        //         rmdir($path);
        //     }
        // }
        // $data->delete();
        return redirect('admin/product');
    }
    // Management users in local

    public function userManagement()
    {
        $addT = new User();
        $data= $addT::all();
        return view('admin.userManagement',['data'=>$data]);
    }

    public function deleteAll(Request $request)
    {
        if($request->has('deleteall')){
            if($request->table=='catalog'){
                $add= new Catalog();
                foreach ($request->deleteall as $value) {
                    $add::find($value)->delete();
                }
                return redirect('admin/catalog');
            }
            if($request->table=='product'){
                $addT = new Product();
                $addC= new Catalog();
                foreach ($request->deleteall as $value) {
                   $data=$addT::find($value);
                   $path='public/images/'.$data->folder;
                   $dataC= $addC::find($data->catalog_id);
                   $dataC->count=$dataC->count-1;
                   $dataC->save();

                   if(!empty($data->folder)){
                    $fl=scandir($path);
                    if($fl){
                        foreach ($fl as $key=> $value) {
                            if($key>1){
                                unlink($path.'/'.$value);
                            }
                        }
                        rmdir($path);
                    }
                }
                $data->delete();
                }
                return redirect('admin/product');
            }
            if($request->table=='slide'){
                foreach ($request->deleteall as $value) {
                   $data= Slide::find($value);
                   $path='public/images/'.$data->folder;
                   if(!empty($data->folder)){
                    $fl=scandir($path);
                    if($fl){
                        foreach ($fl as $key=> $value) {
                            if($key>1){
                                unlink($path.'/'.$value);
                            }
                        }
                        rmdir($path);
                    }
                }
                $data->delete();
                }
                return redirect('admin/slide');
            }


    }
    }

    public function slideView()
    {
        return view('admin.slider',['data'=>Slide::all()]);
    }

    public function slide(Request $request){
        $data= new Slide();
        $data->title= $request->title;
        $data->content= $request->content;
        $data->button= $request->button;
        $data->link = $request->link;

        if($request->hasFile('image')){
            $folder=str_random(10);
            $check=false;
            if(substr($request->file('image')->getClientMimeType(), 0,5)=='image'){
                    $name=str_random(20).$request->file('image')->getClientOriginalName();
                    $request->file('image')->move('public/images/'.$folder, $name); // ham move
                    $check=true;
            }
            if($check){
                $data->folder=$folder;
                $data->image = $name;
                $data->save();
            }

        }
        return redirect('admin/slide')->with('add','<span>Thêm thành công<span>');
    }

    public function slideDelete($id)
    {
        $data= Slide::find($id);
        $path='public/images/'.$data->folder;
        if(!empty($data->folder)){
            $fl=scandir($path);
            if($fl)
            {
                foreach ($fl as $key=> $value) {
                    if($key>1){
                        unlink($path.'/'.$value);
                    }
                }
                rmdir($path);
            }
        }
        $data->delete();
        return redirect('admin/slide');
    }

    public function slideEdit($id){
        return view('admin.slideedit',['data'=>Slide::find($id)]);
    }
    public function slideUpdate(Request $request)
    {
        $data=Slide::find($request->id);
        $data->title= $request->title;
        $data->content=$request->content;
        $data->button= $request->button;
        $data->link= $request->link;
        if($request->hasFile('image')){
            $folder=$data->folder;
            if(empty($folder)){
                $folder=str_random(10);
            }
            $check=false;
            if(substr($request->file('image')->getClientMimeType(), 0,5)=='image'){
                    $name=str_random(20).$request->file('image')->getClientOriginalName();
                    $request->file('image')->move('images/'.$folder, $name);
                    $check=true;
                     $path='images/'.$data->folder.'/'.$data->image;
                    //  unlink($path);
            }
            if($check){
                $data->image =$name;
            }
        }
        $data->save();
        return redirect('admin/slide');
    }

    public function getTransaction() {
        $transaction = Transaction::all();
        return view('admin.transaction', ['transaction' => $transaction]);
    }

    public function getOrder() {
        $orders = Order::all();
        return view('admin.order', ['orders' => $orders]);
    }

    public function getComment() {
        $comment = Comment::all();
        return view('admin.comment', ['comment' => $comment]);
    }
}
