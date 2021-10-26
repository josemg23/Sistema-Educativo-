<script>

export default {
  props:['datos'],
  name: "Sopadeletras",
  display: "Sopadeletras",
  data() {
    return {
      words: ['Comprar', 'Consumo', 'Vender', 'Comercio', 'Metas', 'Producción',
               'Ente'],
    };
  },
    mounted() {
        var gamePuzzle = wordfindgame.create(this.words, '#puzzle', '#words');
        var puzzle = wordfind.newPuzzle(
          this.words, 
        {height: 18, width:18, fillBlanks: false}
          );
          wordfind.print(puzzle);  
      },     
  methods: {
  
  }
};
</script>