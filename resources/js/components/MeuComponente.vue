<template>

<div>
     <a href="#">
        <div class="text-center pt-5" @click="trocaLado">
            <h1 v-if="cartas !== ''">{{ cartas[indice][lado] }}</h1>   
        </div>
    </a>
    <button @click="proxima">Proxima</button>
    <button @click="anterior">Anterior</button>
    <button @click="errou" >Errou</button>
    <button @click="acertou" >Acertou</button>
        
</div>
   
    

</template>

<script>
    export default { // pra que essa linha?
        data: function() { // data must be a function, here comes yours variables
            return {
                lado: 'front',
                indice: 0,
                cartas: '',           
            }
        },
     //   ---------------------------------------------------------------

        props: ['deckId'], // recebe o deck-id que foi pego da pagina play_flash_cards.blade
// Props são atributos personalizáveis que você pode registrar em um componente.
// Quando um valor é passado para um atributo prop, ele torna-se uma propriedade daquela instância de componente

     //   -----------------------------------------------------
        methods:{ // funções
            proxima() {
                this.indice = this.indice + 1
            },
            anterior() {
                this.indice = this.indice - 1
            },
            trocaLado() {
                this.lado = this.lado == 'front' ? 'back' : 'front'
            },
            acertou() {
                this.cartas[this.indice].acertou = true
                this.indice = this.indice + 1  
            },
            errou() {
                this.cartas[this.indice].errou = false
                this.indice = this.indice = 1  
            },
// -----------------------------------------------------------------------------------------
            getCards(){ // essa função é chamada no mounted
                window.axios.get('/api/get_cards/'+this.deckId).then((resposta) => { // window.axios vai pegar a rota get_cards/deckId, que vai retornar um json de cards
                    console.log(resposta.data.cards, 'resposta')                     // e vai da como resposta essa linha
                   // console.log(this.lado,'lado')
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





