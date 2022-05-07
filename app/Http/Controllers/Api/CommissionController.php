<?php

namespace App\Http\Controllers\Api;

use App\Commission;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\Command;

class CommissionController extends Controller
{
    public function index()
    {
        return Commission::latest();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCommission(Request $request, $idProject)
    {
        $com = new Commission();
        if ($request->commissionType == "rate") {
            $com->commission_rate = $request->commission_value;
        }
        if ($request->commissionType == "value") {
            $com->commission_value = $request->commission_value;
        }
        $pro = Project::find($idProject);
        $com->start_date = $pro->start_date;
        $com->end_date = $pro->end_date;
        $com->id_project = $idProject;

        $com->save();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commission_id)
    {
        $commission = Commission::find($commission_id);

        $this->validate($request, [
            // 'commission_rate' => 'integer',
            // 'commission_value' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
        ]);
        if ($request->commissionType == "rate") {
            $commission->commission_rate = $request->commission_value;
            $commission->commission_value = null;
        }
        if ($request->commissionType == "value") {
            $commission->commission_rate = null;
            $commission->commission_value = $request->commission_value;
        }
        $commission->start_date = $request->start_date;
        $commission->end_date = $request->end_date;
        $commission->save();


        return ['message' => 'update the commission info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commission = Commission::findOrFail($id);

        //delete the user
        $commission->delete();
        return ['message' => 'user deleted'];
    }

    public function search()
    {
        if ($search = \Request::get('q')) {
            $commissions = Commission::where(function ($query) use ($search) {
                $query->where('id', 'LIKE', "%$search%");
            })->paginate(20);
        }

        return $commissions;
    }
}
