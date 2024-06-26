<?php
require "sesion.php"; 
include_once "header.php";
include_once "nav.php";
?>
<div class="row" id="app">
    <div class="col-12">
        <h1 class="display-4 text-center my-4">Asistencia al Comedor Infantil</h1>
    </div>
    <div class="col-12">
        <div class="form-inline mb-2">
            <label for="date">Date: &nbsp;</label>
            <input @change="refreshAlumnosList" v-model="date" name="date" id="date" type="date" class="form-control">
            <button @click="save" class="btn btn-success ml-2">Save</button>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Alumno
                        </th>
                        <th>
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="alumno in alumnos">
                        <td>{{alumno.nombre}}</td>
                        <td>
                            <select v-model="alumno.estado" class="form-control">
                                <option disabled value="unset">Selecciona una Opción</option>
                                <hr>
                                <option value="asistencia">Asistencia</option>
                                <option value="falta">Falta</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="js/vue.min.js"></script>
<script src="js/vue-toasted.min.js"></script>
<script>
    Vue.use(Toasted);
    const UNSET_ESTADO = "unset";
    new Vue({
        el: "#app",
        data: () => ({
            alumnos: [],
            date: "",
        }),
        async mounted() {
            this.date = this.getTodaysDate();
            await this.refreshAlumnosList();
        },
        methods: {
            getTodaysDate() {
                const date = new Date();
                const month = date.getMonth() + 1;
                const day = date.getDate();
                return `${date.getFullYear()}-${(month < 10 ? '0' : '').concat(month)}-${(day < 10 ? '0' : '').concat(day)}`;
            },
            async save() {
                // We only need id and status, nothing more
                let alumnosMapped = this.alumnos.map(alumno => {
                    return {
                        id: alumno.id,
                        estado: alumno.estado,
                    }
                });
                // And we need only where status is set
                alumnosMapped = alumnosMapped.filter(alumno => alumno.estado != UNSET_ESTADO);
                const payload = {
                    date: this.date,
                    alumnos: alumnosMapped,
                };
                const response = await fetch("./save_attendance_data.php", {
                    method: "POST",
                    body: JSON.stringify(payload),
                });
                this.$toasted.show("Saved", {
                    position: "top-left",
                    duration: 1000,
                });
            },
            async refreshAlumnosList() {
                // Get all "alumnos"
                let response = await fetch("./get_alumnos_ajax.php");
                let alumnos = await response.json();
                // Set default status: unset
                let alumnoDictionary = {};
                alumnos = alumnos.map((alumno, index) => {
                    alumnoDictionary[alumno.id] = index;
                    return {
                        id: alumno.id,
                        nombre: alumno.nombre,
                        estado: UNSET_ESTADO,
                    }
                });
                // Get attendance data, if any
                response = await fetch(`./get_attendance_data_ajax.php?date=${this.date}`);
                let attendanceData = await response.json();
                // Refresh attendance data in each "alumno", if any
                attendanceData.forEach(attendanceDetail => {
                    let alumnoId = attendanceDetail.alumno_id;
                    if (alumnoId in alumnoDictionary) {
                        let index = alumnoDictionary[alumnoId];
                        alumnos[index].estado = attendanceDetail.estado;
                    }
                });
                // Let Vue do its magic ;)
                this.alumnos = alumnos;
            }
        },
    });
</script>
<?php
include_once "footer.php";
