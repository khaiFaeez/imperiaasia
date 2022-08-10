<script>
import BreezeInput from '@/Components/Input.vue'
export default {
    props: ['productLists', 'products'],
    components: {
        BreezeInput
    },
    data() {
        return {
            expand: false
        }
    },
    methods: {
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
    <div class="overflow-x-auto py-2 px-6 bg-base-100 ">
        <div class="btn btn-sm my-4 btn-outline shadow float-right" @click="expand = true" v-show="!expand">Expand</div>
        <div class="btn btn-sm my-4 btn-outline shadow float-right" @click="expand = false" v-show="expand">Close</div>
        <table class="table table-compact w-full">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Unit/Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Discount %</th>
                    <th scope="col">Discount RM</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="!expand">
                    <tr class="line_items" v-for="(n, i) in removeEmpty" :key="i">
                        <td class="">{{ i + 1 }}</td>
                        <td>
                            {{ products.items[i].product_name }}
                        </td>
                        <td>{{ products.items[i].price }}</td>
                        <td>{{ products.items[i].qty }}</td>
                        <td>{{ products.items[i].discount }}</td>
                        <td>{{ products.items[i].discounted_price }}</td>
                        <td>{{ products.items[i].total }}</td>
                    </tr>
                </template>
                <template v-else>
                    <tr class="line_items" v-for="(n, i) in products.items" :key="i">
                        <td class="">{{ i + 1 }}</td>
                        <td>
                            {{ products.items[i].product_name }}
                        </td>
                        <td>{{ products.items[i].price }}</td>
                        <td>{{ products.items[i].qty }}</td>
                        <td>{{ products.items[i].discount }}</td>
                        <td>{{ products.items[i].discounted_price }}</td>
                        <td>{{ products.items[i].total }}</td>
                    </tr>
                </template>

            </tbody>
            <tfoot>
                <th colspan="5"></th>
                <th>Grand Total (RM)</th>
                <th>{{ products.grand_total }}</th>
            </tfoot>
        </table>
    </div>
</template>
