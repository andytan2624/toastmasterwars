<?php

namespace App\ToastmasterWars\Components;

use Illuminate\Support\Facades\DB;

class PointComponent
{
    /**
     * Retrieve a list of points in the order they happen during meetings. Return an array where each slug
     * corresponds to howmuch points its worth
     */
    public function getMeetingPointSlugs() {

        $points = DB::table('points')
            ->join('categories' , 'points.category_id', '=', 'categories.id')
            ->where('categories.meeting_order', '!=', -1)
            ->orderBy('categories.meeting_order')
            ->select('points.id', 'points.point_value', 'categories.slug')
            ->get();

        // TODO: Check if this returns an array or collection

        $meetingPointSlugs = array();

        /**
         * Sort points object into array, indexed by the slug name
         * for easy reference
         */
        foreach ($points as $point) {
            $meetingPointSlugs[$point->slug] = $point;
        }
        return $meetingPointSlugs;
    }
}
