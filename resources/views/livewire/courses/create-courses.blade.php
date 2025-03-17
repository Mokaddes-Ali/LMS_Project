@extends('layouts.master')

@section('content')

<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Course</h3>
        </div>
        <div class="card-body">
            {{-- Success & Error Messages --}}
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4" wire:model="description"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Course Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" wire:model="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($image)
                        <div class="mt-2">
                            <p>Image Preview:</p>
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" wire:model="price">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" wire:model="is_active">
                    <label class="form-check-label" for="is_active">Active Course</label>
                    @error('is_active')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading wire:target="store" class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
