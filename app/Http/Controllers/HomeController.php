<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Project;
use App\Models\Company;
class HomeController extends Controller
{
    public function index()
    {
        // Get the count of students, companies, and projects
        $studentCount = Student::count();
        $companyCount = Company::count();
        $projectCount = Project::count();
    
        // Get count of projects in progress (status not 'completed')
        $projectsInProgress = Project::where('status', 'In Progress')->count();
    
        // Get count of completed projects
        $completedProjects = Project::where('status', 'Completed')->count();
    
        // Get all projects data
        $projects = Project::paginate(3);  // 3 projects per row * 3 rows
    
        // Return the data to the view
        return view('welcome', compact('studentCount', 'companyCount', 'projectCount', 'projectsInProgress', 'completedProjects', 'projects'));
    }

    public function about()
    {
        // Get the count of students, companies, and projects
        $studentCount = Student::count();
        $companyCount = Company::count();
        $projectCount = Project::count();
    
        // Get count of projects in progress (status not 'completed')
        $projectsInProgress = Project::where('status', 'In Progress')->count();
    
        // Get count of completed projects
        $completedProjects = Project::where('status', 'Completed')->count();
    
        // Get all projects data
        $projects = Project::paginate(3);  // 3 projects per row * 3 rows
    
        // Return the data to the view
        return view('about', compact('studentCount', 'companyCount', 'projectCount', 'projectsInProgress', 'completedProjects', 'projects'));
    }

    public function projects()
    {
        // Get the count of students, companies, and projects
        $studentCount = Student::count();
        $companyCount = Company::count();
        $projectCount = Project::count();
    
        // Get count of projects in progress (status not 'completed')
        $projectsInProgress = Project::where('status', 'In Progress')->count();
    
        // Get count of completed projects
        $completedProjects = Project::where('status', 'Completed')->count();
    
        // Get all projects data
        $projects = Project::paginate(3);  // 3 projects per row * 3 rows
    
        // Return the data to the view
        return view('projects', compact('studentCount', 'companyCount', 'projectCount', 'projectsInProgress', 'completedProjects', 'projects'));
    }
    public function mainPage()
    {
        // You can pass any data to the main page view, similar to how it's done in the index method.
        $projects = Project::all();  // Example of fetching all projects, you can filter or paginate
        return view('mainpage', compact('projects'));  // Return view with the data
    }

    public function contact()
    {
        // You can pass any data to the main page view, similar to how it's done in the index method.
        $projects = Project::all();  // Example of fetching all projects, you can filter or paginate
        return view('contact', compact('projects'));  // Return view with the data
    }
}
