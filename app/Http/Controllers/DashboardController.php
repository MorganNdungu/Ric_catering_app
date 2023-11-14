<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Snack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;

class DashboardController extends Controller
{
    public function dashboard()
{
    $cakes = Cake::all();
    $snacks = Snack::all();
    // $packages = Package::all();

    return view('Dashboard', compact('cakes', 'snacks', 
    // 'packages'
));
}
}

