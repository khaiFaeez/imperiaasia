<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit User') }}
        </h2>
         <div class="flex items-start justify-start">
            <a class="btn btn-ghost btn-sm" href="{{ route('users.index') }}"> Back</a>
         </div>
    </x-slot>

    <x-slot name="slot">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
       {{-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-error text-error-content']) !!}
        {!! Form::close() !!} --}}

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="flex flex-col gap-3">
    <div class="grid grid-cols-2">

            <strong>Username:</strong>
            {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'input input-bordered w-full text-primary max-w-md ')) !!}

    </div>
    <div class="grid grid-cols-2">

            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'input input-bordered w-full text-primary max-w-md')) !!}

    </div>

    <div class="grid grid-cols-2">

            <strong>Staff ID:</strong>
            {!! Form::text('staff_id', null, array('placeholder' => 'EN001','class' => 'input input-bordered w-full text-primary max-w-md')) !!}

    </div>

    <div class="grid grid-cols-2">

            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'select w-full text-primary max-w-md h-52','multiple')) !!}

    </div>
</div>
<div class="flex w-full justify-center mt-5">
        <button type="submit" class="btn btn-primary btn-lg">SAVE</button>
    </div>
{!! Form::close() !!}
</x-slot>
</x-app-layout>
