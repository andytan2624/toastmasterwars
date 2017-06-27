<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Meeting;
use App\Models\Point;
use App\ToastmasterWars\Components\ReportingComponent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ReportingController extends Controller
{

    /**
     * Display layout to view how everyone is performing in different categories
     * and who is doing well
     */
    public function view(Request $request) {

        $userResults = [];
        $categoryTitle = '';
        $categoryId = '';

        /**
         * If the request is a POST method, then check the dates to pick the scores between those dates
         */

        if ($request->isMethod('post')) {
            $input = Input::all();
            $categoryId = $input['category_id'];
            $categoryObject = Category::find($categoryId);
            $categoryTitle = $categoryObject->name;
            $reportingComponent = new ReportingComponent();
            $start_date = $request->input('start_date', '');
            $end_date = $request->input('end_date', '');
            $formattedStartDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d 00:00:00');
            $formattedEndDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d 23:59:59');
            $pointScores = $reportingComponent->getPointScores($categoryId, $formattedStartDate, $formattedEndDate);
            $userResults = $reportingComponent->getUserData($pointScores);
        } else {
            $quarter_dates = getQuarterDates();
            $current_year = date('Y');
            $formattedStartDate = $current_year.'-'.$quarter_dates['start_date'];
            $formattedEndDate = $current_year.'-'.$quarter_dates['end_date'];
            $start_date = Carbon::createFromFormat('Y-m-d', $formattedStartDate)->format('d/m/Y');
            $end_date = Carbon::createFromFormat('Y-m-d', $formattedEndDate)->format('d/m/Y');
        }

        // Get list of categories
        $categories = Category::with('latestPoint')
            ->where('meeting_order', '!=', -1)
            ->whereHas('latestPoint', function($query) {
                $query->where('point_value', '!=', 0);
            })
            ->orderBy('meeting_order')
            ->get()->toArray();

        return view('reporting.view', compact('categories', 'categoryTitle', 'userResults', 'start_date', 'end_date', 'categoryId'));
    }

    /**
     * Function that will take the input data and output the necessary data to show statistics
     */
    public function process() {
        $input = Input::all();
        $categoryId = $input['category_id'] ?: '';
        $reportingComponent = new ReportingComponent();
        $reportingComponent->getCategoryStatistics($categoryId);
    }
}
