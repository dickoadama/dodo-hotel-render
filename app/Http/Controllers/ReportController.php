<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Employee;
use App\Models\CashRegister;
use App\Models\Transaction;
use App\Models\Invoice;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
    
    public function occupancy()
    {
        // Rapport d'occupation des chambres
        $hotels = Hotel::all();
        
        // Statistiques globales
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('is_available', false)->count();
        $availableRooms = Room::where('is_available', true)->count();
        
        // Taux d'occupation global
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 2) : 0;
        
        // Réservations par statut
        $reservationsByStatus = [
            'pending' => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'checked_in' => Reservation::where('status', 'checked_in')->count(),
            'checked_out' => Reservation::where('status', 'checked_out')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];
        
        // Occupation par hôtel
        $occupancyByHotel = [];
        foreach ($hotels as $hotel) {
            $hotelRooms = Room::where('hotel_id', $hotel->id)->count();
            $hotelOccupiedRooms = Room::where('hotel_id', $hotel->id)
                ->where('is_available', false)->count();
            
            $hotelOccupancyRate = $hotelRooms > 0 ? round(($hotelOccupiedRooms / $hotelRooms) * 100, 2) : 0;
            
            $occupancyByHotel[] = [
                'hotel' => $hotel,
                'total_rooms' => $hotelRooms,
                'occupied_rooms' => $hotelOccupiedRooms,
                'available_rooms' => $hotelRooms - $hotelOccupiedRooms,
                'occupancy_rate' => $hotelOccupancyRate
            ];
        }
        
        return view('reports.occupancy', compact(
            'totalRooms',
            'occupiedRooms',
            'availableRooms',
            'occupancyRate',
            'reservationsByStatus',
            'occupancyByHotel'
        ));
    }
    
    public function financial()
    {
        // Rapport financier
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        
        // Revenus totaux
        $totalRevenue = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_amount');
        
        // Dépenses totales
        $totalExpenses = Transaction::where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');
        
        // Bénéfice net
        $netProfit = $totalRevenue - $totalExpenses;
        
        // Transactions par type
        $incomeTransactions = Transaction::where('type', 'income')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');
        
        $expenseTransactions = Transaction::where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');
        
        // Factures par statut
        $invoicesByStatus = [
            'pending' => Invoice::where('status', 'pending')->count(),
            'paid' => Invoice::where('status', 'paid')->count(),
            'overdue' => Invoice::where('status', 'overdue')->count(),
            'cancelled' => Invoice::where('status', 'cancelled')->count(),
        ];
        
        // Revenus par mois (12 derniers mois)
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenue = Invoice::where('status', 'paid')
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total_amount');
            
            $monthlyRevenue[] = [
                'month' => $month->format('M Y'),
                'revenue' => $revenue
            ];
        }
        
        return view('reports.financial', compact(
            'totalRevenue',
            'totalExpenses',
            'netProfit',
            'incomeTransactions',
            'expenseTransactions',
            'invoicesByStatus',
            'monthlyRevenue'
        ));
    }
    
    public function guest()
    {
        // Rapport sur les clients
        $totalGuests = Guest::count();
        
        // Nouveaux clients ce mois
        $newGuestsThisMonth = Guest::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // Clients les plus fréquents
        $frequentGuests = Guest::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->limit(10)
            ->get();
        
        // Répartition par pays (si disponible)
        $guestsByCountry = Guest::select('country')
            ->groupBy('country')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'country' => $item->country ?? 'Non spécifié',
                    'count' => Guest::where('country', $item->country)->count()
                ];
            });
        
        return view('reports.guest', compact(
            'totalGuests',
            'newGuestsThisMonth',
            'frequentGuests',
            'guestsByCountry'
        ));
    }
    
    public function export(Request $request)
    {
        // Fonction d'export de rapports (à implémenter)
        $type = $request->input('type', 'occupancy');
        
        // Pour l'instant, on redirige vers le rapport correspondant
        switch ($type) {
            case 'financial':
                return redirect()->route('reports.financial');
            case 'guest':
                return redirect()->route('reports.guest');
            case 'occupancy':
            default:
                return redirect()->route('reports.occupancy');
        }
    }
}