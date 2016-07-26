<?php
namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ExecutiveRole;
use App\Models\UserClub;
use App\Models\ExecutiveRoleClub;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {

        $users = User::latest()->get();
        $x = 1;
        return view('users/index', compact('users'));
    }

    public function create()
    {
        $user = new User;

        $clubs = Club::lists('name', 'id');
        $executive_roles = ExecutiveRole::lists('name', 'id');

        return view('users.create', compact('user', 'clubs', 'executive_roles'));
    }

    public function show($id)
    {
        $user = User::with('scores.point.category')->findOrFail($id);

        // Find all scores for that user

        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'first_name' => 'required|min:5'
        ]);


        $user = User::create($input);

        $user_club = new UserClub();

        if (isset($input['executive_role_id']) && is_int($input['executive_role_id'])) {
            $executive_role_club = new ExecutiveRoleClub();
            $executive_role_club->club_id = $input['club_id'];
            $executive_role_club->user_id = $user->id;
            $executive_role_club->executive_role_id = $input['executive_role_id'];
            $executive_role_club->period_id = 1;
            $executive_role_club->save();
        }

        $user->userClubs()->save(
            new UserClub([
                'club_id' => $input['club_id'],
                'is_member' => 1,
                'main_club' => 1,
                'date_joined' => $input['date_joined'],
            ])
        );

        return redirect('users/create');
    }

    public function edit($id)
    {
        $user = User::find($id);

        $clubs = Club::lists('name', 'id');
        $executive_roles = ExecutiveRole::lists('name', 'id');


        return view('users.edit', compact('user', 'clubs', 'executive_roles'));
    }

    public function update (User $user)
    {

        $user->update(Request::all());

        return back();
    }
}

