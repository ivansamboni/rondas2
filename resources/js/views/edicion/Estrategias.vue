<template>
  <div id="toast" class="hidden"><i class="bi bi-check-circle"></i> Se agregó correctamente.</div>
  <div class="row">
    <div class="overflow-auto p-10 bg-light" style="max-width: 300px; max-height: 500px;">
      <div class="list-group" id="list-tab" role="tablist">
        <button type="button" class="btnblue2" data-bs-toggle="modal" @click="limpiarmodal()"
          data-bs-target="#ModalAgestr">
          <font-awesome-icon icon="fa-solid fa-file" size="1x" /> Nuevo Formulario
        </button>
        <tr v-for="est in estrats" :key="est.id">
          <a class="list-group-item list-group-item-action" @click="seleccestrat(est.id, est.estrategia)"
            id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">
            <i class="bi bi-journal-text"></i> {{ est.estrategia }}</a>
        </tr>
      </div>
    </div>

    <div class="col-sm-8"><br>

      <div class="card" id="formestrategia" style="display:none;">
        <div class="card-body"><br>

          <h3 align="center">{{ txtestrats.estrategia }} <button type="button" class="btnblue2 btn-sm"
              data-bs-toggle="modal" data-bs-target="#Modaleditestr"><font-awesome-icon icon="fa-solid fa-pen-to-square"
                size="sm" /></button>
            <input type="text" hidden v-model="txtitems.estrategia_id"> <button type="button"
              @click="eliminarEstrategia(txtitems.estrategia_id)" class="btnred btn-sm"><font-awesome-icon
                icon="fa-solid fa-trash" /></button><input type="text" id="titestra" style="display:none;float:center;">
            <input type="text" hidden v-model="txtitems.estrategia_id">

          </h3><br>
          <textarea v-model="txtitems.item" rows="1" class="form-control" placeholder="Nuevo Item"></textarea><br>
          <button type="button" style="float:right;"
            @click="crearItem(txtitems.estrategia_id); seleccestrat(txtitems.estrategia_id, txtestrats.estrategia);"
            class="btnblue2 btn-sm">+ Agregar Item</button>

          <br><br>
          <hr>
          <table class="table" style="width:100%;">
            <thead>
              <tr>
                <th>Items</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody><br>
              <tr v-for="est in estratsitems" :key="est.id">
                <th>{{ est.item }}</th>
                <td><button class="btnblue2 btn-sm" data-bs-toggle="modal" data-bs-target="#Modaledititem"
                    @click="editarItem(est.id);"><font-awesome-icon icon="fa-solid fa-pen-to-square" size="1x" /></button>
                </td>
                <td><button class="btnred btn-sm"
                    @click="eliminarItem(est.id); seleccestrat(txtitems.estrategia_id, txtestrats.estrategia);"><font-awesome-icon
                      icon="fa-solid fa-trash" /></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal nueva estrategia -->
  <div class="modal fade" id="ModalAgestr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center" id="ModalAgestr">Nueva Estrategia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input ref="input1" type="text" class="form-control" v-model="txtestrats.estrategia">

        </div>
        <div class="modal-footer">
          <button type="button" class="btnred btn-sm" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" @click="crearEstra()" class="btnblue2 btn-sm" data-bs-dismiss="modal">Agregar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edit estrategia -->
  <div class="modal fade" id="Modaleditestr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center" id="Modaleditestr">Editar nombre de estrategia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <input type="text" class="form-control" v-model="txtestrats.estrategia">

        </div>
        <div class="modal-footer">
          <button type="button" class="btnred btn-sm" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" @click="actualizarEstra();" class="btnblue2 btn-sm"
            data-bs-dismiss="modal">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal editar item -->
  <div class="modal fade" id="Modaledititem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center" id="Modaledititem">Modificar Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <textarea name="" id="" class="form-control" rows="5" v-model="txtitems.item"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" @click="seleccestrat(txtitems.estrategia_id, txtestrats.estrategia);"
            class="btnred btn-sm" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" @click="actualizarItem(); seleccestrat(txtitems.estrategia_id, txtestrats.estrategia);"
            class="btnblue2 btn-sm" data-bs-dismiss="modal">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { toastf } from '../../helpers/functions.js'
import axios from 'axios';
export default {
  mounted() {
    this.inputs = this.$refs;
  },

  data() {
    return {
      txtestrats: { id: '', estrategia: '' },
      txtitems: { id: '', item: '', estrategia_id: '' },
      estratsitems: [],
      estrats: [],
    }
  },

  methods: {

    limpiarmodal() {

      Object.values(this.inputs).forEach((input) => {
        if (input.classList.contains("form-control")) {
          input.value = '';
        }
      });
    },

    async listarEstra() {
      const res = await axios.get('api/estrategias');
      this.estrats = res.data;
    },

    async crearEstra() {
      try {
        const res = await axios.post('api/estrategias', this.txtestrats);
        toastf(res);
      }
      catch (error) {
        alert('El formulario ya existe');
      };
      formestrategia.style.display = "none";
      this.txtestrats.estrategia = '';
      this.listarEstra();
    },

    async seleccestrat(id, estra) {
      const res = await axios.get('api/estrategias/' + id);
      formestrategia.style.display = "block";
      this.estratsitems = res.data;
      this.txtestrats.id = id;
      this.txtestrats.estrategia = estra;
      this.txtitems.estrategia_id = id;
      this.txtitems.item = '';
    },

    async actualizarEstra() {
      await axios.put('api/estrategias/' + this.txtestrats.id, this.txtestrats);
      this.listarEstra();
    },

    async eliminarEstrategia(id) {
      let confirmac = confirm('Eliminar esta estrategia? se eliminarán todos sus items');
      if (confirmac) {
        const res = await axios.delete('api/estrategias/' + id);
        this.listarEstra();
        formestrategia.style.display = "none";
      }
    },

    async crearItem() {
      try {
        const res = await axios.post('api/items', this.txtitems);
        toastf(res);
      } catch (error) {
        alert('El item ya existe')
      }
      this.seleccestrat(this.txtestrats.id, this.txtestrats.estrategia);
      this.txtitems.item = '';
    },

    async editarItem(id) {
      const res = await axios.get('api/items/' + id);
      this.txtitems.item = res.data.item;
      this.txtitems.id = res.data.id;
      this.txtitems.estrategia_id = res.data.estrategia_id;
    },

    async actualizarItem() {
      await axios.put('api/items/' + this.txtitems.id, this.txtitems);
      this.seleccestrat(this.txtestrats.id, this.txtestrats.estrategia);
      this.txtitems.item = '';
    },

    async eliminarItem(id) {
      let confirmac = confirm('Eliminar este item?');
      if (confirmac) {
        const res = await axios.delete('api/items/' + id);        
      }
      this.listarEstra(res);
    },
  },
  created() {
    this.listarEstra();
  },

}
</script>
  