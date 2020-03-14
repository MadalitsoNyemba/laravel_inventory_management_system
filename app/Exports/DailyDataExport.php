<?php
namespace App\Exports;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\beverage_calculations;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyDataExport implements FromView
{


    public function view(): View
    {
        $data = [];
        $data['products'] = DB::table('tbl_product_calculations')->join('tbl_products','tbl_products.id','=',"product_id")->select(DB::raw("SUM(CASE when status = 'sale' THEN stock END) AS amount_sold,SUM(CASE when status = 'buy' THEN stock END) AS amount_bought,name,selling_price,tbl_products.id as id,threshold,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='buy' THEN stock END) AS old_stock_add,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) = 0 and status ='sale' THEN stock END) AS sold_today,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='sale' THEN stock END) AS old_stock_subtract, tbl_product_calculations.status as status,SUM(CASE when status = 'sale' THEN stock END) AS actual"))->groupBy('tbl_products.id')->orderby('product_id','desc')->get();
        return view('pos.export',$data);
    }
}


