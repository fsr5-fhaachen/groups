<template>
    <div>
        <div class="container position-relative">
            <div class="bg mt-3 ml-5 pl-5 opacity-25"></div>
            <div class="row pt-5 pt-lg-0 position-relative">
                <div class="col-lg-6 mx-auto mt-5 pt-5 pt-lg-0">
                    <h1>Herzlich Willkommen bei der Erstiwoche des FB5!</h1>
                    <div>Melde dich bitte hier an um einer Gruppe zugeordnet zu werden.</div>
                    <div class="mt-3">
                        <form @submit.prevent="submit">
                            <div class="form-group">
                                <label for="firstname"></label>
                                <input type="text" class="form-control" id="firstname"
                                       placeholder="Vorname" v-model="form.firstname">
                                <div class="text-danger" v-if="form.errors.firstname"><strong>{{ form.errors.firstname
                                    }}</strong></div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="lastname"></label>
                                <input type="text" class="form-control" id="lastname"
                                       placeholder="Nachname" v-model="form.lastname">
                                <div class="text-danger" v-if="form.errors.lastname"><strong>{{ form.errors.lastname
                                    }}</strong></div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="email"></label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                       placeholder="E-Mail" v-model="form.email">
                                <div class="text-danger" v-if="form.errors.email"><strong>{{ form.errors.email
                                    }}</strong></div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="input-group pt-1">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="course">Studiengang</label>
                                    </div>
                                    <select class="custom-select form-control" id="course" v-model="form.course">
                                        <option disabled value="">Wähle deinen Studiengang aus</option>
                                        <option value="MCD">MCD</option>
                                        <option value="WI">WI</option>
                                        <option value="INF">INF</option>
                                        <option value="ET">ET</option>
                                    </select>
                                </div>
                                <div class="text-danger" v-if="form.errors.course"><strong>{{ form.errors.course}}</strong></div>
                            </div>
                            <div v-if="timeslots.length" class="form-group mt-4">
                                <div class="input-group pt-1">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="timeslot_id">Zeitslot</label>
                                    </div>
                                    <select class="custom-select form-control" id="timeslot_id" v-model="form.timeslot_id">
                                        <option selected value="">Wähle deinen gewünschten Zeitslot aus</option>
                                        <option v-for="timeslot in timeslots" :key="timeslot.id" :value="timeslot.id" >{{ timeslot.name }}</option>
                                    </select>
                                    <small class="mt-2">Wir versuchen dir deinen präferierten Zeitslot anzubieten, können dir aber nicht versprechen, dass du diesen auch bekommst. Allgemein gilt hier, wie beim Kauf einer PlayStation 5, first come first serve.</small>
                                </div>
                                <div class="text-danger" v-if="form.errors.timeslot_id"><strong>{{ form.errors.timeslot_id}}</strong></div>
                            </div>
                            <button type="submit" class="btn btn-primary text-white mt-3">Anmelden</button>
                        </form>
                    </div>
                    <div class="mt-3">
                        <Link href="/login/">Du hast dich schon für diese Gruppenphase angemeldet? Dann logge dich hier ein.</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import { Link } from '@inertiajs/inertia-vue';
    export default {
        name: 'Index',
        components: {
            Link
        },
        props: {
            timeslots: {
                type: Array,
            }
        },
        data() {
            return {
                form: this.$inertia.form({
                    firstname: null,
                    lastname: null,
                    email: null,
                    course: '',
                    timeslot_id: '',
                }),
            }
        },
        methods: {
            submit() {
                this.form.post('/');
            },
        },
    }
</script>
<style scoped >
    .input-group > .input-group-prepend > .input-group-text {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }
</style>
