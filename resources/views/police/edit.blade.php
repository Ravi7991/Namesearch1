@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Police Record</h1>
        <a href="{{ route('police.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Records
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('police.update', $police->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Personal Information</h5>
                        
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $police->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name', $police->middle_name) }}">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $police->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $police->date_of_birth ? $police->date_of_birth->format('Y-m-d') : '') }}">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $police->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $police->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $police->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="mb-3">Contact Information</h5>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $police->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $police->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="identification_number" class="form-label">Identification Number</label>
                            <input type="text" class="form-control @error('identification_number') is-invalid @enderror" id="identification_number" name="identification_number" value="{{ old('identification_number', $police->identification_number) }}">
                            @error('identification_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5 class="mb-3">Incident Details</h5>
                        
                        <div class="mb-3">
                            <label for="incident_date" class="form-label">Incident Date</label>
                            <input type="date" class="form-control @error('incident_date') is-invalid @enderror" id="incident_date" name="incident_date" value="{{ old('incident_date', $police->incident_date ? $police->incident_date->format('Y-m-d') : '') }}">
                            @error('incident_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="incident_location" class="form-label">Incident Location</label>
                            <input type="text" class="form-control @error('incident_location') is-invalid @enderror" id="incident_location" name="incident_location" value="{{ old('incident_location', $police->incident_location) }}">
                            @error('incident_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="open" {{ old('status', $police->status) == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="closed" {{ old('status', $police->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="mb-3">Additional Information</h5>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $police->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="incident_details" class="form-label">Incident Details</label>
                            <textarea class="form-control @error('incident_details') is-invalid @enderror" id="incident_details" name="incident_details" rows="3">{{ old('incident_details', $police->incident_details) }}</textarea>
                            @error('incident_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3">Phonetic Codes</h5>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Phonetic codes help in searching records when names might be spelled differently.
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phonetic_first_name" class="form-label">First Name Phonetic Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phonetic_first_name" name="phonetic_codes[first_name]" value="{{ old('phonetic_codes.first_name', $phoneticCodes['first_name'] ?? '') }}">
                                        <button type="button" class="btn btn-outline-secondary" onclick="suggestPhoneticCode('first_name')">
                                            <i class="fas fa-magic"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phonetic_middle_name" class="form-label">Middle Name Phonetic Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phonetic_middle_name" name="phonetic_codes[middle_name]" value="{{ old('phonetic_codes.middle_name', $phoneticCodes['middle_name'] ?? '') }}">
                                        <button type="button" class="btn btn-outline-secondary" onclick="suggestPhoneticCode('middle_name')">
                                            <i class="fas fa-magic"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phonetic_last_name" class="form-label">Last Name Phonetic Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phonetic_last_name" name="phonetic_codes[last_name]" value="{{ old('phonetic_codes.last_name', $phoneticCodes['last_name'] ?? '') }}">
                                        <button type="button" class="btn btn-outline-secondary" onclick="suggestPhoneticCode('last_name')">
                                            <i class="fas fa-magic"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function suggestPhoneticCode(field) {
    const input = document.getElementById(field);
    const phoneticInput = document.getElementById(`phonetic_${field}`);
    
    if (!input.value) {
        alert('Please enter a name first');
        return;
    }
    
    fetch('{{ route("search.suggest-phonetic") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            text: input.value,
            algorithm: 'metaphone'
        })
    })
    .then(response => response.json())
    .then(data => {
        phoneticInput.value = data.code;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to generate phonetic code');
    });
}
</script>
@endpush
@endsection 