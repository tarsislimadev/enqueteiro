@extends('layout.default')

@section('content')
<form id="form-{{ $form['id'] }}" action="{{ route('send', ['id' => $form['id']]) }}">
    <input type="hidden" name="id" value="{{ $form['id'] }}">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h2>Enquete</h2>
                    <div class="form-group">
                        <label for="name">Título</label>
                        <input type="text" class="form-control" name="title" placeholder="Nome" data-bind="value: name">
                    </div>
                    <div class="form-group">
                        <label>Opções</label>
                        <div data-bind="foreach: options">
                            <input type="text" class="form-control" name="options[]" placeholder="Opção" data-bind="value: $data">
                            <br>
                        </div>
                    </div>
                    <a class="btn btn-default" href="#" role="button" data-bind="click: addOption">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Adicionar opção
                    </a>
                </div>
                <div class="col-md-4">
                    <h2>Bloco</h2>
                    <div data-bind="with: iframe">
                        <div class="form-group">
                            <label>Largura</label>
                            <input type="number" class="form-control" placeholder="Largura" data-bind="value: width">
                        </div>
                        <div class="form-group">
                            <label>Altura</label>
                            <input type="number" class="form-control" placeholder="Altura" data-bind="value: height">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2>Visualização</h2>
                    <iframe src="{{ route('iframe', ['id' => $form['id']]) }}" data-bind="attr: iframeAttributes"></iframe>

                    <a class="btn btn-default pull-right" href="#" role="button" data-bind="click: reload">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        Visualizar
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-default pull-right" href="#" role="button">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        Salvar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    function ViewModel() {
        var self = this;

        self.id = ko.observable();
        self.name = ko.observable('{{ $form['title'] }}');
        self.options = ko.observableArray([
            ko.observable('Opção 1'), 
            ko.observable('Opção 2')
        ]);
        self.optionsText = ko.computed(function () {
            return ko.toJSON(self.options());
        });
        
        self.iframe = ko.observable({
            width: ko.observable(300),
            height: ko.observable(200)
        });
        
        self.addOption = function () {
            self.options.push(ko.observable());
        };
        
        self.reload = function () {
            debugger;
        };
        
        self.iframeAttributes = ko.computed(function () {
            return {
                width: self.iframe().width(),
                height: self.iframe().height()
            }
        });
    }
</script>
@endsection