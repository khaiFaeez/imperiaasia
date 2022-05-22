<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue'
 import Multiselect from '@vueform/multiselect'
import { Inertia } from '@inertiajs/inertia'

defineProps({
    invoices: Object,
});

const form = useForm({
    included_start: '',
    included_end:'',
    excluded_start:'',
    exluded_end: '',
    status:''
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const fetchLanguages = () => {

Inertia.reload({ only: ['invoice_number'] })
}

</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
<Head title="Invoice List" />
<AppLayout>
<h1 class="mb-8 text-3xl font-bold">
    <Link class="text-primary hover:text-primary-focus" href="/print">Print</Link>
</h1>


<form class="w-full max-w-xl"  @submit.prevent="submit">
  <div class="md:flex md:items-center mb-6 ">
    <div class="md:w-1/3">
      <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Included
      </label>
    </div>
    <div class="md:w-1/3">
      <Multiselect
      v-model="form.included_start"
      :options="async function(query) {
        return await fetchLanguages(query) // check JS block in JSFiddle for implementation
    }"
      :searchable="true"

    />
    </div>
    -
    <div class="md:w-1/3">
      <Multiselect
      v-model="form.included_end"
      :options="invoices"
      :searchable="true"
    />
    </div>
  </div>

  <div class="md:flex md:items-center mb-6 ">
    <div class="md:w-1/3">
      <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Excluded
      </label>
    </div>
    <div class="md:w-1/3">
      <Multiselect
      v-model="form.excluded_start"
      :options="invoices"
       :searchable="true"
    />
    </div>
    -
    <div class="md:w-1/3">
      <Multiselect
      v-model="form.excluded_end"
      :options="invoices"
       :searchable="true"
    />
    </div>
  </div>




  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3"></div>
    <label class="md:w-2/3 block font-bold">
      <input class="mr-2 leading-tight" type="checkbox">
      <span class="text-sm">
        Send me your newsletter!
      </span>
    </label>
  </div>
  <div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
      <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
        Search
      </button>
    </div>
  </div>
</form>

</AppLayout>

</template>
