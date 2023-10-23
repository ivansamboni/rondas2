<template>
  <div id="toast" class="hidden"><i class="bi bi-check-circle"></i> Se agregó correctamente.</div>

  <br>

  <div class="container"> <button type="button" class="btnblue2" @click="modalnuevo()" data-bs-toggle="modal" data-bs-target="#agregarServicio">
    <font-awesome-icon icon="fa-solid fa-file" size="1x" /> Nuevo Servicio
  </button>
  <hr>
    <div class="row">
      <div class="card  mb-2 text-dark" style="max-width: 9rem;" v-for="ser in serviciosData" :key="ser.id">
        <div class="col text-center">
          <a class="text-dark" href="#" @click="editarServicio(ser.id)" data-bs-toggle="modal"
            data-bs-target="#agregarServicio" title="Editar">
            <font-awesome-icon icon="fa-solid fa-pen-to-square" size="1x" />
          </a>&nbsp;
          <a class="text-danger" href="#" @click="eliminarServicios(ser.id);" title="Eliminar">
            <font-awesome-icon icon="fa-solid fa-trash" />
          </a>
          <br>
          <h7><i class="bi bi-building"></i> {{ ser.servicio }}</h7> 
        </div>
      </div>
    </div>
  </div>



  <!-- Modal nuevo servicio-->
  <div class="modal fade" id="agregarServicio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center" id="staticBackdropLabel">{{ titulo }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" v-model="servedit.servicio">
        </div>
        <div class="modal-footer">
          <button type="button" class="btnred" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="btncrear" @click="crearServicio()" class="btnblue2"
            data-bs-dismiss="modal">Crear</button>
          <button type="button" id="btnactualizar" @click="actualizarServicio()" class="btnblue2"
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
      servedit: {
        id: '',
        servicio: ''
      },
      titulo: '',
      serviciosData: [],

    }
  },

  methods: {

    async listarServicios() {
      const res = await axios.get('api/servicios');
      this.serviciosData = res.data;
      console.log(res.data);
    },

    modalnuevo() {
      btncrear.hidden = false;
      btnactualizar.hidden = true;
      this.titulo = 'Crear Servicio';
      this.servedit.servicio = '';
    },

    async crearServicio() {
      try {
        const res = await axios.post('api/servicios', this.servedit);
        toastf(res);
      }
      catch (error) {
        alert('El servicio ya existe');
      };
      this.servedit.servicio = '';
      this.listarServicios();
    },

    async editarServicio(id) {
      btnactualizar.hidden = false;
      btncrear.hidden = true;
      const res = await axios.get('api/servicios/' + id);
      this.servedit.id = res.data.id;
      this.servedit.servicio = res.data.servicio;
      this.titulo = 'Editar Servicio';
    },

    async actualizarServicio() {
      const res = await axios.put('api/servicios/' + this.servedit.id, this.servedit);
      this.listarServicios(res);
    },

    async eliminarServicios(id) {
      let confirmac = confirm('Eliminar este servicio?');
      if (confirmac) {
        const res = await axios.delete('api/servicios/' + id);
        this.listarServicios();

      }
    },
  },
  created() {
    this.listarServicios();
  },

}
</script>