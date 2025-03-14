<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if ($user->isAdminHC()) {
            $reports = Report::with('activity')->latest()->get();
            return view('admin_hc.reports.index', compact('reports'));
        }

        if ($user->isDivisionHead()) {
            $reports = Report::whereHas('activity', function ($query) use ($user) {
                $query->where('division_id', $user->division_id);
            })->with('activity')->latest()->get();
            return view('division_head.reports.index', compact('reports'));
        }

        if ($user->isCultureAgent()) {
            $reports = Report::where('created_by', $user->id)->with('activity')->latest()->get();
            $activities = Activity::where('activity_status', 'done')->get();
            return view('culture_agent.reports.index', compact('reports', 'activities'));
        }
    }

    public function show(Report $report)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $activity = $report->activity;

        if ($user->isAdminHC()) {
            return view('admin_hc.reports.show', compact('report'));
        }

        if ($user->isDivisionHead() && $activity && $activity->division_id == $user->division_id) {
            return view('division_head.reports.show', compact('report'));
        }

        if ($user->id === $report->created_by) {
            return view('culture_agent.reports.show', compact('report'));
        }

        return redirect()->route('division.reports.index')->with('error', 'Anda tidak memiliki akses untuk melihat laporan ini.');
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if (!$user->isCultureAgent()) {
            return redirect()->route('culture.reports.index')->with('error', 'Hanya Culture Agent yang bisa membuat laporan.');
        }

        $activities = Activity::where('activity_status', 'done')->get();

        return view('culture_agent.reports.create', compact('activities'));
    }

    public function store(Request $request)
    {
        $activities = Activity::where('approval_status', '!=', 'approved')->get();
        if ($activities->isNotEmpty()) {
            session()->flash('warning', 'Ada kegiatan yang belum disetujui!');
        }

        $request->validate([
            'participants' => 'required|integer',
            'summary' => 'required|string',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'activity_id' => 'required|exists:activities,id',
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('photos', 'public');
            }
        }

        $report = new Report([
            'participants' => $request->participants,
            'summary' => $request->summary,
            'activity_id' => $request->activity_id,
            'created_by' => Auth::id(),
            'user_id' => Auth::id(),
            'photos' => json_encode($photoPaths),
        ]);

        $report->save();

        return redirect()->route('culture.reports.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function edit(Report $report)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if (!$user->isCultureAgent() || $user->id !== $report->created_by) {
            return redirect()->route('culture.reports.index')->with('error', 'Hanya Culture Agent yang bisa mengedit laporan ini.');
        }

        return view('culture_agent.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'participants' => 'required|integer',
            'summary' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $photoPath = $report->photo;
        if ($request->hasFile('photo')) {
            if ($report->photo) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $report->photo);
            }
            $photoPath = $request->file('photo')->store('reports', 'public');
        }

        $report->update([
            'participants' => $request->participants,
            'summary' => $request->summary,
            'photo' => $photoPath,
        ]);

        return redirect()->route('culture.reports.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Report $report)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        if (!$user->isCultureAgent() || $user->id !== $report->created_by) {
            return redirect()->route('culture.reports.index')->with('error', 'Hanya Culture Agent yang bisa menghapus laporan ini.');
        }

        if ($report->photo) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $report->photo);
        }

        $report->delete();

        return redirect()->route('culture.reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
