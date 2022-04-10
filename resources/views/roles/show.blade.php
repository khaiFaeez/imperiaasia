<x-app-layout>
 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Role') }}
        </h2>
         <div class="flex items-start justify-start mb-3">
            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> Back</a>
         </div>
    </x-slot>
    <x-slot name="slot">


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
</x-slot>
</x-app-layout>
