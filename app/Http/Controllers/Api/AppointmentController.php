<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments (Admin Only).
     */
    public function index(Request $request): JsonResponse
    {
        $query = Appointment::with('service')->orderBy('appointment_date', 'asc')->orderBy('appointment_time', 'asc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    /**
     * Store a newly created appointment booking (Public).
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        
        // Check for double bookings on the exact same date & time slot
        $exists = Appointment::where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This appointment slot is already reserved. Please select another time.'
            ], 409);
        }

        // Set default values
        $validated['status'] = 'pending';
        $validated['duration_minutes'] = 30; // 30-min briefing
        
        // Use static recurring meeting link from .env or fallback
        $validated['meeting_link'] = env('MEETING_LINK', 'https://meet.google.com/pb-mock-link');

        $appointment = Appointment::create($validated);

        // Send email notification to owner
        try {
            $toEmail = env('CONTACT_NOTIFICATION_EMAIL', 'hi@peshalb.com.np');
            \Illuminate\Support\Facades\Mail::to($toEmail)->send(new \App\Mail\AppointmentBookedMail($appointment));
            \Illuminate\Support\Facades\Log::info("Notification: Sent appointment scheduled email to {$toEmail}");
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send appointment email notification: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Your briefing slot has been scheduled successfully. Admin confirmation is pending.',
            'data' => $appointment->load('service')
        ], 201);
    }

    /**
     * Update an appointment status or details (Admin Only).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $appointment = Appointment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'meeting_link' => 'nullable|url',
            'notes' => 'nullable|string',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Appointment details updated successfully.',
            'data' => $appointment->load('service')
        ]);
    }

    /**
     * Remove the specified appointment from storage (Admin Only).
     */
    public function destroy(string $id): JsonResponse
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appointment schedule deleted successfully.'
        ]);
    }
}
