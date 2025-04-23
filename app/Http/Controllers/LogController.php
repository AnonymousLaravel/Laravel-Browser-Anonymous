<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('page')
            ->where('session_id', Session::getId())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('log', compact('logs'));
    }

    public function clear()
    {
        Log::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Cronologia cancellata.');
    }



    public function destroy(Log $log)
    {
        $log->delete();
        return back();
    }
}
