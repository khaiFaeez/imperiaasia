<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New User') }}
        </h2>
         <div class="flex items-start justify-start mb-3">
            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> Back</a>
         </div>
    </x-slot>

    <x-slot name="slot">
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="flex flex-col gap-3">
    <div class="grid grid-cols-2">

            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'input input-bordered w-full max-w-xs')) !!}

    </div>
    <div class="grid grid-cols-2">

            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'input input-bordered w-full max-w-xs')) !!}

    </div>
    <div class="grid grid-cols-2">

            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'input input-bordered w-full max-w-xs')) !!}

    </div>
    <div class="grid grid-cols-2">

            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'input input-bordered w-full max-w-xs')) !!}

    </div>
    <div class="grid grid-cols-2">

            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'select w-full max-w-xs','multiple')) !!}

    </div>
    <div class="grid grid-cols-1 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</x-slot>
</x-app-layout>
