<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function getArticalDetails(Request $request)
    {

        try {
            ini_set('max_execution_time', 180);
            if ($request->ajax()) {
                $draw = $request->get('draw');
                // dd($request->page);
                if ($draw == 1) {
                    $response = array(
                        'status' => 1,
                        "draw" => intval($draw),
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => [],
                    );
                    return response()->json($response);
                }
                $start = $request->get("page");
                $rowperpage = $request->get("length"); // Rows display per page


                // $rowperpage = 1;
                $columnName = "buy_subsys_no";
                $columnSortOrder = "ASC";

                $buy_domain = !empty($request->get('buy_domain')) ?  "'" . $request->get('buy_domain') . "'" : "NULL";
                $sub_artical = !empty($request->get('sub_artical')) ? "'" . $request->get('sub_artical') . "'" : "NULL";
                $sub_artical_name = !empty($request->get('sub_artical_name')) ? "'" . $request->get('sub_artical_name') . "'" : "NULL";
                $articlesDetails = DB::select(" SET NOCOUNT ON;  exec [dbo].[usp_get_articles_details] " . $buy_domain . " , " . $sub_artical . " ," . $sub_artical_name . "");
                /*  $articlesDetails = DB::table("tbl_Articlewise_Sale_Colli")
                    ->where(function ($query) use ($buy_domain, $sub_artical, $sub_artical_name) {
                        if (isset($buy_domain)) {
                            $query->where('buy_domain','like', "%" . $buy_domain . "%");
                        }
                        if (isset($sub_artical)) {
                            $query->where('subsys_art_no', 'like', "%" . $sub_artical . "%");
                        }

                        if (!empty($sub_artical_name)) {
                            $query->where(function ($query) use ($sub_artical_name) {
                                $query->where("subsys_art_name", 'like', "%" . $sub_artical_name . "%");
                            });
                        }
                    })
                    ->skip($start)
                    ->take($rowperpage)
                    ->select("buy_domain_no", "buy_domain", "subsys_art_no", "subsys_art_name", "status_article")
                    ->get();
*/
                // dd($articlesDetails);
                // die;
                $count  = count($articlesDetails);

                $data_arr = array();
                $i = 1;
                if (!empty($articlesDetails)) {
                    foreach ($articlesDetails as $key => $row) {
                        $data_arr[] = array(
                            "buy_subsys_no" => $row->buy_subsys_no,
                            "buy_domain" => $row->buy_domain,
                            "subsys_art_no" => $row->subsys_art_no,
                            "subsys_art_name" => $row->subsys_art_name,
                            "status_article" => $row->status_article,
                            // "qtymonths" => $row->qtymonths,
                            // "sales" => number_format(round($row->sales, 2)),
                            // "colli" => round($row->colli, 2),
                            // "noofinvoice" => $row->noofinvoice,
                            // "sales_per_month" => round($row->sales_per_month, 2),
                            // "colli_per_month" => round($row->colli_per_month, 2),
                            // "invoices_per_month" => round($row->invoices_per_month, 2),
                        );
                        $i++;
                    }
                }

                return    $response = array(
                    'status' => 1,
                    'start' => $start,
                    'rowperpage' => $rowperpage,
                    "draw" => intval($draw),
                    "iTotalRecords" => $count,
                    "iTotalDisplayRecords" => $count,
                    "aaData" => $data_arr
                );
            }
        } catch (\Exception $e) {
            dd($e);
            //$bug = $e->getMessage();
            $bug = 'Something went to wrong.';
            return back()->with('error', $bug);
        }
    }
}
