<script>

import draggable from "vuedraggable";
export default {
  props:['datos'],
  name: "EJEMPLO",
  display: "Ejemplo",
  order: 1,
  components: {
    draggable
  },
  data() {
    return {
      list2: [],
      list3: [],
    };
  },
  methods: {
    log: function(evt) {
      window.console.log(evt);
    }
  }
};
</script>