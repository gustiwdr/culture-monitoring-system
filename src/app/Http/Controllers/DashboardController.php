<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function cultureAgentDashboard()
    {
        $activitiesToMonitor = Activity::where('approval_status', 'pending')->orderBy('updated_at', 'desc')->get();
        return view('culture_agent.dashboard', compact('activitiesToMonitor'));
    }

    public function divisionHeadDashboard()
    {
        $user = Auth::user();
        $activitiesToApprove = Activity::where('approval_status', 'pending')->where('division_id', $user->division_id)->get();
        return view('division_head.dashboard', compact('activitiesToApprove'));
    }

    public function adminHCDashboard()
    {
        $activities = Activity::whereIn('approval_status', ['pending', 'approved_by_head'])->orderBy('updated_at', 'desc')->get();
        return view('admin_hc.dashboard', compact('activities'));
    }
}
