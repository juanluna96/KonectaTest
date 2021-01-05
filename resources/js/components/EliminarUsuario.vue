<template>
    <p>Esto es visible</p>
</template>

<script>
export default {
    props:['userId'],
    mounted() {
        console.log('receta actual',this. userId)
    },
}
</script>