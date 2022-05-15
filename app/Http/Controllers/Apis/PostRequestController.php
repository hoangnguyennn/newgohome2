<?php

namespace App\Http\Controllers\Apis;

use App\Exports\PostRequestsExport;
use App\Http\Controllers\Controller;
use Excel;

class PostRequestController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new PostRequestsExport, 'ds-yeu-cau.xlsx');
    }
}
