<template>
  <div class="wrapper">
    <app-form v-if="!showFinal" :progressbar="progressBar" :info="info" v-on:handleclasse="handleclass" v-on:showresultchild="showResult"></app-form>
    <app-res v-else :info="info"></app-res>
  </div>
</template>

<script>
import appForm from './components/Form';
import appRes from './components/Result';

export default {
  data() {
    return {
      info: [
        {
          name: 'Name',
          value: '',
          pattern: /^[a-zA-Z ]{2,30}$/,
        },
        {
          name: 'Phone',
          value: '',
          pattern: /^[0-9]{7,14}$/,
        },
        {
          name: 'Email',
          value: '',
          pattern: /.+/,
        },
        {
          name: 'Some Field 1',
          value: '',
          pattern: /.+/,
        },
        {
          name: 'Some Field 2',
          value: '',
          pattern: /.+/,
        }
      ],
      showFinal: false
    }
  },
  computed: {
    progressBar(){
      var piece = 100/this.info.length;
      var counter = 0;
      for(var i = 0; i < this.info.length; i++) {
        if(this.info[i].correct) {
          counter++;
        }
      }
      return piece * counter;
    }
  },
  methods: {
    handleclass(val){
      var check = val.pattern.test(val.value);
      if(val.correct === undefined) {
        this.$set(val, 'correct', false);
      }
      val.correct = check;
    },
    showResult(e){
      this.showFinal = true;
      e.preventDefault();
    }
  },
  components: {
    appForm,
    appRes
  }
}
</script>

<style>

</style>
