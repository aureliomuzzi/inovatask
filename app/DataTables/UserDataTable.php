<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
                    "update" => route("users.edit", $query->id),
                    "delete" => route("users.destroy", $query->id),
                ]);
            })
            ->editColumn('fullName', function($query) {
                return $query->fullName;
            })
            ->editColumn('login', function($query) {
                return $query->login;
            })
            ->editColumn('profile', function($query) {
                if ($query->profile == 1) {
                    return '<span class="badge badge-dark"> Administrador </span>';
                } else {
                    return '<span class="badge badge-info"> Usuário </span>';
                }
            })
            ->editColumn('email', function($query) {
                return $query->email;
            })
            ->editColumn('status', function($query) {
                if ($query->status == 1) {
                    return '<span class="badge badge-primary"> Ativo </span>';
                } else {
                    return '<span class="badge badge-danger"> Inativo </span>';
                }
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at->format("d/m/Y H:i");
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at->format("d/m/Y H:i");
            })
            ->rawColumns(['action', 'status', 'profile']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy([0, 'asc'])
            ->buttons(
                Button::make('create')->text("<i class='fas fa-plus'></i> Novo Usuário"),
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
            Column::make('fullName')->title('Nome'),
            Column::make('login')->title('Login'),
            Column::make('profile')->title('Perfil')->addClass('text-center'),
            Column::make('email')->title('Email'),
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
        return 'User_' . date('YmdHis');
    }
}
