<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function view() {
        // Get list of categories
        $categories = Category::with('latestPoint')
            ->where('meeting_order', '!=', -1)
            ->whereHas('latestPoint', function($query) {
                $query->where('point_value', '!=', 0);
            })
            ->orderBy('meeting_order')
            ->get()->toArray();

        return view('reporting.view', compact('categories'));
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
