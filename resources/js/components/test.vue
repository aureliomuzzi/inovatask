<template>
    <div class="container-fluid h-100">  
        <div class="row">
            <div v-for="(status, index) in statusList" :key="index" class="col-md-3">
                <div class="card card-row kanban-column">
                    <div class="card-header">
                        <h3 class="card-title">{{ status }}</h3>
                    </div>
                    <div class="card-body kanban-cards">
                        <div v-if="columns.find(column => column.status === status)">
                            <div v-for="(column, colIndex) in columns" :key="colIndex" v-if="column.status === status">
                                <div v-for="(card, cardIndex) in column.cards" :key="cardIndex" class="card kanban-column card-outline">
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
                        <div v-else>
                            <p>Não há tarefas nesta coluna.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>