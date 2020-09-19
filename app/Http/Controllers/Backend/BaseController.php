<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use View;

class BaseController extends Controller 
{
    public function __construct()
    {
       $onuser = Auth::user();

       View::share( 'onuser', $onuser );
    }  

}
