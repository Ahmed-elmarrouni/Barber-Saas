<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Mockery\Exception;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservations = Reservation::with('user', 'barber')->paginate(10);
            return response()->json(['reservations' => $reservations]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'barber_id' => 'required|exists:barbers,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:pending,done',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $reservation = Reservation::create($request->all());
            return response()->json(['reservation' => $reservation], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $reservation = Reservation::with('user', 'barber')->findOrFail($id);
            return response()->json(['reservation' => $reservation]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id',
            'barber_id' => 'exists:barbers,id',
            'appointment_date' => 'date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'price' => 'numeric',
            'status' => 'in:pending,done',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->update($request->all());
            return response()->json(['reservation' => $reservation]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return response()->json(['message' => 'Reservation deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
