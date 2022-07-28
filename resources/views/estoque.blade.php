<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estoque</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">
                            <i class="bi bi-house-door"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/estoque">
                            <i class="bi bi-box-seam-fill"></i>
                            Estoque
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main style="margin: 10px;">
        <div class="d-flex justify-content-end" style="margin-bottom: 10px">
            <div class="">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-circle-fill" style="color: white;"></i>
                </button>
            </div>
        </div>

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Adicionar item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/item/create" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <input required type="text" class="form-control" name="description">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantidade</label>
                                <input required type="number" class="form-control" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Preço</label>
                                <input required type="float" class="form-control" name="price">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Concluir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center align-items center">
            <div class="col-10">
                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th style="margin: 0px; padding: 0px; width: 0px; height: 0px;"></th>
                            <th style="margin: 0px; padding: 0px; width: 0px; height: 0px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $_item)
                            <tr>
                                <th scope="row">{{ $_item->id }}</th>
                                <td>{{ $_item->description }}</td>
                                <td>{{ $_item->quantity }}</td>
                                <td>{{ $_item->price }}</td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $_item->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $_item->id }}"><i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($item as $_item)
            <div class="modal fade" id="deleteModal{{ $_item->id }}" tabindex="-1"
                aria-labelledby="deleteModal{{ $_item->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModal{{ $_item->id }}Label">Deletar
                                item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/item/delete/{{ $_item->id }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Id</label>
                                    <input disabled required type="text" class="form-control" name="id"
                                        placeholder="{{ $_item->id }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descrição</label>
                                    <input disabled required type="text" class="form-control" name="description"
                                        placeholder="{{ $_item->description }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantidade</label>
                                    <input disabled required type="number" class="form-control" name="quantity"
                                        placeholder="{{ $_item->quantity }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Preço</label>
                                    <input disabled required type="float" class="form-control" name="price"
                                        placeholder="{{ $_item->price }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Concluir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateModal{{ $_item->id }}" tabindex="-1"
                aria-labelledby="updateModal{{ $_item->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModal{{ $_item->id }}Label">Deletar
                                item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/item/update/{{ $_item->id }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Id</label>
                                    <input disabled type="text" class="form-control" name="id"
                                        value="{{ $_item->id }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descrição</label>
                                    <input required type="text" class="form-control" name="description"
                                        value="{{ $_item->description }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Quantidade</label>
                                    <input required type="number" class="form-control" name="quantity"
                                        value="{{ $_item->quantity }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Preço</label>
                                    <input required type="float" class="form-control" name="price"
                                        value="{{ $_item->price }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Concluir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
</body>

</html>
