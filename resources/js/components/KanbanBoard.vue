<template>
    <div class="container-fluid h-100">  
        <div class="row">
            <div v-for="(column, index) in columns" :key="index" class="col-md-3">
                <div :class="['card', 'card-row', 'kanban-column', 'card-' + column.columnType]">
                    <div class="card-header">
                        <h3 class="card-title">{{ column.status }}</h3>
                    </div>
                    <div class="card-body kanban-cards p3">
                        <div v-for="(card, cardIndex) in column.cards" :key="cardIndex" :class="['card', 'kanban-column', 'card-' + column.columnType, 'card-outline']">
                            <div class="card-header">
                                <h5 class="card-title">{{ card.title }}</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#{{ cardIndex + 1 }}</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                {{ card.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    import axios from 'axios';
        export default {
        data() {
            return {
                columns: [],
                statusList: ["To Do", "In Progress", "Paused", "Concluded"]
            }
        },
        mounted() {
            axios.get('/api/columns')
                .then(response => {
                    const columnsData = [];

                    // Agrupando os dados por status
                    const groupedData = {};
                    response.data.forEach(item => {
                        const status = item.status;
                        if (!groupedData[status]) {
                            groupedData[status] = [];
                        }
                        // Criando um cartão para cada título e descrição
                        groupedData[status].push({ title: item.title, description: item.description });
                    });

                    // Convertendo os dados agrupados para o formato esperado
                    for (const status in groupedData) {
                        if (groupedData.hasOwnProperty(status)) {
                            const cards = groupedData[status].map(card => ({
                                title: card.title,
                                description: card.description
                            }));

                            // Adicionando a coluna ao array de colunas
                            columnsData.push({
                                title: status,
                                columnType: '',
                                cards: cards
                            });
                        }
                    }

                    // Atualizando a propriedade columns com os dados processados
                    this.columns = columnsData;
                })
                .catch(error => {
                    console.error('Erro ao buscar dados das colunas:', error);
                });   
        }
    }





    // export default {
    //     data() {
    //         return {
    //             columns: [
    //                 { title: 'Normal', columnType: 'success', cards: [{ title: 'Task 1' }, { title: 'Task 2' }] },
    //                 { title: 'In Progress', columnType: 'dark', cards: [{ title: 'Task 3' }, { title: 'Task 4' }] },
    //                 { title: 'Paused', columnType: 'warning', cards: [{ title: 'Task 5' }, { title: 'Task 6' }] },
    //                 { title: 'Canceled', columnType: 'danger', cards: [{ title: 'Task 5' }, { title: 'Task 6' }] },
    //                 { title: 'Concluded', columnType: 'primary', cards: [{ title: 'Task 5' }, { title: 'Task 6' }] }
    //             ]
    //         }
    //     },
    //     mounted() {
    //         axios.get('/api/columns')
    //             .then(response => {
    //                 this.columns = response.data;
    //             })
    //             .catch(error => {
    //                 console.error('Erro ao buscar dados das colunas:', error);
    //             });   
    //     }
    // }

</script>
  
<style scoped>
    .kanban-column {
        margin-right: 40px;
        float: left;
    }
    .kanban-card {
        background-color: #f4f4f4;
        padding: 10px;
        margin-bottom: 10px;
    }
 </style>
  