<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from '@/Components/InputError.vue'
import BreezeLabel from '@/Components/Label.vue'

export default {
    props: ['payment'],
    components: {
        BreezeInput,
        BreezeInputError,
        BreezeLabel
    },
    methods: {
        totalSettlement() {
            this.payment.total_settlement = this.payment.items.reduce(
                (a, b) => +a + +b.settlement,
                0
            ) //this.products.items.forEach( (e) => Number(this.products.items[0].total) + Number(this.products.items[1].total) + Number(this.products.items[2].total) + Number(this.products.items[3].total )+ Number(this.products.items[4].total)
        }
    }
}
</script>

<template>
    <div class="overflow-x-auto py-2">
        <BreezeInputError
            :message="
                $page.props.errors.updateInvoice?.hasOwnProperty(
                    'payment.items.0.ptp'
                )
                    ? $page.props.errors.updateInvoice['payment.items.0.ptp']
                    : ''
            "
        />
        <table class="table table-compact w-full">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Promise To Pay (PTP)</th>
                    <th scope="col">Settlement (RM)</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="line_items"
                    v-for="(n, i) in payment.items.length"
                    :key="i"
                >
                    <td class="">{{ n }}</td>
                    <td>
                        <BreezeInput
                            type="date"
                            v-model="payment.items[i].ptp"
                            placeholder=""
                            class="border-0"
                        />
                    </td>
                    <td>
                        <BreezeInput
                            v-model="payment.items[i].settlement"
                            placeholder=""
                            class="border-0"
                            @change="totalSettlement(i)"
                        />
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan="1"></th>
                <th>Total Settlement (RM)</th>
                <th>
                    <p class="font-bold">{{ payment.total_settlement }}</p>
                </th>
            </tfoot>
        </table>
    </div>
</template>
