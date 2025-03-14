<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isCultureAgent()) {
            $activitiesToMonitor = Activity::all();
            return view('culture_agent.activities.index', compact('activitiesToMonitor'));
        }

        if ($user->isDivisionHead()) {
            $activitiesToApprove = Activity::where('division_id', $user->division_id)
                ->where('approval_status', 'pending')
                ->get();
            return view('division_head.activities.index', compact('activitiesToApprove'));
        }

        if ($user->isAdminHC()) {
            $activitiesToApprove = Activity::where('approval_status', 'pending')
                ->orWhere('approval_status', 'approved_by_head')
                ->get();
            return view('admin_hc.activities.index', compact('activitiesToApprove'));
        }

        abort(403, 'Anda tidak berhak mengakses halaman ini.');
    }

    public function create()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isCultureAgent()) {
            $divisions = Division::all();
            return view('culture_agent.activities.create', compact('divisions'));
        }

        return redirect()->route('activities.index')->with('error', 'Anda tidak berhak mengakses halaman ini.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'activity_date' => 'required|date',
            'target_participants' => 'required|integer|min:1',
        ]);

        $activity = new Activity([
            'name' => $request->name,
            'description' => $request->description,
            'activity_date' => $request->activity_date,
            'target_participants' => $request->target_participants,
            'approval_status' => 'pending',
            'activity_status' => 'scheduled',
            'division_id' => Auth::user()->division_id,
            'created_by' => Auth::id(),
            'user_id' => Auth::id(),
        ]);

        $activity->save();

        return redirect()->route('culture.activities.index')->with('success', 'Kegiatan berhasil diajukan!');
    }

    public function edit(Activity $activity)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isCultureAgent()) {
            return view('culture_agent.activities.edit', compact('activity'));
        }

        return redirect()->route('culture.activities.index')->with('error', 'Anda tidak berhak mengedit aktivitas ini.');
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'activity_date' => 'required|date',
        ]);

        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isCultureAgent()) {
            $activity->update([
                'name' => $request->name,
                'description' => $request->description,
                'activity_date' => $request->activity_date,
                'activity_status' => $request->activity_status,
            ]);

            return redirect()->route('culture.activities.index')->with('success', 'Aktivitas berhasil diupdate.');
        }

        return redirect()->route('culture.activities.index')->with('error', 'Anda tidak berhak mengupdate aktivitas ini.');
    }

    public function updateStatus(Request $request, Activity $activity)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if (!$user->isCultureAgent()) {
            return redirect()->route('culture.activities.index')->with('error', 'Hanya Culture Agent yang dapat mengupdate status kegiatan.');
        }

        $request->validate([
            'activity_status' => 'required|in:scheduled,done,canceled',
        ]);

        $activity->update(['activity_status' => $request->status]);

        return redirect()->route('culture.activities.index')->with('success', 'Status kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isCultureAgent()) {
            $activity->delete();
            return redirect()->route('culture.activities.index')->with('success', 'Aktivitas berhasil dihapus.');
        }

        return redirect()->route('culture.activities.index')->with('error', 'Anda tidak berhak menghapus aktivitas ini.');
    }

    public function approveByHead(Activity $activity)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if (!$user->isDivisionHead() || $user->division_id !== $activity->division_id) {
            return redirect()->route('division.activities.index')->with('error', 'Anda tidak berhak menyetujui kegiatan ini.');
        }

        $activity->approval_status = 'approved_by_head';
        $activity->save();

        return redirect()->route('division.activities.index')->with('success', 'Kegiatan disetujui oleh Kepala Divisi.');
    }

    public function rejectByHead(Activity $activity)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isDivisionHead() && $user->division_id === $activity->division_id) {
            $activity->approval_status = 'rejected_by_head';
            $activity->save();

            return redirect()->route('division.activities.index')->with('success', 'Kegiatan ditolak oleh Kepala Divisi.');
        }

        return redirect()->route('division.activities.index')->with('error', 'Kegiatan tidak dapat ditolak.');
    }

    public function approveByAdmin(Activity $activity)
    {
        if ($activity->approval_status === 'approved_by_head') {
            $activity->approval_status = 'approved_by_admin';
            $activity->save();

            return redirect()->route('admin.activities.index')->with('success', 'Aktivitas berhasil disetujui oleh Admin HC');
        }

        return redirect()->route('admin.activities.index')->with('error', 'Aktivitas harus disetujui oleh Kepala Divisi terlebih dahulu');
    }

    public function rejectByAdmin(Activity $activity)
    {
        if ($activity->approval_status === 'approved_by_head') {
            $activity->approval_status = 'rejected_by_admin';
            $activity->save();

            return redirect()->route('admin.activities.index')->with('success', 'Aktivitas berhasil ditolak oleh Admin HC');
        }

        return redirect()->route('admin.activities.index')->with('error', 'Aktivitas harus disetujui oleh Kepala Divisi terlebih dahulu');
    }
}
