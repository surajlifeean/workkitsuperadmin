<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use App\Models\Plan;
use App\Models\PlanRequest;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

class PlanRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->type == 'super admin') {
            $plan_requests = PlanRequest::leftJoin('companies', 'plan_requests.company_id', '=', 'companies.id')
                ->leftJoin('subscription_plans', 'plan_requests.subs_plan_id', '=', 'subscription_plans.id')
                ->select(
                    'plan_requests.*',
                    'companies.name as company_name',
                    'companies.email as company_email',
                    'subscription_plans.plan',
                    'subscription_plans.total_users',

                    'subscription_plans.duration'
                )
                ->orderBy('plan_requests.created_at', 'desc')
                ->get();

            // dd($plan_requests);
            return view('plan_request.index', compact('plan_requests'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /*
     *@plan_id = Plan ID encoded
    */
    public function requestView($plan_id)
    {
        if (Auth::user()->type != 'super admin') {
            $planID = \Illuminate\Support\Facades\Crypt::decrypt($plan_id);
            $plan   = Plan::find($planID);

            if (!empty($plan)) {
                return view('plan_request.show', compact('plan'));
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    /*
     * @plan_id = Plan ID encoded
     * @duration = what duration is selected by user while request
    */
    public function userRequest($plan_id)
    {
        $objUser = Auth::user();

        if ($objUser->requested_plan == 0) {
            $planID = \Illuminate\Support\Facades\Crypt::decrypt($plan_id);

            if (!empty($planID)) {
                PlanRequest::create([
                    'user_id' => $objUser->id,
                    'plan_id' => $planID,

                ]);

                // Update User Table

                $objUser['requested_plan'] = $planID;
                $objUser->update();

                return redirect()->back()->with('success', __('Request Send Successfully.'));
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('You already send request to another plan.'));
        }
    }

    /*
     * @id = Project ID
     * @response = 1(accept) or 0(reject)
    */
    public function acceptRequest($id, $response)
    {
        if (Auth::user()->type == 'super admin') {
            $plan_request = PlanRequest::find($id);
            if (!empty($plan_request)) {
                $user = User::find($plan_request->user_id);

                if ($response == 1) {
                    $user->requested_plan = $plan_request->plan_id;
                    $user->plan           = $plan_request->plan_id;
                    $user->requested_plan = '0';
                    $user->save();

                    $plan       = Plan::find($plan_request->plan_id);
                    $assignPlan = $user->assignPlan($plan_request->plan_id, $plan_request->duration);
                    $price      = $plan->price;

                    if ($assignPlan['is_success'] == true && !empty($plan)) {
                        if (!empty($user->payment_subscription_id) && $user->payment_subscription_id != '') {
                            try {
                                $user->cancel_subscription($user->id);
                            } catch (\Exception $exception) {
                                \Log::debug($exception->getMessage());
                            }
                        }

                        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                        Order::create([
                            'order_id' => $orderID,
                            'name' => null,
                            'email' => null,
                            'card_number' => null,
                            'card_exp_month' => null,
                            'card_exp_year' => null,
                            'plan_name' => $plan->name,
                            'plan_id' => $plan->id,
                            'price' => $price,
                            'price_currency' => !empty(env('CURRENCY_CODE')) ? env('CURRENCY_CODE') : 'usd',
                            'txn_id' => '',
                            'payment_type' => __('Manually Upgrade By Super Admin'),
                            'payment_status' => 'succeeded',
                            'receipt' => null,
                            'user_id' => $user->id,
                        ]);

                        $plan_request->delete();

                        return redirect()->back()->with('success', __('Plan successfully upgraded.'));
                    } else {
                        return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                    }
                } else {
                    // $user->update(['requested_plan' => '0']);

                    $user['requested_plan'] = 0;
                    $user->update();

                    $plan_request->delete();

                    return redirect()->back()->with('success', __('Request Rejected Successfully.'));
                }
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /*
     * @id = User ID
    */
    public function cancelRequest($id)
    {

        $user = User::find($id);

        $user['requested_plan'] = '0';
        $user->update();

        PlanRequest::where('user_id', $id)->delete();

        return redirect()->back()->with('success', __('Request Canceled Successfully.'));
    }

    public function show(PlanRequest $planRequest)
    {
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->type == 'super admin') {
            $plan_request = PlanRequest::findOrfail($id);
            // dd($request);
            if ($request->status == 'hold' && $plan_request->end_date > now()) {
                $plan_request->hold_date =  new DateTime();
            }
            if ($request->status == 'active') {
                if ($plan_request->hold_date == null) {
                    $plan_request->start_date = new DateTime($request->start_date);
                    $plan_request->end_date = new DateTime(Carbon::parse($request->start_date)->addDays($request->days));
                } else {

                    if ($plan_request->end_date > now()) {

                        $dateInterval = now()->diff($plan_request->hold_date);
                        $add_days = $dateInterval->days;
                        $add_hours = $dateInterval->h;
                        $add_minutes = $dateInterval->i;
                        $add_seconds = $dateInterval->s;

                        $plan_request->end_date = Carbon::parse($plan_request->end_date)
                            ->addDays($add_days)
                            ->addHours($add_hours)
                            ->addMinutes($add_minutes)
                            ->addSeconds($add_seconds);
                        // dd($plan_request);
                    } else {
                        $dateInterval = $plan_request->end_date->diff($plan_request->hold_date);
                        $add_days = $dateInterval->days;
                        $add_hours = $dateInterval->h;
                        $add_minutes = $dateInterval->i;
                        $add_seconds = $dateInterval->s;

                        $plan_request->end_date = Carbon::parse(now())
                            ->addDays($add_days)
                            ->addHours($add_hours)
                            ->addMinutes($add_minutes)
                            ->addSeconds($add_seconds);
                    }

                    $plan_request->hold_date = null;
                }
            }
            if ($request->status == 'rejected') {
                $plan_request->hold_date = null;
                $plan_request->start_date = null;
                $plan_request->end_date = null;
            }
            $plan_request->status = $request->status;
            $plan_request->save();

            $url = Company::where('id', $plan_request->company_id)->select('url')->first();
            $total_user = SubscriptionPlan::where('id', $plan_request->subs_plan_id)->select('total_users')->first();
            $url = $url->url . '/api/active_plan_update';
            // dd($url);
            $send_updates = Http::post($url, [
                '_token' => csrf_token(),
                "subs_plan_id" => $plan_request->subs_plan_id,
                "plan_request_id" => $plan_request->id,
                "total_users" => $total_user->total_users,
                "status" => $plan_request->status,
                "start_date" => $plan_request->start_date,
                "end_date" => $plan_request->end_date,
            ]);
            // return $send_updates;

            return redirect()->back()->with('success', 'Updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
