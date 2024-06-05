<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admins\Pagesettings\Partner;
use Illuminate\Http\Request;
use App\Models\Admins\Pagesettings\Team;
use App\Models\Admins\Pagesettings\Testimonial;
use App\Models\Home;
use App\Models\Admins\Pagesettings\Blog;
use App\Models\Admins\Pagesettings\Service;
use App\Models\Admins\Pagesettings\ServiceFeatures;

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
    $data['partners'] = Partner::get();
    $data['blogs'] = Blog::take(2)->get();
    $data['services']= Service::take(4)->get();
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
public function publication($slug)
{
    // dd($slug);
    $data = array();
    $blog = Blog::where('slug',$slug)->first();
    $data['blog']= $blog;
    $data['related_blogs'] = Blog::where('category_id', $blog->category_id)
    ->where('id', '!=', $blog->id)
    ->take(2)
    ->get();

    return view('Frontend.blog.publication',$data);
}

public function service($id)
{
    $data = array();
    $service= Service::where('id',$id)->first();
    $data['service'] = $service;
    $data['service_features'] = ServiceFeatures::where('service_id',$service->id)->get();

    return view('Frontend.service.service',$data);
}



}
