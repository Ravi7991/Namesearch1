<?php

namespace App\Http\Controllers;

use App\Models\PoliceRecord;
use App\Models\PhoneticCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;

class PoliceRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the records.
     */
    public function index()
    {
        $records = PoliceRecord::orderBy('created_at', 'desc')->paginate(10);
        return view('police.index', compact('records'));
    }

    /**
     * Show the form for creating a new record.
     */
    public function create()
    {
        return view('police.create');
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'identification_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'incident_details' => 'nullable|string',
            'incident_date' => 'nullable|date',
            'incident_location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);
        
        // Generate a unique case number
        $validated['case_number'] = 'CASE-' . date('Y') . '-' . Str::random(8);
        $validated['created_by'] = Auth::id();
        
        $record = PoliceRecord::create($validated);
        
        // Add phonetic codes if provided
        if ($request->has('phonetic_codes')) {
            foreach ($request->phonetic_codes as $field => $code) {
                if (!empty($code)) {
                    PhoneticCode::create([
                        'record_id' => $record->id,
                        'field_name' => $field,
                        'original_value' => $validated[$field] ?? '',
                        'phonetic_code' => $code,
                        'phonetic_algorithm' => 'manual',
                    ]);
                }
            }
        }
        
        return redirect()->route('police.index')->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified record.
     */
    public function show(PoliceRecord $police)
    {
        return view('police.show', compact('police'));
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit(PoliceRecord $police)
    {
        $phoneticCodes = $police->phoneticCodes->pluck('phonetic_code', 'field_name')->toArray();
        return view('police.edit', compact('police', 'phoneticCodes'));
    }

    /**
     * Update the specified record in storage.
     */
    public function update(Request $request, PoliceRecord $police)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'identification_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'incident_details' => 'nullable|string',
            'incident_date' => 'nullable|date',
            'incident_location' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);
        
        $validated['updated_by'] = Auth::id();
        $police->update($validated);
        
        // Update phonetic codes if provided
        if ($request->has('phonetic_codes')) {
            foreach ($request->phonetic_codes as $field => $code) {
                if (!empty($code)) {
                    // Update or create the phonetic code
                    PhoneticCode::updateOrCreate(
                        [
                            'record_id' => $police->id,
                            'field_name' => $field
                        ],
                        [
                            'original_value' => $validated[$field] ?? '',
                            'phonetic_code' => $code,
                            'phonetic_algorithm' => 'manual',
                        ]
                    );
                }
            }
        }
        
        return redirect()->route('police.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified record from storage.
     */
    public function destroy(PoliceRecord $police)
    {
        $police->delete();
        return redirect()->route('police.index')->with('success', 'Record deleted successfully.');
    }
}
