@extends('layout.default')

@section('content')
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
                        <div data-bind="if: $parent.canRemoveOption()">
                            <div class="input-group">
                                <input type="text" class="form-control" name="options[]" placeholder="Opção" data-bind="value: text">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-bind="click: $parent.removeOption.bind($parent, $index()), if: $parent.canRemoveOption">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" data-bind="if: $parent.canRemoveOption"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div data-bind="if: !$parent.canRemoveOption()">
                            <input type="text" class="form-control" name="options[]" placeholder="Opção" data-bind="value: text">
                        </div>
                        <br>
                    </div>
                </div>
                <a class="btn btn-default btn-block" href="#" role="button" data-bind="click: addOption">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Adicionar opção
                </a>
            </div>
            <div class="col-md-4">
                <h2>Bloco</h2>
                <div data-bind="with: iframe">
                    <div class="form-group">
                        <label>Largura</label>
                        <input type="number" min="200" max="500" class="form-control" placeholder="Largura" data-bind="value: width">
                    </div>
                    <div class="form-group">
                        <label>Altura</label>
                        <input type="number" min="200" max="500" class="form-control" placeholder="Altura" data-bind="value: height">
                    </div>
                </div>

                <h2>Compartilhar</h2>
                <label>Script</label>
                <p class="script-box" data-bind="text: script" data-bind="style: { width: iframe().width() }"></p>

                <label>Link</label>
                <p class="script-box">{{ route('iframe', ['hash' => $form['hash']]) }}</p>
            </div>
            <div class="col-md-4">
                <h2>Visualização</h2>
                <p data-bind="text: iframeLoadingText"></p>
                <iframe id="iframe" src="{{ route('iframe', ['hash' => $form['hash']]) }}" data-bind="attr: iframeAttributes" frameBorder="0" style="border: 1px solid #000; border-radius:  5px"></iframe>

                <p id="button-reload">
                    <a class="btn btn-default btn-block" href="#" role="button" data-bind="click: reload">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        Salvar e atualizar
                    </a>
                </p>

            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    .script-box {
        background-color: #333;
        color: #fff;
        padding: 10px;
    }
</style>
@endsection

@section('scripts')
<script>
    var URL_SAVE = "{{ route('save') }}";

    function Option(text) {
        var self = this;

        self.text = ko.observable(text);
    }

    function ViewModel() {
        var self = this;

        self.hash = ko.observable("{{ $form['hash'] }}");
                self.title = ko.observable('{{ $form['title'] }}');
        self.options = ko.observableArray([
            new Option('Opção 1'),
            new Option('Opção 2')
        ]);
        self.owner = ko.observable();

        self.iframe = ko.observable({
            width: ko.observable(300),
            height: ko.observable(200)
        });
        self.iframeLoadingText = ko.observable('Carregando...');

        self.init = function () {
            document.getElementById('iframe').onload = function () {
                self.iframeLoadingText(null);
            };

            self.iframe().width(document.getElementById('button-reload').offsetWidth);
        };

        self.addOption = function () {
            self.options.push(new Option('Opção ' + (self.options().length + 1)));
        };

        self.canRemoveOption = function () {
            return self.options().length > 2;
        };

        self.removeOption = function (index) {
            var options = self.options(),
                new_options = [];

            for (var o in options) {
                if (o == index) {
                    continue;
                }

                new_options.push(options[o]);
            }

            self.options(new_options);
        };

        self.save = function (callback) {
            self.iframeLoadingText('Salvando...');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', URL_SAVE, true);

            xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById('meta-csrf').attributes.content.value);

            xhr.onload = function () {
                callback();
            };

            xhr.onerror = function () {
                callback(new Error('Erro inesperado.'));
            };

            var fd = new FormData();
            var options = self.options();

            fd.append('hash', self.hash());
            fd.append('title', self.title());
            for (var o in options) fd.append('options[]', options[o].text());
            fd.append('owner', self.owner());

            xhr.send(fd);
        };

        self.reload = function () {
            self.save(function (err) {
                self.iframeLoadingText('Atualizando...');
                if (err) {
                    self.iframeLoadingText(null);
                    return;
                }
                
                var src = document.getElementById('iframe').src;
                document.getElementById('iframe').src = src;
            });
        };
        
        self.iframeAttributes = ko.computed(function () {
            if (self.iframeLoadingText()) {
                return {
                    width: '0px', 
                    height: '0px',
                    display: 'none'
                };
            }
            
            return {
                width: self.iframe().width(),
                height: self.iframe().height()
            };
        });
        
        self.script = ko.computed(function () {
            var iframe = '<iframe ';
            iframe += 'src="{{ route('iframe', ['hash' => $form['hash']]) }}" ';
            iframe += 'width="' + self.iframe().width() + '" ';
            iframe += 'height="' + self.iframe().height() + '" ';
            iframe += 'frameBorder="0" style="border: 1px solid #000; border-radius:  5px" ';
            iframe += '></iframe>';
            
            return iframe;
        });
    }
</script>
@endsection