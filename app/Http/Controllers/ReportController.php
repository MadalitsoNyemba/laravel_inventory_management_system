<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products as products;
use App\categories as categories;
use App\product_calculations as product_calculations;
use DB;
use App\Charts\expenditureVSincome;

class ReportController extends Controller
{
    public function __construct(products $products,categories $categories,product_calculations $product_calculations)
    {
        $this->products = $products; 
        $this->categories = $categories; 
        $this->product_calculations = $product_calculations; 
    }
    public function index()
    {
      

        $product_calculations_inc= product_calculations::select(\DB::raw("*,SUM(CASE when status = 'sale' THEN stock END) AS income"))->where('status','sale')->groupBy(\DB::raw("Month(created_at)"))->pluck('income');
        $product_calculations_exp= product_calculations::select(\DB::raw("*,SUM(CASE when status = 'buy' THEN stock END) AS expenditure"))->where('status','buy')->groupBy(\DB::raw("Month(created_at)"))->pluck('expenditure');
        $months=product_calculations::select(\DB::raw("*,Month(created_at) as month"))->groupBy(\DB::raw("Month(created_at)"))->pluck('month');
        $chart = new expenditureVSincome;

for($i=0;$i<count($months);$i++)
{
    $date_arr[]= date('F', mktime(0, 0, 0, $months[$i], 10));


}

$chart->labels($date_arr);

        $chart->dataset('Expenditure', 'line', $product_calculations_exp)->color("rgb(255, 99, 132)")
        ->backgroundcolor("rgb(255, 99, 132)")
        ->fill(false)
        ->linetension(0.1)
        ->dashed([5]);;
        $chart->dataset('Income', 'line', $product_calculations_inc)
        ->color("rgb(0,191,255)")
            ->backgroundcolor("rgb(0,191,255)")
            ->fill(false)
            ->linetension(0.1)
            ->dashed([5]);;

          
        $data = [];

        $data['products'] = DB::table('tbl_product_calculations')->join('tbl_products','tbl_products.id','=',"product_id")->select(DB::raw("SUM(CASE when status = 'sale' THEN stock END) AS amount_sold,SUM(CASE when status = 'buy' THEN stock END) AS amount_bought,name,selling_price,tbl_products.id as id,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='buy' THEN stock END) AS old_stock_add,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) = 0 and status ='sale' THEN stock END) AS sold_today,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='sale' THEN stock END) AS old_stock_subtract, tbl_product_calculations.status as status,SUM(CASE when status = 'sale' THEN stock END) AS actual"))->groupBy('tbl_product_calculations.created_at')->orderby('product_id','desc')->get();
        return view('report.index',$data, compact('chart'));   
    }

}
