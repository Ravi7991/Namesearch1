@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Police Record Details</h1>
        <div>
            <a href="{{ route('police.edit', $police->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit Record
            </a>
            <a href="{{ route('police.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Records
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Case Number: {{ $police->case_number }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Personal Information</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p>{{ $police->first_name }} {{ $police->middle_name }} {{ $police->last_name }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Date of Birth</label>
                        <p>{{ $police->date_of_birth ? $police->date_of_birth->format('Y-m-d') : 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gender</label>
                        <p>{{ ucfirst($police->gender ?? 'N/A') }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5 class="mb-3">Contact Information</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Address</label>
                        <p>{{ $police->address ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Phone Number</label>
                        <p>{{ $police->phone ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Identification Number</label>
                        <p>{{ $police->identification_number ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Incident Details</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Incident Date</label>
                        <p>{{ $police->incident_date ? $police->incident_date->format('Y-m-d') : 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Incident Location</label>
                        <p>{{ $police->incident_location ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p>
                            @if($police->status === 'open')
                                <span class="badge bg-success">Open</span>
                            @else
                                <span class="badge bg-secondary">Closed</span>
                            @endif
                        </p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5 class="mb-3">Additional Information</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p>{{ $police->description ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Incident Details</label>
                        <p>{{ $police->incident_details ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="mb-3">Phonetic Codes</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Original Value</th>
                                    <th>Phonetic Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($police->phoneticCodes as $code)
                                <tr>
                                    <td>{{ ucfirst(str_replace('_', ' ', $code->field_name)) }}</td>
                                    <td>{{ $code->original_value }}</td>
                                    <td>{{ $code->phonetic_code }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Record History</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Created By</label>
                        <p>{{ $police->creator->name ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p>{{ $police->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                    
                    @if($police->updated_by)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Last Updated By</label>
                        <p>{{ $police->updater->name ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Last Updated At</label>
                        <p>{{ $police->updated_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 