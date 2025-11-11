<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Invoice;
use App\Models\Room;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        // Récupérer les notifications pour l'utilisateur actuel
        $user = auth()->user();
        
        // Notifications de réservations
        $upcomingReservations = [];
        if ($user->isAdmin() || $user->isEmployee()) {
            // Pour admin et employé, voir toutes les réservations à venir
            $upcomingReservations = Reservation::with(['guest', 'room'])
                ->where('check_in_date', '>=', Carbon::today())
                ->where('check_in_date', '<=', Carbon::today()->addDays(7))
                ->orderBy('check_in_date')
                ->get();
        } else {
            // Pour les clients, voir leurs propres réservations
            $upcomingReservations = Reservation::with(['room'])
                ->where('guest_id', $user->id)
                ->where('check_in_date', '>=', Carbon::today())
                ->where('check_in_date', '<=', Carbon::today()->addDays(7))
                ->orderBy('check_in_date')
                ->get();
        }
        
        // Notifications de factures impayées
        $unpaidInvoices = [];
        if ($user->isAdmin() || $user->isEmployee()) {
            // Pour admin et employé, voir toutes les factures impayées
            $unpaidInvoices = Invoice::with('guest')
                ->where('status', 'pending')
                ->where('due_date', '<=', Carbon::today()->addDays(3))
                ->orderBy('due_date')
                ->get();
        } else {
            // Pour les clients, voir leurs propres factures impayées
            $unpaidInvoices = Invoice::where('guest_id', $user->id)
                ->where('status', 'pending')
                ->where('due_date', '<=', Carbon::today()->addDays(3))
                ->orderBy('due_date')
                ->get();
        }
        
        // Notifications de chambres disponibles
        $availableRooms = Room::where('is_available', true)
            ->with('hotel')
            ->limit(5)
            ->get();
        
        return view('notifications.index', compact(
            'upcomingReservations',
            'unpaidInvoices',
            'availableRooms'
        ));
    }
    
    public function markAsRead($id)
    {
        // Marquer une notification comme lue
        // Cette fonctionnalité peut être étendue avec un système de notifications en base de données
        return response()->json(['success' => true]);
    }
}