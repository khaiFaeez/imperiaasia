<script>
import { ref } from 'vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'

const showingNavigationDropdown = ref(false);


export default {
    components:{
        Pagination,
        AppLayout,
        Link,
        Head
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        }
    }
}

</script>

<template>
<Head title="Invoice List" />
<AppLayout>
<section class="flex flex-row items-start mb-5">
    <Link :href="route('portfolio.invoice.create',{portfolio:route().params.portfolio})" v-if="route().current('*.invoice.*')" class="btn btn-primary text-white">
        Create Invoice
    </Link>
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
                <td>{{ $invoice.MyKad_SSM }}</td>
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
<pagination class="mt-6" :links="$page.props.invoices.links" />
</div>
</AppLayout>

</template>
