<template>
    <div>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light shadow-sm">
            <router-link :to="{name: 'dashboard' }" class="navbar-brand">Bridgenote</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <template v-if="isLoggedIn">
                        <li class="nav-item">
                            <a class="nav-link"  @click="logout"> Logout</a>
                        </li>
                    </template>
                </ul>
            </div>
        </nav>

        <main class="pt-4">
            <router-view @setData="getData"></router-view>
        </main>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isLoggedIn: null
            }
        },
        beforeMount() {
            this.getData()
        },
        methods: {
            getData() {
                this.isLoggedIn = localStorage.getItem('bridgenote_token') !== null
            },
            logout() {
                localStorage.removeItem('bridgenote_token')
                this.getData()
                this.$router.push('/')
            }
        }
    }
</script>