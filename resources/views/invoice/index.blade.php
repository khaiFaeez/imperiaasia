
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

<div class="overflow-scroll">
<table class="table table-bordered w-full">
<thead>
 <tr>
    <th>Id</th>
    <th>Status</th>
    <th>Aging</th>
    <th>Inv No</th>
    <th>Date</th>
    <th>ID Card</th>
    <th>Name</th>
    <th>Ship Phone</th>
    <th>Ship Name</th>
    <th>Ship Address 1</th>
    <th>Ship Address 2</th>
    <th>Ship Poscode</th>
    <th>Ship City</th>
    <th>Ship State</th>
    <th>Ship Country</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>

    <th>Grand Total</th>
    <th>Paid Total</th>
    <th>Overdue Amount</th>
    <th>Consultant</th>
    <th>Channel</th>

    <th>PTP 1</th>
    <th>PTP 2</th>
    <th>PTP 3</th>
    <th>PTP 4</th>

    <th>Created By</th>
    <th>Created Date</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($invoices as $key => $invoice)

  <tr class="hover hover:cursor-pointer" onclick="location.href='{{ route('portfolio.invoice.show',['invoice'=>$invoice->Id,'portfolio'=>$portfolio]) }}';">
                <td>Id</td>
                <td>Status</td>
                <td>Aging</td>
                <td>{{ $invoice->Inv_No }}</td>
                <td>Date</td>
                <td>{{ $invoice->client->MyKad_SSM }}</td>
                <td>{{ $invoice->client->Name }}</td>
                <td>Ship Phone</td>
                <td>Ship Name</td>
                <td>Ship Address 1</td>
                <td>Ship Address 2</td>
                <td>Ship Poscode</td>
                <td>Ship City</td>
                <td>Ship State</td>
                <td>Ship Country</td>

                <td>Product</td>
                <td>U/Price</td>
                <td>Qty</td>
                <td>Total</td>

                <td>Product</td>
                <td>U/Price</td>
                <td>Qty</td>
                <td>Total</td>

                <td>Product</td>
                <td>U/Price</td>
                <td>Qty</td>
                <td>Total</td>

                <td>Product</td>
                <td>U/Price</td>
                <td>Qty</td>
                <td>Total</td>

                <td>Product</td>
                <td>U/Price</td>
                <td>Qty</td>
                <td>Total</td>

                <td>Grand Total</td>
                <td>Paid Total</td>
                <td>Overdue Amount</td>
                <td>Consultant</td>
                <td>Channel</td>

                <td>PTP 1</td>
                <td>PTP 2</td>
                <td>PTP 3</td>
                <td>PTP 4</td>

                <td>Created By</td>
                <td>Created Date</td>
  </tr>
 @endforeach
 </tbody>
</table>
</div>
 {{ $invoices->links() }}
</x-slot>
</x-app-layout>
