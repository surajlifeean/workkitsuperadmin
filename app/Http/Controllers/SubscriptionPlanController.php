<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('Manage Plan')) {
            $plans = SubscriptionPlan::where('active', 1)
                ->orderBy('price', 'asc')
                ->get();

            $not_active_plans = SubscriptionPlan::where('active', 0)
                ->orderBy('price', 'asc')
                ->get();
            return view('plan.index1', compact('plans', 'not_active_plans'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('Create Plan')) {
            $currency = ['USD' => 'USD', 'EUR' => 'EUR', 'XOF' => 'XOF', 'XAF' => 'XAF'];
            return view('plan.create1', compact('currency'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('Create Plan')) {
            $new_plan = new SubscriptionPlan();
            $new_plan->plan = $request->name;
            $new_plan->price = $request->price;
            $new_plan->offered_price = $request->offered_price;
            $new_plan->total_users = $request->max_users;
            $new_plan->duration = $request->duration;
            $new_plan->currency = $request->currency;
            $new_plan->start_date = Carbon::today();
            $new_plan->description = $request->description;
            $new_plan->save();

            return redirect()->back()->with('success', 'Plan successfully created');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {

        if (\Auth::user()->can('Edit Plan')) {
            $plan  = SubscriptionPlan::find($id);
            $currency = ['USD' => 'USD', 'EUR' => 'EUR', 'XOF' => 'XOF', 'XAF' => 'XAF'];
            return view('plan.edit1', compact('plan', "currency"));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('Edit Plan')) {
            $old_plan = SubscriptionPlan::find($id);
            $old_plan->active = 0;
            $old_plan->end_date = Carbon::today();
            $old_plan->save();

            $new_plan = new SubscriptionPlan();
            $new_plan->plan = $request->name;
            $new_plan->price = $request->price;
            $new_plan->offered_price = $request->offered_price;
            $new_plan->total_users = $request->max_users;
            $new_plan->duration = $request->duration;
            $new_plan->currency = $request->currency;
            $new_plan->start_date = Carbon::today();
            $new_plan->description = $request->description;
            $new_plan->save();

            return redirect()->back()->with('success', 'Plan Edited successfully created');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function updateOfferPrice(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->is_offer_price = $request->input('isOfferPrice');
        if ($plan->save()) {
            return response()->json(['success' => 'Offer price updated successfully']);
        } else {
            return response()->json(['status' => '500']);
        }
    }

    public function destroy($id)
    {
        try {
            $plan = SubscriptionPlan::findOrFail($id);
            $plan->delete();

            return response()->json(['success' => 'Subscription plan deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => '500 Internal Server Error', 'message' => $e->getMessage()]);
        }
    }
}
