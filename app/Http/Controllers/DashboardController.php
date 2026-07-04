<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalStudents          = Student::count();
        $activeCourses          = Course::active()->count();
        $totalRevenue           = Payment::paid()->sum('amount');
        $outstanding            = Invoice::sum('balance');
        $recentPayments         = Payment::with('invoice.enrollment.student')
                                    ->where('status', 'paid')
                                    ->latest()
                                    ->take(5)
                                    ->get();

        $outstandingInvoices    = Invoice::with('enrollment.student')
                                    ->where('balance', '>', 0)
                                    ->orderByDesc('balance')
                                    ->limit(5)
                                    ->get();

        return view('dashboard.index', compact(
            'totalStudents',
            'activeCourses',
            'totalRevenue',
            'outstanding',
            'recentPayments',
            'outstandingInvoices',
        ));
    }
}
