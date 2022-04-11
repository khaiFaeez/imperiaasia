<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Invoice as InvoiceResource;
use App\Models\Invoice;
use Validator;


class InvoiceController extends BaseController
{

    public function index()
    {
        $invoice = Invoice::all();
        return $this->handleResponse(InvoiceResource::collection($invoice), 'Invoice have been retrieved!');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'mykad' => 'required',
            'invoice_no' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $invoice = Invoice::create($input);
        return $this->handleResponse(new InvoiceResource($invoice), 'Invoice created!');
    }


    public function show($id)
    {
        $invoice = Invoice::find($id);
        if (is_null($invoice)) {
            return $this->handleError('Invoice not found!');
        }
        return $this->handleResponse(new InvoiceResource($invoice), 'Invoice retrieved.');
    }


    public function update(Request $request, Invoice $invoice)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'mykad' => 'required',
            'invoice_no' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $invoice->MyKad_SSM = $input['mykad'];
        $invoice->Inv_No = $input['invoice_no'];
        $invoice->save();

        return $this->handleResponse(new InvoiceResource($invoice), 'Invoice successfully updated!');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return $this->handleResponse([], 'Invoice deleted!');
    }
}
