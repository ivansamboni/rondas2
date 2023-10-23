<template>
  <div id="toast" class="hidden"><i class="bi bi-check-circle"></i> Se agregó correctamente.</div>
  <br>

  <div class="container"> <button type="button" class="btnblue2" @click="modalnuevo()" data-bs-toggle="modal" data-bs-target="#agregarcargo">
    <font-awesome-icon icon="fa-solid fa-file" size="1x" /> Nuevo Cargo
  </button>
  <hr>
    <div class="row">
      <div class="card  mb-2 text-dark" style="max-width: 9rem;" v-for="car in cargosData" :key="car.id">
        <div class="col text-center">
          <a class="text-dark" href="#" @click="editarCargo(car.id)" data-bs-toggle="modal"
            data-bs-target="#agregarcargo">
            <font-awesome-icon icon="fa-solid fa-pen-to-square" size="1x" />
          </a>&nbsp;
          <a class="text-danger" href="#" @click="eliminarCargo(car.id);">
            <font-awesome-icon icon="fa-solid fa-trash" />
          </a><br>
          <h7><i class="bi bi-person-vcard"></i> {{ car.cargo }}</h7> 
        </div>
      </div>
    </div>
  </div>


  <!-- Modal nuevo Cargo-->
  <div class="modal fade" id="agregarcargo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center" id="staticBackdropLabel">{{ titulo }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" v-model="cargoedit.cargo">
        </div>
        <div class="modal-footer">
          <button type="button" class="btnred" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="btncrear" @click="crearCargo()" class="btnblue2"
            data-bs-dismiss="modal">Crear</button>
          <button type="button" id="btnactualizar" @click="actualizarCargo()" class="btnblue2"
            data-bs-dismiss="modal">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { toastf } from '../../helpers/functions.js'
export default {
  data() {
    return {
      cargoedit: {
        id: '',
        cargo: ''
      },
      titulo: '',
      cargosData: [],
      estrats: [],

    }
  },

  methods: {

    async listarEstra() {
      const res = await axios.get('api/estrategias');
      this.estrats = res.data;
    },

    async listarCargos() {
      const res = await axios.get('api/cargos');
      this.cargosData = res.data;
    },

    modalnuevo() {
      btncrear.hidden = false;
      btnactualizar.hidden = true;
      this.titulo = 'Crear cargo';
      this.cargoedit.cargo = '';
    },

    async crearCargo() {
      try {
        const res = await axios.post('api/cargos', this.cargoedit);
        toastf(res);
      } catch (error) {
        alert('El cargo ya existe');
      }
      this.cargoedit.cargo = '';
      this.listarCargos();
    },

    async editarCargo(id) {
      btnactualizar.hidden = false;
      btncrear.hidden = true;
      const res = await axios.get('api/cargos/' + id);
      this.cargoedit.id = res.data.id;
      this.cargoedit.cargo = res.data.cargo;
      this.titulo = 'Editar Cargo';
    },

    async actualizarCargo() {
      const res = await  axios.put('api/cargos/' + this.cargoedit.id, this.cargoedit);      
      this.listarCargos(res);
    },

    async eliminarCargo(id) {
      let confirmac = confirm('Eliminar este cargo?');
      if (confirmac) {
        const res = await axios.delete('api/cargos/' + id);
        this.listarCargos(res);

      }
    },
  },
  created() {
    this.listarCargos();
    this.listarEstra();
  },

}
</script>