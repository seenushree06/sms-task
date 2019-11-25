<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
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

  
    public function index()
    {   

        $students = DB::table('students')->count();
        $teachers = DB::table('teachers')->count();
    
        return view('home',compact('students','teachers'));
    }
}
