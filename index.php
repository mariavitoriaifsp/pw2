// Maria Vitória do Nascimemento Inocencio SC3020517


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Webservice Clínica Médica com autenticação JWT</title>
</head>

<body>
    <h1>Webservice de Clínica Médica</h1>
    <p>Este webservice JSON didático contém um sistema de exemplo de uma clínica médica, formada por <b>pacientes</b>,
        <b>médicos</b>, <b>especializações</b> e <b>consultas</b>. Para entrar, o usuário deve criar e fazer o login de
        <b>Admin</b> para realizar qualquer operação no sistema. Veja detalhes do login na rota
        <i>administradores.php</i>
    </p>
    <h2>As rotas disponíveis são:</h2>
    <p><a href="administradores.php">administradores.php</a> suporta as seguintes operações:</p>
    <ul>
        <li><b>PUT</b> - Adiciona um novo administrador. Requer parâmetros <i>login</i> e <i>senha</i>. O login deve ser
            único na aplicação (e não precisa ser um email!).</li>
        <li><b>POST</b> - Usado para login. Requer os parâmetros <i>login</i> e <i>senha</i>. Retorna um json contendo
            um token JWT válido para 10 minutos de interação.</li>
    </ul>
    <p><a href="pacientes.php">pacientes.php</a> suporta as seguintes operações:</p>
    <ul>
        <li><b>GET</b> - Retorna a lista de pacientes.</li>
        <li><b>POST</b> - Adiciona um novo paciente. Requer parâmetros <i>nome</i> e <i>dataNascimento</i> (no formato
            YYYY-MM-DD).</li>
        <li><b>PUT</b> - Edita um paciente. Requer parâmetros <i>id</i>, <i>nome</i> e <i>dataNascimento</i> (no formato
            YYYY-MM-DD).</li>
        <li><b>DELETE</b> - Remove um paciente. Requer parâmetro <i>id</i> (do tipo GET).</li>
    </ul>
    <p><a href="medicos.php">medicos.php</a> suporta as seguintes operações:</p>
    <ul>
        <li><b>GET</b> - Retorna a lista de médicos.</li>
        <li><b>POST</b> - Adiciona um novo médico. Requer parâmetros <i>nome</i> e <i>idEspecialidade</i>.</li>
        <li><b>PUT</b> - Edita um médico. Requer parâmetros <i>id</i>, <i>nome</i> e <i>idEspecialidade</i>.</li>
        <li><b>DELETE</b> - Remove um médico. Requer parâmetro <i>id</i> (do tipo GET).</li>
    </ul>
    <p><a href="consultas.php">consultas.php</a> suporta as seguintes operações:</p>
    <ul>
        <li><b>GET</b> - Retorna a lista de consultas.</li>
        <li><b>POST</b> - Adiciona uma nova consulta. Requer parâmetros <i>idPaciente</i> e <i>idMedico</i> e
            <i>data</i> (no formato YYYY-MM-DD HH:mm).
        </li>
        <li><b>PUT</b> - Edita uma consulta. Requer parâmetros <i>id</i>, <i>idPaciente</i> e <i>idMedico</i> e
            <i>data</i> (no formato YYYY-MM-DD HH:mm).
        </li>
        <li><b>DELETE</b> - Remove uma consulta. Requer parâmetro <i>id</i> (do tipo GET).</li>
    </ul>
    <p><a href="especialidades.php">especialidades.php</a> suporta as seguintes operações:</p>
    <ul>
        <li><b>GET</b> - Retorna a lista de especialidades.</li>
    </ul>
</body>

</html>
