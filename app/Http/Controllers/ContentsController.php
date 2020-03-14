<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products as products;
use App\categories as categories;
use App\product_calculations as product_calculations;
use DB;

class ContentsController extends Controller
{
    public function __construct(products $products,categories $categories,product_calculations $product_calculations)
    {
        $this->products = $products; 
        $this->categories = $categories; 
        $this->product_calculations = $product_calculations; 
    }
    public function index()
    {
        $data = [];
        $data['total_products'] = products::count();
        $data['total_categories'] = categories::count();
        $sold_count = product_calculations::whereYear('created_at','=','20'.date('y'))->whereMonth('created_at','=',date('m'))->whereDay('created_at','=',date('d'))->where('status','sale')->count();
        $sold = product_calculations::whereYear('created_at','=','20'.date('y'))->whereMonth('created_at','=',date('m'))->whereDay('created_at','=',date('d'))->where('status','sale')->get();
        $sales=0;
        $revenue=0;
        for($i=0;$i<$sold_count;$i++)
        {
            $sales=$sales+$sold[$i]->stock;
            $revenue=$revenue+$sold[$i]->sold_price;
        }
        $data['revenue_made_today'] = $sales*$revenue;

        $data['products'] = DB::table('tbl_product_calculations')->join('tbl_products','tbl_products.id','=',"product_id")->select(DB::raw("SUM(CASE when status = 'sale' THEN stock END) AS amount_sold,SUM(CASE when status = 'buy' THEN stock END) AS amount_bought,name,selling_price,tbl_products.id as id,threshold,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='buy' THEN stock END) AS old_stock_add,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) = 0 and status ='sale' THEN stock END) AS sold_today,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='sale' THEN stock END) AS old_stock_subtract, tbl_product_calculations.status as status,SUM(CASE when status = 'sale' THEN stock END) AS actual"))->groupBy('tbl_products.id')->where('tbl_product_calculations.deleted_at',NULL)->orderby('sold_today','desc')->get()->take(10);
        return view('welcome',$data);   
    }
}
