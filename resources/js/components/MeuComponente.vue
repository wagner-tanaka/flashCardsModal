<template>

<div>
     <a href="#">
        <div class="text-center pt-5" @click="trocaLado">
            <h1>{{ cartas[indice][lado] }}</h1>   
        </div>
    </a>
    <button @click="errou" >Errou</button>
    <button @click="acertou" >Acertou</button>
</div>
   
    

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
        props: ['deckId'],
        methods:{
            trocaLado() {
                this.lado = this.lado == 'frente' ? 'verso' : 'frente'
            },
            acertou() {
                this.cartas[this.indice].acertou = true
                this.indice = this.indice + 1  
            },
            errou() {
                this.cartas[this.indice].acertou = false
                this.indice = this.indice + 1  
            },
            getCards(){
                window.axios.get('/api/get_cards/'+this.deckId).then((response) => {
                    console.log(response)
                })
            } 
        },
        mounted(){
            this.getCards()
        }
    }
</script>
