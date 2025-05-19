@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Search Police Records</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Advanced Search</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('search.results') }}" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="query" class="form-label">Search Term</label>
                            <input type="text" class="form-control" id="query" name="query" placeholder="Enter search term..." value="{{ request('query') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="field" class="form-label">Field</label>
                            <select class="form-select" id="field" name="field">
                                <option value="all" {{ request('field') == 'all' ? 'selected' : '' }}>All Fields</option>
                                <option value="first_name" {{ request('field') == 'first_name' ? 'selected' : '' }}>First Name</option>
                                <option value="last_name" {{ request('field') == 'last_name' ? 'selected' : '' }}>Last Name</option>
                                <option value="case_number" {{ request('field') == 'case_number' ? 'selected' : '' }}>Case Number</option>
                                <option value="identification_number" {{ request('field') == 'identification_number' ? 'selected' : '' }}>ID Number</option>
                                <option value="address" {{ request('field') == 'address' ? 'selected' : '' }}>Address</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="search_type" class="form-label">Search Type</label>
                            <select class="form-select" id="search_type" name="search_type">
                                <option value="regular" {{ request('search_type') == 'regular' ? 'selected' : '' }}>Regular</option>
                                <option value="phonetic" {{ request('search_type') == 'phonetic' ? 'selected' : '' }}>Phonetic</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">About Phonetic Search</h5>
        </div>
        <div class="card-body">
            <p>The phonetic search feature can help you find records based on how names sound, rather than how they are spelled. This is particularly useful when:</p>
            <ul>
                <li>Names have alternative spellings (e.g., Smith, Smyth, Smythe)</li>
                <li>Names were recorded incorrectly due to pronunciation issues</li>
                <li>Foreign names were transliterated differently</li>
            </ul>
            <p>To use this feature effectively, select "Phonetic" as the search type and enter your search term. The system will match records based on phonetic similarity.</p>
        </div>
    </div>
</div>
@endsection
