@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Task</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        @include('tasks.form')
    </form>
</div>
@endsection
