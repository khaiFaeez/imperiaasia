<script>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'


export default {
    components:{
        AppLayout,
        BreezeLabel,
        BreezeButton,
        BreezeInput,
        BreezeInputError,
        Link
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        }
    },
    data() {
        return {
            invoiceForm: this.$inertia.form({
                grand_total:0,
                client:{
                    ic_number:"",
                    name:"",
                    mobile_number:"",
                    phone:"",
                    off_phone:"",
                    occupation:"",
                    new_order:true
                },
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
            this.invoiceForm.grand_total = this.invoiceForm.products[0].total + this.invoiceForm.products[1].total + this.invoiceForm.products[2].total + this.invoiceForm.products[3].total + this.invoiceForm.products[4].total
        },
        total (i) {
            this.invoiceForm.products[i].discounted_price = ( this.invoiceForm.products[i].discount * (this.invoiceForm.products[i].price * this.invoiceForm.products[i].qty) / 100);
            this.invoiceForm.products[i].total = this.invoiceForm.products[i].price * this.invoiceForm.products[i].qty - this.invoiceForm.products[i].discounted_price
            this.grandTotal()
        },
        storeInvoice(){

        }
    }
}

</script>

<template>

<AppLayout>

    <form @submit.prevent="storeInvoice" class="form">
        <div class="divider text-xl">Client</div>
        <div class="grid grid-cols-1 gap-5 mb-12">
                <div>
                  <BreezeLabel value="ID Card"/>
                  <BreezeInput  type="text" name="MyKad_SSM" v-model="invoiceForm.client.ic_number" required />
                </div>

                <div>
                  <BreezeLabel value="Name"/>
                  <BreezeInput  type="text" name="Name" v-model="invoiceForm.client.name" required />
                </div>

                <div class="grid grid-cols-3 gap-2">
                <div>
                    <BreezeLabel value="Contact No. 1"/>
                    <BreezeInput  type="text" name="Phone_1" v-model="invoiceForm.client.mobile_number" required />
                </div>

                <div>
                    <BreezeLabel value="Contact No. 2"/>
                    <BreezeInput  type="text" name="Phone_2" v-model="invoiceForm.client.phone" placeholder="" />
                </div>

                <div>
                    <BreezeLabel value="Contact No. 3"/>
                    <BreezeInput  type="text" name="Phone_3" v-model="invoiceForm.client.off_phone" placeholder="" />
                </div>
                </div>

                <div>
                <BreezeLabel value="Client Occupation"/>
                          <select name="Occupation"  v-model="invoiceForm.client.occupation" class="border-primary w-full max-w-md">
                          <option  value=''>Please select</option>
                          <option  value='A'>Gaji Bulanan</option>
                          <option  value='B'>Bekerja Sendiri/berniaga</option>
                          <option  value='C'>Suri Rumah</option>
                          <option  value='D'>Goverment Staff</option>
                          </select>
                </div>

                <div>
                  <BreezeLabel value="Address"/>
                  <BreezeInput  type="text" placeholder="" name="Address" v-model="invoiceForm.client.address1" required />
                </div>

                <div>
                  <BreezeLabel value="Address 2"/>
                  <BreezeInput  type="text" placeholder=""  name="Address_2" v-model="invoiceForm.client.address2" />
                </div>
                 <div class="grid grid-cols-4 gap-2">
                <div>
                      <BreezeLabel value="Poscode"/>
                      <BreezeInput  type="text" placeholder="" name="Poscode" v-model="invoiceForm.client.postcode" required />
                </div>

                <div>
                      <BreezeLabel value="City" />
                      <BreezeInput  type="text" placeholder="" name="City" v-model="invoiceForm.client.city" required />
                </div>


                <div>
                      <BreezeLabel  value="State" />
                      <select name="State"  required v-model="invoiceForm.client.state" class="select border-primary w-full">
                                            <option  value=''>Please select state</option>
									        <option v-for="$state in $page.props.states" :key="$state.id" :value="$state.id" >{{$state.Negeri}}</option>
                      </select>
                </div>

                <div>
                      <BreezeLabel value="Country"/>
                      <select name="Country"  required v-model="invoiceForm.client.country" class="select border-primary w-full">
                        <option value='MALAYSIA'>MALAYSIA</option>
                        <option v-for="$country in $page.props.countries" :key="$country" :value="$country" >{{$country}}</option>
                      </select>
                </div>
                </div>
            </div>
    </form>

<div class="divider text-xl">Product</div>
    <div class="grid grid-cols-1 gap-5">
    <table class="table table-compact ">
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
                <select class="border-0 p-0 select" v-model="invoiceForm.products[i].product">
                                <option  value=''>Product</option>
                                <option v-for="product in $page.props.products" :key="product.id" :value="product.id" >{{product.Product_Name}}</option>
                </select>
            </td>
            <td class="p-0"><BreezeInput class="border-0" type="text" placeholder="" v-model="invoiceForm.products[i].price"  @change="total(i)"/></td>
            <td class="p-0"><BreezeInput class="border-0" type="text" placeholder="" v-model="invoiceForm.products[i].qty"  @change="total(i)"/></td>
            <td class="p-0"><BreezeInput class="border-0" type="text" placeholder="" v-model="invoiceForm.products[i].discount"  @change="total(i)"/></td>
            <td class="p-0"><BreezeInput class="border-0" type="text" placeholder="" v-model="invoiceForm.products[i].discounted_price"  @change="total(i)"/></td>
            <td class="p-0"><BreezeInput class="border-0" type="text" placeholder="" v-model="invoiceForm.products[i].total" @change="grandTotal(i)"/></td>
            </tr>
        </tbody>
        <tfoot>
        <th colspan=5></th>
        <th >Grand Total</th>
        <th ><BreezeInput v-model="invoiceForm.grand_total" style="border: 0;" type="text" name="Grand_Total"  placeholder="" /></th>
        </tfoot>
  </table>
  </div>

</AppLayout>

</template>
