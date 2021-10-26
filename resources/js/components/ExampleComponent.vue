<template>
        <div id="calApp">
            <div class="row justify-content-center">
                <div class="col-8">
            <h3 class="text-danger font-weight-bold">Calculadora</h3>     
                </div>
                <div class="col-12">
                            <div class="calculator">
                          <div class="display text-info font-weight-bold">{{ display }}</div> 
                          <div class="boton operator" @click="clear">C</div>
                          <div class="boton operator" @click="del">DEL</div>
                          <div class="boton operator" @click="enterOps(4)">÷</div>
                          <div class="boton operator" @click="enterOps(3)">*</div>
                       
                          <div class="boton" @click="enterNum(7)">7</div>
                          <div class="boton" @click="enterNum(8)">8</div>
                          <div class="boton" @click="enterNum(9)">9</div>
                          <div class="boton operator" @click="enterOps(2)">-</div>
                        
                          <div class="boton" @click="enterNum(4)">4</div>
                          <div class="boton" @click="enterNum(5)">5</div>
                          <div class="boton" @click="enterNum(6)">6</div>
                          <div class="boton operator" @click="enterOps(1)">+</div>
                        
                          <div class="boton" @click="enterNum(1)">1</div>
                          <div class="boton" @click="enterNum(2)">2</div>
                          <div class="boton" @click="enterNum(3)">3</div>
                       
                          <div class="zero" @click="enterNum(0)">0</div>
                          <div class="boton" @click="addDecimal">.</div>
                          <div class="boton operator" @click="sum">=</div>
                          <div class="btn ">&nbsp;</div>
                      </div>
                </div>
            </div>
    
                  </div>
</template>

<script>
    export default {
      
  data(){
    return{
          currentNum: 0,
    decimalAdded: false,
    total: 0,
    prevOps: 0,
    display: '',
    }
  
  },
  ready: function() {
    var target, ink, d, x, y;
    $(".containerBox .row .cBox").click(function(e) {
      target = $(this);
      //create .ink element if it doesn't exist
      if (target.find(".ink").length == 0)
        target.prepend("<span class='ink'></span>");

      ink = target.find(".ink");
      //incase of quick double clicks stop the previous animation
      ink.removeClass("animate");

      //set size of .ink
      if (!ink.height() && !ink.width()) {
        //use parent's width or height whichever is larger for the diameter to make a circle which can cover the entire element.
        d = Math.max(target.outerWidth(), target.outerHeight());
        ink.css({
          height: d,
          width: d
        });
      }

      //get click coordinates
      //logic = click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center;
      x = e.pageX - target.offset().left - ink.width() / 2;
      y = e.pageY - target.offset().top - ink.height() / 2;

      //set the position and add class .animate
      ink.css({
        top: y + 'px',
        left: x + 'px'
      }).addClass("animate");
    })
  },
  methods: {
    addDecimal: function() {
      if (this.decimalAdded == false) {
        // if (this.prevOps != 0) {
        //   this.display = '0.';
        // } else {
          this.display += '.';
        // }
        this.decimalAdded = true;
      }
    },
    clear: function() {
      this.currentNum = 0;
      this.decimalAdded = false;
      this.total = 0;
      this.display = '';
      this.prevOps = 0;
    },
    del: function() {
      if (this.currentNum > 0) {
        if (this.decimalAdded == false) {
          this.currentNum = parseInt(this.currentNum.toString().slice(0, -1), 10);
        } else {
          this.currentNum = parseFloat(this.currentNum.toString().slice(0, -1));
        }

        if (isNaN(this.currentNum))
          this.currentNum = 0;
        this.display = this.currentNum;
      } else if (this.currentNum == 0) {
        this.display = '';
      }
    },
    enterNum: function(val) {
      if (this.currentNum == 0) {
        if (this.prevOps == 0)
          this.total = 0;

        if (this.decimalAdded == true) {
          this.currentNum = val / 10;
          this.display += val.toString();
        } else {
          this.currentNum = val;
          this.display = val.toString();
        }
      } else {
        if (this.decimalAdded == true) {
          if (this.currentNum.toString().indexOf('.') == -1) {
            this.currentNum = parseFloat(this.currentNum.toString() + '.' + val.toString());
          } else {
            this.currentNum += val.toString();
            this.currentNum = parseFloat(this.currentNum);
          }
        } else {
          this.currentNum *= 10;
          this.currentNum += val;
        }
        this.display += val.toString();
      }
    },
    enterOps: function(ops) {
      if (this.total == 0 && this.currentNum == 0) {
        return;
      }
      if (this.total == 0) {
        this.total += this.currentNum;
      }
      switch (this.prevOps) {
        case 1:
          this.total += this.currentNum;
          break;
        case 2:
          this.total -= this.currentNum;
          break;
        case 3:
          this.total *= this.currentNum;
          break;
        case 4:
          this.total /= this.currentNum;
          break;
        case 0:
          break;
      }

      if (this.decimalAdded == true) {
        this.decimalAdded = false;
      }
      this.currentNum = 0;
      this.prevOps = ops;
    },
    sum: function() {
      switch (this.prevOps) {
        case 1:
          this.total += this.currentNum;
          break;
        case 2:
          this.total -= this.currentNum;
          break;
        case 3:
          this.total *= this.currentNum;
          break;
        case 4:
          this.total /= this.currentNum;
          break;
        case 0:
          break;
      }
      this.display = this.total.toFixed(2);
      this.prevOps = 0;
      this.currentNum = 0;
    }
  }

    }
</script>

<style scoped>
    #js__addNoteContainer{
        position: absolute;
        top: 0;
        right: 0;
    }
    #js__addNoteContainer button{
        border: solid 1px #ccc;
    }
    #notesContainer ul{
        list-style: none;
    }
</style>