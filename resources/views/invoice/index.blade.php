
<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
               {{ Str::ucfirst($portfolio) }}
        </h2>
    </x-slot>

    <x-slot name="slot">
    @if ($message = Session::get('success'))

    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 1000)" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-show="show">
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    </div>
    @endif

    <a href="" class="btn btn-primary">Create Invoice</a>
    <a href="" class="btn btn-primary">Create Invoice</a>


<table class="table table-bordered w-full">
<thead>
 <tr>
   <th>No</th>
   <th>Invoice No</th>
   <th>Name</th>
   <th>IC Number</th>
   <th>Phone No</th>
 </tr>
 </thead>
 <tbody>
 @php
 $i = 0;
 @endphp
 @foreach ($invoices as $key => $invoice)

  <tr class="hover hover:cursor-pointer" onclick="location.href='{{ route('users.edit',$invoice->Id) }}';">
    <td>{{ ++$i }}</td>
    <td>{{ $invoice->Inv_No }}</td>
    <td>{{ $invoice->client->Name }}</td>
    <td>{{ $invoice->client->MyKad_SSM }}</td>
    <td>{{ $invoice->client->Phone }}</td>
  </tr>
 @endforeach
 {{ $invoices->links() }}
 </tbody>
</table>

</x-slot>
</x-app-layout>
