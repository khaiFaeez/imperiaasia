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

<div class="w-full grid md:grid-cols-2 gap-4">

    <div class="flex flex-wrap -mx-3">
        <div class="w-full px-3">
            <BreezeLabel value="IC Number / Passport"/>
            <p>{{client.MyKad_SSM}}</p>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        <div class="w-full px-3">
            <BreezeLabel value="Name"/>
            <p>{{client.Name}}</p>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <BreezeLabel value="Contact No. 1"/>
            <p>{{client.Mobile_No}}</p>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <BreezeLabel value="Contact No. 2"/>
            <p>{{client.Phone}}</p>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <BreezeLabel value="Contact No. 3"/>
            <p>{{client.Off_Phone}}</p>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        <div class="w-full px-3">
            <BreezeLabel value="Client Occupation"/>
            <p>{{client.occupation}}</p>
        </div>
    </div>

  <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Address"/>
         <p>{{client.Address}}</p>
    </div>
  </div>

    <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Address 2"/>
        <p>{{client.Address_2}}</p>
    </div>
  </div>


<div class="flex flex-wrap -mx-3">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <BreezeLabel value="Poscode"/>
        <p>{{client.Poscode}}</p>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <BreezeLabel value="City" />
        <p>{{client.City}}</p>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
       <BreezeLabel  value="State" />
        <p>{{activeState?.Negeri}}</p>
    </div>
</div>


    <div class="flex flex-wrap -mx-3">
    <div class="w-full px-3">
        <BreezeLabel value="Country"/>
        <p>{{client.Country}}</p>
    </div>
  </div>
</div>
</template>
