<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\StatusReport;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show the list of all statuses which are reported by users.
     *
     * @return StatusReport[]|\Illuminate\Database\Eloquent\Collection
     */
    public function reportedStatusesList()
    {
        $statuses = StatusReport::where('notify', 'new')->get();

        return $statuses;
    }
}
