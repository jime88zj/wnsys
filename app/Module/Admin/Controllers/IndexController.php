<?php
namespace App\Module\Admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller{
    use AuthenticatesUsers;
    private $redirectTo;
    public function index(){
        
    }
    public function username(){
        return "user_name";
    }
}