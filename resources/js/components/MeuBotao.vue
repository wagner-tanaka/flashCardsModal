<template>

    <button @click="acertou" >Acertou</button>
    

</template>


<script>
    export default {
        data: function() {
            return {
                lado: 'frente',
                indice: 0,
                cartas: [
                    {frente: 'aa', verso: 'AA', acertou: ''},
                    {frente: 'bb', verso: 'BB', acertou: ''},
                    {frente: 'cc', verso: 'CC', acertou: ''},
                    {frente: 'dd', verso: 'DD', acertou: ''},  
                ],           
            }
        },
        methods:{
            trocaLado() {
                this.lado = this.lado == 'frente' ? 'verso' : 'frente'
            },
            acertou() {
              this.indice = this.indice + 1  
            }
        },
        mounted(){

        }
    }
</script>
