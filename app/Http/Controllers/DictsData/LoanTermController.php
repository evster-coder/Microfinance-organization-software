<?php

namespace App\Http\Controllers\DictsData;

use App\Models\DictsData\LoanTerm;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Response;

class LoanTermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = LoanTerm::orderBy('daysAmount')->paginate(10);
        return view('dictfields.loanterm.index', ['terms' => $items]);
    }

    //возврат данных по запросу
    public function getTerms(Request $req)
    {
        if($req->ajax())
        {
            $query = $req->get('query');
            $query = str_replace(" ", "%", $query);

            $terms = LoanTerm::where('daysAmount', 'like', '%'.$query.'%')
                        ->orderBy('daysAmount')
                        ->paginate(10);

            return view('components.loanterms-tbody', compact('terms'))->render();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //simple validation (no need to add Request class)
        $request->validate([
                'daysAmount' => 'required|numeric|between:1, 1000',
        ]);

        $termId = $request->dataId;
        LoanTerm::updateOrCreate(['id' => $termId],['daysAmount' => $request->daysAmount]);
        if(empty($request->dataId))
            $msg = 'Элемент успешно создан.';
        else
            $msg = 'Элемент успешно обновлен.';
        return redirect()->route('loanterm.index')->with(['status' => $msg]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanTerm  $loanTerm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loanTerm = LoanTerm::find($id);
        return Response::json($loanTerm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanTerm  $loanTerm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletingItem = LoanTerm::find($id);

        if($deletingItem)
        {
            $deletingItem->delete();
            return redirect()->route('loanterm.index')->with(['status' => 'Элемент успешно удален.']);
        }
        else
            return redirect()->route('loanterm.index')
                ->withErrors(['msg' => 'Ошибка удаления в LoanTermController::destroy']);
    }
}