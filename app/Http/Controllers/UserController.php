<?php
namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ExecutiveRole;
use App\Models\UserClub;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\ToastmasterWars\Transformers\UserTransformer;

class UserController extends Controller
{
    use SoftDeletes;

    /**
     * Custom\Transformers\UserTransformer
     */
    protected $userTransformer;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

        $clubs = Club::pluck('name', 'id');
        $executive_roles = ExecutiveRole::pluck('name', 'id');

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
        $userClub->club_id = $input['club_id'][0];
        $userClub->main_club = 1;
        $user->userClubs()->save($userClub);

        return redirect('users/create');
    }

    public function edit($id)
    {

        $user = User::find($id);
        $clubs = Club::pluck('name', 'id');

        $relatedClubs = $user->clubs()->getRelatedIds()->toArray();

        return view('users.edit', compact('user', 'clubs', 'relatedClubs'));
    }

    /**
     * Update a users details
     * @param $id
     */
    public function update($id) {
        $user = User::findOrFail($id);
        $input = Input::all();
        $user->fill($input)->save();
        $user->clubs()->sync($input['club_id']);
        return redirect()->route('users.view');
    }

    /**
     * Delete a users association with any club
     * @param $id
     */
    public function delete($id) {
        $user = User::findOrFail($id);
        $user->userClubs()->delete();
        return redirect()->route('users.view');
    }

    /**
     * Display all current active users
     */
    public function view() {
        /**
         * Get list of users who aren't deleted, and get the name of their club
         */
        $users = User::with('userClubs', 'userClubs.club')->whereHas('userClubs', function($query) {
            $query->where('date_left', null);
        })->orderBy('first_name')->orderBy('last_name')->get()->toArray();

        return view('users.view', compact('users'));
    }
}

