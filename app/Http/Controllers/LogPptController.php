<?php

namespace App\Http\Controllers;

use App\Models\LogPpt;
use App\Models\Ppt;

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

    public function store(Request $request, Ppt $ppt)
    {

        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        /* $ppt->update([
            'status' => $data['status'],
        ]); */
        $logPpt = LogPpt::insertLogPpt([
            //'status' => 'Finish',
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
    public function getLogPptForm(Request $request)
    {
        $ppt = Ppt::findOrFail($request->id);

        return response()->json([
            'status' => 'ok',
            'msg' => view('log_Ppt.formlog', compact('ppt'))->render()
        ], 200);
    }
}
