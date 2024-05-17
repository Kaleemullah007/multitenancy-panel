<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Imports\ImportUser;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    // View import view
    public function importView()
    {

        return view('tenant.import');
    }

    // import file
    function import(Request $request)
    {
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }

    // export file csv or xlsx
    function exportUsers(Request $request)
    {

        if (in_array($request->format, array('csv', 'xlsx')))
            return Excel::download(new ExportUser, 'users.' . $request->format);
        else
            abort(403, "Invalid format type, It would be csv or xlsx"); //abort(404, );
    }
}
