<template>
    <button :value="value" :type="type ?? 'submit'" :class="'text-'+color+'-600 hover:text-'+ hover +'-900 ml-2 p-2 text-sm hover:transition hover:duration-1000 duration-1000 bg-gray-100 m-1 border border-gray-300  rounded-sm'" :title="title">
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
