<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{


    public function index()
    {

        return view('dashboard.index');
    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return view('dashboard.clear-cache');
    }

    public function customers()
    {

        $data = "";
        $id = "";
        $avgData = "";
        $avgData2 = "";
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];


            $sql = "SELECT DISTINCT  `ID`, `buy_domain_no`, `subsys_art_no`, `article`, `status_article`, COUNT(`invoice_id`) as invoice_id, SUM(`sales`) as sales, SUM(`colli`) as colli , SUM(`oti`) as oti FROM `customers` WHERE `cust_no`= '" . $id . "' GROUP BY  `subsys_art_no` ORDER BY f_date_of_day ASC";
            $data = DB::select($sql);

            $avgSql = "SELECT catmanager_group, COUNT(*) AS Total , (COUNT(*) / (SELECT COUNT(*) FROM customers WHERE `cust_no`='" . $id . "')) * 100 AS 'Percentage' FROM customers WHERE `cust_no`='" . $id . "' GROUP BY catmanager_group ORDER BY catmanager_group";
            $avgData = DB::select($avgSql);


            $avgSql2 = "select 'Last Month' as name,count(`invoice_id`) as invoice_id,sum(sales) as sales,sum(oti) as oti from customers where `f_date_of_day` > now() - INTERVAL 1 MONTH AND cust_no='106007'
                UNION
                select 'Last Month 3' AS name,count(`invoice_id`) as invoice_id,sum(sales) as sales,sum(oti) as oti from customers where `f_date_of_day` > now() - INTERVAL 3 MONTH AND cust_no='106007'
                UNION
                select 'Last Month 6' AS name,count(`invoice_id`) as invoice_id,sum(sales) as sales,sum(oti) as oti from customers where `f_date_of_day` > now() - INTERVAL 6 MONTH AND cust_no='106007'
                UNION
                select 'Last Month 12' AS name,count(`invoice_id`) as invoice_id,sum(sales) as sales,sum(oti) as oti from customers where `f_date_of_day` > now() - INTERVAL 12 MONTH AND cust_no='106007'";
            $avgData2 = DB::select($avgSql2);
        }

        //return view('dashboard.index');
        return view('customer.index', compact('id', 'data', 'avgData', 'avgData2'));
    }

    public function customersOffer(Request $request)
    {

        if (!empty($request->cOfferID)) {

            $sql = "SELECT DISTINCT  `ID`, `buy_domain_no`, `subsys_art_no`, `article`, `status_article`, `nn_buy_pr_ho_curr`, COUNT(`invoice_id`) as invoice_id, SUM(`sales`) as sales, SUM(`colli`) as colli , SUM(`oti`) as oti FROM `customers` WHERE  `ID` IN (" . $request->cOfferID . ") GROUP BY  `subsys_art_no` ORDER BY f_date_of_day ASC";
            $data = DB::select($sql);
            return view('customer.offer', compact('data'));
        }else{
            return redirect('customer');
        }
    }

    public function forecastedCal(Request $request)
    {

        $selling = [];
        $buying = [];
        foreach ($request->colli as $key => $cvalue) {
            $selling[] = $request->selling[$key] * $cvalue;
            $buying[] = str_replace(",", "", $request->buying[$key]) * $cvalue;
        }

        $sellingSum = array_sum($selling);
        $buyingSum =  array_sum($buying);


        $forecastedOTI = ((($sellingSum  - $buyingSum)) *100) / $sellingSum;
        
        if($forecastedOTI < 0){
        
            return json_encode("Less Then Zero");
        }
        return round($forecastedOTI, 2);
    }
}
