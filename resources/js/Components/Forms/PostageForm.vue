<script>

import { Link,Head } from '@inertiajs/inertia-vue3'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'


export default {
    props: ['countries','states','shipping'],
    components:{
        BreezeLabel,
        BreezeInput,
        BreezeInputError,
        Link
    }
}

</script>
<template>

<div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Name"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Ship_Name" v-model="shipping.Ship_Name"  />
        <!-- <BreezeInputError :message="shipping.Ship_Name.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Phone"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Ship_Phone" v-model="shipping.Ship_Phone"  />
        <!-- <BreezeInputError :message="shipping.Ship_Phone.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Address"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Ship_Add1" v-model="shipping.Ship_Add1"  />
        <!-- <BreezeInputError :message="shipping.Ship_Add1.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Address"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Ship_Add2" v-model="shipping.Ship_Add2"  />
        <!-- <BreezeInputError :message="shipping.Ship_Add2.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Postcode"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Ship_poscode" v-model="shipping.Ship_poscode"  />
        <!-- <BreezeInputError :message="shipping.Ship_poscode.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping City"/>
    </div>
    <div class="md:w-2/3">
        <BreezeInput  type="text" name="Ship_City" v-model="shipping.Ship_City"  />
        <!-- <BreezeInputError :message="shipping.Ship_City.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping State"/>
    </div>
    <div class="md:w-2/3">
       <select name="State"   v-model="shipping.Ship_State" class="select border-primary w-full">
                                <option  value=''>Please select state</option>
                                <option v-for="$state in $page.props.states" :key="$state.id" :value="$state.id" >{{$state.Negeri}}</option>
        </select>
        <!-- <BreezeInputError :message="shipping.Ship_State.errors" /> -->
    </div>
    </div>

    <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Country"/>
    </div>
    <div class="md:w-2/3">
       <select name="Country"   v-model="shipping.Ship_Country" class="select border-primary w-full">
            <option v-for="$country in $page.props.countries" :key="$country" :value="$country" >{{$country}}</option>
        </select>
        <!-- <BreezeInputError :message="shipping.Ship_Country.errors" /> -->
    </div>
    </div>
</div>
</template>
