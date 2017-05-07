<?php


namespace App\ToastmasterWars\Components;


use Illuminate\Support\Facades\DB;

class CategoryComponent
{

    /**
     * Get list of categories needed for meetings
     * @return array
     */
    public static function getMeetingCategories() {
        $points = DB::table('points')
            ->join('categories' , 'points.category_id', '=', 'categories.id')
            ->where('categories.meeting_order', '!=', -1)
            ->orderBy('categories.meeting_order')
            ->select('points.id', 'points.point_value', 'categories.slug')
            ->get();
        return $points;
    }

    /**
     * Get list of categories and their respective point value
     * @return array
     */
    public static function getAllMeetingCategories() {
        $categories = DB::table('points')
            ->join('categories' , 'points.category_id', '=', 'categories.id')
            ->orderByDesc('points.point_value')
            ->select('points.id', 'points.point_value', 'categories.name')
            ->get();
        return $categories;
    }
}