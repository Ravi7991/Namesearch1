@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard</h1>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold">Total Records</h5>
                            <h2 class="mb-0">{{ $totalRecords ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-folder fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('police.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold">Open Cases</h5>
                            <h2 class="mb-0">{{ $openCases ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-folder-open fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('police.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold">Closed Cases</h5>
                            <h2 class="mb-0">{{ $closedCases ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-folder-minus fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('police.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold">Search</h5>
                            <p class="mb-0">Find Records</p>
                        </div>
                        <i class="fas fa-search fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('search') }}">Search Records</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Recent Records
                </div>
                <div class="card-body">
                    @if(isset($recentRecords) && count($recentRecords) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Case Number</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRecords as $record)
                                <tr>
                                    <td>{{ $record->case_number }}</td>
                                    <td>{{ $record->first_name }} {{ $record->last_name }}</td>
                                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if($record->status === 'open')
                                            <span class="badge bg-success">Open</span>
                                        @else
                                            <span class="badge bg-secondary">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('police.show', $record->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center">No records found.</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('police.index') }}" class="btn btn-sm btn-primary">View All Records</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-bullhorn me-1"></i>
                    Quick Actions
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('police.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus me-2"></i> Add New Record
                        </a>
                        <a href="{{ route('search') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-search me-2"></i> Search Records
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    System Information
                </div>
                <div class="card-body">
                    <p><strong>User:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
                    <p><strong>Last Login:</strong> {{ Auth::user()->last_login_attempt ? Auth::user()->last_login_attempt->format('Y-m-d H:i:s') : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
