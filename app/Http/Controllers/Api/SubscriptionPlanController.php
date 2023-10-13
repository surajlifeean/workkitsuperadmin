<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanRequest;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::orderBy('price', 'asc')->get();
        // return response()->json('$subscriptionPlans');
        return response()->json([
            'status' => 200,
            'data' => $subscriptionPlans
        ]);
    }

    public function store(Request $request)
    {
        $new_transaction = new Transaction();
        $new_transaction->company_id = $request->company_id;
        $new_transaction->transaction_json = json_encode($request->subscription_plan_data);

        $new_transaction->save();

        $plan_req = new PlanRequest();
        $plan_req->transaction_id = $new_transaction->id;
        $plan_req->subs_plan_id = $request->subs_plan_id;
        $plan_req->company_id = $request->company_id;
        $plan_req->is_offer_price = $request->is_offer_price;

        if ($plan_req->save()) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 422]);
        }
    }
}
