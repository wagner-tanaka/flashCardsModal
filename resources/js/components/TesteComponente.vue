<template> 
    
    <div>

    <input v-model="um">
    <input v-model="dois">
    =
    {{ sum() }}
    <br><br>
    <button :value="umm" @click="ummm">1</button> 
    <button :value="doiss" @click="doisss">2</button> 
    <button :value="multiplicar" @click="multiplicarr">*</button> 

</div>

   
</template>
<script>
 export default { 
        data: function() { 
            return {
                um: '',     
                dois: '',
                umm: '1',
                doiss: '2',
                multiplicar: '*',
           }
        },

        methods:{ 
             sum(){ 
                 return (this.um * this.dois)
            },

            ummm(){
                return console.log(this.umm)
            },

             doisss(){
                return console.log(this.doiss)
            },
            multiplicarr() {
                return console.log(this.multiplicar )

            }
        
        },
        mounted(){ 
            
        }
    }

</script>