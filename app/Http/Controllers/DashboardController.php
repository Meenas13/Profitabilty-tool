<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\tbl_Articlewise_Sale_Colli;
use App\category_share;
use App\nnnbp_source;
use Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$user = Auth::user();
    }

    public function index()
    {
        $id = "";
        return view('customer.index', compact('id'));
    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return view('dashboard.clear-cache');
    }

    public function customers()
    {

        $id = '';
        $unique_number = array();
        $unique_implode = implode(',', $unique_number);

        $quater_implode = array();
        $sel_quater_implode = implode(',', $quater_implode);

        $cust_icoList =  tbl_Articlewise_Sale_Colli::orderBy('month_id')->select('ico', 'month_id')->distinct()->get();
        $catmanager_groupList = category_share::select('catmanager_group')->distinct()->get();

        $cust_uniqueList = tbl_Articlewise_Sale_Colli::where('ico', '=', $id)->select('cust_no_unique')->distinct()->get();

        return view('customer.index', compact('id', 'unique_number', 'unique_implode', 'quater_implode', 'sel_quater_implode', 'cust_uniqueList', 'cust_icoList', 'catmanager_groupList'));
    }


    public function full_domainList(Request $request)
    {

        //dd($request);
        $unique_number = array();
        $quater = array();
        $id = $request->customer_ico;

        $unique_number = $request->customer_unique;

        $unique_implode = implode(',', $unique_number);
        $unique_number_implode = "'" . $unique_implode . "'";

        $quater = array();
        $quater = $request->quater;
        if ($quater) {
            $quater_implode = implode(',', $quater);
            $sel_quater_implode = "'" . $quater_implode . "'";
        } else {
            $sel_quater_implode = "NULL";
        }

        $article_category = $request->category;
        if (!empty($article_category)) {
            $article_category = "'" . $request->category . "'";
        } else {
            $article_category = "NULL";
        }

        $channel = $request->channel;
        if ($channel == "both") {
            $channel = "NULL";
        } elseif ($channel == "C&C") {
            $channel = "'" . $request->channel . "'";
        } elseif ($channel == "Delivery") {
            $channel = "'" . $request->channel . "'";
        } else {
            $channel = "NULL";
        }

        $quater = $request->quater;

        if ($quater != "") {
            $quaters_implode = implode(',', $quater);
            $quater_implode = "'" . $quaters_implode . "'";
        } else {
            $quater_implode = "NULL";
        }

        $month_id = $request->month_id;

        if (!empty($month_id)) {
            $monthId = date("Ym", strtotime($month_id));
        } else {
            $monthId = "NULL";
        }

        $from_year = $request->from_year;
        $to_year = $request->to_year;

        if ($from_year != "" && $to_year != "") {
            $year_range = $from_year . $to_year;
        } else {
            $year_range = "NULL";
        }

        if (!empty($id)) {
            $cust_uniqueList = tbl_Articlewise_Sale_Colli::where('ico', '=', $id)->select('cust_no_unique')->distinct()->get();
        }

        $final_domainList = DB::select(" SET NOCOUNT ON;  exec [dbo].[usp_get_article_summary] " . $id . " , " . $unique_number_implode . " , " . $article_category . ",  " . $channel . ", " . $year_range . " ," . $quater_implode . ", " . $monthId . ", NULL  ");

        $catSaleShare = DB::select("SET NOCOUNT ON;  exec usp_get_category_share_summary @p_ico = " . $id . " , @p_cust_no_unique =" . $unique_number_implode . " , @p_catmanager_group = " . $article_category . ", @p_delivery_flag_name = " . $channel . ", @p_fy_year_id=" . $year_range . " , @p_fy_quarter=" . $quater_implode . " , @p_month_id=" . $monthId . " ");
        $salesOti = DB::select("SET NOCOUNT ON;  exec usp_get_sales_oti_summary @p_ico = " . $id . " , @p_cust_no_unique =" . $unique_number_implode . " , @p_catmanager_group = " . $article_category . " ");

        $cust_icoList =  tbl_Articlewise_Sale_Colli::orderBy('month_id')->select('ico', 'month_id')->distinct()->get();

        $catmanager_groupList = category_share::select('catmanager_group')->distinct()->get();

        // return json_encode($cust_uniqueList) ;

        return view('customer.index', compact('id', 'unique_number', 'unique_implode', 'sel_quater_implode', 'final_domainList', 'cust_icoList', 'catSaleShare', 'salesOti', 'cust_uniqueList', 'catmanager_groupList'));
    }

    public function get_uniqueCustomer(Request $request)
    {
        $id = $request->selected_ico;
        $cust_icoList =  tbl_Articlewise_Sale_Colli::orderBy('month_id')->select('ico', 'month_id')->distinct()->get();
        $catmanager_goupeList = category_share::select('catmanager_group')->distinct()->get();
        if (!empty($id)) {
            $cust_uniqueList = tbl_Articlewise_Sale_Colli::where('ico', '=', $id)->select('cust_no_unique')->distinct()->get();
            return json_encode($cust_uniqueList);
        }
        return view('customer.index', compact('id', 'cust_icoList', 'catmanager_goupeList', 'cust_uniqueList'));
    }

    public function customersOffer(Request $request)
    {
        $cust_id = "";

        $allList_data = "";
        $avgData = "";
        $avgData2 = "";

        //dd($request->cOfferID);

        $cust_icoList =  tbl_Articlewise_Sale_Colli::orderBy('month_id')->select('ico', 'month_id')->distinct()->get();

        if (!empty($request->cOfferID)) {

            $buyer_arr = preg_split("/\,/", $request->cOfferID);
            $buyer_arr_implode = implode(",", $buyer_arr);
            $buyer_arr_IDs = "'" . $buyer_arr_implode . "'";
            // dd($buyer_arr_IDs);

            $cust_unique = preg_split("/\,/", $request->cust_unique);
            $unique_implode = implode(',', $cust_unique);
            $cust_uni_implode = "'" . $unique_implode . "'";

            $selected_quarter = preg_split("/\,/", $request->sel_quarter);
            $selected_quarter_implode = implode(',', $selected_quarter);

            // dd($cust_uni_implode);

            $data = DB::select("SET NOCOUNT ON; EXEC usp_get_article_summary NULL, NULL , NULL, NULL, NULL , NULL, NULL, " . $buyer_arr_IDs . " ");

            if (!empty($request->cust_id)) {

                $cust_id = $request->cust_id;

                // $allList_data = DB::select("SET NOCOUNT ON;  exec usp_get_article_summary @p_ico = " . $cust_id . ", @p_cust_no_unique =" . $cust_uni_implode . ", @p_catmanager_group = NULL, @p_delivery_flag_name = NULL, @p_fy_year_id=NULL, @p_fy_quarter=NULL , @p_month_id=NULL ,  @buy_subsys_no = " . $buyer_arr_IDs . " ");
                $allList_data = DB::select(" SET NOCOUNT ON;  exec [dbo].[usp_get_article_summary] " . $cust_id . " , " . $cust_uni_implode . " , NULL, NULL, NULL , NULL, NULL, NULL ");

                //52397041 , 2300112584,2300702032 
            }

            return view('customer.offer', compact('cust_id', 'cust_unique', 'unique_implode', 'cust_uni_implode', 'cust_icoList', 'data', 'allList_data', 'selected_quarter', 'selected_quarter_implode'));
        } else {
            return redirect('customer');
        }
    }

    public function bb_preRequestedData(Request $request)
    {
        $cust_icoList =  tbl_Articlewise_Sale_Colli::orderBy('month_id')->select('ico', 'month_id')->distinct()->get();
        return json_encode($cust_icoList);
    }

    public function forecastedCal_old(Request $request)
    {
        $selling = [];
        $buying = [];
        foreach ($request->colli as $key => $cvalue) {
            $selling[] = $request->selling[$key] * $cvalue;
            $buying[] = str_replace(",", "", $request->buying[$key]) * $cvalue;
        }

        $sellingSum = array_sum($selling);
        $buyingSum =  array_sum($buying);

        $forecastedOTI = ((($sellingSum  - $buyingSum)) * 100) / $sellingSum;

        if ($forecastedOTI < 0) {

            return json_encode("Less Then Zero");
        }
        return round($forecastedOTI, 2);
    }


    public function forecastedCal(Request $request)
    {

        $sum_colli_sp = [];
        $sum_colli_nnnbp = [];
        $backBonus = $request->backBonus_amount;
        $backBonus_amount  = str_replace('"', "", $backBonus);
        //dd($backBonus_amount);

        foreach ($request->colli as $key => $cvalue) {

            $sum_colli_sp[] =  $request->colli[$key] * $request->selling[$key];
            $get_nnnbp_val = DB::select(" SET NOCOUNT ON; exec usp_get_nnnbp_value '" . $request->buy_domain_no[$key] . "' , '" . $request->subsys_art_no[$key] . "' ");
            $sum_colli_nnnbp[] = $request->colli[$key] * str_replace('"', "", $get_nnnbp_val[0]->nnnbp_value);
        }

        $colli_sp_sum = array_sum($sum_colli_sp);
        $colli_nnnbp_sum = array_sum($sum_colli_nnnbp);

        $forecastedOTI = ($colli_sp_sum  - $colli_nnnbp_sum - $backBonus_amount) / $colli_sp_sum;

        if ($forecastedOTI < 0) {

            return json_encode("Less Then Zero");
        }
        return round($forecastedOTI, 2);
    }

    public function insertCustomer(Request $request)
    {
        if ($request->ajax()) {

            $data = array(
                $total_no = $request->row,
                $cust_id = $request->cust_id,
                $buy_domain = $request->buy_domain,
                $subsys_art_no = $request->subsys_art_no,
                $subsys_art_name = $request->subsys_art_name,
                $status = $request->status,
                $sales = $request->sales,
                $colli = $request->colli,
                $invoices = $request->invoices

            );

            for ($i = 0; $i < $total_no; $i++) {
                $Record = new Customer();

                $Record->cust_no = $cust_id;
                $Record->buy_domain_no = $request->get('buy_domain')[$i];
                $Record->subsys_art_no = $request->get('subsys_art_no')[$i];
                $Record->article = $request->get('subsys_art_name')[$i];
                $Record->status_article = $request->get('status')[$i];
                // $Record-> = $request->get('qty_of_month')[$i];
                $Record->sales = $request->get('sales')[$i];
                $Record->colli = $request->get('colli')[$i];
                $Record->invoice_id = $request->get('invoices')[$i];
                // $Record-> = $request->get('sales_per_month')[$i];
                // $Record-> = $request->get('colli_per_month')[$i];
                // $Record-> = $request->get('invoices_per_month')[$i];
                $Record->f_date_of_day = date("Y-m-d");
                $Record->f_month_id = date("Ym");
                $Record->month_id_il = date("Ym");
                $Record->year_id =  date("Y");
                $Record->DATE_PK = date("d-m-Y");
                $Record->MONTH_MTD_PK = date("Ym") . "0";

                $Record->save();
            }

            return json_encode(array('data' => $data));
        }
    }

    public function calculate_backBonus(Request $request)
    {
        if ($request->ajax()) {


            $customer_ico = $request->customer_ico;
            $customer_unique =  $request->get('customer_unique');
            $quater = $request->selected_quarter;

            // $data = array(
            //     $total_rows = $request->rows,
            //     $amount = $request->amount,
            //     $percent = $request->percent,
            //     $from_amount = $request->from_amount,
            //     $to_amount = $request->to_amount,
            //     $percentage = $request->percentage,
            // );

            $getSalesSum = array();

            for ($i = 0; $i < count($customer_unique); $i++) {
                $getSales = DB::select(" SET NOCOUNT ON;  exec [dbo].[usp_get_sales_summary] '" . $customer_ico . "' , '" . $customer_unique[$i] . "', NULL, NULL, NULL , " . $quater . ", NULL ");
                $getSalesSum[] = $getSales;
            }

            return response()->json([

                'data' => $getSalesSum,
            ]);
        }
    }

    public function nnnbp_screen()
    {
        //  $buyer_uid = tbl_Articlewise_Sale_Colli::orderBy('fy_year_id')->select('buy_domain', 'fy_year_id')->get()->unique('buy_domain');;
        //$buyer_uid = tbl_Articlewise_Sale_Colli::orderBy('fy_year_id')->select('buy_domain', 'fy_year_id')->distinct()->get();

        $buyer_uid = nnnbp_source::select('buy_domain', 'buy_domain_no', 'nnnbp_source')->get();

        return view('nnnbp.index', compact('buyer_uid'));
    }


    public function update_nnnbpSrc(Request $request)
    {
        $selected_src = $request->selected_src;
        $buy_domain_no = $request->buy_domain_no;

        $change_src = DB::table('tbl_nnnbp_source')->where('buy_domain_no', $buy_domain_no)->update([
            'nnnbp_source'     => $selected_src
        ]);

        if ($change_src) {
            // return redirect()->back()->with('success', 'nnnbp_src updated ');
            return json_encode(array('success' => 'nnnbp_src updated '));
        } else {
            return json_encode(array('error' => 'Sorry! could not update the nnnbp_src '));
        }
    }
}
