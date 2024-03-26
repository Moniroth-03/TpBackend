<!-- form.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>

    <!-- {!! Form::open(['route' => 'products.store', 'method' => 'post']) !!} -->
    {!! Form::open(['route' => 'products.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

    <section class="m-auto flex flex-col space-y-4 bg-pink-200 items-center justify-center w-[500px]">
        <div class="form-group gap-2 flex-1 w-full m-auto flex items-center justify-center">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', $categories->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pricing', 'Pricing') !!}
            {!! Form::text('pricing', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('images', 'Images') !!}
            {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Product', ['class' => 'btn btn-primary']) !!}
        </div>
    </section>

    {!! Form::close() !!}
@endsection
