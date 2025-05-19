@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Police Records</h1>
        <a href="{{ route('police.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Add New Record
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if(count($records) > 0)
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
                        @foreach($records as $record)
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
                                <a href="{{ route('police.edit', $record->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('police.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>No records found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
