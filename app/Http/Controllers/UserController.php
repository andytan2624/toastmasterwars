<?php
namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ExecutiveRole;
use App\Models\UserClub;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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
        $limit = Input::get('limit') ?: 20;
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

    public function store(Request $request)
    {
        $input = $request->all();

        $user = User::create($input);

        $userClub = new UserClub($input);
        $userClub->main_club = 1;
        $user->userClubs()->save($userClub);

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

