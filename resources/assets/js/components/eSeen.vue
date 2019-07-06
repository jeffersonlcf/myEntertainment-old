<template>
    <div>
        <button class="btn" :class="[isSeen ? 'btn-success' : 'btn-outline-primary']" 
        @click="toggleSeen(entertainment)">
            Seen
        </button>
    </div>
</template>

<script>
    export default {
        props: ['entertainment', 'seen'],

        data: function () {
            return {
                isSeen: this.seen
            }
        },

        methods: {
            toggleSeen(entertainment) {
                axios.get('/entertainment/'+entertainment+'/seen')
                    .then(response => this.isSeen = !this.isSeen)
                    .catch(response => console.log(response.data));
            },
        }
    }
</script>