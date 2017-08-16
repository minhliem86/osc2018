<?php namespace App\Modules\Frontend\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\LaravelAnalytics\LaravelAnalytics;
use Spatie\LaravelAnalytics\Period;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class GAController extends Controller {

    protected $ga;

    public function __construct(LaravelAnalytics $ga){
        $this->ga = $ga;
    }

    public function index()
    {
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate = Carbon::now();
        $rs = $this->ga->performQuery($startDate, $endDate, 'ga:pageviews',
        array(
            'filters' => 'ga:pagePath=@/duhoche2017/thu-vien-hinh-anh',
            'dimensions' => 'ga:date',
            'metrics' => 'ga:pageviews, ga:visits',
        )
        );
        // $rs = $this->ga->performQuery($startDate, $startDate,  'ga:pageviews', ['dimensions' => 'ga:fullReferrer', 'sort' => '-ga:pageviews', 'filters' => 'ga:pagePath=@/duhoche2017/thu-vien-hinh-anh']);
        $data_analytic = [];
        foreach($rs->rows as $item){
            $data_analytic [] = ['date' => Carbon::createFromFormat( 'Ymd', $item[0])->format('d-m-Y'), 'visitors' => $item[2], 'pageviews' => $item[1] ];
        }
        $data =  new Collection($data_analytic);
        return view('Frontend::users.course.report.index', compact('data'));
    }


}
