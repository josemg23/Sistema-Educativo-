require('./bootstrap');
window.Vue = require('vue');
import Swal from 'sweetalert2/src/sweetalert2.js';
import draggable from "vuedraggable";
Vue.component('draggable', draggable);
import Multiselect from 'vue-multiselect';
  // register globally
Vue.component('multiselect', Multiselect);
import 'vue-search-select/dist/VueSearchSelect.css';
import 'vue-multiselect/dist/vue-multiselect.min.css';
import VueCkeditor from 'vue-ckeditor2';
Vue.component('vue-ckeditor', VueCkeditor );
 import { ModelSelect } from 'vue-search-select';
Vue.component('ModelSelect', ModelSelect);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('drag-component', require('./components/DragComponent.vue').default);
if(document.getElementById('app')){
        const app = new Vue({
    		el: '#app',
		}); 
                }
if(document.getElementById('tallerlist')){
  require('./talleres');   
                }

if(document.getElementById('cruc')){
           require('./crucigrama');  
                }





