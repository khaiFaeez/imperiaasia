<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import moment from 'moment'

export default {
    props: ['client', 'states'],
    components: {
        AppLayout,
        Link,
        Head,
        ClientDisplay
    },
    created: function () {
        this.moment = moment
    },
    data() {
        return {
            isPending: this.client.invoices.find(
                (o) => o.Status_Inv === 'PENDING'
            )
        }
    }
}
</script>
<template>
    <Head title="View Client" />
    <AppLayout>
        <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/client"
                >Client</Link
            >
            <span class="text-primary font-medium">/</span> {{ client.Name }}
        </h1>
        <div class="alert alert-error shadow-lg mb-5" v-show="isPending">
            <div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current flex-shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span>This client have pending invoice</span>
            </div>
        </div>
        <div class="flex flex-row items-center justify-end mb-5 gap-3">
            <Link
                :href="route('portfolio.client.edit', { client: client.id })"
                class="hover:underline hover:text-primary hover:cursor-pointer"
                v-if="hasAnyPermission(['client-edit'])"
            >
                Edit Client
            </Link>

            <Link
                :href="
                    route('portfolio.invoice.create', { client_id: client.id })
                "
                class="btn btn-primary btn-sm"
                v-if="!isPending && hasAnyPermission(['invoice-create'])"
            >
                New Invoice
            </Link>
            <div class="btn btn-primary btn-sm btn-disabled" v-else>
                New Invoice
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 max-w-4xl">
            <ClientDisplay
                class="mb-12"
                :client="client"
                :states="$page.props.states"
            />

            <table class="table table-compact table-bordered w-full">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Inv No</th>
                        <th>Aging</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="invoice in $page.props.client.invoices"
                        :key="invoice.Id"
                    >
                        <td>
                            <div
                                class="badge text-white"
                                :class="
                                    invoice.Status_Inv == 'PAID'
                                        ? 'badge-success '
                                        : 'badge-warning'
                                "
                            >
                                {{ invoice.Status_Inv }}
                            </div>
                        </td>
                        <td>
                            <Link
                                class="hover:underline text-primary hover:cursor-pointer"
                                :href="
                                    route('portfolio.invoice.show', {
                                        invoice: invoice.Id
                                    })
                                "
                            >
                                {{ invoice.Inv_No }}
                            </Link>
                        </td>
                        <td>
                            {{
                                invoice.Date
                                    ? moment(
                                          moment().subtract(
                                              invoice.Aging,
                                              'days'
                                          )
                                      )
                                          .endOf('day')
                                          .fromNow()
                                    : ''
                            }}
                        </td>
                        <td>
                            {{
                                invoice.Date
                                    ? moment(invoice.Date).format('DD/MM/YYYY')
                                    : ''
                            }}
                        </td>
                        <td
                            v-if="
                                !isPending &&
                                hasAnyPermission(['invoice-create'])
                            "
                        >
                            <Link
                                :href="
                                    route('portfolio.invoice.repeat', {
                                        portfolio: route().params.portfolio,
                                        invoice_id: invoice.Id
                                    })
                                "
                                class="btn btn-primary btn-sm"
                                title="Quick Order"
                            >
                                <i class="bi bi-arrow-repeat"></i>
                            </Link>
                        </td>
                        <td v-else>
                            <div class="btn btn-primary btn-sm btn-disabled">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
