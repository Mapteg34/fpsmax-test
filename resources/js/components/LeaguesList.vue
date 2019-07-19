<template>
    <!--suppress XmlUnboundNsPrefix -->
    <list
        resource="leagues"
        ref="list"
        v-slot:item="{item}"
    >
        <div class="item league-item m-2" :id="`league${item.id}`">
            <p class="id"><span class="text-secondary">ID</span> {{ item.id }}</p>
            <p class="name"><span class="text-secondary">Название</span> {{ item.name }}</p>
        </div>
    </list>
</template>

<script>
    // noinspection JSUnusedGlobalSymbols
    export default {
    }
</script>
