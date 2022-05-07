<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Project;
use App\Notification;
use App\Commission;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Mail\NotifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CalendarController extends Controller
{
    public $table = 'calendars';

    public function addToCalendar(Request $request, $id_project, $year, $month, $day)
    {
        // $startDate = $request->start;
        // $endDate = $request->end;
        // $calendars = DB::table('calendars')->where('start', '>=', $request->start)
        // ->where('end', '<=', $request->end)->where('id_project', $id_project)->count();

        // for ($i=0; $i < $calendars; $i++) {
        //     $calendar = DB::table('calendars')->where('start', '>=', $request->start)
        //     ->where('end', '<=', $request->end)->where('id_project', $id_project)->first();
        //     DB::table('calendars')->where('id', $calendar->id)->delete();
        // }

        // $calendars = DB::table('calendars')->where('start', '<=', $request->end)
        // ->where('end', '>=', $request->end)->where('start', '>=', $request->start)->where('id_project', $id_project)->count();

        // for ($i=0; $i < $calendars; $i++) {
        //     $calendar = DB::table('calendars')->where('start', '<=', $request->end)
        //     ->where('end', '>=', $request->end)->where('start', '>=', $request->start)->where('id_project', $id_project)->first();
        //     DB::table('calendars')->where('id', $calendar->id)->delete();
        //     $endDate = $calendar->end;
        // }

        // $calendars = DB::table('calendars')->where('end', '<=', $request->end)
        // ->where('end', '>=', $request->start)->where('start', '<=', $request->start)->where('id_project', $id_project)->count();

        // for ($i=0; $i < $calendars; $i++) {
        //     $calendar = DB::table('calendars')->where('end', '<=', $request->end)
        //     ->where('end', '>=', $request->start)->where('start', '<=', $request->start)->where('id_project', $id_project)->first();
        //     DB::table('calendars')->where('id', $calendar->id)->delete();
        //     $startDate = $calendar->start;
        // }

        // $calendars = DB::table('calendars')->where('start', '<=', $request->start)
        // ->where('end', '>=', $request->end)->where('id_project', $id_project)->count();

        // for ($i=0; $i < $calendars; $i++) {
        //     $calendar = DB::table('calendars')->where('start', '<=', $request->start)
        //     ->where('end', '>=', $request->end)->where('id_project', $id_project)->first();
        //     DB::table('calendars')->where('id', $calendar->id)->delete();
        //     $startDate = $calendar->start;
        //     $endDate = $calendar->end;
        // }

        // $date1  = $startDate;
        // $date2  = $endDate;
        // $date1 = explode("-", $date1);
        // $date1 = $date1[2];
        // $date1 = intval($date1);
        // $date2 = explode("-", $date2);
        // $date2 = $date2[2];
        // $date2 = intval($date2);

        // $nbr = $date2 - $date1;

        // $calendar = new Calendar();
        // $calendar->start = $startDate;
        // $calendar->end = $endDate;
        // $calendar->nbrOfDays = $nbr;
        // $calendar->id_project = $id_project;

        // $calendar->save();
        $calendar = new Calendar();
        $calendar->start = $year . '-' . $month . '-' . $day;
        $calendar->end = $year . '-' . $month . '-' . $day;
        $calendar->id_project = $id_project;
        $calendar->save();


        return response()->json(['status' => 'success', 'data' => $calendar]);
    }

    public function getCalendars(Request $request, $user_id, $year, $month)
    {
        $cond = $year . '-' . $month . '%';
        $calendars = DB::table('calendars')->join('projects', 'projects.id', 'calendars.id_project')
        ->join('users', 'users.id', 'projects.id_provider')
        ->select(['calendars.id', 'projects.name AS title', 'projects.id AS id_project', 'users.id AS provider_id', 'calendars.start AS date', 'calendars.nbrOfDays'])
        ->where('projects.id_provider', $user_id)->where('start', 'like', $cond)
        ->get();
        return response()->json(['status' => 'success', 'data' => $calendars]);
    }

    public function isAvailableCalendar(Request $request, $start, $end, $id_project)
    {
        $calendars = DB::table('calendars')->where('start', 'like', $start)
        ->where('end', 'like', $end)->count();
        $calendars2 = DB::table('calendars')->where('id_project', '=', $id_project)->where('start', 'like', $start)
        ->where('end', 'like', $end)->count();
        $count = $calendars + $calendars2;
        if($calendars2 == 0 && $calendars <= 2) {
            return response()->json(['status' => 'success', 'data' => 'true']);
        }
        else {
            return response()->json(['status' => 'success', 'data' => 'false']);
        }
    }

    public function getNbrOfDays(Request $request, $id_project)
    {
        $data = json_decode($request->getContent());
        $nbr = 0;
        $nbr1 = 0;
        $nbr0 = DB::table('calendars')->where('id_project', $id_project)->sum('nbrOfDays');
        $nbr2 = DB::table('calendars')->where('id_project', '!=', $id_project)->sum('nbrOfDays');
        for ($i=1; $i <=31 ; $i++) {
            if ($i <10){
                $date1 = '2021-08-0' . $i;
                $date2 = '2021-08-0' . ($i+1);
                if ($i == 9){
                    $date2 = '2021-08-' . ($i+1);
                }
            }
            else {
                $date1 = '2021-08-' . $i;
                $date2 = '2021-08-' . ($i+1);
                if($i == 31) {
                    $date2 = '2021-09-01';
                }
            }
            if (DB::table('calendars')->where('start', '=', $date1)->where('end', '=', $date2)->where('id_project', '!=', 0)->count() == 0){
                $nbr1 = $nbr1 + 1;
            }
        }
        $nbrrr = DB::table('calendars')->where('nbrOfDays', '>', 1)->sum('nbrOfDays');
        $nbr1 = $nbr1 - $nbrrr;
        $nbr = $nbr0 - ($nbr1 / 2);
        return response()->json(['status' => 'success', 'data' => $nbr1]);

    }

    public function getCalendarsId(Request $request, $id_project)
    {
        $calendarsId = DB::table('calendars')->select(['id'])->where('id_project', $id_project)->get();
        return response()->json(['status' => 'success', 'data' => $calendarsId]);
    }

    public function deleteCalendar(Request $request, $id_calendar)
    {
        DB::table('calendars')->where('id', $id_calendar)->delete();
        return response()->json(['status' => 'success', 'data' => 'done']);
    }

    public function getAverageDailyRate(Request $request, $id_project)
    {
        $averageDailyRate = DB::table('projects')->select(['average_daily_rate'])->where('id', $id_project)->first();
        return response()->json(['status' => 'success', 'data' => $averageDailyRate]);
    }

}
