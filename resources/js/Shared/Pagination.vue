<template>
    <div>
        <Component 
        :is="link.url ? 'Link' : 'Span'"
        v-for="link in links"
        v-html="link.label"
        :class="{'font-bold' : link.active, 'text-grey' : !link.url}"
        :href="link.url"
        preserve-scroll
        />
</div>
</template>

<script>
    export default{
        props: {
            links: Array
        }
    }
</script>