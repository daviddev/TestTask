<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">Game</div>

                    <div class="card-body" style="min-height: 80px;">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-success" @click="startGame">Im feeling lucky</button>
                            </div>
                            <div class="col-md-3" v-if="number">
                                <h3>
                                    <template v-if="loading">{{ loadingNumber }}</template>
                                    <template v-else> {{ number }}</template>
                                </h3>
                            </div>
                            <div class="col-md-3" v-if="game_score">
                                <h3> {{ game_score.score }} </h3>
                            </div>
                            <div class="col-md-3" v-if="game_score">
                                <h3>
                                    <span class="badge" :class="game_score.is_win ? 'bg-success': 'bg-danger'">
                                        {{ game_score.is_win ? 'Win' : 'Lose' }}
                                    </span>
                                </h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">History</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Score</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in history" :class="item.is_win ? 'table-success' : 'table-danger'">
                                <th>{{ item.number }}</th>
                                <td>{{ item.score }}</td>
                                <td>{{ item.is_win ? 'Win' : 'Lose' }}</td>
                                <td>{{ item.created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary" @click="showHistory">Show History</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">Generate link</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Link</th>
                                <th scope="col">Expired at</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="manualLink in manualLinks" :key="manualLink.id">
                                <th>
                                    <a :href="manualLink.url" class="btn btn-sm btn-info">{{ manualLink.url }}</a>
                                </th>
                                <td>
                                    <template v-if="manualLink.status === 'active'">
                                        {{ $filters.dateFormat(manualLink.expired_at) }}
                                    </template>
                                    <template v-else> -</template>
                                </td>
                                <td>
                                    <template v-if="manualLink.status === 'inactive'">
                                       <span class="badge bg-danger">Deactivated</span>
                                    </template>
                                    <template v-if="manualLink.status === 'active'">
                                        <button class="btn btn-sm btn-warning" @click="deactivateLink(manualLink.id)">Deactivate</button>
                                    </template>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary" @click="generateLink">Generate Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'game',
        data() {
            return {
                data: {
                    username: null,
                    phone_number: null,
                },
                history: [],
                errorMessages: [],
                manualLinks: this.user.manual_links,
                loading: false,
                loadingNumber: null,
                number: null,
                game_score: null
            }
        },
        props: ['link', 'user'],
        methods: {
            startGame() {
                this.game_score = null
                this.loading = true
                this.getLoadNumbers()
                this.number = Math.floor(Math.random() * 1000) + 1

                return axios.post(`/game/${this.link.key}/score`, {number: this.number})
                    .then(response => {
                        this.game_score = response.data.data
                        this.loading = false
                    })
                    .catch(error => {
                        location.reload()
                    });
            },
            generateLink() {
                return axios.post(`/game/${this.link.key}/link`)
                    .then(response => {
                        this.manualLinks = response.data.data
                    })
                    .catch(error => {
                        location.reload()
                    });
            },
            deactivateLink(id) {
                return axios.post(`/game/${this.link.key}/link/${id}/deactivate`)
                    .then(response => {
                        this.manualLinks = response.data.data
                    })
                    .catch(error => {
                        location.reload()
                    });
            },
            getLoadNumbers() {
                if (this.loading) {
                    setInterval(() => {
                        this.loadingNumber = Math.floor(Math.random() * 1000) + 1
                    }, 5);
                }
            },
            showHistory() {
                return axios.get(`/game/${this.link.key}/score/`, this.data)
                    .then(response => {
                        this.history = response.data.data
                    })
                    .catch(error => {
                        location.reload()
                    });
            },
        }
    }
</script>

<style lang="scss" scoped>
    .badge {
        border-radius: 4px;
        padding: 8px;
    }
</style>
