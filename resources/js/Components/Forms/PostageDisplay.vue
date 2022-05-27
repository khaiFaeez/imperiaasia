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
    },
      computed: {
                activeState() {
                    let that = this;
                    // return this.states.find(( id ) => id === that.client.state);
                //    return this.states.find(key => key === that.client.state);
                    let x;
                    this.states.forEach(function(a){
                        if(a.id == that.shipping.Ship_State){
                            x = a;
                        }
                    })
                    return x;
                }
                }
}

</script>
<template>

<div class="w-full">
  <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Name"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_Name}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Phone"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_Phone}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Address"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_Add1}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Address"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_Add2}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Postcode"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_poscode}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping City"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_City}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping State"/>
    </div>
    <div class="md:w-2/3">
        <p>{{activeState?.Negeri}}</p>
    </div>
    </div>

    <div class="md:flex md:items-center mb-3">
    <div class="md:w-1/3">
        <BreezeLabel value="Shipping Country"/>
    </div>
    <div class="md:w-2/3">
        <p>{{shipping.Ship_Country}}</p>
    </div>
    </div>
</div>
</template>
