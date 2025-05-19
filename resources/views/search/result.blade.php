@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Search Results</h1>
        <a href="{{ route('search') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>New Search
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Search Parameters</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Search Term:</strong> {{ $query }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Field:</strong> {{ ucfirst(str_replace('_', ' ', $field)) }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Search Type:</strong> {{ ucfirst($searchType) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Results ({{ $results->total() }} found)</h5>
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
                                <a href="{{ route('police.show', $record->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('police.edit', $record->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $results->appends(['query' => $query, 'field' => $field, 'search_type' => $searchType])->links() }}
            </div>
            @else
            <div class="alert alert-info">
                No records found matching your search criteria.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
