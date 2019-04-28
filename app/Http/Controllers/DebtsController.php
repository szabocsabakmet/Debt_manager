<?php

namespace App\Http\Controllers;

use App\Debt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function debtsHome()
    {
        $sumdebts= DB::table('debts')
                                ->select(DB::raw('users.email,sum(money) as money'))
                                ->join('users','users.id','=','debts.payer_id')
                                ->where([
                                    ['owner_id',auth()->id()],
                                    ['completed',0],
                                ])
                                ->groupBy('email')
                                ->get();

        $sumnegdebts= DB::table('debts')
                                ->select(DB::raw('users.email,sum(money) as money'))
                                ->join('users','users.id','=','debts.owner_id')
                                ->where([
                                    ['payer_id',auth()->id()],
                                    ['completed',0],
                                ])
                                ->groupBy('email')
                                ->get();

        return view('debts.debtsHome',compact('sumdebts','sumnegdebts'));
    }


    public function archive()
    {
        $debts=Debt::where([
            ['owner_id',auth()->id()],
            ['completed',1],
        ])
            ->get();
        $negdebts=Debt::where([
            ['payer_id',auth()->id()],
            ['completed',1],
        ])  ->get();
        return view('debts.archive',compact('debts','negdebts'));
    }


    public function index()
    {
        $debts=Debt::where([
            ['owner_id',auth()->id()],
            ['completed',0],
        ])
            ->get();
        $negdebts=Debt::where([
            ['payer_id',auth()->id()],
            ['completed',0],
        ])  ->get();
        return view('debts.index',compact('debts','negdebts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::where('id','!=',auth()->id())->get();
        return view('debts.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $attributes=request()->validate([
            'who'           =>  'required',
            'money'         =>  'required',
            'description'   =>  'required'

        ]);

        Debt::create([
            'owner_id'      =>  auth()->id(),
            'payer_id'      =>  (DB::table('users')->where('email', request('who'))->first('id'))->id,
            'money'         =>  request('money'),
            'description'   =>  request('description')
        ]);

       return redirect('/debts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {
        abort_unless($debt->owner_id == auth()->id(),403);

        $users=User::where('id','!=',auth()->id())->get();

        return view('debts.edit',compact('debt','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Debt $debt)
    {
        abort_unless($debt->owner_id == auth()->id(),403);

        request()->validate([
            'who'           =>  'required',
            'money'         =>  'required',
            'description'   =>  'required'
            ]);

        $debt->owner_id=auth()->id();
        $debt->payer_id=(DB::table('users')->where('email', request('who'))->first('id'))->id;
        $debt->money=\request('money');
        $debt->description=\request('description');

        $debt->save();

        return redirect('/debts');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        abort_unless($debt->owner_id == auth()->id(),403);
        $debt->delete();
        return redirect('/debts');
    }

    public function complete($id)
    {
        $debt=Debt::findorfail($id);
        $debt->completed=true;
        $debt->save();
        return redirect('/debts');
    }

}
