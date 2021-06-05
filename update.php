<?php
//sessao
session_start();
include('verifica_login.php'); 
require_once 'conexao.php';

if(isset($_POST['Atualizar'])){
$ID =$_SESSION['id_user'];
$NOME = mysqli_escape_String($conexao, utf8_decode($_POST['nome']));
$DTNASC = mysqli_escape_String($conexao, $_POST['dtnasc']);
$NATURALIDADE = mysqli_escape_String($conexao, utf8_decode($_POST['naturalidade']));
$NACIONALIDADE = mysqli_escape_String($conexao, $_POST['nacionalidade']);
$ESTADOCIVIL = mysqli_escape_String($conexao, $_POST['estadocivil']);
$SEXO = mysqli_escape_String($conexao, $_POST['sexo']);
$GRAUINSTRUCAO = mysqli_escape_String($conexao, $_POST['grauinstrucao']);
$RACA = mysqli_escape_String($conexao, $_POST['raca']);
$EMAIL = mysqli_escape_String($conexao, utf8_decode($_POST['email']));
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
$ORGAO_RG = mysqli_escape_String($conexao, utf8_decode($_POST['orgaorg']));
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
$LOGRADOURO = mysqli_escape_String($conexao,utf8_decode($_POST['logradouro']));
$NUMERO_END = mysqli_escape_String($conexao, $_POST['numero']);
$COMPLEMENTO = mysqli_escape_String($conexao, utf8_decode($_POST['complemento']));
$BAIRRO = mysqli_escape_String($conexao, utf8_decode($_POST['bairro']));
$MUNICIPIO = mysqli_escape_String($conexao,utf8_decode($_POST['municipio']));
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


$FORMATOS = array("png","jpeg","jpg","gif");
$EXTENSAO = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
    if(in_array($EXTENSAO,$FORMATOS)):
        $PASTA = "fotos_clientes/";
        $TEMP = $_FILES["imagem"]["tmp_name"];
        date_default_timezone_set('America/Sao_Paulo');
        $hora = date('s');
        $novoNome =$CPF."_$hora.$EXTENSAO";
        $nomeBanco =$PASTA.$novoNome;

        if(move_uploaded_file($TEMP,$PASTA.$novoNome)):
            $sql = "SELECT FOTO_PERFIL FROM PFUNC FUN WHERE FUN.ID ='{$ID}'";
            $dados = mysqli_query($conexao,$sql);
            $local_foto =mysqli_fetch_assoc($dados);
            unlink($local_foto["FOTO_PERFIL"]);

            $sql = "UPDATE pfunc set FOTO_PERFIL='$nomeBanco' WHERE ID = '{$ID}' ";
            mysqli_query($conexao,$sql);
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
        $cpfnome=$CPF."_CPF.$CPF_PDF";
        $cpfbanco =$PASTA_DOC.$cpfnome;
        if(move_uploaded_file($TEMP_CPFRG,$PASTA_DOC.$cpfnome)):
            $sql_cpf = "UPDATE pfunc SET ANEXO_CPF = '../$cpfbanco' WHERE '$CPF'";
            mysqli_query($conexao,$sql_cpf);
            $_SESSION['mensagem'] = "ENVIADO!";
        endif;
    endif;

    $RG_PDF = pathinfo($_FILES["RG_PDF"]["name"], PATHINFO_EXTENSION);
    if(in_array($RG_PDF,$FORMATOS_DOC)):
        $TEMP_CPFRG = $_FILES["RG_PDF"]["tmp_name"];
        $rgnome =$RG."_RG.$RG_PDF";
        $rgbanco =$PASTA_DOC.$rgnome;
        if(move_uploaded_file($TEMP_CPFRG,$PASTA_DOC.$rgnome)):
            $sql_rg = "UPDATE pfunc SET ANEXO_RG = '../$rgbanco' WHERE '$CPF'";
            mysqli_query($conexao,$sql_rg);
            $_SESSION['mensagem'] = "ENVIADO!";
        endif;
    endif;

    $TITULO_PDF = pathinfo($_FILES["titulopdf"]["name"], PATHINFO_EXTENSION);
    if(in_array($TITULO_PDF,$FORMATOS_DOC)):
        $TEMP_TITULO = $_FILES["titulopdf"]["tmp_name"];
        $titulonome =$NUMERO_TITULO."_TITULO.$TITULO_PDF";
        $titulobanco =$PASTA_DOC.$titulonome;
        if(move_uploaded_file($TEMP_TITULO,$PASTA_DOC.$titulonome)):
            $sql_titulo = "UPDATE pfunc SET ANEXO_TITULO = '../$titulobanco' WHERE '$CPF'";
            mysqli_query($conexao,$sql_titulo);
            $_SESSION['mensagem'] = "ENVIADO!";
        endif;
    endif;

    $CTPS_PDF = pathinfo($_FILES["ctps_pdf"]["name"], PATHINFO_EXTENSION);
    if(in_array($CTPS_PDF,$FORMATOS_DOC)):
        $TEMP_CTPS = $_FILES["ctps_pdf"]["tmp_name"];
        $ctpsnome =$NUMERO_CARTEIRA."_CTPS.$CTPS_PDF";
        $ctpsbanco =$PASTA_DOC.$ctpsnome;
        if(move_uploaded_file($TEMP_CTPS,$PASTA_DOC.$ctpsnome)):
            $sql_ctps = "UPDATE pfunc SET ANEXO_CTPS = '../$ctpsbanco' WHERE '$CPF'";
            mysqli_query($conexao,$sql_ctps);
            $_SESSION['mensagem'] = "ENVIADO!";
        endif;
    endif;

    $MILITAR_PDF = pathinfo($_FILES["militar_pdf"]["name"], PATHINFO_EXTENSION);
    if(in_array($MILITAR_PDF,$FORMATOS_DOC)):
        $TEMP_MILITAR = $_FILES["militar_pdf"]["tmp_name"];
        $militarnome =$NUMERO_MILITAR."_RESERVISTA.$MILITAR_PDF";
        $militarbanco =$PASTA_DOC.$militarnome;
        if(move_uploaded_file($TEMP_MILITAR,$PASTA_DOC.$militarnome)):
            $sql_militar = "UPDATE pfunc SET ANEXO_MILITAR = '../$militarbanco' WHERE '$CPF'";
            mysqli_query($conexao,$sql_militar);
            $_SESSION['mensagem'] = "ENVIADO!";
        endif;
    endif;

    $END_PDF = pathinfo($_FILES["end_pdf"]["name"], PATHINFO_EXTENSION);
    if(in_array($END_PDF,$FORMATOS_DOC)):
        $TEMP_END = $_FILES["end_pdf"]["tmp_name"];
        $endnome =$CPF."_ENDERECO.$END_PDF";
        $endbanco =$PASTA_DOC.$endnome;
        if(move_uploaded_file($TEMP_END,$PASTA_DOC.$endnome)):
            $sql_militar = "UPDATE pfunc SET ANEXO_END = '../$endbanco' WHERE '$CPF'";
            mysqli_query($conexao,$sql_militar);
            $_SESSION['mensagem'] = "ENVIADO!";
        endif;
    endif;


$sql = "UPDATE pfunc set NOME = UPPER('$NOME'), DTNASC= STR_TO_DATE('$DTNASC', '%d/%m/%Y'), NATURALIDADE=UPPER('$NATURALIDADE'), NACIONALIDADE='$NACIONALIDADE', ESTADOCIVIL='$ESTADOCIVIL', SEXO='$SEXO',GRAUINSTRUCAO='$GRAUINSTRUCAO', RACA='$RACA', NOMEPAI='$NOMEPAI', CIVILPAI='$CIVILPAI', CPFPAI='$CPFPAI',NOMEMAE='$NOMEMAE',CIVILMAE='$CIVILMAE', CPFMAE='$CPFMAE' , EMAIL='$EMAIL', TELEFONE='$TELEFONE', CELULAR='$CELULAR', CPF='$CPF',RG='$RG',DTEMISSAORG=STR_TO_DATE('$DT_EMISSAO_RG','%d/%m/%Y'), ORGAORG=UPPER('$ORGAO_RG'), ESTADORG='$ESTADO_RG', TITULO='$NUMERO_TITULO',ZONA='$ZONA_TITULO', SECAO='$SECAO_TITULO', DTEMISSAOTITULO=STR_TO_DATE('$DATA_TITULO', '%d/%m/%Y'), ESTADOTITULO='$UF_TITULO', NUMEROCARTEIRA='$NUMERO_CARTEIRA', SERIECARTEIRA='$SERIE_CARTEIRA', DTEMISSAOCTPS=STR_TO_DATE('$DTEMISSAO_CARTEIRA', '%d/%m/%Y'), ESTADOCTPS='$UF_CARTEIRA', ALISTAMENTO='$NUMERO_MILITAR', CATEGORIAMILITAR='$CATEGORIA_MILITAR', PIS='$PIS', CEP='$CEP', TIPORUA='$TP_RUA' ,LOGRADOURO='$LOGRADOURO', NUMERO='$NUMERO_END', COMPLEMENTO='$COMPLEMENTO', TIPOBAIRRO='$TP_BAIRRO', BAIRRO='$BAIRRO',MUNICIPIO='$MUNICIPIO',ESTADO='$UF_END',BANCO='$BANCO',AGENCIA='$AGENCIA',DAGENCIA='$D_AGENCIA',CONTA='$CONTA',DCONTA='$D_CONTA',TP_CONTA='$TP_CONTA', DEFICIENCIA = '$DEF', TP_DEFICIENCIA = '$TPDEF', CONT_SIND1 = '$SIND1', CONT_SIND2 = '$SIND2', VT = '$VT', VALORVT = REPLACE( REPLACE( '$VALORVT', '.' ,'' ), ',', '.' ), TARIFAOPERADORA = '$OPERADORA', VAVR = '$VAVR' WHERE ID = '{$ID}' ";
};
   if(mysqli_query($conexao,$sql)):
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header('location: lista_func.php');
    else:
        $_SESSION['mensagem'] = "Erro ao Atualizar!";
        header('location: lista_func.php');
   endif;
?>
