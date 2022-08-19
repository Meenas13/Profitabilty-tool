<?php

namespace App\Http\Controllers;

use App\category_share;
use App\tbl_Articlewise_Sale_Colli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FullDomainListController extends Controller
{

    public function full_domainList(Request $request)
    {
        try {
            ini_set('max_execution_time', 180);
            if ($request->ajax()) {
                $draw = $request->get('draw');
                $catSaleShareHtml = NULL;
                $salesOtiHtml = NULL;
                if ($draw == 1) {
                    $response = array(
                        'status' => 1,
                        "draw" => intval($draw),
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => [],
                        "catSaleShare" => $catSaleShareHtml,
                        "salesOti" => $salesOtiHtml,
                    );
                    return response()->json($response);
                }
                $start = $request->get("page");
                $rowperpage = $request->get("length"); // Rows display per page
                // $rowperpage = 1;
                $columnName = "buy_subsys_no";
                $columnSortOrder = "ASC";
                $filterByKeyword = $request->get('filterByKeyword');

                $unique_number = array();

                if ($request->filterByKeyword['customer_ico']) {
                    $id = $request->filterByKeyword['customer_ico'];
                } else {
                    $id = "NULL";
                }


                if (isset($request->filterByKeyword['customer_unique'])) {
                    $unique_number = $request->filterByKeyword['customer_unique'];
                    $unique_implode = is_array($unique_number) ? implode(',', $unique_number) : $unique_number;
                    $unique_number_implode = "'" . $unique_implode . "'";
                } else {
                    $unique_implode = "NULL";
                    $unique_number_implode = "NULL";
                }
                $quater = array();
                if ($request->filterByKeyword['quater']) {
                    $quater = $request->filterByKeyword['quater'];
                    $quater_implode = implode(',', $quater);
                    $sel_quater_implode = "'" . $quater_implode . "'";
                } else {
                    $sel_quater_implode = "NULL";
                }

                // $article_category_type = $request->filterByKeyword['category'];

                $article_category = array();
                $article_category = $request->filterByKeyword['category'];
                if (!empty($article_category)) {
                    // article_category_imp
                    $category_implode = implode(',', $article_category);
                    $article_category_imp = "'" . $category_implode . "'";
                } else {
                    $article_category_imp = "NULL";
                }

                $channel_type = $request->filterByKeyword['channel'];
                $channel = $request->filterByKeyword['channel'];
                if ($channel == "both") {
                    $channel = "NULL";
                } elseif ($channel == "C&C") {
                    $channel = "'" . $request->filterByKeyword['channel'] . "'";
                } elseif ($channel == "Delivery") {
                    $channel = "'" . $request->filterByKeyword['channel'] . "'";
                } else {
                    $channel = "NULL";
                }

                $quater = $request->filterByKeyword['quater'];

                if ($quater != "") {
                    $quaters_implode = implode(',', $quater);
                    $quater_implode = "'" . $quaters_implode . "'";
                } else {
                    $quater_implode = "NULL";
                }

                $month_id = $request->filterByKeyword['month_id'];
                if (!empty($month_id)) {
                    $monthId = implode(',', $month_id);
                    $monthId = "'" . $monthId . "'";
                    //  dd($monthId);
                } else {
                    $monthId = "NULL";
                }

                $from_year = $request->filterByKeyword['from_year'];
                $to_year = $request->filterByKeyword['to_year'];

                if ($from_year != "" && $to_year != "") {
                    $year_range = $from_year . $to_year;
                } else {
                    $year_range = "NULL";
                }

                if (!empty($request->filterByKeyword['customer_ico'])) {
                    $cust_uniqueList = tbl_Articlewise_Sale_Colli::where('ico', '=', $id)->select('cust_no_unique')->distinct()->get();
                } else {
                    $cust_uniqueList = tbl_Articlewise_Sale_Colli::select('cust_no_unique')->distinct()->get();
                }

                $final_domainList = DB::select(" SET NOCOUNT ON;  exec [dbo].[usp_get_article_summary] '" . $id . "' , " . $unique_number_implode . " ," . $article_category_imp . "," . $channel . ",  " . $year_range . " ," . $quater_implode . ", " . $monthId . ", NULL," . $start . "," . $rowperpage . "");
                $count  = 0;
                if (count($final_domainList)) {
                    $count = $final_domainList['0']->total_records;
                }
                $data_arr = array();
                $i = 1;
                if (!empty($final_domainList)) {
                    foreach ($final_domainList as $key => $row) {
                        $data_arr[] = array(
                            "buy_subsys_no" => $row->buy_subsys_no,
                            "buy_domain" => $row->buy_domain,
                            "subsys_art_no" => $row->subsys_art_no,
                            "subsys_art_name" => $row->subsys_art_name,
                            "status_article" => $row->status_article,
                            "qtymonths" => $row->qtymonths,
                            "sales" => number_format(round($row->sales, 2)),
                            "colli" => round($row->colli, 2),
                            "noofinvoice" => $row->noofinvoice,
                            "sales_per_month" => round($row->sales_per_month, 2),
                            "colli_per_month" => round($row->colli_per_month, 2),
                            "invoices_per_month" => round($row->invoices_per_month, 2),
                        );
                        $i++;
                    }
                }


                if ($start == 1) {

                    $catSaleShare = DB::select("SET NOCOUNT ON;  exec usp_get_category_share_summary @p_ico = '" . $id . "' , @p_cust_no_unique =" . $unique_number_implode . " , @p_catmanager_group = " . $article_category_imp . ", @p_delivery_flag_name = " . $channel . ", @p_fy_year_id=" . $year_range . " , @p_fy_quarter=" . $quater_implode . " , @p_month_id=" . $monthId . " ");
                    $salesOti = DB::select("SET NOCOUNT ON;  exec usp_get_sales_oti_summary @p_ico = '" . $id . "' , @p_cust_no_unique =" . $unique_number_implode . " , @p_catmanager_group = " . $article_category_imp . " ");

                    foreach ($catSaleShare as $key => $value) {
                        $sales_percentage = !empty($value->sales_percentage) ?  round($value->sales_percentage, 2) : 0;
                        $catSaleShareHtml .= "<tr>
                        <td>$value->catmanager_group</td>
                        <td>$sales_percentage</td>
                        </tr>";
                    }
                    $salesOtiHtml = '';
                    foreach ($salesOti as $key2 => $value2) {
                        $invoiceCount = !empty($value2->invoice_count) ? round($value2->invoice_count, 2) : 0;
                        $salesOtiHtml .= "<tr>
                        <td>$value2->Period</td>
                        <td> " . number_format(round($value2->sales, 2)) . " </td>
                        <td> " . round($value2->total_oti_percentage, 2) . "%" . " </td>
                        <td> " . round($invoiceCount, 0) . " </td>
                        </tr>";
                    }
                }

                $response = array(
                    'status' => 1,
                    "draw" => intval($draw),
                    "iTotalRecords" => $count,
                    "iTotalDisplayRecords" => $count,
                    "aaData" => $data_arr,
                    "catSaleShare" => $catSaleShareHtml,
                    "salesOti" => $salesOtiHtml,

                );
                return response()->json($response);
            }
        } catch (\Exception $e) {
            dd($e);
            //$bug = $e->getMessage();
            $bug = 'Something went to wrong.';
            return back()->with('error', $bug);
        }
    }
}
