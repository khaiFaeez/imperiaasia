<script>
import { ref } from 'vue'
import AppLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import { Head, Link } from '@inertiajs/inertia-vue3'
import SearchFilter from '@/Components/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
const showingNavigationDropdown = ref(false)

export default {
    props: ['clients', 'filters'],
    data() {
        return {
            form: {
                search: this.filters.search
            }
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(
                    route('portfolio.client.index'),
                    pickBy(this.form),
                    { preserveState: true }
                )
            }, 150)
        }
    },
    components: {
        Pagination,
        AppLayout,
        Head,
        Link,
        SearchFilter
    },
    created: function () {
        this.moment = moment
    },
    methods: {
        goToViewPage(data) {
            this.$inertia.get(
                route('portfolio.client.show', { client: data.id })
            )
        },
        reset() {
            this.form = {
                search: null
            }
        }
    }
}
</script>

<template>
    <Head title="Client List" />
    <AppLayout>
        <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/client"
                >Client</Link
            >
        </h1>
        <section class="flex flex-row items-center justify-between mb-4">
            <search-filter
                v-model="form.search"
                class="mr-4 w-full max-w-md"
                @reset="reset"
            >
            </search-filter>
            <div class="btn-group bg-white">
                <Link
                    :href="
                        route('portfolio.client.create', {
                            portfolio: route().params.portfolio
                        })
                    "
                    v-if="hasAnyPermission(['client-create'])"
                    class="btn btn-primary btn-sm"
                >
                    New Client
                </Link>
            </div>
        </section>
        <div class="overflow-auto">
            <table
                class="table table-compact table-bordered w-full"
                v-if="clients.data.length > 0"
            >
                <thead>
                    <tr>
                        <th width="10%">Name</th>
                        <th width="10%">IC Number</th>
                        <th width="10%">State</th>
                        <th width="10%">Mobile Number</th>
                        <th width="10%">Last Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="hover hover:cursor-pointer"
                        v-for="($client, i) in clients.data"
                        :key="i"
                        @click="goToViewPage($client)"
                    >
                        <td>{{ $client.Name }}</td>
                        <td>{{ $client.MyKad_SSM }}</td>
                        <td>{{ $client.state?.Negeri }}</td>
                        <td>{{ $client.Mobile_No }}</td>
                        <td>{{ $client.invoice }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-else>
                <Link
                    :href="
                        route('portfolio.client.create', {
                            portfolio: route().params.portfolio
                        })
                    "
                    v-if="hasAnyPermission(['client-create'])"
                    class="text-3xl underline text-primary"
                >
                    Create new Client
                </Link>
            </div>
            <pagination class="mt-6" :links="clients.links" />
        </div>
    </AppLayout>
</template>
