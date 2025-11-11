<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Employee;
use App\Models\CashRegister;
use App\Models\Transaction;
use App\Models\Invoice;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $hotelCount = Hotel::count();
        $roomCount = Room::count();
        $guestCount = Guest::count();
        $reservationCount = Reservation::count();
        $serviceCount = Service::count();
        $employeeCount = Employee::count();
        
        // Chambres disponibles
        $availableRooms = Room::where('is_available', true)->count();
        
        // Réservations par statut
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $confirmedReservations = Reservation::where('status', 'confirmed')->count();
        $checkedInReservations = Reservation::where('status', 'checked_in')->count();
        $checkedOutReservations = Reservation::where('status', 'checked_out')->count();
        $cancelledReservations = Reservation::where('status', 'cancelled')->count();
        
        // Employés actifs/inactifs
        $activeEmployees = Employee::where('is_active', true)->count();
        $inactiveEmployees = Employee::where('is_active', false)->count();
        
        // Statistiques de la caisse
        $cashRegisterCount = CashRegister::count();
        $totalCashBalance = CashRegister::sum('balance');
        $todayIncome = Transaction::where('type', 'income')
            ->whereDate('transaction_date', Carbon::today())
            ->sum('amount');
        $todayExpense = Transaction::where('type', 'expense')
            ->whereDate('transaction_date', Carbon::today())
            ->sum('amount');
        $monthlyIncome = Transaction::where('type', 'income')
            ->whereMonth('transaction_date', Carbon::now()->month)
            ->whereYear('transaction_date', Carbon::now()->year)
            ->sum('amount');
        $monthlyExpense = Transaction::where('type', 'expense')
            ->whereMonth('transaction_date', Carbon::now()->month)
            ->whereYear('transaction_date', Carbon::now()->year)
            ->sum('amount');
        
        // Statistiques des factures
        $invoiceCount = Invoice::count();
        $pendingInvoices = Invoice::where('status', 'pending')->count();
        $paidInvoices = Invoice::where('status', 'paid')->count();
        $overdueInvoices = Invoice::where('status', 'overdue')->count();
        $totalInvoiceAmount = Invoice::sum('total_amount');
        
        // Réservations des 7 derniers jours
        $recentReservations = Reservation::with(['guest', 'room'])
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Chambres les plus réservées
        $popularRooms = Room::withCount('reservations')
            ->with('hotel')
            ->orderBy('reservations_count', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard.index', compact(
            'hotelCount',
            'roomCount',
            'guestCount',
            'reservationCount',
            'serviceCount',
            'employeeCount',
            'cashRegisterCount',
            'totalCashBalance',
            'todayIncome',
            'todayExpense',
            'monthlyIncome',
            'monthlyExpense',
            'invoiceCount',
            'pendingInvoices',
            'paidInvoices',
            'overdueInvoices',
            'totalInvoiceAmount',
            'availableRooms',
            'pendingReservations',
            'confirmedReservations',
            'checkedInReservations',
            'checkedOutReservations',
            'cancelledReservations',
            'activeEmployees',
            'inactiveEmployees',
            'recentReservations',
            'popularRooms'
        ));
    }
}