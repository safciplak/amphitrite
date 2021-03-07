<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * List.
     *
     * @return mixed
     */
    public function list()
    {
        return Device::leftJoin('operating_systems', 'operating_systems.id', '=', 'devices.operating_system_id')
            ->leftJoin('apps', 'apps.id', '=', 'devices.app_id')
            ->leftJoin('subscriptions', 'subscriptions.id', '=', 'devices.subscription_status')
            ->groupBy('devices.app_id')
            ->groupBy('devices.operating_system_id')
            ->get(
                [
                DB::raw('DATE(devices.created_at) date'),
                'apps.name as app_name',
                'operating_systems.name as os',
                'subscriptions.status_name',
                DB::raw('COUNT(*) numbers')
                ]
            );
    }
}
