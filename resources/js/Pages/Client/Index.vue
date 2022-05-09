<script>
import { ref } from 'vue';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import { Head,Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);


export default {
    props:[
        'clients'
    ],
    components:{
        Pagination,
        AppLayout,
        Head,
        Link
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.client.show',{'client': data.id,'portfolio':this.$page.props.portfolio}), '_self');
        }
    }
}

</script>

<template>
<Head title="Client List"/>
<AppLayout>

<h1 class="mb-8 text-3xl font-bold">
    <Link class="text-primary hover:text-primary-focus" href="/client">Client</Link>
</h1>
<section class="flex flex-row items-start mb-5">

    <Link :href="route('portfolio.client.create',{portfolio:route().params.portfolio})" v-if="route().current('*.client.*')" class="btn btn-primary text-white">
        Create Client
    </Link>
</section>
<div class="overflow-auto">
<table class="table table-compact table-bordered w-full">
<thead>
 <tr>
    <th>Name</th>
    <th>IC Number</th>
    <th>State</th>
    <th>Mobile Number</th>
    <th>Last Purchase</th>
 </tr>
 </thead>
 <tbody>
  <tr class="hover hover:cursor-pointer" v-for="($client,i) in clients.data" :key="i" @click="goToViewPage($client)">
                <td>{{ $client.Name}}</td>
                <td>{{ $client.MyKad_SSM}}</td>
                <td>{{ $client.state?.Negeri }}</td>
                <td>{{ $client.Mobile_No }}</td>
                <td>{{ $client.invoice }}</td>
  </tr>
 </tbody>
</table>
<pagination class="mt-6" :links="clients.links" />
</div>
</AppLayout>

</template>
