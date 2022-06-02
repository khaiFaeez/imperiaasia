<script>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination'
import { Inertia } from '@inertiajs/inertia'





export default {
    props:[
        'invoices'
    ],
     data() {
        return {
        selected : this.$page.props.selected,
        selectAll : false,
        }
    },
    components:{
        Pagination,
        AppLayout,
        Head,
        Link,
    },
    methods: {
         select() {
			if (!this.selectAll) {
				for (let i in this.invoices.data) {
					this.selected.push(this.invoices.data[i].Id);
				}
			}
         },
         check_form(event){
             if( this.selected.length > 0){
                 event.target.submit();
                //  Inertia.reload({ only: ['invoices'] });
                 window.location.reload();
             }else{
                 alert('please select at least 1 invoice');
             }
         },
    }
}

</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
<Head title="Invoice List" />
<AppLayout>

<h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
    <Link class="text-primary hover:text-primary-focus" href="/print">Print</Link>
</h1>

<div class="flex items-center justify-end gap-4">
                <form :action="route('portfolio.print.invoices')" method="post" target="_blank" @submit.prevent="check_form" v-if="$page.props.invoices.data.length > 0">
                <input type="hidden" :value="$page.props.attribute_name" name="_token"/>
                <input type="hidden" :value="selected" name="ids"/>
                <button  class="btn btn-primary" @click="check_form">
                  <i class="bi bi-printer text-xl mr-3"></i>
                    Print Invoices
                </button>
                </form>

                <form :action="route('portfolio.print.dockets')" method="post" target="_blank" @submit.prevent="check_form" v-if="$page.props.invoices.data.length > 0">
                <input type="hidden" :value="$page.props.attribute_name" name="_token"/>
                <input type="hidden" :value="selected" name="ids"/>
                <button  class="btn btn-secondary" @click="check_form">
                 <i class="bi bi-printer-fill text-xl mr-3"></i>
                Print Docket</button>
                </form>
</div>



<div class="overflow-auto my-5">
<table class="table table-compact table-bordered w-full">
<thead>
 <tr>
    <th><input type="checkbox" class="checkbox" v-model="selectAll" @click="select"> </th>
    <th class="w-8">Invoice Status</th>
    <th class="w-8">Docket Status</th>
    <th>Inv No</th>
    <th>ID Card</th>
    <th>Ship Phone</th>
    <th>Ship Name</th>
    <th>Ship Postcode</th>
    <th>Ship City</th>
    <th>Ship State</th>
 </tr>
 </thead>
 <tbody>
  <tr v-for="$invoice in $page.props.invoices.data" :key="$invoice.Id" >
                <td><input type="checkbox" class="checkbox" :value="$invoice.Id" v-model="selected"></td>
                <td><div class="badge text-white" :class='$invoice.Invoice_Status == "1" ? "badge-success " : "badge-error"'> <i :class='$invoice.Invoice_Status == "1" ? "bi bi-check-lg" : "bi bi-x-lg"'></i></div></td>
                <td><div class="badge text-white" :class='$invoice.Docket_Status == "1" ? "badge-success " : "badge-error"'> <i :class='$invoice.Docket_Status == "1" ? "bi bi-check-lg" : "bi bi-x-lg"'></i></div></td>
                <td>{{ $invoice.Inv_No }}</td>

                <td>{{ $invoice.client.MyKad_SSM }}</td>
                <td>{{ $invoice.Ship_Phone }}</td>
                <td>{{ $invoice.Ship_Name }}</td>
                <td>{{ $invoice.Ship_poscode }}</td>
                <td>{{ $invoice.Ship_City }}</td>
                <td>{{ $invoice.state?.Negeri}}</td>

  </tr>
 </tbody>
</table>
</div>
<pagination class="mt-6" :links="$page.props.invoices.links" />
</AppLayout>

</template>
