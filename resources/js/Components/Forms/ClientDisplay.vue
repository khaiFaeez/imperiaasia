<script>

import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue'


export default {
    props: ['client','countries','states'],
    components:{
        AppLayout,
        BreezeLabel,
        Link,
        Head
    },
    computed: {
                activeState() {
                    let that = this;
                    // return this.states.find(( id ) => id === that.client.state);
                //    return this.states.find(key => key === that.client.state);
                    let x;
                    this.states.forEach(function(a){
                        if(a.id == that.client.State){
                            x = a;
                        }
                    })
                    return x;
                }
  }
}

</script>
<template>

<div class="w-full  grid md:grid-cols-2 gap-4">
  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="IC Number / Passport"/>
    </div>
    <div class="md:w-2/3">
         <Link :href="route('portfolio.client.show',{'client': client.id})" class="text-info hover:underline">{{client.MyKad_SSM}}</Link>
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Name"/>
    </div>
    <div class="md:w-2/3">
        <p>{{client.Name}}</p>
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Contact No. 1"/>
    </div>
    <div class="md:w-2/3">
         <p>{{client.Mobile_No}}</p>
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Contact No. 2"/>
    </div>
    <div class="md:w-2/3">
         <p>{{client.Phone}}</p>
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Contact No. 3"/>
    </div>
    <div class="md:w-2/3">
         <p>{{client.Off_Phone}}</p>
    </div>
  </div>

   <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Client Occupation"/>
    </div>
    <div class="md:w-2/3">
         <p>{{client.occupation}}</p>
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Address"/>
    </div>
    <div class="md:w-2/3">
         <p>{{client.Address}}</p>
    </div>
  </div>


<div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Address 2"/>
    </div>
    <div class="md:w-2/3">
        <p>{{client.Address_2}}</p>
    </div>
  </div>


<div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Poscode"/>
    </div>
    <div class="md:w-2/3">
        <p>{{client.Poscode}}</p>
    </div>
  </div>


<div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="City" />
    </div>
    <div class="md:w-2/3">
        <p>{{client.City}}</p>
    </div>
  </div>


<div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel  value="State" />
    </div>
    <div class="md:w-2/3">
        <p>{{activeState?.Negeri}}</p>
    </div>
  </div>

<div class="md:flex md:items-center">
    <div class="md:w-1/3">
        <BreezeLabel value="Country"/>
    </div>
    <div class="md:w-2/3">
        <p>{{client.Country}}</p>
    </div>
  </div>
</div>

</template>
