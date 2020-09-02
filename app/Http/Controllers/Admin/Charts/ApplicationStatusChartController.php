<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
// use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Classes\Echarts\Chart;
// use ConsoleTVs\Charts\Classes\Fusioncharts\Chart;
// use ConsoleTVs\Charts\Classes\Highcharts\Chart;
// use ConsoleTVs\Charts\Classes\C3\Chart;
// use ConsoleTVs\Charts\Classes\Frappe\Chart;
use App\Models\Application;

/**
 * Class ApplicationStatusChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ApplicationStatusChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        $ddata = \DB::table('applications')
                 ->select('status', \DB::raw('count(*) as total'))
                 ->groupBy('status')
                 ->get();

        $labels = [];
        $conts = [];

        foreach($ddata as $d){
          $labels[] = $d->status;
          $conts[] = $d->total;
        }


        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels($labels);
        $this->chart->dataset('Count', 'pie', $conts);
        $this->chart->title('Application Status');
        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/application-status'));

        // OPTIONAL
        $this->chart->minimalist(true);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    // public function data()
    // {
    //     $ddata = \DB::table('applications')
    //              ->select('status', \DB::raw('count(*) as total'))
    //              ->groupBy('status')
    //              ->get();
    //
    //     $this->chart->dataset('Application Status', 'pie', $ddata)
    //         ->color('rgba(205, 32, 31, 1)')
    //         ->backgroundColor('rgba(205, 32, 31, 0.4)');
    // }
}
