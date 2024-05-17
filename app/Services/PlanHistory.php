<?php

namespace App\Services;

use App\Models\PlanHistory as ModelsPlanHistory;

class PlanHistory
{
    /**
     * Create a new class instance.
     */

    // User plan History
    function create($data): ModelsPlanHistory
    {

        return ModelsPlanHistory::create([
            "plan_id" => $data['plan_id'],
            "user_id" => $data['user_id'],
            "name" => $data['plan_name'],
            "start_date" => $data['start_date'],
            "end_date" => $data['end_date'],
            "validity" => $data['validaty'],
            "price" => $data['plan_price'],
        ]);
    }
}
