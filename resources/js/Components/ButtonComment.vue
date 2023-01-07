<template>
    <button :value="value" :type="type ?? 'submit'" :class="color+' hover:text-'+ hover +'-900 ml-2 p-2 text-sm hover:transition hover:duration-1000 duration-1000 bg-dark-gray m-1 rounded-sm ' + (color === 'text-white' ? 'hover:text-black ' : ' ') + 'hover:bg-white'" :title="title">
        {{ texto  }}
    </button>
</template>

<script>
export default {
    name: "ButtonComment",
    props: ['value', 'color', 'hover', 'title', 'texto', 'type']
}
</script>

<style scoped>

</style>
