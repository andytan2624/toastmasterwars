<?php

namespace App\Http\Controllers;

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

        $userGraphResults = [];
        $categoryTitle = '';

        if ($request->isMethod('post')) {
            $input = Input::all();
            $categoryId = $input['category_id'];
            $categoryObject = Category::find($categoryId);
            $categoryTitle = $categoryObject->name;
            $reportingComponent = new ReportingComponent();
            $pointScores = $reportingComponent->getPointScores($categoryId);

            $userGraphResults = array_slice($reportingComponent->getUserGraphData($pointScores), 0 ,15);
        }

        // Get list of categories
        $categories = Category::with('latestPoint')
            ->where('meeting_order', '!=', -1)
            ->whereHas('latestPoint', function($query) {
                $query->where('point_value', '!=', 0);
            })
            ->orderBy('meeting_order')
            ->get()->toArray();

        return view('reporting.view', compact('categories', 'categoryTitle', 'userGraphResults'));
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
