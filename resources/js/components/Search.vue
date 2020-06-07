<template>
    <div class="dropdown w-50">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search" v-model="search" v-on:keyup="findFilms">
            <div class="input-group-append">
                <span class="input-group-text">
                    <svg focusable="false" height="20px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="M20.49,19l-5.73-5.73C15.53,12.2,16,10.91,16,9.5C16,5.91,13.09,3,9.5,3S3,5.91,3,9.5C3,13.09,5.91,16,9.5,16 c1.41,0,2.7-0.47,3.77-1.24L19,20.49L20.49,19z M5,9.5C5,7.01,7.01,5,9.5,5S14,7.01,14,9.5S11.99,14,9.5,14S5,11.99,5,9.5z"></path><path d="M0,0h24v24H0V0z" fill="none"></path></svg>
                </span>
            </div>
        </div>
        <div class="dropdown-menu" :class="{show: isActive}">
            <a class="dropdown-item" href="#" v-bind:key="result.id" v-for="result in results">
                <div class="card border-light flex-row">
                    <img v-bind:alt="result.title" v-bind:src="result.image" width="50">
                    <div class="px-2">
                        <h5 class="card-title">{{ result.title }} ({{ result.type }})</h5>
                        <p class="card-text">{{ result.year }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                search: '',
                isActive: false,
                results: [],
            };
        },
        methods: {
            findFilms: function () {
                if (this.search === '') {
                    this.isActive = false;
                } else {
                    axios.get(this.url).then(response => {
                        this.results = response.data.results
                        this.isActive = true;
                    });
                }
            }
        },
        computed: {
            url(){
                return '/api/search?q=' + this.search;
            }
        } 
    }
</script>
