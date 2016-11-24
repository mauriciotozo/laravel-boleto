<?php
include realpath(__DIR__ . '/../../../') . DIRECTORY_SEPARATOR . 'autoload.php';
$beneficiario = new \Eduardokum\LaravelBoleto\Boleto\Pessoa([
    'nome' => 'ACME',
    'endereco' => 'Rua um, 123',
    'cep' => '99999-999',
    'uf' => 'UF',
    'cidade' => 'CIDADE',
    'documento' => '99.999.999/9999-99',
]);

$pagador = new \Eduardokum\LaravelBoleto\Boleto\Pessoa([
    'nome' => 'Cliente',
    'endereco' => 'Rua um, 123',
    'bairro' => 'Bairro',
    'cep' => '99999-999',
    'uf' => 'UF',
    'cidade' => 'CIDADE',
    'documento' => '999.999.999-99',
]);

$boleto = new Eduardokum\LaravelBoleto\Boleto\Banco\Banrisul([
    'logo' => realpath(__DIR__ . '/../logos/') . DIRECTORY_SEPARATOR . '041.png',
    'dataVencimento' => new \Carbon\Carbon(),
    'valor' => 100,
    'multa' => false,
    'juros' => false,
    'numero' => 1,
    'numeroDocumento' => 1,
    'pagador' => $pagador,
    'beneficiario' => $beneficiario,
    'carteira' => 11,
    'agencia' => 1111,
    'agenciaDv' => 11,
    'conta' => \Eduardokum\LaravelBoleto\Boleto\Banco\Banrisul::extractContaFromCodigo('111122222222222'), // Gera o número da conta a partir do numero do CEDENTE(dev 11 à 15 dígitos) informado pelo banco
    'contaDv' => \Eduardokum\LaravelBoleto\Boleto\Banco\Banrisul::extractContaDvFromCodigo('111122222222222'), // Gera o DV da conta a partir do numero do CEDENTE(dev 11 à 15 dígitos) informado pelo banco
    'descricaoDemonstrativo' => ['demonstrativo 1', 'demonstrativo 2', 'demonstrativo 3'],
    'instrucoes' =>  ['instrucao 1', 'instrucao 2', 'instrucao 3'],
    'aceite' => 'S',
    'especieDoc' => 'DM',
]);

$pdf = new Eduardokum\LaravelBoleto\Boleto\Render\Pdf();
$pdf->addBoleto($boleto);
$pdf->gerarBoleto($pdf::OUTPUT_SAVE, __DIR__ . DIRECTORY_SEPARATOR . 'arquivos' . DIRECTORY_SEPARATOR . 'bb.pdf');