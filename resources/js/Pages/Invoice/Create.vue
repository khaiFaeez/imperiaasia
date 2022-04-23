<script>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';


export default {
    components:{
        AppLayout
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                grand_total:0,
                products:[
                    {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    },{
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }, {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }, {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }, {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }
                ]
            }),
        };
    },
    methods: {
        grandTotal () {
            this.form.grand_total = this.form.products[0].total + this.form.products[1].total + this.form.products[2].total + this.form.products[3].total + this.form.products[4].total
        },
        total (i) {
            this.form.products[i].discounted_price = ( this.form.products[i].discount * (this.form.products[i].price * this.form.products[i].qty) / 100);
            this.form.products[i].total = this.form.products[i].price * this.form.products[i].qty - this.form.products[i].discounted_price
            this.grandTotal()
        }
    }
}

</script>

<template>

<AppLayout>
    <table class="table">
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
            <td class="p-0">{{n}}</td>
            <td class="p-0">
                <select class="border-0 p-0 select" v-model="form.products[i].product">
                                <option  value=''>Product</option>
                                <option v-for="product in $page.props.products" :key="product.id" :value="product.id" >{{product.Product_Name}}</option>
                </select>
            </td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="form.products[i].price"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="form.products[i].qty"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="form.products[i].discount"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="form.products[i].discounted_price"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder=""  v-model="form.products[i].total" @change="grandTotal(i)"></td>
            </tr>
        </tbody>
        <tfoot>
        <th colspan=5></th>
        <th >Grand Total</th>
        <th ><input v-model="form.grand_total" style="border: 0;" type="text" name="Grand_Total"  placeholder="" ></th>
        </tfoot>
  </table>

</AppLayout>

</template>
