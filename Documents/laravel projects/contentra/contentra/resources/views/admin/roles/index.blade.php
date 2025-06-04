
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

<h1 class="text-2xl font-bold text-white mb-4">Manage User Roles</h1>

@foreach ($users as $user)
    <div class="bg-gray-800 p-4 mb-4 rounded">
        <h2 class="text-white font-semibold">{{ $user->name }} ({{ $user->email }})</h2>
        <form method="POST" action="{{ route('admin.roles.assign', $user->id) }}">
            @csrf
            <select name="role" class="p-2 rounded">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <button class="bg-blue-600 text-white px-3 py-1 rounded">Assign Role</button>
        </form>
    </div>
@endforeach
</div>
@endsection