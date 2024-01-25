<?php

namespace App\Http\Controllers\Backend;

use App\Models\StatusReport;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;


class StatusController extends Controller
{

    /**
     * Show the list of all statuses which are reported by users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportedStatusesList()
    {
        $all_statuses = StatusReport::all();
        $statuses = $all_statuses->filter(function ($status) {
            return $status->notify == 'new';
        });

        return view('cbs.backend.report', compact('all_statuses', 'statuses'));
    }
}
