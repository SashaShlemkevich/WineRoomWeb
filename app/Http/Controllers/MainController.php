<?php

namespace App\Http\Controllers;

use App\Models\WineModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function main(){
        $mains = new WineModel();
        return view('main', ['mains' => $mains->all()]);
       // return view('main');
    }

    public function contacts( Request $request){
        $review = new contact();
        $review ->name = $request->input('name');
        $review ->phone = $request->input('phone');
        $review ->email = $request->input('email');
        $review ->massage = $request->input('massage');

        $review->save();
return redirect()->route('/main');
    }

    public function about(){
        return view('about');
    }

    public function addwine(){
        return view('addwine');
    }

    public function ToOrder(){
        return view('ToOrder');
    }

    public function Orders(){
        $orders = DB::select("SELECT wine_models.*,orders.id AS oid, orders.* FROM orders INNER JOIN wine_models ON wine_models.id = orders.basketid");
        return view('Orders',['orders'=>$orders]);
    }

    public function deleteOrders($id){
        DB::delete("DELETE FROM orders WHERE id = ?",[$id]);
        return redirect()->route('Orders');
    }

    public function UpdateInfo($id){
        $info = DB::select("SELECT * FROM wine_models WHERE id =?",[$id])[0];
        return view('UpdateInfo',['el'=>$info]);
    }

    public function basket(Request $request){
        $wines = DB::select("SELECT basket.ID AS basketID, basket.counts AS bcount, wine_models.* FROM basket INNER JOIN wine_models ON wine_models.ID = basket.Idwine WHERE basket.ID = ?",[$request->cookie('id')]);
        return view('basket', ['wines'=>isset($wines)?$wines:NULL]);
    }

        public function search(Request $request){
        $search = $request->search;
        $wine = DB::select("SELECT * FROM wine_models WHERE name LIKE '%$search%'");
        return view('main', ['mains'=>$wine]);
        }

    public function moredetalis_id($id){
        $info = DB::select("SELECT * FROM wine_models WHERE id = ?",[$id]);
        return view('moredetalis',['mains'=>$info]);
    }

    public function addwine_check(Request $request ){
      $valid = $request->validate([
          'name'=>'required|min:5|max:30',
          'price'=>'required|min:2|max:25',
          'type'=>'required|min:5|max:25',
          'storage'=>'required|min:5|max:200',
          'vol'=>'required|min:5|max:25',
          'eat'=>'required|min:5|max:100',
          'temperature'=>'required|min:5|max:50',
          'short_description'=>'required|min:5|max:100',
          'description'=>'required|min:15|max:500',
          'count'=>'required|min:1|max:100|',
          'image'=>'required',

      ]);

      $review = new WineModel();
      $review ->name = $request->input('name');
      $review ->price = $request->input('price');
      $review ->type = $request->input('type');
      $review ->storage = $request->input('storage');
      $review ->vol = $request->input('vol');
      $review ->eat = $request->input('eat');
      $review ->temperature = $request->input('temperature');
      $review ->short_description = $request->input('short_description');
      $review ->description = $request->input('description');
      $review->count=$request->input('count');

        if ($request->hasFile('image')) {
            $photo_file = $request->file("image");
            $photo = $photo_file->openFile()->fread($photo_file->getSize());
            $review->image = $photo;
        }

      $review->save();

      return redirect()->route('addwine');
    }

    public function UpdateWine(Request $request, $id){

        $valid = $request->validate([
            'name'=>'required|min:5|max:30',
            'price'=>'required|min:2|max:25',
            'type'=>'required|min:5|max:25',
            'storage'=>'required|min:5|max:200',
            'vol'=>'required|min:1|max:25',
            'eat'=>'required|min:5|max:50',
            'temperature'=>'required|min:5|max:50',
            'short_description'=>'required|min:5|max:100',
            'description'=>'required|min:15|max:500',
            'count'=>'required|min:1|max:100|',
        ]);

        DB::update("UPDATE wine_models SET name = ?, price = ?, type = ?, storage = ?, vol = ?, eat = ? , temperature = ?, short_description = ?, description = ?, count = ? WHERE id = ?
        ",[$request->input('name'),$request->input('price'),$request->input('type')
            ,$request->input('storage'),$request->input('vol'),$request->input('eat'),$request->input('temperature'),$request->input('short_description'),
            $request->input('description'),$request->input('count'),$id]);

        if ($request->file('image')) DB::update("UPDATE wine_models SET image = ? WHERE id = ?", [$request->file('image')->openFile()->fread($request->file('image')->getSize()),$id]);



        return redirect()->route('main');
    }

    public function deleteWine($id){
        DB::delete("DELETE FROM wine_models WHERE id = ?",[$id]);

        return redirect()->route('main');
    }
}