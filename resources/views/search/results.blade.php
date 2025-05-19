@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Search Results</h1>
        <a href="{{ route('search') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Search
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                @if($searchType === 'phonetic')
                    Phonetic Search Results for "{{ $query }}"
                @else
                    Search Results for "{{ $query }}"
                @endif
            </h5>
        </div>
        <div class="card-body">
            @if(count($results) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Case Number</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $record)
                        <tr>
                            <td>{{ $record->case_number }}</td>
                            <td>{{ $record->first_name }} {{ $record->middle_name }} {{ $record->last_name }}</td>
                            <td>{{ $record->date_of_birth ? $record->date_of_birth->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                @if($record->status === 'open')
                                    <span class="badge bg-success">Open</span>
                                @else
                                    <span class="badge bg-secondary">Closed</span>
                                @endif
                            </td>
                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('police.show', $record->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $results->links() }}
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                No records found matching your search criteria.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 