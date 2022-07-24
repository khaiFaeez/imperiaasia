<script>
import BreezeInput from '@/Components/Input.vue'
export default {
    props: ['productLists', 'products'],
    components: {
        BreezeInput
    },
    computed: {
        removeEmpty() {
            let o = Object.fromEntries(
                Object.entries(this.products.items).filter(
                    ([_, v]) => v.product != null
                )
            )
            return Object.keys(o).length < 4 ? 4 : Object.keys(o).length
        }
    }
}
</script>

<template>
    <div class="overflow-x-auto py-2">
        <table class="table table-compact w-full">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">U/Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Disc %</th>
                    <th scope="col">Disc RM</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="line_items" v-for="(n, i) in removeEmpty" :key="i">
                    <td class="">{{ n }}</td>
                    <td>
                        {{ products.items[i].product_name }}
                    </td>
                    <td>{{ products.items[i].price }}</td>
                    <td>{{ products.items[i].qty }}</td>
                    <td>{{ products.items[i].discount }}</td>
                    <td>{{ products.items[i].discounted_price }}</td>
                    <td>{{ products.items[i].total }}</td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan="5"></th>
                <th>Grand Total</th>
                <th>{{ products.grand_total }}</th>
            </tfoot>
        </table>
    </div>
</template>
