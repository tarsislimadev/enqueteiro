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
                    <div data-bind="foreach: answers">
                        <div data-bind="if: $parent.canRemoveAnswer()">
                            <div class="input-group">
                                <input type="text" class="form-control" name="answers[]" placeholder="Opção" data-bind="value: text">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-bind="click: $parent.removeAnswer.bind($parent, $index()), if: $parent.canRemoveAnswer">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" data-bind="if: $parent.canRemoveAnswer"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div data-bind="if: !$parent.canRemoveAnswer()">
                            <input type="text" class="form-control" name="answers[]" placeholder="Opção" data-bind="value: text">
                        </div>
                        <br>
                    </div>
                </div>
                <a class="btn btn-default btn-block" href="#" role="button" data-bind="click: addAnswer">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Adicionar opção
                </a>
            </div>
            <div class="col-md-4">
                <h2>Bloco</h2>
                <div data-bind="with: iframe">
                    <div class="form-group">
                        <label>Largura</label>
                        <div class="input-group">
                            <input type="number" min="200" max="500" class="form-control text-right" placeholder="Largura" data-bind="value: width, valueUpdate: 'input'">
                            <span class="input-group-addon" id="basic-addon3">px</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Altura</label>
                        <div class="input-group">
                            <input type="number" min="200" max="500" class="form-control text-right" placeholder="Altura" data-bind="value: height, valueUpdate: 'input'">
                            <span class="input-group-addon" id="basic-addon3">px</span>
                        </div>
                    </div>
                </div>

                <h2>Compartilhar</h2>
                <label>Script</label>
                <p class="script-box" data-bind="text: script" data-bind="style: { width: iframe().width() }"></p>

                <label>Link</label>
                <p class="script-box">{{ route('form', ['hash' => $form['hash']]) }}</p>
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

@section('scripts')
<script>
    function Answer(text) {
        var self = this;

        self.text = ko.observable(text);
    }

    function ViewModel() {
        var self = this;

        self.hash = ko.observable("{{ $form['hash'] }}");
                self.title = ko.observable('{{ $form['title'] }}');
        self.answers = ko.observableArray([
            new Answer('Opção 1'),
            new Answer('Opção 2')
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

        self.addAnswer = function () {
            self.answers.push(new Answer('Opção ' + (self.answers().length + 1)));
        };

        self.canRemoveAnswer = function () {
            return self.answers().length > 2;
        };

        self.removeAnswer = function (index) {
            var answers = self.answers(),
                new_answers = [];

            for (var o in answers) {
                if (o == index) {
                    continue;
                }

                new_answers.push(answers[o]);
            }

            self.answers(new_answers);
        };

        self.save = function (callback) {
            self.iframeLoadingText('Salvando...');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('save') }}", true);

            xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById('meta-csrf').attributes.content.value);

            xhr.onload = function () {
                callback();
            };

            xhr.onerror = function () {
                callback(new Error('Erro inesperado.'));
            };

            var fd = new FormData();
            var answers = self.answers();

            fd.append('hash', self.hash());
            fd.append('title', self.title());
            for (var o in answers) fd.append('answers[]', answers[o].text());
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