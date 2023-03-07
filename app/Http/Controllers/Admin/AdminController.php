<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth",'admin']);
    }
    public function index()
    {
        $title = "Admin - Dashboard";
        $chartData = DB::table("posts")
            ->leftJoin("employees","posts.id","=","employees.post_id")
            ->groupBy("employees.post_id","posts.name")
            ->select("posts.name",DB::raw("count(employees.social_number) as count"))
            ->get();
        return view("admin.index",compact("title","chartData"));
    }

}
