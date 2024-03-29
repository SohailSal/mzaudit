<?php

namespace App\Http\Controllers;

use App\Models\BankConfirmation;
use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Company;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
// use App\Models\BankConfirmation;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,address'],
            'type' => [''],
        ]);
        // dd(request('type'));
        $query = Company::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        } else {
            $query->orderBy(('name'), ('asc'));
        }

        // Dashboard Data
        $balances = $query->paginate(10)
            ->through(
                function ($dash) {
                    $confirmations = request('type') == 'Advisor' ? $dash->advisorConfirmations()->get() : $dash->bankconfirmations()->get();
                    $total_sent = 0;
                    $total_recieve = 0;
                    $total_confirm = 0;
                    $confirm_create = "";
                    foreach ($confirmations as $confirmation) {
                        // dd($confirmation->received);
                        if ($confirmation->sent) {
                            $total_sent++;
                        }

                        if ($total_confirm == 0) {
                            $confirm_create = $confirmation->confirm_create;
                        }

                        if ($confirmation->received) {
                            $total_recieve++;
                        }

                        $total_confirm++;
                    }




                    return [
                        'id' => $dash->id,
                        'name' => $dash->name,
                        $confirm_create = $confirm_create ? new Carbon($confirm_create) : null,
                        'create_confirm' => $confirm_create ?  $confirm_create->format("M d Y") : null,
                        'total_confirm' => $total_confirm,
                        'total_sent' => $total_sent,
                        'reamaning' => $total_confirm - $total_recieve,
                    ];
                }
            );

        //UnConfirmation Record
        $companies = Company::all();
        $name = 0;
        $confirm = 0;
        foreach ($companies as $company) {
            if ($company->name) {
                $name++;
            }
                $get = request('type') == 'Advisor' ? $company->advisorConfirmations()->get()->first() : $company->bankConfirmations()->get()->first();
            if (!$get) {
                $confirm++;
            }
        }

        // dd($balances);
        return Inertia::render('Dashboard/Index', [

            'filters' => request()->all(['search', 'field', 'direction']),
            'balances' => $balances,
            'confirmation' => $confirm,
            'client' => $name,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
