<template lang="">
    <div>
      <div class="row justify-content-center">
        <div class="col-xs-1-12 col-md-6">
          <form @submit.prevent="submit" method="post">
              <div class="form-group py-2">
                <label for="">Name</label>
                <input type="text" class="form-control" v-model="form.name" id="" aria-describedby="helpId" placeholder="">
                <small v-if="errors.name" v-text="errors.name" class="form-text text-danger" />
              </div>
              <div class="form-group py-2">
                <label for="">Email</label>
                <input type="text" class="form-control" v-model="form.email" id="" aria-describedby="helpId" placeholder="">
                <small v-if="errors.email" v-text="errors.email" class="form-text text-danger" />
              </div>
              <div class="form-group py-2">
                <label for="">Password</label>
                <input type="password" class="form-control" v-model="form.password" id=""  aria-describedby="helpId" placeholder="">
                <small v-if="errors.password" v-text="errors.password" class="form-text text-danger" />
              </div>
              <button type="submit" class="btn btn-primary" :disabled="processing">Submit</button>
          </form>
        </div>
      </div>
    </div>
</template>
<script setup>
  import {reactive, ref} from 'vue';
  import { router } from '@inertiajs/vue3';

  defineProps({
    errors: Object,
  });

  let processing = ref(false);

  let form = reactive({
    name: '',
    email: '',
    password: '',
  });

  let submit = () =>{
    router.post('/users', form,{
      onStart: () => {processing.value = true;},
      onFinish: () => {processing.value = false;},
    });
  };
</script>