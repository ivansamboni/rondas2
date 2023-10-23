<template>
    <br><br>

    <div class="modal" id="modalusuario" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center"><i class="bi bi-person-circle"></i> {{ modaltitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Nombre de Usuario</label>

                        <div class="col-md-6">
                            <input id="name" type="text" v-model="registro.name" class="form-control" name="name" required
                                @input="validator()" autocomplete="name" autofocus>
                            <h7 v-if="registro.name == 0" style="color:red;">Completa este campo</h7>
                            <h7 v-else style="color:rgb(24, 207, 79);"><i class="bi bi-check-circle"></i> Completado</h7>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electronico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" v-model="registro.email" class="form-control" name="email"
                                required @input="validator()" autocomplete="email">
                            <h7 v-if="registro.email == 0" style="color:red;">Completa este campo</h7>
                            <h7 v-else style="color:rgb(24, 207, 79);"><i class="bi bi-check-circle"></i> Completado</h7>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="rol" class="col-md-4 col-form-label text-md-end">Rol</label>
                        <div class="col-md-6">
                            <select name="rol" v-model="registro.rol" class="form-select" @change="validator()">
                                <option value="admin">Administrador</option>
                                <option value="auditor">Auditor</option>
                            </select>
                            <h7 v-if="registro.rol == 0" style="color:red;">Debe escoger un rol</h7>
                            <h7 v-else style="color:rgb(24, 207, 79);"><i class="bi bi-check-circle"></i> Completado</h7><br><br>
                            <div class="alert alert-info" role="alert">
                               El Auditor solo podrá ver informes pero no podrá crear usuarios ni podrá crear formularios o editarlos
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btnred" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btncrear" disabled @click="crearUsuario()" class="btnblue2"
                        data-bs-dismiss="modal">Crear usuario</button>
                    <button type="button" id="btnactualizar" disabled @click="actualizarUsuario()" class="btnblue2"
                        data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead><button type="button" @click="modalCrear()" class="btnblue2" data-bs-toggle="modal"
                    data-bs-target="#modalusuario">
                    + Crear usuario
                </button>
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Fecha de Creación</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td><i class="bi bi-person-circle"></i> {{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td><strong>{{ user.rol }}</strong></td>
                    <td>{{ moment(user.created_at).format("DD/MM/YYYY") }}</td>
                    <td><button class="btnblue2" @click="showUser(user.id); modalEditar();" data-bs-toggle="modal"
                            data-bs-target="#modalusuario">
                            <i class="bi bi-pencil-square"></i></button></td>
                    <td><button class="btnred" @click="deleteuser(user.id);">
                            <font-awesome-icon icon="fa-solid fa-trash" /></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from "moment";
export default {
    data() {
        return {
            moment: moment,
            registro: { id: '', name: '', email: '', rol: '' },
            modaltitle: '',
            users: []
        }

    },

    methods: {

        validator() {
            if (this.registro.name !== '' && this.registro.email !== ''
                && this.registro.rol !== '') {
                btncrear.disabled = false;
                btnactualizar.disabled = false;
            } else {
                btncrear.disabled = true;
                btnactualizar.disabled = true;
            }
        },

        modalCrear() {
            btncrear.style.display = 'block';
            btnactualizar.style.display = 'none';
            this.modaltitle = 'Crear Nuevo Usuario';
            this.registro.name = '';
            this.registro.email = '';
            this.registro.rol = '';
        },
        modalEditar() {
            this.modaltitle = 'Editar Datos de Usuario';
            btncrear.style.display = 'none';
            btnactualizar.style.display = 'block';

        },

        async listusers() {
            const res = await axios.get('api/userlist');
            this.users = res.data;
        },

        async crearUsuario() {
            const res = await axios.post('api/users', this.registro).then(function (response) {
                alert('Usuario Creado con Éxito');
            })
                .catch(function (error) {
                    alert('El correo eléctronico ya existe o no cumple con el formato de correo');
                });    
            this.listusers();
            this.validator();
        },

        async showUser(id) {
            const res = await axios.get('api/showuser/' + id);
            this.registro.id = res.data.id;
            this.registro.name = res.data.name;
            this.registro.email = res.data.email;
            this.registro.rol = res.data.rol;

        },

        async actualizarUsuario() {
            const res = await  axios.put('api/updateuser/' + this.registro.id, this.registro)
                .then(function (response) {
                    alert('Datos Actualizados con Éxito')
                })
                .catch(function (error) {
                    alert('No se actualizaron los datos el correo ya existe o tiene un formato incorrecto');
                });
            this.listusers(res);
            this.validator();
        },

        async deleteuser(id) {
            let confirmac = confirm('Eliminar este usuario?');
            if (confirmac) {
                const res = await axios.get('api/users/' + id);
                this.listusers();
            }
        },

    },
    created() {
        this.listusers();
    },

}

</script>