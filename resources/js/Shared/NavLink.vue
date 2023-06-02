<template>
    <Link class="nav-link" :class="{'active': active}">
        <slot />
    </Link>
</template>

<script setup>
    defineProps({
        active: Boolean
    });
</script>