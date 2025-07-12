<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    try {
        // Test database connection
        DB::connection()->getPdo();
        $tables = DB::select('SHOW TABLES');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Database Connected!',
            'database' => env('DB_DATABASE'),
            'host' => env('DB_HOST'),
            'tables_count' => count($tables)
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error', 
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);
    }
});