<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Employee;
use App\Models\Invoice;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'all');
        
        $results = [];
        
        // Recherche selon le type sélectionné
        switch ($type) {
            case 'hotels':
                $results = $this->searchHotels($query);
                break;
            case 'rooms':
                $results = $this->searchRooms($query);
                break;
            case 'guests':
                $results = $this->searchGuests($query);
                break;
            case 'reservations':
                $results = $this->searchReservations($query);
                break;
            case 'employees':
                $results = $this->searchEmployees($query);
                break;
            case 'invoices':
                $results = $this->searchInvoices($query);
                break;
            case 'all':
            default:
                $results = [
                    'hotels' => $this->searchHotels($query),
                    'rooms' => $this->searchRooms($query),
                    'guests' => $this->searchGuests($query),
                    'reservations' => $this->searchReservations($query),
                    'employees' => $this->searchEmployees($query),
                    'invoices' => $this->searchInvoices($query),
                ];
                break;
        }
        
        return view('search.results', compact('results', 'query', 'type'));
    }
    
    private function searchHotels($query)
    {
        return Hotel::where('name', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->orWhere('city', 'LIKE', "%{$query}%")
            ->orWhere('country', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
    }
    
    private function searchRooms($query)
    {
        return Room::where('room_number', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('floor', 'LIKE', "%{$query}%")
            ->with(['hotel', 'roomType'])
            ->get();
    }
    
    private function searchGuests($query)
    {
        return Guest::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->get();
    }
    
    private function searchReservations($query)
    {
        return Reservation::where('id', 'LIKE', "%{$query}%")
            ->orWhere('status', 'LIKE', "%{$query}%")
            ->orWhere('special_requests', 'LIKE', "%{$query}%")
            ->with(['guest', 'room'])
            ->get();
    }
    
    private function searchEmployees($query)
    {
        return Employee::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->orWhere('position', 'LIKE', "%{$query}%")
            ->get();
    }
    
    private function searchInvoices($query)
    {
        return Invoice::where('invoice_number', 'LIKE', "%{$query}%")
            ->orWhere('status', 'LIKE', "%{$query}%")
            ->orWhere('notes', 'LIKE', "%{$query}%")
            ->with(['guest', 'reservation'])
            ->get();
    }
}