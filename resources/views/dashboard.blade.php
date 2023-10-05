<x-app-layout>
    <x-slot name="header">
        <div class="page-content">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Relatório de Dados Nobreaks') }}
            </h2>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg overflow-auto">
                        <table class="table-auto w-full">
                            <select class="select2" style="width: 40%;" name="equipamento" id="equipamento">
                                <option value="">Selecione o equipamento</option>
                                @foreach ($equipamentos as $equipamento)
                                    <option value="{{ $equipamento->id }}">{{$equipamento->id}}-{{ $equipamento->nome }}</option>
                                @endforeach
                            </select>
                            <a href="#" id="export-csv-btn" class="btn btn-primary">
                                <i class="bi bi-file-earmark-arrow-down"></i> Exportar para CSV...
                            </a>
                            <script>
                                document.getElementById('equipamento').addEventListener('change', function() {
                                    var selectedEquipamento = this.value;
                                    document.getElementById('export-csv-btn').href = "{{ route('nobreaks.export.id', ['id' => ':id']) }}"
                                        .replace(':id', selectedEquipamento);
                                });
                            </script>


                            <table class="table-auto w-full" id="tabelaLogs">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 font-bold bg-gray-100 border-b border-gray-200">Data de
                                            Cadastro</th>
                                        <th class="px-4 py-2 font-bold bg-gray-100 border-b border-gray-200">Log</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <script>
        $(document).ready(function() {
            // Quando a página for carregada, executar a função buscarLogs
            buscarLogs();

            // Quando o valor do select mudar, executar a função buscarLogs
            $('#equipamento').change(buscarLogs);
        });

        function buscarLogs() {
            // Obter o ID do equipamento selecionado
            var equipamentoId = $('#equipamento').val();

            // Enviar uma solicitação AJAX para o servidor
            $.ajax({
                url: "{{ url('/logs') }}/" + equipamentoId,
                success: function(data) {
                    // Armazenar uma referência à tabela
                    var tabela = $('#tabelaLogs');

                    // Criar uma animação de fade para a tabela
                    tabela.fadeOut('fast', function() {
                        // Atualizar a tabela com os dados recebidos
                        var tbody = tabela.find('tbody');
                        tbody.empty(); // Limpar os dados antigos

                        for (var i = 0; i < data.length; i++) {
                            var log = data[i];
                            var tr = $('<tr>');
                            // tr.append($('<td>').text(log.id_equipamento));
                            tr.append($('<td>').text(formatarData(log.data_cadastro)));
                            tr.append($('<td>').text(log.log));
                            tbody.append(tr);
                        }
                        function formatarData(data) {
                        const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit'};
                        const dataFormatada = new Date(data).toLocaleDateString('pt-BR', options);
                        return dataFormatada;
}
                        // Mostrar a tabela novamente com uma animação de fade
                        tabela.fadeIn('fast');
                    });
                }
            });
        }
    </script>
    <style>
        .vertical-links li {
            margin-bottom: 1rem;
            position: relative;
            transition: all 0.2s ease;
        }

        .vertical-links li:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ccc;
            bottom: 0;
            left: 0;
            transform: scaleX(0);
            transform-origin: right;
            transition: all 0.2s ease;
        }

        .vertical-links li:hover:before {
            transform: scaleX(1);
            transform-origin: left;
        }

        .link-icon {
            margin-right: 0.5rem;
            display: inline-block;
            font-size: 1.2rem;
            line-height: 1;
            transition: all 0.2s ease;
        }

        a:hover .link-icon {
            transform: translateX(-0.2rem);
        }

        a:hover {
            background-color: #c4dfff;
            transition: background-color 0.3s ease;
        }

        #export-csv-btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
            border-radius: 4px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        #export-csv-btn:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .select2 {
            width: 40%;
            background-color: #fff;
            color: #333;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
        }

        #tabelaLogs {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tabelaLogs th,
        #tabelaLogs td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #tabelaLogs th {
            background-color: #f2f2f2;
        }

        #tabelaLogs tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</x-app-layout>
