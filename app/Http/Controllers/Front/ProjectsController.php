<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Projectvisit;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::all()[0];
    }

    public function index() {

        SEOMeta::setTitle( __('messages.projects') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.projects') . '  - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.projects') . ' - ' . $this->settings['title']);

        \General::seoProjects();

        $projects = Project::active()->get();
        return view('front.pages.projects', compact('projects'));
    }

    public function show($slug) {


        $project = Project::where('slug', $slug)->first();

        \General::singleProject($slug);

        $related = Project::where('slug', '!=' , $slug)->get();

        return view('front.pages.single_project', compact('project', 'related'));
    }
}
