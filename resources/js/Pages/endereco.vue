<template>
    <v-app>
        <v-container>
            <v-data-table
                :headers="headers"
                :items="items"
                item-key="id"
                :items-per-page="5"
                class="elevation-1"
            >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Endereços</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical></v-divider>
                    <v-dialog
                        v-model="dialog"
                        max-width="500px">

                    
                    <template v-slot:activator="{on, attrs}">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                        >
                            Novo Endereço
                        </v-btn>

                    </template>
                    <v-card>
                <v-card-title>
                    <span class="text-h5">{{formTitle}}</span>
                </v-card-title>

                 <v-card-text>
                <v-container>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                        <v-text-field
                            v-model="editedItem.logradouro"
                            label="logradouro"
                        >

                        </v-text-field>

                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                        <v-text-field
                            v-model="editedItem.numero"
                            label="numero"
                        >

                        </v-text-field>

                        </v-col>
                             <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                        <v-text-field
                            v-model="editedItem.bairro"
                            label="bairro"
                        >

                        </v-text-field>

                        </v-col>

                             <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                         <div class="inline-block relative w-64">
                            <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                v-model="editedItem.cidade_id">
                                <option>Selecione a cidade.</option>
                                <option id="cidade_id" v-for="cidade in cidades" v-bind:key="cidade.id" :value="cidade.id">{{cidade.nome}}</option>
                                </select>
                                            </div>

                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
             <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="save">
                        Save
                    </v-btn>
                    <v-btn
                    color="blue darken-1"
                    text
                    @click="close">
                        Close
                    </v-btn>
            </v-card-actions>
            </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
                <v-card-title class="text-h5">Você tem certeza que quer remover está cidade ?</v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDelete()">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="deleteItemConfirm()">Ok</v-btn>
                </v-card-actions>
            </v-dialog>
                </v-toolbar>
            </template>
           

            

            <template v-slot:[`item.actions`]="{item}">
                <v-icon
						small
						class="mr-2"
						color="indigo"
						@click="editItem(item)"
						
					>
						mdi-pencil
					</v-icon>
                    <v-icon
						small
						class="mr-2"
						color="indigo"
						@click="deleteItem(item)"
						
					>
						mdi-delete
					</v-icon>
            </template>

           
            </v-data-table>
        </v-container>
    </v-app>
</template>

<script>

export default({
    props: ['cidades',"enderecos"],
    data(){
        return{
            dialog: false,
    dialogDelete: false,
             headers: [
            {
                text: 'Endereços',
                align: 'start',
                sortable: false,
                value: 'Enderecos',
            },
            {text: 'Logradouro', value: 'logradouro'},
            {text: 'Número', value: 'numero'},
            {text: 'Bairro', value: 'bairro'},
            {text: 'cidade', value: 'cidade_id'},
            {text: 'Ações', value: 'actions', sortable: false},
        ],
        items: [],
        editedIndex: -1,
        editedItem: {
            logradouro: '',
            numero: 0,
            bairro: '',
            cidade: 0,

        },
        defaultItem: {
            logradouro: '',
            numero: 0,
            bairro: '',
            cidade: 0,
        },
    };
    },
        
       
     
       
    computed: {
        formTitle(){
            return this.editedIndex === -1 ? 'Novo Item' : 'Editar item'
        },
    },
    watch: {
        dialog(val){
            val || this.close()
        },
        dialogDelete(val){
            val || this.closeDelete()
        }
    },
    created(){
        this.initialize();
    },
    methods: {
        getItems(enderecos){
            var enderecos = this.enderecos;
            this.items = enderecos;
        },
        initialize(){
            this.items = [];
        },
        editeItem(item){
            this.editedIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item){
            this.editedIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        deleteItemConfirm(){
            axios.post(`endereco/destroy/${this.editedItem.id}`)
            .then(function(response){
                window.alert('Endereco removido');
                window.location.href="/teste";
            })
            .catch(function(error){
                window.alert(error)
            });
            this.items.splice(this.editedIndex, 1);
            this.closeDelete();
        },
        close(){
            this.dialog = false,
            this.$nextTick(() =>{
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        closeDelete(){
            this.dialogDelete = false,
            this.$nextTick(() =>{
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        save(){
            if(this.editedIndex > -1){
                var data = Object.assign(this.items[this.editedIndex], this.editedItem);
                axios.post(`endereco/update/${this.editedItem.id}`)
                .then(function(response){
                    window.alert('Endereco alterado com sucesso...');
                    window.location.href="/endereco";
                })
                .catch(function(error){
                    window.alert(error);
                });
            }
            else{
                axios.post('endereco/store', this.editedItem)
                .then(function(response){
                    window.alert('Endereço salvo...');
                    window.location.href="/endereco";
                })
                .catch(function(error){
                    window.alert(error);
                });

                this.items.push(this.editedItem);
            }
            this.close();
        }
    },
    
    mounted(){
        this.getItems();
    }
})

</script>
