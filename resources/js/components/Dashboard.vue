<template>
    <div class="container">
        <div class="row">
            <div class="col-12" v-if="error">
                <div class="alert bg-danger text-white my-4 alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ error }}

                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header">Position</div>

                    <div class="card-body">{{records}}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="record in records">
                                        <td>{{ record.user.name }}</td>
                                        <td>{{ record.user.email }}/td>
                                        <td>{{ record.position }}/td>
                                        <td>{{ record.status }}/td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                records: [],
                error: ""
            }
        },
        setup() {
            const token = localStorage.getItem('bridgenote_token')

            mounted(() => {
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get('api/user-position')
                    .then(response => {
                        this.records = response.data.data
                    })
                    .catch(error => {
                        this.error = error.response.data.message
                    })
            })
        }
    }
</script>