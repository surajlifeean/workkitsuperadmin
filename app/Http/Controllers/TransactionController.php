<?php

namespace App\Http\Controllers;

use App\Models\PlanRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        // dd($id);
        $transaction = Transaction::findOrFail($id);
        $transaction = json_decode($transaction->transaction_json, true);
        // dd($transaction);
        $plan_request = PlanRequest::leftJoin('subscription_plans', 'plan_requests.subs_plan_id', '=', 'subscription_plans.id')
        ->select('plan_requests.*', 'subscription_plans.plan', 'subscription_plans.price', 'subscription_plans.offered_price', 'subscription_plans.duration')
        ->where('transaction_id', $id)->first();
        // dd($plan_request);
        return view('transactions.show', compact('transaction', 'plan_request'));
    }
}
