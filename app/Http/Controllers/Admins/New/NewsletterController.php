<?php

namespace App\Http\Controllers\Admins\New;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('admin.pagesettings.newsletter.index');
    }
}
