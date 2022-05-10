<script>
import { ref } from 'vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import BreezeInput from '@/Components/Input.vue'
import SearchFilter from '@/Components/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'

const showingNavigationDropdown = ref(false);


export default {
    props:[
        'invoice','filters'
    ],
     data() {
        return {
        form: {
            search: this.filters.search,
        },
        }
    },
     watch: {
        form: {
        deep: true,
        handler: throttle(function () {
            this.$inertia.get(route('portfolio.invoice.index',{'portfolio':this.$page.props.portfolio}), pickBy(this.form), { preserveState: true })
        }, 150),
        },
    },
    components:{
        Pagination,
        AppLayout,
        Head,
        Link,
        SearchFilter,
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        },
         reset() {
            this.form = {
            search: null,
            }
         }
    }
}
</script>

<template>
<Head title="Invoice List" />
<AppLayout>
<h1 class="mb-8 text-3xl font-bold">
    <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
</h1>
<section class="flex flex-row items-center justify-between mb-5">
    <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
</section>
<div class="overflow-auto">
<table class="table table-compact table-bordered w-full">
<thead>
 <tr>
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
    <th>Ship Postcode</th>
    <th>Ship City</th>
    <th>Ship State</th>
    <th>Ship Country</th>

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
  <tr class="hover hover:cursor-pointer" v-for="$invoice in $page.props.invoices.data" :key="$invoice.Id" @click="goToViewPage($invoice)">
                <!-- <td>{{ $invoice.status}}</td>
                <td>{{ $invoice.aging}} Days</td>
                <td>{{ $invoice.inv_no }}</td>
                <td>Date</td>
                <td>{{ $invoice.id_number }}</td>
                <td>{{ $invoice.name }}</td>
                <td>{{ $invoice.ship_phone }}</td>
                <td>{{ $invoice.ship_name }}</td>
                <td>{{ $invoice.ship_address1 }}</td>
                <td>{{ $invoice.ship_address2 }}</td>
                <td>{{ $invoice.ship_postcode }}</td>
                <td>{{ $invoice.ship_city }}</td>
                <td>{{ $invoice.ship_state}}</td>
                <td>{{ $invoice.ship_country }}</td>

                <td>{{ $invoice.product_name}}</td>
                <td>{{ $invoice.price }}</td>
                <td>{{ $invoice.qty }}</td>
                <td>{{ $invoice.total_rm }}</td>

                <td>Grand Total</td>
                <td>Paid Total</td>
                <td>Overdue Amount</td>
                <td>{{$invoice.consultant}}</td>
                <td>{{$invoice.channel}}</td>

                <td>{{ $invoice.ptp1}}</td>
                <td>{{ $invoice.ptp2 }}</td>
                <td>{{ $invoice.ptp3 }}</td>
                <td>{{ $invoice.ptp4 }}</td>

                <td>{{ $invoice.created_by }}</td>
                <td>{{ $invoice.created_at }}</td> -->

                <td>{{ $invoice.Status_Inv}}</td>
                <td>{{ $invoice.Aging}} Days</td>
                <td>{{ $invoice.Inv_No }}</td>
                <td>Date</td>
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

                <td>{{ $invoice.product?.Product_Name}}</td>
                <td>{{ $invoice.Price }}</td>
                <td>{{ $invoice.Qty }}</td>
                <td>{{ $invoice.Total_RM }}</td>

                <td>Grand Total</td>
                <td>Paid Total</td>
                <td>Overdue Amount</td>
                <td>{{$invoice.Consultant}}</td>
                <td>{{$invoice.channel?.Name}}</td>

                <td>{{  moment($invoice.Promise_pay1).format('LL')}}</td>
                <td>{{  moment($invoice.Promise_pay2).format('LL') }}</td>
                <td>{{  moment($invoice.Promise_pay3).format('LL') }}</td>
                <td>{{  moment($invoice.Promise_pay4).format('LL') }}</td>

                <td>{{ $invoice.Created_By }}</td>
                <td>{{ moment($invoice.Created_Date).format('LL') }}</td>
  </tr>
 </tbody>
</table>
</div>
<pagination class="mt-6" :links="$page.props.invoices.links" />
</AppLayout>

</template>
