<?php

namespace App\DataTables;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class TaskDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                return view('components.botao-acoes', [
                    "update" => route("tasks.edit", $query->id),
                    "delete" => route("tasks.destroy", $query->id),
                ]);
            })
            ->editColumn('title', function($query) {
                return $query->title;
            })
            ->editColumn('description', function($query) {
                return $query->description;
            })
            ->editColumn('status', function($query) {
                switch ($query->status) {
                    case 'Normal':
                        return '<span class="badge badge-success"> Normal </span>';
                        break;
                    case 'In Progress':
                        return '<span class="badge badge-dark"> Em Progresso </span>';
                        break;
                    case 'Paused':
                        return '<span class="badge badge-warning"> Pausado </span>';
                        break;
                    case 'Canceled':
                        return '<span class="badge badge-danger"> Cancelado </span>';
                        break;
                    case 'Concluded':
                        return '<span class="badge badge-primary"> Concluido </span>';
                        break;
                }
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at->format("d/m/Y H:i");
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at->format("d/m/Y H:i");
            })
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Task $model): QueryBuilder
    {
        $userId = Auth::id();
        return $model->newQuery()->where('user_id', $userId);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('task-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy([4, 'desc'])
            ->buttons(
                Button::make('create')->text("<i class='fas fa-plus'></i> Nova Tarefa"),
            )
            ->parameters([
                "language" => [
                    "url" => "/js/translate_pt-br.json"
                ]
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('title')->title('Titulo'),
            Column::make('description')->title('Descrição'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::make('created_at')->title('Cadastro')->addClass('text-center'),
            Column::make('updated_at')->title('Atualizado')->addClass('text-center'),
            Column::make('action')->title('')->searchable(false)->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Task_' . date('YmdHis');
    }
}
