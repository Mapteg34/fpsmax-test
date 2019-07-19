<template>
    <div :id="id">
        <div v-if="!ready" style="width:100%; height:100%; display:flex; justify-content: center">
            <div class="spinner-border align-self-center" role="status" style="align-self: center">
            
            </div>
        </div>
        <slot v-if="ready"></slot>
    </div>
</template>

<script>
    module.exports = {
        props: {
            ready: Boolean,
            id:null,
        },
    }
</script>
