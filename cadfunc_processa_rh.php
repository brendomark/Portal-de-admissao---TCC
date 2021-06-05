<?php
//sessao
session_start();
include('verifica_login.php');
//conexao
require_once 'conexao.php';
include_once 'mensagem.php';

if(isset($_POST['Cadastrar']));
$NOME = mysqli_escape_String($conexao, $_POST['nome']);
$DATANASC = mysqli_escape_String($conexao, $_POST['dtnasc']);
$NATURALIDADE = mysqli_escape_String($conexao, $_POST['naturalidade']);
$NACIONALIDADE = mysqli_escape_String($conexao, $_POST['nacionalidade']);
$ESTADOCIVIL = mysqli_escape_String($conexao, $_POST['estadocivil']);
$SEXO = mysqli_escape_String($conexao, $_POST['sexo']);
$GRAUINSTRUCAO = mysqli_escape_String($conexao, $_POST['grauinstrucao']);
$RACA = mysqli_escape_String($conexao, $_POST['raca']);
$EMAIL = mysqli_escape_String($conexao, $_POST['email']);
$TELEFONE = mysqli_escape_String($conexao, $_POST['telefone']);
$CELULAR = mysqli_escape_String($conexao, $_POST['celular']);
$CPF = mysqli_escape_String($conexao, $_POST['cpf']);

$NOMEMAE = mysqli_escape_String($conexao, utf8_decode($_POST['nomemae']));
$CIVILMAE = mysqli_escape_String($conexao, $_POST['estadocivilmae']);
$CPFMAE = mysqli_escape_String($conexao, $_POST['cpfmae']);

$NOMEPAI = mysqli_escape_String($conexao, utf8_decode($_POST['nomepai']));
$CIVILPAI = mysqli_escape_String($conexao, utf8_decode($_POST['estadocivilpai']));
$CPFPAI = mysqli_escape_String($conexao, $_POST['cpfpai']);

$RG = mysqli_escape_String($conexao, $_POST['rg']);
$DT_EMISSAO_RG = mysqli_escape_String($conexao, $_POST['dtemissaorg']);
$ORGAO_RG = mysqli_escape_String($conexao, $_POST['orgaorg']);
$ESTADO_RG = mysqli_escape_String($conexao, $_POST['estadorg']);

$NUMERO_TITULO = mysqli_escape_String($conexao, $_POST['ntitulo']);
$ZONA_TITULO = mysqli_escape_String($conexao, $_POST['zona']);
$SECAO_TITULO = mysqli_escape_String($conexao, $_POST['secao']);
$DATA_TITULO = mysqli_escape_String($conexao, $_POST['dtemissaotitulo']);
$UF_TITULO = mysqli_escape_String($conexao, $_POST['estadotitulo']);

$NUMERO_CARTEIRA = mysqli_escape_String($conexao, $_POST['numerocarteira']);
$SERIE_CARTEIRA = mysqli_escape_String($conexao, $_POST['seriecarteira']);
$DTEMISSAO_CARTEIRA = mysqli_escape_String($conexao, $_POST['datacarteira']);
$UF_CARTEIRA = mysqli_escape_String($conexao, $_POST['ufcarteira']);

$NUMERO_MILITAR = mysqli_escape_String($conexao, $_POST['nmilitar']);
$CATEGORIA_MILITAR = mysqli_escape_String($conexao, $_POST['categoriamilitar']);
$PIS = mysqli_escape_String($conexao, $_POST['pis']);

$CEP = mysqli_escape_String($conexao, $_POST['cep']);
$LOGRADOURO = mysqli_escape_String($conexao, $_POST['logradouro']);
$NUMERO_END = mysqli_escape_String($conexao, $_POST['numero']);
$COMPLEMENTO = mysqli_escape_String($conexao, $_POST['complemento']);
$BAIRRO = mysqli_escape_String($conexao, $_POST['bairro']);
$MUNICIPIO = mysqli_escape_String($conexao, $_POST['municipio']);
$UF_END = mysqli_escape_String($conexao, $_POST['ufendereco']);
$TP_RUA = mysqli_escape_String($conexao,utf8_decode($_POST['tp_rua']));
$TP_BAIRRO = mysqli_escape_String($conexao, $_POST['tp_bairro']);

$BANCO = mysqli_escape_String($conexao, $_POST['banco']);
$AGENCIA = mysqli_escape_String($conexao, $_POST['agencia']);
$D_AGENCIA = mysqli_escape_String($conexao, $_POST['dagencia']);
$CONTA = mysqli_escape_String($conexao, $_POST['conta']);
$D_CONTA = mysqli_escape_String($conexao, $_POST['dconta']);
$TP_CONTA = mysqli_escape_String($conexao, $_POST['tpconta']);

$DEF = mysqli_escape_String($conexao,utf8_decode($_POST['deficiencia']));
$TPDEF = mysqli_escape_String($conexao,utf8_decode($_POST['tpdeficiencia']));
$SIND1 = mysqli_escape_String($conexao,utf8_decode($_POST['cont_sindical_rj']));
$SIND2 = mysqli_escape_String($conexao,utf8_decode($_POST['cont_sindical_sp']));

$VT = mysqli_escape_String($conexao,utf8_decode($_POST['vt']));
$VALORVT = mysqli_escape_String($conexao,utf8_decode($_POST['valorvt']));
$OPERADORA = mysqli_escape_String($conexao,utf8_decode($_POST['operadora']));
$VAVR = mysqli_escape_String($conexao,utf8_decode($_POST['vavr']));

$SECAO = mysqli_escape_String($conexao, $_POST['secao']);
$PRIMEIRO_EMP = mysqli_escape_String($conexao, $_POST['primeiroemp']);
$DT_ADMISSAO = mysqli_escape_String($conexao, $_POST['dtadmissao']);
$GESTOR = mysqli_escape_String($conexao, $_POST['gestor']);
$FUNCAO = mysqli_escape_String($conexao, $_POST['funcao']);
$TP_SALARIO = mysqli_escape_String($conexao, $_POST['tpsalario']);
$SALARIO = mysqli_escape_String($conexao, $_POST['salario']);
$JORNADA = mysqli_escape_String($conexao, $_POST['jornada']);
$HORARIOS = mysqli_escape_String($conexao, $_POST['tphorario']);
$MATRICULA = mysqli_escape_String($conexao, $_POST['matricula']);
$LOCAL_SERVE = mysqli_escape_String($conexao, $_POST['localserve']);
$TP_JORNADA = mysqli_escape_String($conexao, $_POST['tpjornada']);
$CONTRATACAO = mysqli_escape_String($conexao, $_POST['contratacao']);
$PRAZO = mysqli_escape_String($conexao, $_POST['prazo']);

    
$sql = "SELECT max(ID)+1 as ID FROM ppessoa";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);
$ID = $dados["ID"];
$COLIGADA = $_SESSION["coligada"];

$FORMATOS = array("png","jpeg","jpg","gif","pdf");
$EXTENSAO = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
    if(in_array($EXTENSAO,$FORMATOS)):
        $PASTA = "fotos_clientes/";
        $TEMP = $_FILES["imagem"]["tmp_name"];
        date_default_timezone_set('America/Sao_Paulo');
        $hora = date('s');
        $novoNome =$CPF."_$hora.$EXTENSAO";
        $nomeBanco =$PASTA.$novoNome;
        if(move_uploaded_file($TEMP,$PASTA.$novoNome)):
            $_SESSION['mensagem'] = "Sucesso!";
        else:    
            $_SESSION['mensagem'] = "Erro!";
        endif;
    else:
        $_SESSION['mensagem'] = "Formato errado!";
    endif;


    $FORMATOS_DOC = array("pdf");
    $PASTA_DOC = "docs_clientes/";

    $CPF_PDF = pathinfo($_FILES["CPF_PDF"]["name"], PATHINFO_EXTENSION);
        if(in_array($CPF_PDF,$FORMATOS_DOC)):
            $TEMP_CPFRG = $_FILES["CPF_PDF"]["tmp_name"];
            $novoNome =$CPF."_CPF.$CPF_PDF";
            if(move_uploaded_file($TEMP_CPFRG,$PASTA_DOC.$novoNome)):
                $anexo_cpf ="../".$PASTA_DOC.$novoNome;
                $_SESSION['mensagem'] = "ENVIADO!";
            endif;
        endif;

        $RG_PDF = pathinfo($_FILES["RG_PDF"]["name"], PATHINFO_EXTENSION);
        if(in_array($RG_PDF,$FORMATOS_DOC)):
            $TEMP_CPFRG = $_FILES["RG_PDF"]["tmp_name"];
            $novoNome =$RG."_RG.$RG_PDF";
            if(move_uploaded_file($TEMP_CPFRG,$PASTA_DOC.$novoNome)):
                $anexo_rg ="../".$PASTA_DOC.$novoNome;
                $_SESSION['mensagem'] = "ENVIADO!";
            endif;
        endif;
    
        $TITULO_PDF = pathinfo($_FILES["titulopdf"]["name"], PATHINFO_EXTENSION);
        if(in_array($TITULO_PDF,$FORMATOS_DOC)):
            $TEMP_TITULO = $_FILES["titulopdf"]["tmp_name"];
            $novoNome =$NUMERO_TITULO."_TITULO.$TITULO_PDF";
            if(move_uploaded_file($TEMP_TITULO,$PASTA_DOC.$novoNome)):
                $anexo_titulo ="../".$PASTA_DOC.$novoNome;
                $_SESSION['mensagem'] = "ENVIADO!";
            endif;
        endif;
    
        $CTPS_PDF = pathinfo($_FILES["ctps_pdf"]["name"], PATHINFO_EXTENSION);
        if(in_array($CTPS_PDF,$FORMATOS_DOC)):
            $TEMP_CTPS = $_FILES["ctps_pdf"]["tmp_name"];
            $novoNome =$NUMERO_CARTEIRA."_CTPS.$CTPS_PDF";
            if(move_uploaded_file($TEMP_CTPS,$PASTA_DOC.$novoNome)):
                $anexo_ctps ="../".$PASTA_DOC.$novoNome;
                $_SESSION['mensagem'] = "ENVIADO!";
            endif;
        endif;
    
        $MILITAR_PDF = pathinfo($_FILES["militar_pdf"]["name"], PATHINFO_EXTENSION);
        if(in_array($MILITAR_PDF,$FORMATOS_DOC)):
            $TEMP_MILITAR = $_FILES["militar_pdf"]["tmp_name"];
            $novoNome =$NUMERO_MILITAR."_RESERVISTA.$MILITAR_PDF";
            if(move_uploaded_file($TEMP_MILITAR,$PASTA_DOC.$novoNome)):
                $anexo_militar ="../".$PASTA_DOC.$novoNome;
                $_SESSION['mensagem'] = "ENVIADO!";
            endif;
        endif;
    
        $END_PDF = pathinfo($_FILES["end_pdf"]["name"], PATHINFO_EXTENSION);
        if(in_array($END_PDF,$FORMATOS_DOC)):
            $TEMP_END = $_FILES["end_pdf"]["tmp_name"];
            $novoNome =$CPF."_ENDERECO.$END_PDF";
            if(move_uploaded_file($TEMP_END,$PASTA_DOC.$novoNome)):
                $anexo_end ="../".$PASTA_DOC.$novoNome;
                $_SESSION['mensagem'] = "ENVIADO!";
            endif;
        endif;


$sql = "INSERT INTO pfunc(codcoligada,id,foto_perfil,nome,dtnasc,naturalidade,nacionalidade,estadocivil,sexo,grauinstrucao,raca,nomepai,civilpai,cpfpai,nomemae,civilmae,cpfmae,email,telefone,celular,cpf,rg,dtemissaorg,orgaorg,estadorg,titulo,zona,secao,dtemissaotitulo,estadotitulo,numerocarteira,seriecarteira,dtemissaoctps,estadoctps,alistamento,categoriamilitar,pis,cep,tiporua,logradouro,numero,complemento,tipobairro,bairro,municipio,estado,banco,agencia,dagencia,conta,dconta,tp_conta,deficiencia,tp_deficiencia,cont_sind1, cont_sind2,VT,VALORVT,TARIFAOPERADORA,VAVR,ANEXO_CPF,ANEXO_RG,ANEXO_TITULO,ANEXO_CTPS,ANEXO_MILITAR,ANEXO_END)
    VALUES('$COLIGADA','$ID','$nomeBanco',UPPER('$NOME'),STR_TO_DATE('$DATANASC', '%d/%m/%Y'),UPPER('$NATURALIDADE'),UPPER('$NACIONALIDADE'),UPPER('$ESTADOCIVIL'),'$SEXO','$GRAUINSTRUCAO','$RACA',UPPER('$NOMEPAI'),'$CIVILPAI','$CPFPAI',UPPER('$NOMEMAE'),'$CIVILMAE','$CPFMAE','$EMAIL','$TELEFONE','$CELULAR','$CPF','$RG',STR_TO_DATE('$DT_EMISSAO_RG','%d/%m/%Y'),UPPER('$ORGAO_RG'),'$ESTADO_RG','$NUMERO_TITULO','$ZONA_TITULO','$SECAO_TITULO',STR_TO_DATE('$DATA_TITULO', '%d/%m/%Y'),'$UF_TITULO','$NUMERO_CARTEIRA','$SERIE_CARTEIRA',STR_TO_DATE('$DTEMISSAO_CARTEIRA', '%d/%m/%Y'),'$UF_CARTEIRA','$NUMERO_MILITAR','$CATEGORIA_MILITAR','$PIS','$CEP','$TP_RUA',upper('$LOGRADOURO'),'$NUMERO_END',upper('$COMPLEMENTO'),'$TP_BAIRRO',upper('$BAIRRO'),upper('$MUNICIPIO'),'$UF_END','$BANCO','$AGENCIA','$D_AGENCIA','$CONTA','$D_CONTA','$TP_CONTA',UPPER('$DEF'),'$TPDEF',UPPER('$SIND1'),UPPER('$SIND2'),'$VT','$VALORVT',upper('$OPERADORA'),'$VAVR','$anexo_cpf', '$anexo_rg', '$anexo_titulo', '$anexo_ctps', '$anexo_militar', '$anexo_end')";


$sqlpes = "INSERT INTO PPESSOA(CODCOLIGADA,ID,USUARIO,CPF,SENHA,EMAIL,CODSECAO,PRIMEIROEMP,DTADMISSAO,GESTOR,CODFUNCAO,TPSALARIO,SALARIO,JORNADA,HORARIOS,MATRICULA,LOCALSERVICO,TPJORNADA,CONTRATACAO,PRAZO)
 VALUES('$COLIGADA', '$ID', '$EMAIL', '$CPF' , '$CPF' , '$EMAIL' , '$SECAO' , '$PRIMEIRO_EMP' , STR_TO_DATE('$DT_ADMISSAO', '%d/%m/%Y') , '$GESTOR' , '$FUNCAO' , '$TP_SALARIO' , '$SALARIO' , '$JORNADA' , '$HORARIOS' , '$MATRICULA' , '$LOCAL_SERVE' , '$TP_JORNADA' , '$CONTRATACAO' , '$PRAZO')";

    if(mysqli_query($conexao,$sql)){
        mysqli_query($conexao,$sqlpes);
        $dependentes = $_POST['nomedep'];
            foreach ($dependentes as $key => $dependente) {
                $nomedep = $dependente;
                $dtnascdep = $_POST['dtnascdep'][$key];
                $parentescodep = $_POST['parentescodep'][$key];
                // seguir assim até obter todos os atributos do dependente:
                $cpf_dep = $_POST['cpfdep'][$key];
                $ir_dep = $_POST['irdep'][$key];
                $maedep = $_POST['maedep'][$key];
                // nesse ponto você tem os dados do dependente n e pode inseri-lo
                // rodar o insert do dependente. Ai vai depender de como modelou o banco
                // o certo seria realizar todos os inserts dentro de uma transaction e commitar td no final se nao der erro
                $sqlDep = "INSERT INTO pfdepend (CODCOLIGADA,ID_FUNC, ID_DEP, NOME_DEP, DTNASC_DEP, PARENTESCO, CPF_DEP, IR_DEP, MAE_DEP)
                        VALUES ('$COLIGADA','$MATRICULA','$key',UPPER('$nomedep'),STR_TO_DATE('$dtnascdep', '%d/%m/%Y'),'$parentescodep',replace(replace('$cpf_dep','.',''),'-','') ,'$ir_dep',upper('$maedep'))";
                mysqli_query($conexao,$sqlDep);
            };
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('location: lista_func_rh.php');
        exit();
    }else{
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('location: cadastrorh.php');
        exit();
    }
?>
