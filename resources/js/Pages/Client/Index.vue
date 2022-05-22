<script>
import { ref } from 'vue';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import { Head,Link } from '@inertiajs/inertia-vue3';
import SearchFilter from '@/Components/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
const showingNavigationDropdown = ref(false);


export default {
    props:[
        'clients','filters'
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
            this.$inertia.get(route('portfolio.client.index'), pickBy(this.form), { preserveState: true })
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
            window.open(route('portfolio.client.show',{'client': data.id}), '_self');
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
<Head title="Client List"/>
<AppLayout>

<h1 class="mb-8 text-3xl font-bold">
    <Link class="text-primary hover:text-primary-focus" href="/client">Client</Link>
</h1>
<section class="flex flex-row items-center justify-between mb-5">
    <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
      </search-filter>
    <Link :href="route('portfolio.client.create',{portfolio:route().params.portfolio})" v-if="route().current('*.client.*')" class="btn btn-primary text-white">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
    </svg>
        Create Client
    </Link>
</section>
<div class="overflow-auto">
<table class="table table-compact table-bordered w-full" v-if="clients.data.length > 0">
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
<div v-else>
   <Link :href="route('portfolio.client.create',{portfolio:route().params.portfolio})" v-if="route().current('*.client.*')" class="text-3xl underline text-primary">
        Create new Client
    </Link>
</div>
<pagination class="mt-6" :links="clients.links" />
</div>
</AppLayout>

</template>
