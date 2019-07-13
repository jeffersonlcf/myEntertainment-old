<template>
    <div>
        <star-rating v-model="newRating" :show-rating="false" @rating-selected="sendRequest"/>
    </div>
</template>
<script type="text/javascript">
import StarRating from './starrating/star-rating';

export default {
    props: ['entertainment', 'rating'],

    data() {
        return {
            newRating: this.rating
        }
    },

    components: {
        StarRating
    },
    methods: {
        sendRequest() {
            axios.get('/entertainment/'+this.entertainment+'/rating?rating='+this.newRating)
            .then(response => this.isSeen = !this.isSeen)
            .catch(response => console.log(response.data));
        }
    },
}
</script>
