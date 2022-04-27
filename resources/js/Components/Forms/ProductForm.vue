<script>
import BreezeInput from '@/Components/Input.vue';
export default {
    props:['products','product'],
    components:{
        BreezeInput,
    },
    data() {
        return {
            form:this.$inertia.form({
                    grand_total:this.product.grand_total,
                    items: Object.values(this.product.items)
                })
        }
    },
    methods:{
         grandTotal () {
            this.form.grand_total = this.form.items[0].total + this.form.items[1].total + this.form.items[2].total + this.form.items[3].total + this.form.items[4].total
        },
        total (i) {
            this.form.items[i].discounted_price = ( this.form.items[i].discount * (this.form.items[i].price * this.form.items[i].qty) / 100);
            this.form.items[i].total = this.form.items[i].price * this.form.items[i].qty - this.form.items[i].discounted_price
            this.grandTotal()
        },
    }
}
</script>

<template>
<div class="overflow-x-auto">
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

                    <tr class="line_items" v-for="(n, i) in 5" :key="i">
                        <td class="">{{n}}</td>
                        <td class="p-0">
                            <select class="border-0 p-0 select" v-model="form.items[i].product">
                                            <option  value=''>Product</option>
                                            <option v-for="product in products" :key="product.id" :value="product.id" >{{product.Product_Name}}</option>
                            </select>
                        </td>
                        <td class="p-0"><BreezeInput class="border-0" type="number" placeholder="" v-model="form.items[i].price"  @change="total(i)"/></td>
                        <td class="p-0"><BreezeInput class="border-0" type="number" placeholder="" v-model="form.items[i].qty"  @change="total(i)"/></td>
                        <td class="p-0"><BreezeInput class="border-0" type="number" placeholder="" v-model="form.items[i].discount"  @change="total(i)"/></td>
                        <td class="p-0"><BreezeInput class="border-0" type="number" placeholder="" v-model="form.items[i].discounted_price"  @change="total(i)"/></td>
                        <td class="p-0"><BreezeInput class="border-0" type="number" placeholder="" v-model="form.items[i].total" @change="grandTotal(i)"/></td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <th colspan=5></th>
                    <th >Grand Total</th>
                    <th ><BreezeInput v-model="form.grand_total" style="border: 0;" type="text" name="Grand_Total"  placeholder="" /></th>
                    </tfoot>
            </table>
            </div>
</template>
