import { createRouter, createWebHistory } from "vue-router";
import Estrategias from "../views/edicion/Estrategias.vue";
import Servicios from "../views/edicion/Servicios.vue";
import Cargos from "../views/edicion/Cargos.vue";
import Users from "../views/Users.vue";

const routes = [
  
    {
        path: "/estrategias",
        component: Estrategias,
    },
    {
        path: "/servicios",
        component: Servicios,
    },
    {
        path: "/cargos",
        component: Cargos,
    },
];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
