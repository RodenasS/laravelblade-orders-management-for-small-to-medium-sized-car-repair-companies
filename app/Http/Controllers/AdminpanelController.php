<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyInformation;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class AdminpanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = DB::table('users')->paginate(12);
        $companies = CompanyInformation::all();

        return view('adminpanel', compact('users', 'companies'));
    }
}
