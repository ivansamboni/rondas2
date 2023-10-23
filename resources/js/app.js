import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue'
import Users from './views/Users.vue'
import Auditarjs from './views/Auditarjs.vue'
import {router}  from './router/index';
/* import the fontawesome core */
import moment from "moment";
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faPenToSquare } from '@fortawesome/free-solid-svg-icons'
import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { faFile } from '@fortawesome/free-solid-svg-icons'
import { faFloppyDisk } from '@fortawesome/free-solid-svg-icons'


/* add icons to the library */
library.add(faPenToSquare,faTrash,faFile,faFloppyDisk)

createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).mount('#app')
createApp(Users).component('font-awesome-icon', FontAwesomeIcon).mount('#users')
createApp(Auditarjs).component('font-awesome-icon', FontAwesomeIcon).mount('#auditarjs')



