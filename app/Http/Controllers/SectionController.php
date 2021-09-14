<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
 
class SectionController extends Controller
{
    public function show_section()
    {
        // dd(22);
        $myArray['section']=Section::get();
        // $myArray['isAdmin']=Auth::user()->is_admin;
       
        return view('section/section')->with($myArray);
    }
// vjezba za postmen
    public function addSection()
    {
        return ["Result"=>"Dodao si sekciju"];
    }
}