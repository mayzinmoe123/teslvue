<template>
    <Head>
        <title>My App - User</title>
    </Head>

    <div class="flex justify-between">

        <h1>Users</h1>
        <Link v-if="can.create" href="/users/create">Create</Link>
        <input v-model="search" type="text" placeholder="Search" />
    </div>
    <ul>
        <template v-for="user in users.data" :key="user.id">
            <li>
                {{  user.name }}
                <Link :href="'/users/edit/'+user.id"  v-if="user.can.edit">
                    Edit
                </Link>
            </li>
        </template>
    </ul>

    <!-- pagination -->
    <Pagination :links="users.links"/>
    
</template>

<script setup>
    import Pagination from '../../../Shared/Pagination.vue';
    import {ref, watch} from 'vue';
    import { router } from '@inertiajs/vue3';
    // import throttle from 'lodash/throttle';
    import debounce from 'lodash/debounce';

    let props = defineProps({
        users : Object,
        filter: Object,
        can: Object,
    });
    let search = ref(props.filter.search);

    // watch(search, value => {
    //     router.get('/users', 
    //         { 
    //             search: value
    //         },
    //         {
    //             preserveState: true,
    //             replace: true,
    //         }
    //     );
    // });

    watch(search, debounce(function(value){
        console.log('debounce');
        router.get('/users', 
            {
                search: value
            },
            {
                preserveState: true,
                replace: true,
            }
        )
    }, 500));
</script>