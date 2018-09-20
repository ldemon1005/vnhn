<?php

namespace App\Http\Controllers\Admin;

use App\Model\Group_vn;
use App\Model\News;
use App\Models\Video_vn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public $view_id;
    public function getHome(Request $request){
//        return redirect('admin/articel');
        $req = $request->all();

        $from = strtotime(date('Y-m-1 0:0',time()));
        $to = time();

        if (isset($req['from']) && isset($req['to'])){
            $from = strtotime($req['from']."00:00");
            $to = strtotime($req['to']."23:59");
        }

        $data_google = [];
        $analytics = $this->initializeAnalytics();

        $response = $this->getReportPageView($analytics,$from,$to);
     
        $this->printResults($response,$data_google['page']);

        $user = $this->getReportUser($analytics,$from,$to);
        $this->printResults($user,$data_google['user']);

//        dd($data_google);

        $data = [
            'data_google' => $data_google,
            'from' =>  date('d/m/Y H:m',$from),
            'to' => date('d/m/Y H:m',$to)
        ];

        return view('admin.index.home',$data);
    }

    function initializeAnalytics()
    {
        // Creates and returns the Analytics Reporting service object.

        // Use the developers console and download your service account
        // credentials in JSON format. Place them in this directory or
        // change the key file location if necessary.
        $this->view_id = env('VIEW_ID');

        $KEY_FILE_LOCATION = __DIR__ . '/../../../../demo5-215411-9fb25b310016.json';

        // Create and configure a new client object.
        $client = new \Google_Client();
        $client->setApplicationName("Analytics Reporting");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new \Google_Service_AnalyticsReporting($client);
        return $analytics;
    }

    /**
     * Queries the Analytics Reporting API V4.
     *
     * @param service An authorized Analytics Reporting API V4 service object.
     * @return The Analytics Reporting API V4 response.
     */
    function getReportPageView($analytics,$from,$to) {

        $dateRange = new \Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate(date('Y-m-d',$from));
        $dateRange->setEndDate(date('Y-m-d',$to));

        $pageView = new \Google_Service_AnalyticsReporting_Metric();
        $pageView->setExpression("ga:pageviews");
        $pageView->setAlias("pageviews");
        
        $timeOnPage = new \Google_Service_AnalyticsReporting_Metric();
        $timeOnPage->setExpression("ga:timeOnPage");
        $timeOnPage->setAlias("timeOnPage");
        // dd($timeOnPage);
        $page_title = new \Google_Service_AnalyticsReporting_Dimension();
        $page_title->setName("ga:pageTitle");

//        $path = new \Google_Service_AnalyticsReporting_Dimension();
//        $path->setName("ga:pagePath");

        $request = new \Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->view_id);
        $request->setDateRanges($dateRange);
        $request->setDimensions(array($page_title));
        $request->setMetrics(array($pageView,$timeOnPage));
        $request->setOrderBys([
            "fieldName" => "ga:pageviews",
            "sortOrder" => "DESCENDING"
        ]);

        $body = new \Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests( array( $request) );

        return $analytics->reports->batchGet( $body );
    }


    /**
     * Queries the Analytics Reporting API V4.
     *
     * @param service An authorized Analytics Reporting API V4 service object.
     * @return The Analytics Reporting API V4 response.
     */
    function getReportUser($analytics,$from,$to) {

        $dateRange = new \Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate(date('Y-m-d',$from));
        $dateRange->setEndDate(date('Y-m-d',$to));

        $sessions = new \Google_Service_AnalyticsReporting_Metric();
        $sessions->setExpression("ga:users");
        $sessions->setAlias("users");

        $browser = new \Google_Service_AnalyticsReporting_Dimension();
        $browser->setName("ga:userType");

        $request = new \Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->view_id);
        $request->setDateRanges($dateRange);
        $request->setDimensions(array($browser));
        $request->setMetrics(array($sessions));
        $request->setOrderBys([
            "fieldName" => "ga:users",
            "sortOrder" => "DESCENDING"
        ]);

        $body = new \Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests( array( $request) );

        return $analytics->reports->batchGet( $body );
    }


    /**
     * Parses and prints the Analytics Reporting API V4 response.
     *
     * @param An Analytics Reporting API V4 response.
     */
    function printResults($reports,&$data) { 
        
        for ( $reportIndex = 0; $reportIndex < count( $reports ); $reportIndex++ ) {
            $report = $reports[ $reportIndex ];
            $header = $report->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
//            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $report->getData()->getRows();

            for ( $rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                $row = $rows[ $rowIndex ];
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();
                $key = '';
                for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                    $key = $dimensions[$i];
                }

                for ($j = 0; $j < count($metrics); $j++) {
                    $values = $metrics[$j]->getValues();
                    for ($k = 0; $k < count($values); $k++) {
                        $data[$key][$k] = $values[$k];
                    }
                }
            }
        }
    }
}
