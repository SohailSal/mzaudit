<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\BankBranch;
use App\Models\Year;
use App\Models\BankConfirmation;
use Inertia\Inertia;

class BankConfirmationController extends Controller
{
    public function index()
    {
        return Inertia::render('Confirmations/Index', [
            'data' => BankConfirmation::all()
                ->map(function ($confirmation){
                    return [
                        'id' => $confirmation->id,
                        'sent' => $confirmation->sent,
                        'remind_first' => $confirmation->remind_first,
                        'remind_second' => $confirmation->remind_second,
                        'received' => $confirmation->received,
                        'branch' => $confirmation->bankBranch->bank->name." - ".$confirmation->bankBranch->address,
                        'company' => $confirmation->company->name,
                        'year' => $confirmation->year->begin." - ".$confirmation->year->end,
                    ];
                }), 
        ]);
    }

    public function create()
    {
        return Inertia::render('Confirmations/Create',[
            'branches' => BankBranch::all()
                ->map(function ($branch){
                    return [
                        'id' => $branch->id,
                        'name' => $branch->bank->name." - ".$branch->address,
                    ];
                }),
            'year' => Year::where('id',2)->first(),
        ]);
    }

    public function store(Req $request)
    {
        Request::validate([
            'sent' => ['required'],
            'company_id' => ['required'],
            'year_id' => ['required'],
        ]);

        BankConfirmation::create([
            'sent' => Request::input('sent'),
            'company_id' => Request::input('company_id'),
            'year_id' => Request::input('year_id'),
            'branch_id' => Request::input('branch_id'),
        ]);

        return Redirect::route('confirmations')->with('success', 'Bank Confirmation created.');
    }

    public function show($id)
    {
        //
    }

    public function edit(BankConfirmation $confirmation)
    {
        return Inertia::render('Confirmations/Edit', [
            'confirmation' => [
                'id' => $confirmation->id,
                'sent' => $confirmation->sent,
                'remind_first' => $confirmation->remind_first,
                'remind_second' => $confirmation->remind_second,
                'received' => $confirmation->received,
                'company_id' => $confirmation->company_id,
                'branch_id' => $confirmation->branch_id,
                'year_id' => $confirmation->year_id,
            ],
            'branches' => BankBranch::all()
                ->map(function ($branch){
                    return [
                        'id' => $branch->id,
                        'name' => $branch->bank->name." - ".$branch->address,
                    ];
                }), 
            'year' => Year::where('id',2)->first(),
        ]);
    }

    public function update(Req $request, BankConfirmation $confirmation)
    {
        Request::validate([
            'sent' => ['required'],
            'company_id' => ['required'],
            'year_id' => ['required'],
        ]);

        $confirmation->sent = Request::input('sent');
        $confirmation->remind_first = Request::input('remind_first');
        $confirmation->remind_second = Request::input('remind_second');
        $confirmation->received = Request::input('received');
        $confirmation->company_id = Request::input('company_id');
        $confirmation->branch_id = Request::input('branch_id');
        $confirmation->year_id = Request::input('year_id');
        $confirmation->save();

        return Redirect::route('confirmations')->with('success', 'Bank Confirmation updated.');
    }

    public function destroy(BankConfirmation $confirmation)
    {
        $confirmation->delete();
        return Redirect::back()->with('success', 'Bank Confirmation deleted.');
    }
}
