<template lang="">
    <div>
        <div class="row justify-content-center">
            <div class="col-xs-1-12 col-md-8">
                <form @submit.prevent="submit">
                    <div class="form-group py-2">
                        <label for="">Name</label>
                        <input type="text" class="form-control" v-model="form.name" id="" aria-describedby="helpId" placeholder="">
                        <small v-if="form.errors.name" v-text="form.errors.name" class="form-text text-danger" />
                    </div>
                    <div class="form-group py-2">
                        <label for="">Email</label>
                        <input type="email" class="form-control" v-model="form.email" id="" aria-describedby="emailHelpId" placeholder="">
                        <small v-if="form.errors.email" v-text="form.errors.email" class="form-text text-danger" />
                    </div>
                    <div class="form-group py-2">
                        <label for="">Password</label>
                        <input type="password" class="form-control" v-model="form.password" id="" placeholder="">
                        <small v-if="form.errors.password" v-text="form.errors.password" class="form-text text-danger" />
                    </div>
                    <div class="form-group py-2">
                        <button type="submit" class="btn btn-primary" :disabled="form.processing">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { useForm } from '@inertiajs/vue3';

    let form = useForm({
        'name' : null,
        'email': null,
        'password': null,
    });

    let submit = () => {
        form.post('/usercreatehelper');
    };
</script>
