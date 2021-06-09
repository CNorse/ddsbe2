<?php

namespace App\Http\Controllers;

//use App\users;
use App\Models\User; // <-- your model
use App\Models\UserJob; // <-- userjob Model

use Illuminate\Http\Response; // <-- handling http response in lumen
use App\Traits\ApiResponser; // <-- use of standized our code for API response
use Illuminate\Http\Request; // <-- handling http request in lumen
use DB; // <-- if your not using lumen eloquent you can use DB component in lumen

class UserController extends Controller {
    use ApiResponser;

    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers(){

        // eloquent style
        // $users = Users::all();

        // sql string as parameters
        $users = DB::connection('mysql')
        ->select("Select * from tbluser");

        // return reponse()->json($users, 200);
        return $this->successResponse($users);
    }
    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        //return $users; // <-- not standardized return of data
        // return $this->successResponse($users);
        // return response()->json($users, 200);
        return $this->successResponse($users);
    }
    // Add Function
    public function add(Request $request) {
       
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];
         // use this rule to validate
        $this->validate($request,$rules);

        // validate if Jobid is found in the table tbluserjob
        $userjob = UserJob::findOrFail($request->jobid);
        $user = User::create($request->all());
        
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Obtain and show one author
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::findOrFail($id);
        return $this->successResponse($user);

        // old code
        /*
        $user = User::where('userid', $id)->first();
        if($user){
            return $this->successResponse($user);
        }
        {
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
        */
    }

    /**
     *  update an existing author
     *  @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        $userjob = UserJob::findOrFail($request->jobid);
        $user = User::findOrFail($id);

        $user->fill ($request->all());

        // if no change happpen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);

        // old code
        /*
        $this->validate($request, $rules);

        // $user = User::findOrFail($id);
        $user = User::where('userid', $id)->first();
        if($user){
            $user->fill($request->all());

            // if no changes happen
            if ($user->isclean()){
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user->save();
            return $this->successResponse($user);
            }
            {
                return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }   
        */
    }
    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);

        // old code
        /*
        $user = User::where('userid', $id)->first();
        if ($user){
            $user->delete();
            return $this->successResponse($user);
        }
        {
            return $this->errorResponse('UserID Does not Exists', Response::HTTP_NOT_FOUND);
        }
        */
    }
}

 
