<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class NotificationController extends Controller
{
    public function index()
    {
        // dd('fgvhbjk');
        if (auth()->user()->type == 'super admin') {
            $notifications = Notification::where('is_seen', 0)
                ->where('is_superadmin', 0)
                ->leftJoin('companies', 'notifications.company_id', '=', 'companies.id')
                ->select('notifications.title', 'notifications.message', 'notifications.company_id','companies.email', 'companies.name as company_name', 'notifications.created_at')
                ->get();

        //    dd('edrfgyjio');
            
            return response()->json($notifications);
        }
    }
    public function create(){
        // dd('fghjk');
        return view('notification.create');
    }
    public function store(Request $request){
        // dd($request);
        $notifications = Notification::create([
           "title" => $request->title,
           "message" => $request->message,
           "company_id" => $request->company_id,
           "is_superadmin" => 1
        ]);
        $comp_url = Company::where('id', $request->company_id)->select('url')->first();
        if ($comp_url->url) {
            $send_msg = Http::post($comp_url->url . '/api/receive_notification_superadmin', [
            'title' => $request->title,
            'message' => $request->message,
            'is_superadmin' => 1
          ]);
          return redirect()->back()->with('success', 'Successfully sent');
        }
       return redirect()->back()->with('error', 'Something went wrong');
        
    }
    public function show(Request $request, $id)
    {
        $notifications = Notification::where('company_id', $id)
        ->leftJoin('companies', 'notifications.company_id', '=', 'companies.id')
        ->select('notifications.title', 'notifications.message', 'notifications.company_id', 'notifications.is_superadmin','companies.email', 'companies.name as company_name', 'notifications.created_at')
        ->get();
        
        return view('notification.show', compact('notifications'));
    }
    public function get_clients_notifications(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'company_id' => 'required|integer',
        ]);

        $notification = new \App\Models\Notification($validatedData);
        $notification->save();

        return response()->json(['message' => 'Notification stored successfully'], 200);
    }
    public function broadcast_message(Request $request){
      $companies = Company::select('url')->get();
      foreach ($companies as $company) {
        if ($company->url && filter_var($company->url, FILTER_VALIDATE_URL)) {
            $send_msg = Http::post($company->url . '/api/receive_notification_superadmin', [
            'title' => $request->title,
            'message' => $request->message,
            'is_superadmin' => 1
          ]);
        }
      }
      return redirect()->back()->with('success', 'Successfully broadcasted.');
    }
    public function update_all_seen(){
        $set_seen = \App\Models\Notification::where('is_seen', 0)->update(['is_seen' => 1]);
        return response()->json(['status' => 200]);
    }
}
