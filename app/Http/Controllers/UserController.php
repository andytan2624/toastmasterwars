<?php
namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ExecutiveRole;
use App\Models\UserClub;
use App\Models\ExecutiveRoleClub;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Request;
use App\Custom\Transformers\UserTransformer;

class UserController extends Controller
{

    /**
     * Custom\Transformers\UserTransformer
     */
    protected $userTransformer;

    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function index()
    {
        $limit = Input::get('limit') ?: 3;
        $users = User::paginate($limit);

        return $this->respondWithPagination(
            $users,
            $this->userTransformer->transformCollection($users->getCollection())
        );
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
        $user = User::find($id);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        return $this->respond([
            'data' => $this->userTransformer->transform($user)
        ]);
    }

    public function store()
    {
        $input = Request::all();

        $user = User::create($input);

        $user_club = new UserClub();

        if (isset($input['executive_role_id']) && is_int($input['executive_role_id'])) {
            $executive_role_club = new ExecutiveRoleClub();
            $executive_role_club->club_id = $input['club_id'];
            $executive_role_club->user_id = $user->id;
            $executive_role_club->executive_role_id = $input['executive_role_id'];
            $executive_role_club->period_id = 1;
            $executive_role_club->save();
            $user_club->is_club_admin = 1;
        } else {
            $user_club->is_club_admin = 0;
        }

        $user_club->club_id = $input['club_id'];
        $user_club->user_id = $user->id;
        $user_club->is_member = 1;
        $user_club->main_club = 1;
        $user_club->date_joined = $input['date_joined'];
        $user_club->save();

        return redirect('users/create');

        /**
         * if (invalid)
         * {
         *  return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a lesson.');
         * }
         *
         * User::create($input);
         *
         * return $this->respondCreated('Lesson successfully created.');
         */
    }

    public function edit($id)
    {
        $user = User::find($id);

        $clubs = Club::lists('name', 'id');
        $executive_roles = ExecutiveRole::lists('name', 'id');


        return view('users.edit', compact('user', 'clubs', 'executive_roles'));
    }


}

