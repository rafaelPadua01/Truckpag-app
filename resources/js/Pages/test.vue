<template>
		
	<v-app>
		<v-container>
			<v-row align='center'>
				<v-col
					cols="12"
					sm="6"
					>
					<div class="text-center">
						<div class="my-2">
							<v-btn
								color="primary"
								dark
								href="/endereco"
							>
								Endereços
							</v-btn>
						</div>
					</div>
				</v-col>
			</v-row>
			
			<p>Clique em qualquer <v-icon>mdi-publish</v-icon> para importar todos os dados</p>
			<v-data-table
				:headers='headers'
				:items="items"
				item-key="id"
				:items-per-page='5'
				class="elevation-1"
			>
		
				<!-- Slot botão export dos dados -->
				<template v-slot:[`item.actions`]="{item}">
					<v-icon
						small
						class="mr-2"
						color="indigo"
						@click="exportData(item)"
						
					>
						mdi-publish
					</v-icon>
				</template>
					
				
			</v-data-table>

			<!-- Slot botão export dos dados -->
				<template v-slot:[`item.actions`]="{item}">
					<v-icon
						small
						class="mr-2"
						color="indigo"
						@click="exportData(item)"
						
					>
						mdi-pencil
					</v-icon>
				</template>
			
		</v-container>
	</v-app>
</template>

<script>
	export default{
		data(){
			return {
				dialog: false,
				items: [],
				headers: [
			{
				text: 'UF (DF)',
					align: 'start',
					sortable: false,
					value: "controls",
			},
				
					{text: 'Cidade', value: 'nome'},
					{text: 'Açoes', value: 'actions', sortable: false}
			],
			
				
			};
				
			},
			watch: {
        dialog(val){
            val || this.close()
        },
        dialogDelete(val){
            val || this.closeDelete()
        }
    },
			methods: {
			initialize(){
				this.items = [];
			},
			goToEndereco(){
				this.$router.push('/endereco');
			},
			getItems(){
				this.items = [];
				var vm = this;
				axios.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/DF/municipios')
					.then(function(response){
						vm.items = response.data;
						
					})
					.catch(function(error){
						console.log(error);
					});
			},
			exportData(item){
				axios.post('/cidades/export', item)
				.then(function(response){
					console.log(item.nome);
					window.alert('Dados exportados com sucesso');
					
				})
				.catch(function(error){
					console.log(error);
				})
				
			},
			close(){
            this.dialog = false,
            this.$nextTick(() =>{
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
			
				
			},
		created(){
			this.initialize();
		},
		mounted(){
					this.getItems();
				},
		
		}
</script>