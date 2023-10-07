<div>
    <x-app-layout>
        <x-slot name="header">
            <ul class="header-links">
                <a href="#" id="open-datalog"></a>
            </ul>
        </x-slot>
        <main>
            <h1 class="form-title" style="text-align: center">Cadastrar Equipamento</h1>
            <form method="POST" action="{{ route('cadastroequipamento') }}">
                <!-- Seu formulário aqui -->
            </form>
        </main>

        <div class="page-content">
            <form method="POST" action="{{ route('cadastroequipamento') }}">
                @csrf
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required><br>

                <label for="ip">IP:</label>
                <input type="text" id="ip" name="ip" required><br>

                <label for="porta">Porta:</label>
                <input type="text" id="porta" name="porta" required><br>

                <label for="versao_protocolo">Versão do Protocolo:</label>
                <input type="text" id="versao_protocolo" name="versao_protocolo" required><br>

                <label for="comunidade_snmp">Comunidade SNMP:</label>
                <input type="text" id="comunidade_snmp" name="comunidade_snmp" required><br>

                <label for="usuario_snmp">Usuário SNMP:</label>
                <input type="text" id="usuario_snmp" name="usuario_snmp" required><br>

                <label for="senha_snmp">Senha SNMP:</label>
                <input type="password" id="senha_snmp" name="senha_snmp" required><br>

                <input type="submit" value="Enviar">
                {{-- <button type="submit">Enviar</button> --}}
            </form>
        </div>
    </x-app-layout>
</div>
<style>
    /* Estilizando o formulário */
    form {
        max-width: 400px;
        /* Tamanho máximo para o formulário */
        margin: 0 auto;
        /* Centraliza o formulário horizontalmente na tela */
        padding: 20px;
        /* Espaçamento interno do formulário */
    }

    /* Estilizando os rótulos (labels) */
    label {
        display: block;
        /* Coloca cada rótulo em uma nova linha */
        margin-bottom: 5px;
        /* Espaço entre rótulos */
    }

    /* Estilizando os campos de entrada (inputs) */
    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 100%;
        /* Preenche todo o espaço disponível no formulário */
        padding: 10px;
        /* Espaçamento interno nos campos de entrada */
        margin-bottom: 10px;
        /* Espaço entre os campos */
        border: 1px solid #ccc;
        /* Borda dos campos */
        border-radius: 4px;
        /* Cantos arredondados */
    }

    /* Estilizando o botão de envio */
    input[type="submit"] {
        background-color: #007bff;
        /* Cor de fundo do botão */
        color: #fff;
        /* Cor do texto do botão */
        padding: 10px 20px;
        /* Espaçamento interno do botão */
        border: none;
        /* Remove a borda do botão */
        border-radius: 4px;
        /* Cantos arredondados */
        cursor: pointer;
        /* Altera o cursor para um ponteiro ao passar o mouse sobre o botão */
    }

    /* Estilizando o botão de envio quando hover (passar o mouse por cima) */
    input[type="submit"]:hover {
        background-color: #0056b3;
        /* Cor de fundo do botão ao passar o mouse */
    }

    /* Estilizando o título do formulário */
    .form-title {
        font-size: 24px;
        /* Tamanho da fonte do título */
        font-weight: bold;
        /* Peso da fonte (negrito) */
        margin-bottom: 20px;
        /* Espaçamento inferior para separar do formulário */
        color: #333;
        /* Cor do texto do título */
    }
</style>
