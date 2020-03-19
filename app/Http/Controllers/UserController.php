<?php
namespace App\Http\Controllers;
use App\User_reg;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
     public function showlist(){

        //return response()->json(User_reg::get());
        $users = DB::table('user_regs')->get();
        return response()->json($users);
        
        //https://restfulapi.net/http-status-codes/
         //return response()->json(User_reg::get(),200);

    }
    public function showlistById($id){
        $user = DB::table('user_regs')->where('id',$id)->first();
        return response()->json($user);
    	//return response()->json(User_reg::find($id));
    	//return response()->json(User_reg::find($id),200);
    }
    public function savelist(Request $request){
        
        $fname = $request->f_name;
        $lname = $request->l_name;
        $dob = $request->dob;
        $gender = $request->gender;
        $username = $request->username;
        $password = $request->password;
        $list=DB::table('user_regs')->insert(
        ['f_name' => $fname, 'l_name' => $lname,'dob' => $dob,'gender' => $gender,'username' => $username,'password' => $password]
        );
    	//$list = User_reg::create($request->all());
    	//return response()->json($list,201);
    	 return response()->json($list);
    }
    public function editlist(Request $request ,$id){
        
        $fname = $request->f_name;
        $lname = $request->l_name;
        $dob = $request->dob;
        $gender = $request->gender;
        $username = $request->username;
        $password = $request->password;
        
         $article=DB::table('user_regs')
         ->where('id', $id)
         ->update(
        ['f_name' => $fname, 'l_name' => $lname,'dob' => $dob,'gender' => $gender,'username' => $username,'password' => $password]
        );
        
        
        
    	//$article = User_reg::find($id);
    	//$article->update($request->all());
    	return response()->json($article);
    }
    public function deletelist(Request $request ,$id){
    	//$article = User_reg::find($id);
    	//$article->delete();
    	$articl = DB::table('user_regs')->where('id',$id)->delete();
    	return response()->json($article);
    }

    public function login(Request $request){

    	$cre=request(['username','password']);
    	$username =  $cre['username'];
    	$password =  $cre['password'];

    	$logqry=DB::table('user_regs')
        ->where('username',$username)
        ->first();
         if(is_null($logqry)){
        	
        	return response()->json("Incorrect Username");
        	//sending multiple
        	//return response()->json(array('dsdsd','dsdsd'));
        }
        elseif (($username==$logqry->username)&&($password==$logqry->password)) {

        	return response()->json("Login Success");
        }
        else{

        	return response()->json("Incorrect Password");
        }
    }
}
