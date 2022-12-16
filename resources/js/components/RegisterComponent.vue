<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div v-if="!url" class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <div role="alert" class="alert alert-danger"
                             v-for="errorMessage in errorMessages">
                            {{ errorMessage[0] }}
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" v-model="data.username" id="username" placeholder="Username">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone number</label>
                                <input type="text" class="form-control" v-model="data.phone_number" id="phone" placeholder="Phone number">
                            </div>

                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
                <div v-else class="card">
                    <div class="card-header">Generated Link</div>

                    <div class="card-body">
                        <a class="btn btn-primary" :href="url">{{ url }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'register-form',
        data() {
            return {
                data: {
                    username: null,
                    phone_number: null,
                },
                url: null,
                errorMessages: []
            }
        },
        methods: {
            submit() {
                return axios.post('', this.data)
                    .then(response => {
                        this.errorMessages = []
                        this.url = response.data.data['url']
                    })
                    .catch(error => {
                        this.errorMessages = error.response.data.errors;
                    });
            }
        }
    }
</script>
