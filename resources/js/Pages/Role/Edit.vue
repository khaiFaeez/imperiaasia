<script>
import { ref } from 'vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
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
        Link,
        Head
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
    }
}

</script>

<template>
<Head title="Edit Role" />
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
                        <input class="checkbox" type="checkbox"  name="permission[]" v-model="form.permission" :value="$permission.id"/>
                        <label class="mx-3" >  {{ $permission.name }}</label>
                </div>

            </div>

            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save mr-3" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg>
                Save
            </BreezeButton>

    </div>
</form>
</AppLayout>

</template>
