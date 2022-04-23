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
            productForm: this.$inertia.form({
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
            this.productForm.grand_total = this.productForm.products[0].total + this.productForm.products[1].total + this.productForm.products[2].total + this.productForm.products[3].total + this.productForm.products[4].total
        },
        total (i) {
            this.productForm.products[i].discounted_price = ( this.productForm.products[i].discount * (this.productForm.products[i].price * this.productForm.products[i].qty) / 100);
            this.productForm.products[i].total = this.productForm.products[i].price * this.productForm.products[i].qty - this.productForm.products[i].discounted_price
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
                <select class="border-0 p-0 select" v-model="productForm.products[i].product">
                                <option  value=''>Product</option>
                                <option v-for="product in $page.props.products" :key="product.id" :value="product.id" >{{product.Product_Name}}</option>
                </select>
            </td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="productForm.products[i].price"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="productForm.products[i].qty"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="productForm.products[i].discount"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder="" v-model="productForm.products[i].discounted_price"  @change="total(i)"></td>
            <td class="p-0"><input class="border-0" type="text"   placeholder=""  v-model="productForm.products[i].total" @change="grandTotal(i)"></td>
            </tr>
        </tbody>
        <tfoot>
        <th colspan=5></th>
        <th >Grand Total</th>
        <th ><input v-model="productForm.grand_total" style="border: 0;" type="text" name="Grand_Total"  placeholder="" ></th>
        </tfoot>
  </table>

</AppLayout>

</template>
