<script>
import BreezeInput from '@/Components/Input.vue'
export default {
    props: ['productLists', 'products'],
    components: {
        BreezeInput
    },
    methods: {
        grandTotal() {
            this.products.grand_total = this.products.items.reduce(
                (a, b) => +a + +b.total,
                0
            ) //this.products.items.forEach( (e) => Number(this.products.items[0].total) + Number(this.products.items[1].total) + Number(this.products.items[2].total) + Number(this.products.items[3].total )+ Number(this.products.items[4].total)
        },
        total(i) {
            // this.products.items[i].discounted_price = (Number(this.products.items[i].discount) * (Number(this.products.items[i].price) * Number(this.products.items[i].qty)) / 100);
            // this.products.items[i].total = Number(this.products.items[i].price) * Number(this.products.items[i].qty) - Number(this.products.items[i].discounted_price)
            // this.grandTotal()

            this.products.items[i].discounted_price =
                Math.round(
                    ((Number(this.products.items[i].discount) *
                        (Number(this.products.items[i].price) *
                            Number(this.products.items[i].qty))) /
                        100) *
                    100
                ) / 100;

            this.products.items[i].total =
                Math.round(
                    Number(this.products.items[i].price) *
                    Number(this.products.items[i].qty) -
                    Number(this.products.items[i].discounted_price)
                ).toFixed(2);

            this.grandTotal()
        }
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
                    <th scope="col">Unit/Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Discount %</th>
                    <th scope="col">Discount RM</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="line_items" v-for="(n, i) in removeEmpty" :key="i">
                    <td class="">{{ n }}</td>
                    <td>
                        <select class="p-0 select select-sm" v-model="products.items[i].product">
                            <option value="">Product</option>
                            <option v-for="product in productLists" :key="product.id" :value="product.id">
                                {{ product.Product_Name }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <BreezeInput class="input-sm" type="number" step="any" placeholder=""
                            v-model="products.items[i].price" @change="total(i)" />
                    </td>
                    <td>
                        <BreezeInput class="input-sm" type="number" step="any" placeholder=""
                            v-model="products.items[i].qty" @change="total(i)" />
                    </td>
                    <td>
                        <BreezeInput class="input-sm" type="number" step="any" placeholder=""
                            v-model="products.items[i].discount" @change="total(i)" />
                    </td>
                    <td>
                        <BreezeInput class="input-sm" type="number" step="any" placeholder=""
                            v-model="products.items[i].discounted_price" @change="total(i)" />
                    </td>
                    <td>
                        <BreezeInput class="input-sm" type="number" step="any" placeholder=""
                            v-model="products.items[i].total" @change="grandTotal(i)" />
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan="5"></th>
                <th>Grand Total (RM)</th>
                <th>
                    <p class="font-bold">
                        {{ products.grand_total }}
                    </p>
                </th>
            </tfoot>
        </table>
    </div>
</template>
