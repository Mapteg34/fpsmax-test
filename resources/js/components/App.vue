<template>
    <div class="container">
        <main>
            <h1>FPSMax-test</h1>
            <resync-button></resync-button>
            
            <h2>Leagues list</h2>
            <leagues-list></leagues-list>
            
            <h2>Teams list</h2>
            <teams-list></teams-list>
            
            <h2>Matches list</h2>
            <matches-list></matches-list>
        </main>
    </div>
</template>

<script>
    const ResyncButton = require('./ResyncButton.vue').default;
    const LeaguesList = require('./LeaguesList.vue').default;
    const TeamsList = require('./TeamsList.vue').default;
    const MatchesList = require('./MatchesList.vue').default;
    
    export default {
        components: {
            ResyncButton,
            LeaguesList,
            TeamsList,
            MatchesList,
        },
    }
</script>
