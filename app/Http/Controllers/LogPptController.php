<?php

namespace App\Http\Controllers;

use App\Models\LogPpt;

use Illuminate\Http\Request;

class LogPptController extends Controller
{
    public function index()
    {
        $logPpts = LogPpt::logPpts();
        return view('logPpts.index', compact('logPpts'));
    }

    //get log (status, desc)
    public function getStatusAndDesc($user_id, $ppt_id)
    {
        return LogPpt::getStatusAndDesc($user_id, $ppt_id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $logPpt = LogPpt::insertLog($data);

        return redirect()->route('logPpts.index')->with('status', 'Berhasil Tambah');
    }

    //update
    public function update($user_id, $ppt_id, Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $logPpt = LogPpt::updateLog($user_id, $ppt_id, $data);

        return redirect()->route('logPpts.index')->with('status', 'Berhasil Update');
    }
}
