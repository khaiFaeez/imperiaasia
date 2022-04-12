<x-app-layout>
 <x-slot name="header">
        <h2 class="font-semibold text-xl  leading-tight">
            {{ __('Edit Role') }}
        </h2>
         <div class="flex items-start justify-start mb-3">
            <a class="btn btn-ghost btn-sm" href="{{ route('roles.index') }}"> Back</a>
         </div>
    </x-slot>
    <x-slot name="slot">



{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6">

            <x-label>Name:</x-label>

            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'input input-bordered w-full text-primary')) !!}

    </div>
     <div class="col-span-6">

            <x-label>Permission:</x-label>

           @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach

    </div>
</div>
    <div class="flex w-full justify-end mt-5">
        <button type="submit" class="btn btn-primary btn-lg">SAVE</button>
    </div>
{!! Form::close() !!}
</x-slot>
</x-app-layout>
