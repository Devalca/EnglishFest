<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Contest;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HomesController extends Controller
{
    public function logout(Request $request)
    {
        Filament::auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function home()
    {
        $today = Carbon::today();
        $homeContent = HomeContent::first();
        $programs = Contest::whereDate('time_start', '<=', $today)
            ->whereDate('time_end', '>=', $today)
            ->get();
        return view('welcome', [
            'contests' => Contest::where('parent_id', null)->get(),
            'programs' => $programs,
            'homeContent' => $homeContent
        ]);
    }

    public function contestDetail(Contest $contest)
    {
        $today = Carbon::today();
        $cek_id = Auth::user() != null ? Auth::user()->id : '';
        $cek_compe = Competition::where('contest_id', $contest->id)->where('user_id', $cek_id)->get();
        // dd($contest->time_start);
        if ($contest->time_start <= $today && $contest->time_end >= $today) {
            return view('contest', [
                'contests' => $contest,
                'compes' => $cek_compe
            ]);
        } else {
            alert()->error('404', 'Lomba Yang Anda Cari Tidak Di Temukan');
            return redirect()->route('home');
        }
    }

    public function submitContests(Request $request)
    {
        $today = Carbon::today();
        $cek_kon = Contest::find($request->contest_id);
        
        if ($cek_kon) {
            if ($cek_kon->time_start <= $today && $cek_kon->time_end >= $today) {
                try {
                    $data = $request->validate([
                        'user_id' => 'required',
                        'contest_id' => 'required',
                        'coach_name' => 'required',
                        'coach_phone' => 'required|numeric'
                    ]);
        
                    Competition::create($data);
        
                    alert()->success('Success', 'Competition submitted successfully');
                    return back();
                } catch (\Exception $e) {
                    alert()->error('Error', 'Failed to submit Competition. Please try again.');
                    return back();
                }
            } else {
                alert()->error('404', 'Lomba Yang Anda Cari Sudah Selesai');
                return redirect()->route('home');
            }
        } else {
            alert()->error('404', 'Contest not found');
            return redirect()->route('home');
        }
    }
}
