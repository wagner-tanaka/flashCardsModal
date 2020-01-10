<template>

<div>
     <a href="#">
        <div class="text-center pt-5" @click="trocaLado">
            <h1 v-if="cartas !== ''">{{ cartas[indice][lado] }}</h1>   
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
                lado: 'front',
                indice: 0,
                cartas: '',           
            }
        },
     //   ---------------------------------------------------------------
        props: ['deckId'], // recebe o deck-id que foi pego da pagina play_flash_cards.blade
     //   -----------------------------------------------------
        methods:{
            trocaLado() {
                this.lado = this.lado == 'front' ? 'back' : 'front'
            },
            acertou() {
                this.cartas[this.indice].acertou = true
                this.indice = this.indice + 1  
            },
            errou() {
                this.cartas[this.indice].acertou = false
                this.indice = this.indice + 1  
            },
// -----------------------------------------------------------------------------------------
            getCards(){ // onde essa função é chamada?
                window.axios.get('/api/get_cards/'+this.deckId).then((resposta) => {
                    console.log(resposta.data.cards)
                    this.cartas = resposta.data.cards
                })

            } 
// Usa essa função para pegar o Id do deck
// -----------------------------------------------------------------------------------------
        },
        mounted(){
            this.getCards()
        }
    }
</script>
