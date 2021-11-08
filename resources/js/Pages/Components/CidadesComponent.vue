<template>
		
	<v-app>
		<v-container>
		
			<v-data-table
				:headers  = 'headers'
				:items = "items"
				:items-per-page='5'
				class="elevation-1"
			>
				
			</v-data-table>
asahsuaihsauishaiuashusa
		</v-container>
	</v-app>
</template>

<script>
	export default{
		data(){
			return {
				headers: [
			{
				text: 'UF (DF)',
					align: 'start',
					sortable: false,
					value: 'name',
			},
					{text: 'UF', value: 'uf'},
					{text: 'Cidade', value:  'cidade'}
			],
				items: [
				{
					name: 'DF',
					uf: 	'DF',
					cidade: 'Sobradinhio',
				
					},
				],
				}
			},
		}
</script>