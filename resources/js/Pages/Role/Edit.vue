<script>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'

const showingNavigationDropdown = ref(false);


export default {
    components:{
        Pagination,
        AppLayout,
        BreezeLabel,
        BreezeButton,
        BreezeInput,
        BreezeInputError,
        Link
    },
    data() {
        return {
            form: this.$inertia.form({
                 _method: 'PUT',
                name:this.$page.props.role.name,
                permission:Object.values(this.$page.props.rolePermissions)

            })
        }
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        updateRole(id) {

                this.form.post(route('roles.update',{"role":id}),{
                    errorBag: 'updateRoles',
                    preserveScroll: true,
                });
            },
        checkform(){
            console.log(this.form.permission)
        }
    }
}

</script>

<template>

<AppLayout>

<form @submit.prevent="updateRole($page.props.role.id)" class="form">
    <div class="grid grid-cols-6 gap-6">

    <div class="col-span-6">

            <BreezeLabel>Name:</BreezeLabel>

             <BreezeInput id="name" type="text" v-model="form.name" required autocomplete="name" />


    </div>
     <div class="col-span-6">

             <BreezeLabel>Permission:</BreezeLabel>

                <div v-for="($permission, i) in $page.props.permissions" :key="i" >
                    <input class="checkbox" type="checkbox"  name="permission[]" v-model="form.permission" :value="$permission.id" @click="checkform"/>
                    <label class="mx-3" >  {{ $permission.name }}</label>
                </div>

    </div>
    <div class="flex items-center justify-end px-4 py-3 bg-transparent text-right sm:px-6 rounded-xl" v-if="$page.props.flash.message">
         <transition leave-active-class="transition ease-in duration-1000 mr-3" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="on" class="text-sm text-gray-600">
                 Saved.
            </div>
        </transition>
    </div>

                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </BreezeButton>

</div>
        </form>


</AppLayout>

</template>
