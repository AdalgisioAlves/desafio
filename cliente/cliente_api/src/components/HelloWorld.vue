/* eslint-disable vue/no-async-in-computed-properties */
/* eslint-disable vue/no-async-in-computed-properties */
/* eslint-disable vue/no-async-in-computed-properties */
<template>
  <div class="col-md-6 align-content-left">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Digite CPF Para Acessar</label>
        <input type="text" class="form-control" v-model="cpf" />
        <small
          id="emailHelp"
          class="form-text text-muted"
        >We'll never share your email with anyone else.</small>
      </div>
      <button type="submit" class="btn btn-primary" v-on:click="loginCliente">Enviar</button>
    </form>
    <div class="alert alert-primary" role="alert">{{mensagem}}</div>
  </div>
</template>

<script>
export default {
  name: "HelloWorld",
  data: function() {
    return {
      cpf: '',
      mensagem:''
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
          .post("http://localhost:8000/cliente/saldo", {
            cpf: this.cpf
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
