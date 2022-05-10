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
            this.$inertia.get(route('portfolio.client.index',{'portfolio':this.$page.props.portfolio}), pickBy(this.form), { preserveState: true })
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
            window.open(route('portfolio.client.show',{'client': data.id,'portfolio':this.$page.props.portfolio}), '_self');
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
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
    <Link :href="route('portfolio.client.create',{portfolio:route().params.portfolio})" v-if="route().current('*.client.*')" class="btn btn-primary text-white">
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
