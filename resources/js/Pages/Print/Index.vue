<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue'
 import Multiselect from '@vueform/multiselect'
import { Inertia } from '@inertiajs/inertia'
import InertiaTable from 'inertia-table'
import Pagination from '@/Components/Pagination'

export default {
    props:[
        'invoices','from','to','limit','ids'
    ],
     data() {
        return {
        search: this.$inertia.form({
            from: this.from,
            to: this.to,
            limit:this.limit
        }),
        selected_id: this.$inertia.form({
            ids:[]
        }),
        selected : this.ids,
         selectAll : true
        }
    },
    components:{
        Pagination,
        AppLayout,
        Head,
        Link,
        BreezeInput
    },
    methods: {
        submit() {
            this.search.get(route('portfolio.print.view.invoice'), {
                onFinish: (invoices) => console.log(invoices),
            });
        },
        reset() {
             window.open(route('portfolio.print.view.invoice'), '_self');
        },
         select() {
             this.selected = [];
			if (!this.selectAll) {
				for (let i in this.invoices) {
					this.selected.push(this.invoices[i].Id);
				}
			}
         },
         check_form1(event){

             if( this.selected.length > 0){
                 event.target.submit();
             }else{
                 alert('please select at least 1 invoice');
             }
         },
        check_form2(event){
             if( this.selected.length > 0){
                 event.target.submit();
             }else{
                 alert('please select at least 1 invoice');
             }
         }
    }
}

</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
<Head title="Invoice List" />
<AppLayout>
<h1 class="mb-8 text-2xl font-bold">
    <Link class="text-primary hover:text-primary-focus" href="/print">Print</Link>
</h1>


<form class="w-full max-w-xl my-8"  @submit.prevent="submit">
  <div class="md:flex md:items-center mb-6 ">
    <div class="md:w-1/3">
      <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Invoice Number
      </label>
    </div>
    <div class="md:w-1/3 mr-5">
      <BreezeInput
      v-model="search.from"
    />
    </div>
    ~
    <div class="md:w-1/3 ml-5">
       <BreezeInput
      v-model="search.to"
    />
    </div>
  </div>

  <div class="md:flex md:items-center mb-6 ">
    <div class="md:w-1/3">
      <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Max Pages
      </label>
    </div>


    <div class="md:w-1/3 mr-5">
      <select class="input" v-model="search.limit" >
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
      </select>
    </div>
  </div>

  <div class="md:flex md:items-center ">
    <div class="md:w-1/3"></div>
    <div class="md:w-1/3 ">
      <button class="btn btn-success" type="button" @click="submit">
        Search
      </button>
    </div>
    <div class="md:w-1/3 ">
       <button class="btn btn-error" type="button" @click="reset">
        Reset
      </button>
    </div>
  </div>
</form>

<div v-if="$page.props.invoices.length > 0">
<div class="flex justify-end gap-5 m-5">
<form :action="route('portfolio.print.invoices')" method="post" target="_blank" @submit.prevent="check_form1">
<input type="hidden" :value="$page.props.attribute_name" name="_token"/>
<input type="hidden" :value="selected" name="ids"/>
 <button  class="btn btn-primary" @click="check_form">Print Invoices</button>
 </form>
 <form :action="route('portfolio.print.dockets')" method="post" target="_blank" @submit.prevent="check_form2">
<input type="hidden" :value="$page.props.attribute_name" name="_token"/>
<input type="hidden" :value="selected" name="ids"/>
 <button  class="btn btn-secondary" @click="check_form">Print Docket</button>
 </form></div>

<div class="overflow-auto">
<table class="table table-compact table-bordered w-full">
<thead>
 <tr>
    <th>   <input type="checkbox" class="checkbox" v-model="selectAll" @click="select"> </th>
    <th>Inv No</th>
    <th>ID Card</th>
    <th>Name</th>
    <th>Ship Phone</th>
    <th>Ship Name</th>
    <th>Ship Address 1</th>
    <th>Ship Address 2</th>
    <th>Ship Postcode</th>
    <th>Ship City</th>
    <th>Ship State</th>
    <th>Ship Country</th>
 </tr>
 </thead>
 <tbody>
  <tr class="hover hover:cursor-pointer" v-for="$invoice in $page.props.invoices" :key="$invoice.Id" >
                <td><input type="checkbox" class="checkbox" :value="$invoice.Id" v-model="selected"></td>
                <td>{{ $invoice.Inv_No }}</td>

                <td>{{ $invoice.client.MyKad_SSM }}</td>
                <td>{{ $invoice.client.Name }}</td>
                <td>{{ $invoice.Ship_Phone }}</td>
                <td>{{ $invoice.Ship_Name }}</td>
                <td>{{ $invoice.Ship_Add1 }}</td>
                <td>{{ $invoice.Ship_Add2 }}</td>
                <td>{{ $invoice.Ship_poscode }}</td>
                <td>{{ $invoice.Ship_City }}</td>
                <td>{{ $invoice.state?.Negeri}}</td>
                <td>{{ $invoice.Ship_Country }}</td>
  </tr>
 </tbody>
</table>
</div>
</div>
</AppLayout>

</template>
