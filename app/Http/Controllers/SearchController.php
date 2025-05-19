<?php

namespace App\Http\Controllers;

use App\Models\PoliceRecord;
use App\Models\PhoneticCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search.index');
    }
    
    public function search(Request $request)
    {
        $query = $request->get('query');
        $searchType = $request->get('search_type', 'regular');
        $field = $request->get('field', 'all');
        
        if (empty($query)) {
            return view('search.index')
                ->with('error', 'Please enter a search term.');
        }
        
        if ($searchType === 'phonetic') {
            // Phonetic search using manually entered codes
            $results = $this->phoneticSearch($query, $field);
        } else {
            // Regular search
            $results = $this->regularSearch($query, $field);
        }
        
        return view('search.results', compact('results', 'query', 'searchType', 'field'));
    }
    
    private function phoneticSearch($query, $field)
    {
        $query = strtolower($query);
        
        // Search in the phonetic_codes table
        $phoneticQuery = PhoneticCode::query();
        
        // Filter by field if specified
        if ($field !== 'all') {
            $phoneticQuery->where('field_name', $field);
        }
        
        // Search for matching phonetic code
        $phoneticQuery->where('phonetic_code', 'like', "%{$query}%");
        
        // Get record IDs from matching phonetic codes
        $recordIds = $phoneticQuery->pluck('record_id')->unique()->toArray();
        
        // Retrieve the actual records
        $results = PoliceRecord::whereIn('id', $recordIds)->paginate(10);
        
        return $results;
    }
    
    private function regularSearch($query, $field)
    {
        $recordsQuery = PoliceRecord::query();
        
        if ($field === 'all' || $field === 'name') {
            $recordsQuery->where(function($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('middle_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%");
            });
        } elseif ($field === 'case_number') {
            $recordsQuery->where('case_number', 'like', "%{$query}%");
        } elseif ($field !== 'all') {
            $recordsQuery->where($field, 'like', "%{$query}%");
        }
        
        return $recordsQuery->paginate(10);
    }
    
    // Method to suggest phonetic codes (helper function)
    public function suggestPhoneticCode(Request $request)
    {
        $text = $request->get('text');
        $algorithm = $request->get('algorithm', 'metaphone');
        
        if (empty($text)) {
            return response()->json(['code' => '']);
        }
        
        if ($algorithm === 'soundex') {
            $code = soundex($text);
        } else {
            // Use metaphone as default (more accurate than soundex)
            $code = metaphone($text);
        }
        
        return response()->json(['code' => $code]);
    }
}
