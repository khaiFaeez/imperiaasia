<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Create New User') }}
        </h2>
         <div class="flex items-start justify-start">
            <a class="btn btn-ghost btn-sm" href="{{ route('users.index') }}"> Back</a>
         </div>
    </x-slot>

    <x-slot name="slot">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6">

            <x-label>Username:</x-label>
            {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'input input-bordered w-full text-primary ')) !!}

    </div>
    <div class="col-span-6">

            <x-label>Name:</x-label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'input input-bordered w-full text-primary')) !!}

    </div>

    <div class="col-span-6">

            <x-label>Staff ID:</x-label>
            {!! Form::text('staff_id', null, array('placeholder' => 'EN001','class' => 'input input-bordered w-full text-primary')) !!}

    </div>
    <div class="col-span-6">

            <x-label>Password:</x-label>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'input input-bordered w-full text-primary')) !!}

    </div>
    <div class="col-span-6">

            <x-label>Confirm Password:</x-label>
            {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' => 'input input-bordered w-full text-primary')) !!}

    </div>
    <div class="col-span-6">

            <x-label>Role:</x-label>
            {!! Form::select('roles[]', $roles,[], array('class' => 'select w-full text-primary h-52','multiple')) !!}

    </div>
</div>
<div class="flex w-full justify-end mt-5">
        <x-button>Submit</x-button>
    </div>
{!! Form::close() !!}
</x-slot>
</x-app-layout>
