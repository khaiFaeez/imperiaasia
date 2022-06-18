<script>

import { Link,Head } from '@inertiajs/inertia-vue3'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'
import { ref } from 'vue';
  // import the component
  import Treeselect from 'vue3-treeselect'
  // import the styles
  import 'vue3-treeselect/dist/vue3-treeselect.css'

const showingNavigationDropdown = ref(false);
export default {
    props: ['user','options'],
    components:{
        BreezeLabel,
        BreezeInput,
        BreezeInputError,
        Link,
        Treeselect,
    }
}

</script>
<template>
    <div class="w-full">

        <div class="md:flex md:items-center mb-3">
            <div class="md:w-1/3">
                <BreezeLabel for="username" value="Username" />
            </div>
            <div class="md:w-2/3">
                <BreezeInput id="username" type="text" v-model="user.username" required autocomplete="username" />
                <BreezeInputError :message="$page.props.errors.username" />
            </div>
        </div>


        <div class="md:flex md:items-center mb-3">
            <div class="md:w-1/3">
                <BreezeLabel for="name" value="Name" />
            </div>
            <div class="md:w-2/3">
                <BreezeInput id="name" type="text" v-model="user.name" required autocomplete="name" />
                <BreezeInputError :message="$page.props.errors.name" />
            </div>
        </div>


        <div class="md:flex md:items-center mb-3">
            <div class="md:w-1/3">
                <BreezeLabel for="staff_id" value="Staff ID" />
            </div>
            <div class="md:w-2/3">
                <BreezeInput id="staff_id" type="text" v-model="user.staff_id" required autocomplete="staff_id" />
                <BreezeInputError :message="$page.props.errors.staff_id" />
            </div>
        </div>


        <div class="md:flex md:items-center mb-3">
            <div class="md:w-1/3">
                <BreezeLabel for="password" value="Password" />
            </div>
            <div class="md:w-2/3">
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="user.password" required
                    autocomplete="new-password" />
            </div>
        </div>


        <div class="md:flex md:items-center mb-3">
            <div class="md:w-1/3">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
            </div>
            <div class="md:w-2/3">
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="user.password_confirmation" required autocomplete="new-password" />
            </div>
        </div>

        <div class="md:flex md:items-center mb-3">
            <div class="md:w-1/3">
                <BreezeLabel value="Portfolio & Roles" />
            </div>
            <div class="md:w-2/3">
                <select name="roles" id="roles" multiple v-model="user.roles"
                    class="select input-bordered border-primary w-full h-52">
                    <option v-for="(role, i ) in $page.props.roles" :key="i" :value="role.id">{{ role.portfolio }} - {{
                        role.name }}</option>
                </select>
                <BreezeInputError :message="$page.props.errors.roles" />
                <Link :href="route('roles.index')" class="underline">Manage Roles</Link>
            </div>
        </div>

    </div>

</template>
