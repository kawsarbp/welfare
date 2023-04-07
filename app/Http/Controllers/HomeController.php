<?php

namespace App\Http\Controllers;

use App\Models\AllMember;
use App\Models\Death;
use App\Models\HelpCategory;
use App\Models\KhairatMembers;
use App\Models\User;
use App\Models\WelfareService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function users(){
        $users = User::all();
        return view('users', compact('users'));
    }

    public function summaryData(Request $request){
        $cyear = Carbon::today()->format('Y');
        if($request->get == 'years'){
            $startY = $cyear - 6;
            $end = ($cyear);
        }elseif($request->get == 'months'){
            $startY = 1;
            $end = 12;
            if(isset($request->year)){
                $cyear = $request->year;
            }
        }
        $death = [];
        $asnaf = [];
        $khairat = [];
        $welfare = [];
        for($start = $startY; $start <= $end; $start++){
            if($request->get == 'years'){
                array_push($death, [$start => Death::whereYear('date_of_death', $start)->get()->count()]);
                array_push($asnaf, [$start => WelfareService::where('help_cat_id', '=', HelpCategory::where('name', 'like', 'Asnaf')->first()->id)->whereYear('date_apply', $start)->get()->count()]);
                array_push($khairat, [$start => KhairatMembers::whereYear('member_start_date', $start)->get()->count()]);
                array_push($welfare, [$start => WelfareService::whereYear('date_apply', $start)->get()->count()]);

            }elseif($request->get == 'months'){
                array_push($death, [Carbon::parse($start.'/01/'. $cyear)->format('F Y') => Death::whereMonth('date_of_death', $start)->whereYear('date_of_death', $cyear)->get()->count()]);
                array_push($asnaf, [Carbon::parse($start.'/01/'. $cyear)->format('F Y') => WelfareService::where('help_cat_id', '=', HelpCategory::where('name', 'like', 'Asnaf')->first()->id)->whereMonth('date_apply', $start)->whereYear('date_apply', $cyear)->get()->count()]);
                array_push($khairat, [Carbon::parse($start.'/01/'. $cyear)->format('F Y') => KhairatMembers::whereMonth('member_start_date', $start)->whereYear('member_start_date', $cyear)->get()->count()]);
                array_push($welfare, [Carbon::parse($start.'/01/'. $cyear)->format('F Y') => WelfareService::where('help_cat_id', '=', HelpCategory::where('name', 'like', 'Welfare')->first()->id)->whereMonth('date_apply', $start)->whereYear('date_apply', $cyear)->get()->count()]);
            }
        }

        $response['death'] = $death;
        $response['asnaf'] = $asnaf;
        $response['khairat'] = $khairat;
        $response['welfare'] = $welfare;

        return response($response);
    }

    public function summary(){
        return view('summary');
    }

    public function setting(){
        $user = Auth::user();
        return view('settings', compact('user'));
    }

    public function updateUser(Request $request,User $user){
        $request->validate([
            'name' => 'required',
        ]);

        $user->name = $request->name;

        $user->update();
        $message = trans('lang.user_updated_successfully_alert');
        return redirect('setting')->with('alert-success', $message);

    }

    public function changePassword(Request $request,User $user){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(password_verify($request->old_password , $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->update();
            $message = trans('lang.password_change_successfully_alert');
            return redirect('setting')->with('alert-success', $message);
        }else{
            $message = trans('lang.old_password_is_wrong_alert');
            return redirect('setting')->with('alert-warning', $message);
        }

    }

    public function dataList(Request $request){
        $members_data = AllMember::where('name', 'LIKE', '%'.$request->search['value'].'%')->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir'])->offset($request->start)->limit($request->length)->get()->toArray();
        $members = AllMember::where('name', 'LIKE', '%'.$request->search['value'].'%')->offset($request->start)->paginate($request->length)->toArray();

        $data = [];
        foreach ($members_data as $member){
            $data[] = array(
                'id' => $member['id'],
                'name' => $member['name'],
                'ic_no' => $member['ic_no'],
                'home_address1' => $member['home_address1'],
                'member_status' => memberStatus($member['member_status_ids'])
            );
        }
        return response(array(
                "start" => $request->start,
                "draw" => $request->draw,
                "data" => $data,
                "recordsTotal" => $members['total'],
                "recordsFiltered" => $members['total']
            )
        );
    }
}
