<template>
    <div class="col-xs-1-12">
        <div class="card">
            <div class="card-body">
                <div class="modal fade" id="modalestras" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Estrategias</strong> </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="container">
                                    <div class="row">
                                        <button class="card border-dark mb-2" style="max-width: 10rem;"
                                            v-for="estra in estrategias" :key="id" data-bs-dismiss="modal"
                                            @click="selecestra(estra.id, estra.estrategia)">
                                            <i class="bi bi-journal-text"
                                                style="font-size: 1rem; color: cornflowerblue;"></i>
                                            {{ estra.estrategia }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btnred" data-bs-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalguardar" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Guardar avance</strong></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="avance">Nombre del avance</label>
                                <input type="text" name="avance" v-model="auditar.auditoria" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btnred" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" @click="guardar()" class="btnblue2" data-bs-dismiss="modal">Guardar
                                    avance</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalabrir" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Avances guardados</strong></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <button class="card border-info mb-3" style="max-width: 7rem;"
                                            v-for="aud in auditorias" :key="id" data-bs-dismiss="modal"
                                            @click="selecauditoria(aud.auditoria)">
                                            <i class="bi bi-journal-text"
                                                style="font-size: 1rem; color: cornflowerblue;"></i>
                                            {{ aud.auditoria }}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><strong><i
                                            class="bi bi-info-circle"></i> Información</strong></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-info" role="alert">
                                    <i class="bi bi-search"></i>
                                    Estrategias: Aquí encontrará todos los formularios creados con todos sus ítems para ser
                                    evaluados, solo basta con pulsar y seleccionar el formulario que desea evaluar. El
                                    formulario solo se podrá enviar si todos sus ítems están seleccionados con su respectiva
                                    respuesta (C,NC,NA).
                                </div>
                                <div class="alert alert-info" role="alert">
                                    <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                                    Guardar: Aquí podrás guardar tu avance si no alcanzas a completar todos los ítems,
                                    podrás guardar sin necesidad de completar el formulario para terminarlo después, debes
                                    poner un nombre al avance y que no exista, seleccionar el servicio y el cargo estas
                                    opciones no pueden estar vacías.
                                </div>
                                <div class="alert alert-info" role="alert">
                                    <i class="bi bi-download"></i>
                                    Abrir: Aquí podrás cargar un avance que hayas guardado previamente para completar la
                                    auditoria asegúrate de cargar el avance indicado ya que cuando envíes el formulario
                                    completo este archivo de avance se eliminará
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modalestras"><i
                                class="bi bi-search"></i>
                            Estrategias
                        </a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modalguardar">
                            <font-awesome-icon icon="fa-solid fa-floppy-disk" /> Guardar
                        </a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modalabrir">
                            <i class="bi bi-download"></i> Abrir
                        </a>
                    </div>
                    <div class="col">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modalinfo">
                            <i class="bi bi-info-circle"></i> Info
                        </a>
                    </div>
                </div>
                <hr><br>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" id="spinner" role="status" style="display: none;"></div>
                    <h3><i class="bi bi-journal-text"></i> Estrategia
                        <strong>
                            {{ auditar.estrategia }}
                        </strong>
                    </h3>
                </div><br>
                <br>
                <div v-if="auditar.estrategia !== ''">
                    <h5 class="text-center"><i class="bi bi-building"></i> Servicio <strong>{{ auditar.servicio
                    }}</strong>
                    </h5>
                    <select name="servicio" v-model="auditar.servicio" class="form-control" required>
                        <option value="">Seleccione Servicio</option>
                        <option v-for="serv in servicios" :key="serv.id">{{ serv.servicio }}</option>

                    </select>
                    <br>
                    <h5 class="text-center"><i class="bi bi-person-vcard"></i> Cargo <strong>{{ auditar.cargo
                    }}</strong>
                    </h5>
                    <select name="cargo" v-model="auditar.cargo" class="form-control" required>
                        <option value="">Seleccione Cargo</option>
                        <option v-for="carg in cargos" :key="carg.id">{{ carg.cargo }}</option>

                    </select>


                    <br><br>
                    <hr>

                    <div v-for="(ite, index) in items" :key="index">
                        <div class="alert alert-info" role="alert">
                            <h6><strong>{{ ite }}</strong></h6>

                            <select v-model="auditar.respuesta[index]" class="form-control">
                                <option>N/A</option>
                                <option style="color:green;">C</option>
                                <option style="color:red;">NC</option>
                            </select>
                        </div>

                        <hr>
                    </div>
                    <label for="observacion">Observación:</label>
                    <textarea name="observacion" v-model="auditar.observacion" rows="3" class="form-control"></textarea>
                    <br>
                    <br>
                    <br>
                    <button v-if="this.auditar.pregunta.length == this.auditar.respuesta.length
                        && this.auditar.servicio !== '' && this.auditar.cargo !== ''" @click="enviar()"
                        class="btnblue2 form-control">Enviar</button>
                    <button v-else disabled class="btn btn-secondary form-control">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

let user = document.head.querySelector('meta[name="user"]');

export default {
    data() {
        return {
            auditar: {
                estrategia: '',
                servicio: '', cargo: '', pregunta: [], respuesta: [], observacion: '',
                auditor: '', estrategia_id: '', auditoria: '',
            },

            seleccestrategia: '',
            servicios: [],
            estrategias: [],
            cargos: [],
            items: [],
            auditorias: []
        }
    },
    computed: {
        user() {
            return JSON.parse(user.content);
        }
    },

    methods: {

        async listarestras() {
            const res = await axios.get('api/estrategialist');
            this.estrategias = res.data;
            this.auditar.auditor = this.user.name;
        },
        async listarservis() {
            const res = await axios.get('api/servicios');
            this.servicios = res.data;
        },
        async listarcargos() {
            const res = await axios.get('api/cargos');
            this.cargos = res.data;
        },
        async listarauditorias() {
            const res = await axios.get('api/auditorias');
            this.auditorias = res.data;
        },

        async selecauditoria(aud) {
            spinner.style.display = 'block';
            const res = await axios.get('api/auditoriasshow/' + aud);
            this.auditar.estrategia_id = res.data[0].estrategia_id;
            this.auditar.estrategia = res.data[0].estrategia;
            this.auditar.auditoria = res.data[0].auditoria;
            this.auditar.servicio = res.data[0].servicio;
            this.auditar.cargo = res.data[0].cargo;
            this.auditar.respuesta = res.data.map(objeto => objeto.respuesta);
            const resitem = await axios.get('api/estrategiashow/' + this.auditar.estrategia_id);
            this.items = resitem.data;
            this.auditar.pregunta = resitem.data;
            spinner.style.display = 'none';

        },

        async selecestra(id, estra) {
            spinner.style.display = 'block';
            const res = await axios.get('api/estrategiashow/' + id);
            this.items = res.data;
            this.auditar.estrategia_id = id;
            this.auditar.servicio = '';
            this.auditar.cargo = '';
            this.auditar.estrategia = estra;
            this.auditar.pregunta = res.data;
            this.auditar.respuesta.splice(0, this.auditar.respuesta.length);
            spinner.style.display = 'none';

        },
        push() {
            this.auditar.respuesta.push(this.auditar.respuesta);
        },

        async enviar() {
            let confirmac = confirm('¿Enviar formulario?');
            if (confirmac) {
                await axios.post('/enviar', this.auditar).then(function (response) {
                    window.location.href = '/home';
                })
                    .catch(function (error) {
                        alert('Debe completar todas las opciones');
                    });
            }
        },

        async guardar() {
            await axios.post('/enviarjs', this.auditar).then(function (response) {
                alert('Se guardó el avance con éxito');
            })
                .catch(function (error) {
                    alert('Debe poner un nombre al avance y que ya no exista, y seleccionar un servicio y un cargo');
                });
            this.listarauditorias();
            this.auditar.auditoria = '';
        },

    },
    created() {
        this.listarservis();
        this.listarcargos();
        this.listarestras();
        this.listarauditorias();

    }
}

</script>
