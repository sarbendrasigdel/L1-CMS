<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Pagesettings\Team;
use App\Models\Admins\Pagesettings\Testimonial;
use App\Models\Home;

class FrontendController extends Controller
{
public function home()
{
    $data = array();
    $data['founders']= Team::where('position','founder')
    ->where('featured',1)
    ->take(2)
    ->get();
    $data['teams']= Team::where('position','!=','founder')
    ->where('featured',1)
    ->take(2)
    ->get();
    $data['homepageInfo'] = Home::first();
    $data['founderImg'] = Team::where('position','founder')->first();
    $data['testimonials']= Testimonial::get();
    return view('Frontend.home.index',$data);
}

public function teams()
{
    $data = array();
    $data['teams'] = Team::get();
    return view('Frontend.about.team',$data);
}


public function services()
{

    return view('Frontend.service.services');
}
public function portfolio()
{

    return view('Frontend.portfolio.index');
}
public function contact()
{

    return view('Frontend.about.contact');
}
public function blog()
{

    return view('Frontend.blog.index');
}
public function publication()
{

    return view('Frontend.blog.publication');
}



}
