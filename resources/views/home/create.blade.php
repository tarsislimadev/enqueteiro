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
                        <input type="text" class="form-control" name="title" placeholder="Nome" data-bind="value: title">
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
                    <iframe id="iframe" src="{{ route('iframe', ['id' => $form['id']]) }}" data-bind="attr: iframeAttributes, visible: iframeVisible"></iframe>

                    <a class="btn btn-default" href="#" role="button" data-bind="click: reload">
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
    var URL_SAVE = "{{ route('save') }}";
    var URL_IFRAME = "{{ route('iframe', ['id' => $form['id']]) }}";
    
    function ViewModel() {
        var self = this;

        self.id = ko.observable("{{ $form['id'] }}");
        self.title = ko.observable('{{ $form['title'] }}');
        self.options = ko.observableArray([
            ko.observable('Opção 1'), 
            ko.observable('Opção 2')
        ]);
        self.owner = ko.observable();
        
        self.iframe = ko.observable({
            width: ko.observable(300),
            height: ko.observable(200)
        });
        self.iframeVisible = ko.observable(false);
        
        self.addOption = function () {
            self.options.push(ko.observable(''));
        };
        
        self.save = function (callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', URL_SAVE, true);
            
            //xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById('meta-csrf').attributes.content.value);
            
            xhr.onload = function () {
                callback();
            };
            
            xhr.onerror = function () {
                callback(new Error('Erro inesperado.'));
            };
            
            var fd = new FormData();
            var options = self.options();
            
            fd.append('id', self.id());
            fd.append('title', self.title());
            for (var o in options) fd.append('options[]', options[o]());
            fd.append('owner', self.owner());
            
            xhr.send(fd);
        };
        
        self.reload = function () {
            self.iframeVisible(true);
            self.save(function (err) {
                if (err) return err;
                
                document.getElementById('iframe').src = "";
                document.getElementById('iframe').src = URL_IFRAME;
            });
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