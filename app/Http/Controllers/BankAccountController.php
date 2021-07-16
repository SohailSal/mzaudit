<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\BankAccount;
use App\Models\BankBalance;
use App\Models\Year;
use App\Models\BankBranch;
use App\Models\Company;
use Inertia\Inertia;
use Carbon\Carbon;

class BankAccountController extends Controller
{
    public function index()
    {
        //


        return Inertia::render(
            'Accounts/Index',
            [
                'balances' => BankAccount::all()
                    ->where('company_id', session('company_id'))
                    ->map(
                        function ($branch) {
                            return
                                [
                                    'id' => $branch->id,
                                    'name' => $branch->name,
                                    'type' => $branch->type,
                                    'currency' => $branch->currency,
                                    'branches' => $branch->bankBranch->address,
                                    'delete' => BankBalance::where('account_id', $branch->id)->first() ? false : true,
                                ];
                        }
                    ),
                'companies' => Company::all()
                    ->map(function ($company) {
                        return [
                            'id' => $company->id,
                            'name' => $company->name,
                        ];
                    }),

                'years' => Year::where('company_id', session('company_id'))->get()
                    ->map(function ($year) {
                        $end = new Carbon($year->end);
                        $begin = new Carbon($year->begin);
                        return [
                            'id' => $year->id,
                            'begin' => $begin->format("F j Y"),
                            'end' => $end->format("F j Y"),
                        ];
                    }),

                'branches' => BankBranch::all()
                    ->map(function ($branch) {
                        return [
                            'id' => $branch->id,
                            'address' => $branch->address,
                            'bank_id' => $branch->bank_id,
                            'name' => $branch->bank->name,
                        ];
                    }),
            ],

        );
    }

    //BankAccount Create
    public function create()
    {
        $data  = BankBranch::all()->map->only('bank_id')->first();
        if ($data) {
            return Inertia::render('Accounts/Create', [
                'branches' => BankBranch::all()
                    ->map(function ($branch) {
                        return [
                            'id' => $branch->id,
                            'address' => $branch->address,
                            'bank_id' => $branch->bank_id,
                            'name' => $branch->bank->name,
                        ];
                    }),
            ]);
        } else {
            return Redirect::route('branches.create', 'accounts')->with('success', 'Create Branch First');
        }
    }

    public function store(Req $request)
    {
        // dd($request);
        Request::validate([
            'accounts.*.name' => 'required|unique:App\Models\BankAccount,name',
            'accounts.*.type' => ['required'],
            'accounts.*.currency' => ['required'],

        ]);

        $accounts = $request->accounts;
        foreach ($accounts as $acc) {
            BankAccount::create([
                'name' => $acc['name'],
                'type' => $acc['type'],
                'currency' => $acc['currency'],
                'branch_id' => $acc['branch_id'],
                'company_id' => session('company_id'),
            ]);
        }


        return Redirect::route('accounts')->with('success', 'Bank Account created.');
    }

    //BankAccount Show
    public function show($id)
    {
        //
    }

    //BankAccount Edit
    public function edit()
    {
        return Inertia::render(
            'Accounts/Edit',
            [
                'data' => BankAccount::where('company_id', session('company_id'))->get(),
            ]
        );
    }

    //BankAccount Update
    public function update(Req $request, BankAccount $account)
    {
        Request::validate([
            'balances.*.name' => 'required',
        ]);


        foreach ($request->balances as $account) {

            $acc = BankAccount::find($account['id']);
            $acc->update([

                'name' => $account['name'],
                'type' => $account['type'],
                'currency' => $account['currency'],
            ]);
        }
        return Redirect::route('accounts')->with('success', 'Bank Account updated.');
    }
    //BanKAccount Delete
    public function destroy(BankAccount $account)
    {
        $account->delete();
        return Redirect::back()->with('success', 'Bank Account deleted.');
    }
}
