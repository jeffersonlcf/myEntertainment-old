<template>
    <article class="dropdown mx-2 d-inline w-100">
        <section class="input-group">
            <input class="form-control" type="text" placeholder="Search" v-model="search" v-on:keyup="findFilms">
            <div class="input-group-append">
                <span class="input-group-text">
                    <svg focusable="false" height="20px" viewBox="0 0 20 24" width="20px" xmlns="http://www.w3.org/2000/svg"><path d="M20.49,19l-5.73-5.73C15.53,12.2,16,10.91,16,9.5C16,5.91,13.09,3,9.5,3S3,5.91,3,9.5C3,13.09,5.91,16,9.5,16 c1.41,0,2.7-0.47,3.77-1.24L19,20.49L20.49,19z M5,9.5C5,7.01,7.01,5,9.5,5S14,7.01,14,9.5S11.99,14,9.5,14S5,11.99,5,9.5z"></path></svg>
                </span>
            </div>
             <div class="dropdown-menu w-100" :class="{show: isActive}">
                <table class="table table-hover table-borderless">
                    <tbody>
                        <tr v-if="this.results.length === 0">
                            <th scope="row">
                                <p class="text-center">Oops... Nothing Found!</p>   
                            </th>
                        </tr>
                        <tr v-else v-bind:key="result.id" v-for="result in results">
                            <th scope="row">
                                <div class="d-inline-flex">
                                    <div class="float-left mr-2">
                                        <svg v-if="result.image === ''" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 25 25" fill="currentColor" role="presentation"><path d="M18 4v1h-2V4c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v1H6V4c0-.55-.45-1-1-1s-1 .45-1 1v16c0 .55.45 1 1 1s1-.45 1-1v-1h2v1c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-1h2v1c0 .55.45 1 1 1s1-.45 1-1V4c0-.55-.45-1-1-1s-1 .45-1 1zM8 17H6v-2h2v2zm0-4H6v-2h2v2zm0-4H6V7h2v2zm10 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2z"></path></svg>
                                        <img v-else v-bind:alt="result.title" v-bind:src="result.image" class="rounded" width="50">
                                    </div>
                                    <div>
                                        <a :href="result.showUrl">
                                            <h5>
                                                {{ result.title }} ({{ result.type }})
                                            </h5>
                                            <p>{{ result.year }}</p>
                                        </a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </article>
</template>

<script>
    export default {
        data: function() {
            return {
                search: '',
                isActive: false,
                results: [],
                timer: 0,
            };
        },
        created: function () {
            this.clickOutside();
        },
        methods: {
            findFilms: function () {

                clearTimeout(this.timer);
                this.timer = null;
                
                this.timer = setTimeout(() => {
                    if (this.search === '') {
                        this.isActive = false;
                    } else {
                        axios.get(this.url).then(response => {
                            this.results = response.data.results;
                            this.isActive = true;
                        });
                    }
                }, 500);
            },
            clickOutside: function () {
                let self = this;
                window.addEventListener('click', function (e) {
                    if (!self.$el.contains(e.target)) {
                        self.isActive = false;
                    }
                });
            }
        },
        computed: {
            url(){
                return '/api/search?q=' + this.search;
            }
        } 
    }
</script>