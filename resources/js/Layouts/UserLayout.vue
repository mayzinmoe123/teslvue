<template>
    <Head>
        <title>My App</title>
        <meta name="description" content="Inertia: Laravel and Vue" head-key="description">
    </Head>
    <section class="header">
        <Navbar/>
    </section>
    <section class="content">
        <slot />
    </section>
</template>


<script>
    import {Head} from '@inertiajs/vue3';
    import Navbar from '../Shared/Navbar.vue';
    export default{
        components:{ Navbar, Head},
    }
</script>