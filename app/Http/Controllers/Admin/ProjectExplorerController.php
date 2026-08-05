<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ProjectExplorerController extends Controller
{
    public function index()
    {
        $tables = DB::select("
    SELECT name 
    FROM sqlite_master 
    WHERE type='table'
    AND name NOT LIKE 'sqlite_%'
");

        $models = collect(File::files(app_path('Models')))
            ->map(fn ($file) => $file->getFilenameWithoutExtension());

        $routes = collect(Route::getRoutes())
            ->map(function ($route) {
                return [
                    'method' => implode('|', $route->methods()),
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'action' => $route->getActionName(),
                ];
            });

        $migrations = collect(File::files(database_path('migrations')))
            ->map(fn ($file) => $file->getFilename());

        return view('admin.dashboard.project-explorer', [
            'tables' => $tables,
            'models' => $models,
            'routes' => $routes,
            'migrations' => $migrations,
        ]);
    }
}
