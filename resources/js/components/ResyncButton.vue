<template>
    <div class="resync-button">
        <input type="button" value="Resync" @click.prevent="resync"/>
    </div>
</template>

<script>
    export default {
        methods: {
            resync() {
                this.axios.post('/api/sync').then(() => {
                    // @TODO: event on backend, websocket to client
                    this.$alertify.success('Resync task created, wait and update page to see result');
                }, () => {
                    this.$alertify.error('Fail to create resync task');
                });
            },
        }
    }
</script>
