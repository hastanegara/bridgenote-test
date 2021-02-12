<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-12" v-if="error">
                <div class="alert bg-danger text-white my-4 alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ error }}

                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">Login</div>
                        <div class="card-body">

                        <form @submit.prevent="submit">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" v-model="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"  v-model="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                password: "",
                error: ""
            }
        },
        methods: {
            submit() {
                axios.post('api/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    let data = response.data

                    localStorage.setItem('bridgenote_token', data.token)
                    this.$emit('setData')
                    this.$router.push({ name: 'dashboard' })
                }).catch(error => {
                    this.error = error.response.data.message
                })
            }
        }
    }
</script>