<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination'

export default {
    props: ['invoices'],
    data() {
        return {
            selected: this.$page.props.selected,
            selectAll: false
        }
    },
    components: {
        Pagination,
        AppLayout,
        Head,
        Link
    },
    methods: {
        select() {
            if (!this.selectAll) {
                for (let i in this.invoices.data) {
                    this.selected.push(this.invoices.data[i].Id)
                }
            } else {
                this.selected = []
            }
        },
        check_form(event) {
            if (this.selected.length > 0) {
                event.target.submit()
                //  Inertia.reload({ only: ['invoices'] });
                window.location.reload()
            } else {
                alert('please select at least 1 invoice')
            }
        }
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
    <Head title="Invoice List" />
    <AppLayout>
        <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/print"
                >Printing</Link
            >
        </h1>

        <div class="menu menu-horizontal mb-4 w-full justify-end">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-primary btn-sm">Print</label>
                <ul
                    tabindex="0"
                    class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-box w-52"
                >
                    <li>
                        <form
                            class="w-full"
                            :action="route('portfolio.print.invoices')"
                            method="post"
                            target="_blank"
                            @submit.prevent="check_form"
                            v-if="$page.props.invoices.data.length > 0"
                        >
                            <input
                                type="hidden"
                                :value="$page.props.attribute_name"
                                name="_token"
                            />
                            <input type="hidden" :value="selected" name="ids" />
                            <button @click="check_form">Invoices</button>
                        </form>
                    </li>
                    <li>
                        <form
                            class="w-full"
                            :action="route('portfolio.print.dockets')"
                            method="post"
                            target="_blank"
                            @submit.prevent="check_form"
                            v-if="$page.props.invoices.data.length > 0"
                        >
                            <input
                                type="hidden"
                                :value="$page.props.attribute_name"
                                name="_token"
                            />
                            <input type="hidden" :value="selected" name="ids" />
                            <button @click="check_form">Docket</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="overflow-auto">
            <table
                class="table table-compact table-bordered w-full max-w-7xl text-center"
            >
                <thead>
                    <tr>
                        <th>Select</th>
                        <th colspan="2">Status</th>
                        <th>Inv No</th>
                        <th colspan="5">Shipping</th>
                    </tr>
                    <tr>
                        <th>
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                v-model="selectAll"
                                @click="select"
                            />
                        </th>
                        <th>Invoice</th>
                        <th>Docket</th>
                        <th></th>
                        <th>Phone</th>
                        <th>Name</th>
                        <th>Postcode</th>
                        <th>City</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="$invoice in $page.props.invoices.data"
                        :key="$invoice.Id"
                    >
                        <td>
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                :value="$invoice.Id"
                                v-model="selected"
                            />
                        </td>
                        <td class="text-center">
                            <div
                                class="badge text-white"
                                :class="
                                    $invoice.Invoice_Status == '1'
                                        ? 'badge-success '
                                        : 'badge-error'
                                "
                            >
                                <i
                                    :class="
                                        $invoice.Invoice_Status == '1'
                                            ? 'bi bi-check-lg'
                                            : 'bi bi-x-lg'
                                    "
                                ></i>
                            </div>
                        </td>
                        <td class="text-center">
                            <div
                                class="badge text-white"
                                :class="
                                    $invoice.Docket_Status == '1'
                                        ? 'badge-success '
                                        : 'badge-error'
                                "
                            >
                                <i
                                    :class="
                                        $invoice.Docket_Status == '1'
                                            ? 'bi bi-check-lg'
                                            : 'bi bi-x-lg'
                                    "
                                ></i>
                            </div>
                        </td>
                        <td>{{ $invoice.Inv_No }}</td>
                        <td>{{ $invoice.Ship_Phone }}</td>
                        <td>{{ $invoice.Ship_Name }}</td>
                        <td>{{ $invoice.Ship_poscode }}</td>
                        <td>{{ $invoice.Ship_City }}</td>
                        <td>{{ $invoice.state?.Negeri }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination class="mt-6" :links="$page.props.invoices.links" />
    </AppLayout>
</template>
