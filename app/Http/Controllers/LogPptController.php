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
    public function getStatusAndDesc($user_id, $ppt_id)
    {
        return LogPpt::getStatusAndDesc($user_id, $ppt_id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
            'description' => 'nullable|string',
        ]);
        LogPpt::insertLogPpt([

            'status' => $data['status'],
            'description' => $data['description'],
            'user_id' => auth()->id(),
            'ppt_id' => $request->ppt_id,
        ]);
        return redirect()->route('ppt.index')->with('status', 'Berhasil Tambah');
    }
    public function update($user_id, $ppt_id, Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $logPpt = LogPpt::updateLog($user_id, $ppt_id, $data);
        return redirect()->route('logPpts.index')->with('status', 'Berhasil Update');
    }
    public function getLogPpt(Request $request)
    {
        $id = $request->input('id');
        $log_ppt = LogPpt::getLogPpt($id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('log_Ppt.formlog', compact('log_ppt'))->render()
        ], 200);
    }

    public function checkButton($id)
    {
        $logPpt = LogPpt::where('ppt_id', $id)
            ->orderBy('created_at', 'desc')
            ->select('status', 'description')
            ->first();
        return response()->json([
            'ppt' => $logPpt,
        ]);
    }
}
