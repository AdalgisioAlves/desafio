/* eslint-disable vue/no-async-in-computed-properties */
/* eslint-disable vue/no-async-in-computed-properties */
/* eslint-disable vue/no-async-in-computed-properties */
<template>
  <div class="col-md-6 align-content-left">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Digite CPF Para Depositar</label>
        <input type="text" class="form-control" v-model="cpf" />
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Digite O Valor do Deposito</label>
        <input type="text" class="form-control" v-model="valor" />
      </div>
      <button type="submit" class="btn btn-primary" v-on:click="loginCliente">Enviar</button>
    </form>
    <div class="alert alert-primary" role="alert">{{mensagem}}</div>
    
  </div>
</template>

<script>
export default {
  name: "Deposito",
  data: function() {
    return {
      cpf: '',
      mensagem:'',
      valor:''
    };
  },
  methods: {
    // eslint-disable-next-line vue/return-in-computed-property
    loginCliente: function() {
      if (!this.cpf) {
        alert("Digite Um CPF Valido");
      } else {
        // eslint-disable-next-line vue/no-async-in-computed-properties
        let nthis = this
        this.axios
          .post("http://127.0.0.1:8000/cliente/deposito", {
            cpf: this.cpf,
            valor: this.valor
          })
          .then(function(response) {
            let ret = response.data;
          
            if (ret["erro"] == 0) {
              nthis.mensagem = 'Olá ' + ret['cliente'] + 'Seu Saldo :' + ret['saldo']             
                
            }
          })
          .catch(function(error) {
            console.log(error);
          });
           
      }
    }
  }
};
</script>
