<?php 
session_start();
include('verifica_login.php');
include('verifica_acesso_USER.php');
include_once 'conexao.php';

$ID = mysqli_escape_String($conexao, $_GET['id']);
$CODCOLIGADA = $_SESSION['coligada'];

$sql ="SELECT * FROM PFUNC FUN INNER JOIN PPESSOA PES ON PES.ID=FUN.ID AND PES.CODCOLIGADA=FUN.CODCOLIGADA WHERE FUN.ID = $ID"; 
$resultado_usuario = mysqli_query($conexao,$sql);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);

$meus_links = array($row_usuario);

// Receberá todos os dados do XML
/*$xml = "<?xml version='1.0' encoding='ISO-8859-1'?>\n";*/
// A raiz do meu documento XML
$xml = null;
/*$xml .= "<links>\n";*/

for ( $i = 0; $i < count( $meus_links ); $i++ ) {
	$xml .= str_pad($meus_links[$i]['MATRICULA'], 16).";";      //1
    $xml .= str_pad($meus_links[$i]['NOME'],120).";";           //2
    $xml .= str_pad("",40).";";                                 //3
    $xml .= str_replace('/','',str_pad( date("d/m/Y", strtotime($meus_links[$i]['DTNASC'])),8).";");    //4
    $xml .= str_pad($meus_links[$i]['ESTADOCIVIL'],1).";";      //5
    //$xml .= str_pad($meus_links[$i]['SEXO'],1).";";             //6
    $xml .= str_pad('M',1).";"; 
    $xml .= str_pad("",3).";";                                  //7
$xml .= str_pad($meus_links[$i]['GRAUINSTRUCAO'],1).";";        //8
    $xml .= str_pad("",30).";";                                 //9
    $xml .= str_pad("",8).";";                                  //10            
    $xml .= str_pad("",16).";";//11
    $xml .= str_pad("",20).";";//12
    $xml .= str_pad("",2).";";//13
    $xml .= str_pad("",32).";";//14
    $xml .= str_pad("",9).";";//15
    $xml .= str_pad("",16).";";//16
    $xml .= str_pad("",15).";";//17
    //$xml .= str_pad(str_replace('-','',str_replace('.','',$meus_links[$i]['CPF'])),12).";"; //18
    $xml .= str_pad('92857610033',12).";"; 
    $xml .= str_pad("",15).";";//19
    $xml .= str_pad("",15).";";//20
    $xml .= str_pad("",15).";";//21
    $xml .= str_pad("",2).";";//22
    $xml .= str_pad("",15).";";//23
    $xml .= str_pad("",8).";";//24
    $xml .= str_pad("",8).";";//25
    $xml .= str_pad("",14).";";//26
    $xml .= str_pad("",6).";";//27
    $xml .= str_pad("",6).";";//28
    $xml .= str_pad("",10).";";//29
    $xml .= str_pad("",5).";";//30
    $xml .= str_pad("",2).";";//31
    $xml .= str_pad("",8).";";//32
    $xml .= str_pad("",8).";";//33
    $xml .= str_pad("",1).";";/*PPESSOA.NIT -- NIT - Tipo de Carteira de Trabalho (0-Não/1-Sim)*/ //34
    $xml .= str_pad("",15).";";//35
    $xml .= str_pad("",5).";";//36
    $xml .= str_pad("",8).";";//37
    $xml .= str_pad("",40).";";//38
    $xml .= str_pad("",10).";";//39
    $xml .= str_pad($meus_links[$i]['NATURALIDADE'],32).";";//40
    $xml .= str_pad($meus_links[$i]['ESTADO'],2).";";//41
    $xml .= str_pad("",8).";";//42
    $xml .= str_pad("",15).";";//43
    $xml .= str_pad("",1).";";/*PPESSOA.CONJUGEBRASIL -- Cônjuge Brasil (0-Não/1-Sim)*/ //44
    $xml .= str_pad("",1).";";/*PPESSOA.NATURALIZADO -- Naturalizado (0-Não/1-Sim)*/    //45
    $xml .= str_pad("",1).";";/*PPESSOA.FILHOSBRASIL -- Filhos no Brasil (0-Não/1-Sim)*/   //46     
    $xml .= str_pad("",2).";"; //47
    $xml .= str_pad("",15).";"; //48
    $xml .= str_pad("",15).";"; //49
    $xml .= str_pad("",10).";"; //50  
    $xml .= str_pad("",60).";"; //51
    $xml .= str_pad("",8).";";  //52
    $xml .= str_pad($meus_links[$i]['MATRICULA'],10).";"; //53
    $xml .= str_pad("M",1).";";/*PFUNC.CODRECEBIMENTO -- Código de Recebimento*/ //54 
    $xml .= str_pad("A",1).";";/*PFUNC.CODSITUACAO -- Código de Situação*/       //55 
    $xml .= str_pad("N",1).";";/*PFUNC.CODTIPO -- Código do Tipo do Funcionário*/  //56
    $xml .= str_pad($meus_links[$i]['CODSECAO'],35).";";  //57
    $xml .= str_pad($meus_links[$i]['CODFUNCAO'],10).";"; //58
    $xml .= str_pad("0001",10).";";/*PFUNC.CODSINDICATO -- Código do Sindicato*/ //59
    $xml .= str_pad($meus_links[$i]['JORNADA'],6).";"; //60
    $xml .= str_pad($meus_links[$i]['HORARIOS'],10).";"; //61
    $xml .= str_pad("",2).";";//62
    $xml .= str_pad("",2).";";//63
    $xml .= str_pad("",8).";";//64
    $xml .= str_pad(str_replace('-','',str_replace('.',',',$meus_links[$i]['SALARIO'])),15).";"; //65
    $xml .= str_pad("1",1).";";/*PFUNC.SITUACAOFGTS -- Situação de FGTS (1-Optante / 2-Não Optante)*/ //66
    $xml .= str_pad("",8).";";//67
    $xml .= str_pad("",11).";";//68
    $xml .= str_pad("",15).";";//69
    $xml .= str_pad("",8).";";//70
    $xml .= str_pad("",11).";";//71
    $xml .= str_pad("",8).";";//72
    $xml .= str_pad("",3).";";//73

    if($meus_links[$i]['CONT_SIND1'] == "SIM")
        $codsind="J";
    else 
        $codsind="L";

    $xml .= str_pad('X',1).";";//74
    $xml .= str_pad("0",1).";";/*PFUNC.APOSENTADO -- Aposentado (0-Não/1-Sim)*///75
    $xml .= str_pad("0",1).";";/*PFUNC.TEMMAIS65ANOS -- Tem Mais de 65 Anos (0-Não/1-Sim)*///76
    $xml .= str_pad("",15).";";//77
    $xml .= str_pad("",6).";";//78
    $xml .= str_pad("",8).";";//79
    $xml .= str_replace('/','',str_pad( date("d/m/Y", strtotime($meus_links[$i]['DTADMISSAO'])),8).";"); //80
    $xml .= str_pad("R",1).";";/*PFUNC.TIPOADMISSAO -- Tipo de Admissão*/ //81
    $xml .= str_pad("",8).";";//82
    $xml .= str_pad("01",2).";";/*PFUNC.MOTIVOADMISSAO -- Motivo da Admissão*///83
    $xml .= str_pad("",1).";";/*PFUNC.TEMPRAZOCONTR -- Contrato tem Prazo Determinado (0-Não/1-Sim)*///84
    $xml .= str_pad("",8).";";//85
    $xml .= str_pad("",8).";";//86
    $xml .= str_pad("",1).";";//87
    $xml .= str_pad("",2).";";//88
    $xml .= str_pad("",8).";";//89
    $xml .= str_pad("",8).";";//90
    $xml .= str_pad("",8).";";//91
    $xml .= str_pad("",2).";";//92
    $xml .= str_pad("",1).";";/*PFUNC.TEMAVISOPREVIO -- Tem Aviso Prévio (0- Não / 1-Sim)*///93
    $xml .= str_pad("",8).";";//94
    $xml .= str_pad("",3).";";//95
    $xml .= str_pad("",8).";";//96
    $xml .= str_pad("",8).";";//97
    $xml .= str_pad("",8).";";//98
    $xml .= str_pad("",1).";";/*PFUNC.QUERABONO -- Quer Abono (0- Não / 1-Sim)*///99
    $xml .= str_pad("0",1).";";/*PFUNC.QUER1APARC13O -- Quer 1ª Parcela de 13º (0- Não / 1-Sim)*///100
    $xml .= str_pad("",3).";";//101
    $xml .= str_pad("",4).";";//102
    $xml .= str_pad("0",1).";";/*PFUNC.FERIASCOLETIVAS -- Férias Coletivas / Globais (0-Não/1-Sim)*///103
    $xml .= str_pad("",7).";";//104
    $xml .= str_pad("",6).";";//105
    $xml .= str_pad("",6).";";//106
    $xml .= str_pad("",6).";";//107
    $xml .= str_pad("",6).";";//108
    $xml .= str_pad("",80).";";//109
    $xml .= str_pad("",8).";";//110
    $xml .= str_pad("",8).";";//111
    $xml .= str_pad("",6).";";//112
    $xml .= str_pad("",6).";";//113
    $xml .= str_pad("",8).";";//114
    $xml .= str_pad("",15).";";//115
    $xml .= str_pad("1",1).";";/*PFUNC.SITUACAORAIS -- Situação RAIS*///116
    $xml .= str_pad("",3).";";//117
    $xml .= str_pad("",6).";";//118
    $xml .= str_pad("",15).";";//119
    $xml .= str_pad("",1).";";/*PFUNC.MEMBROSINDICAL -- Membro Sindical (0-Não/1-Sim)*///120
    $xml .= str_pad("",1).";";//121
    $xml .= str_pad($meus_links[$i]['VT'],1).";";//122
    $xml .= str_pad("",2).";";//123
    $xml .= str_pad("",2).";";//124
    $xml .= str_pad("",2).";";//125
    $xml .= str_pad("",2).";";//126
    $xml .= str_pad("",2).";";//127
    $xml .= str_pad("",2).";";//128
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUENDERECO -- MMudou Endereço (0-Não/1-Sim)*///129
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUCARTTRAB -- Mudou Carteira de Trabalho (0-Não/1-Sim)*///130
    $xml .= str_pad("",10).";";//131
    $xml .= str_pad("",5).";";//132
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUNOME -- Mudou Nome (0-Não/1-Sim)*///133
    $xml .= str_pad("",45).";";//134
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUPIS -- Mudou PIS (0-Não/1-Sim)*///135
    $xml .= str_pad("",11).";";//136
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUCHAPA -- Mudou Chapa (0-Não/1-Sim)*///137
    $xml .= str_pad("",16).";";//138
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUADMISSAO -- Mudou Data de Admissão (0-Não/1-Sim)*///139
    $xml .= str_pad("",8).";";//140
    $xml .= str_pad("",1).";";//141
    $xml .= str_pad("",1).";";//142
    $xml .= str_pad("",1).";";//143
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUDTOPCAO -- Mudou Data de Opção (0-Não/1-Sim)*///144
    $xml .= str_pad("",8).";";//145
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUSECAO -- Mudou Seção (0-Não/1-Sim)*///146
    $xml .= str_pad("",35).";";//147
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUDTNASCIM -- Mudou Data de Nascimento (0-Não/1-Sim)*///148
    $xml .= str_pad("",8).";";//149
    $xml .= str_pad("0",1).";";/*PFUNC.FALTAALTERFGTS -- Falta Alterar FGTS (0-Não/1-Sim)*///150
    $xml .= str_pad("0",1).";";/*PFUNC.DEDUZIRRF65 -- Deduzir IRRF Mais 65 (0-Não/1-Sim)*///151
    $xml .= str_pad("",11).";";//152
    $xml .= str_pad("",3).";";//153
    $xml .= str_pad("0",1).";";//154
    $xml .= str_pad("0001",2).";";//155
    $xml .= str_pad("01",5).";";/*PFUNC.INDINICIOHOR -- Índice de Início de Horário*///156
    $xml .= str_pad("0",1).";";/*PFUNC.USASALCOMPOSTO -- Usa Salário Composto (0-Não/1-Sim)*///157
    $xml .= str_pad("0",1).";";/*PFUNC.MEMBROCIPA -- Funcionário é membro da CIPA (0-Não/1-Sim)*///158
    $xml .= str_pad("",5).";";//159
    $xml .= str_pad("",2).";";//160
    $xml .= str_pad("",8).";";//161
    $xml .= str_pad("",10).";";//162
    $xml .= str_pad("0",1).";";/*PFUNC.REGATUAL -- Funcionário é o atual? (0-Não/1-Sim)*///163
    $xml .= str_pad("",8).";";//164
    $xml .= str_pad("0",2).";";/*PFUNC.CODOCORRENCIA -- Bitmap Código da Ocorrência*///165
    $xml .= str_pad("",2).";";//166
    $xml .= str_pad("",8).";";//167
    $xml .= str_pad("",4).";";//168
    $xml .= str_pad("0",2).";";/*PFUNC.ESUPERVISOR -- Funcionário tem status de supervisor? (0-Não/1-Sim)*///169
    $xml .= str_pad("",22).";";//170
    $xml .= str_pad("",22).";";//171
    $xml .= str_pad("0",1).";";/*PFUNC.USACONTROLEDESALDO -- Usa Controle de Saldo de Verbas? (0-Não/1-Sim)*///172
    $xml .= str_pad("",11).";";//173
    $xml .= str_pad("0",1).";";/*PFUNC.MUDOUCI -- Mudou Código Contribuinte Individual (0-Não/1-Sim)*///174
    $xml .= str_pad("",11).";";//175
    $xml .= str_pad("",2).";";//176
    $xml .= str_pad("",1).";";//177
    $xml .= str_pad("",1).";";//178
    $xml .= str_pad("0",1).";";/*PFUNC.FGTSMESANTRECOLGRFP -- FGTS mês anterior será recolhido na GRFC (0-Não/1-Sim)*///179
    $xml .= str_pad("",10).";";//180
    $xml .= str_pad("",2).";";//181
    $xml .= str_pad("",1).";";/*PFUNC.POSSUIALVARAMENOR16 -- Tem alvará judicial p/func menor 16 anos (1-Sim/2-Não)*///182
    $xml .= str_pad("",1).";";//183
    $xml .= str_pad("",8).";";//184
    $xml .= str_pad("",1).";";/*PFUNC.QUERADIANTAMENTO -- Quer adiantamento nas férias (0-Não/1-Sim)*///185
    $xml .= str_pad("",8).";";//186
    $xml .= str_pad("",5).";";//187
    $xml .= str_pad("",25).";";//188
    $xml .= str_pad("",1).";";//189
    $xml .= str_pad("",1).";";//190
    $xml .= str_pad("",1).";";//191
    $xml .= str_pad("",1).";";//192
    $xml .= str_pad("",20).";";//193
    $xml .= str_pad("",40).";";//194
    $xml .= str_pad("",2).";";/*PFUNC.POSICAOABONO -- Posição Abono (0-Não/1-Sim)*///195
    $xml .= str_pad("",2).";";//196
    $xml .= str_pad("",20).";";//197
    $xml .= str_pad("",2).";";/*PPESSOA.FUMANTE -- Fumante (0-Não/1-Sim)*///198
    $xml .= str_pad("",15).";";//199
    $xml .= str_pad("",15).";";//200
    $xml .= str_pad("",8).";";//201
    $xml .= str_pad("",8).";";//202
    $xml .= str_pad("",1).";";//203
    $xml .= str_pad("N",1).";";/*PFUNC.REPOEVAGA -- Reposição de Vaga (N-Não/S-Sim)*///204
    $xml .= str_pad("",15).";";//205
    $xml .= str_pad("",5).";";//206

    $xml .= str_pad("",2).";";//207
    $xml .= str_pad("",1).";";//208
    $xml .= str_pad("",2).";";//209
    $xml .= str_pad("",16).";";//210
    $xml .= str_pad("",2).";";//211
    $xml .= str_pad("",100).";";//212
    $xml .= str_pad("",2).";";//213
    $xml .= str_pad("",2).";";//214
    $xml .= str_pad("",2).";";//215
    $xml .= str_pad("",1).";";//216
    $xml .= str_pad("",20).";";//217
    $xml .= str_pad("",2).";";//218
    $xml .= str_pad("",2).";";//219
    $xml .= str_pad("",1).";";//220
    $xml .= str_pad("",2).";";//221
    $xml .= str_pad("",2).";";//222
    $xml .= str_pad("",8).";";//223
    $xml .= str_pad("",8).";";//224
    $xml .= str_pad("",20).";";//225
    $xml .= str_pad("",20).";";//226
    $xml .= str_pad("",1).";";//227
    $xml .= str_pad("",1).";";//228
    $xml .= str_pad("",50).";";//229
    $xml .= str_pad("",30).";";//230
    $xml .= str_pad("",8).";";//231
    $xml .= str_pad("",16).";";//232
    $xml .= str_pad("",16).";";//233
    $xml .= str_pad("",11).";";//234
    $xml .= str_pad("",80).";";//235
    $xml .= str_pad("",20).";";//236
    $xml .= str_pad("",8).";";//237
    $xml .= str_pad("",30).";";//238
    $xml .= str_pad("",2).";";//239
    $xml .= str_pad("",2).";";//240
    $xml .= str_pad("",16).";";//241
    $xml .= str_pad("",2).";";//242
    $xml .= str_pad("",8).";";//243
    $xml .= str_pad("",30).";";//244
    $xml .= str_pad("",20).";";//245
    $xml .= str_pad("",255).";";//246
    $xml .= str_pad("",255).";";//247
    $xml .= str_pad("",90).";";//248
    $xml .= str_pad("",255).";";//249
    $xml .= str_pad("",2).";";//250
    $xml .= str_pad("",14).";";//251
    $xml .= str_pad("",30).";";//252
    $xml .= str_pad("",8).";";//253
    $xml .= str_pad("",255).";";//254
    $xml .= str_pad("",2).";";//255
    $xml .= str_pad("",8).";";//256
    $xml .= str_pad("",2).";";//257
    $xml .= str_pad("",2).";";//258
    $xml .= str_pad("",9).";";//259
    $xml .= str_pad("",2).";";//260
    $xml .= str_pad("",2).";";//261
    $xml .= str_pad("",2).";";//262
    $xml .= str_pad("",3).";";//263
    $xml .= str_pad("",6).";";//264
    $xml .= str_pad("",15).";";//265
    $xml .= str_pad("",5).";";//266
    $xml .= str_pad("",1).";";//267
    $xml .= str_pad("",2).";";//268
    $xml .= str_pad("",2).";";//269
    $xml .= str_pad("",8).";";//270/
    $xml .= str_pad("",30).";";//271
    $xml .= str_pad("",2).";";//272
    $xml .= str_pad("",25).";";//273
    $xml .= str_pad("",4).";";//274
    $xml .= str_pad("",4).";";//275
    $xml .= str_pad("",4).";";//276
    $xml .= str_pad("",10).";";//277
    $xml .= str_pad("",2).";";//278
    $xml .= str_pad("",2).";";//279
    $xml .= str_pad("",1).";";/*PFUNC.DESCONTAAVISOPREVIO -- Desconta Aviso Prévio (0-Não/1-Sim)*///280
    $xml .= str_pad("",4).";";//281
    $xml .= str_pad("",2).";";//282
    $xml .= str_pad("",8).";";//283
    $xml .= str_pad("",15).";";//284
    $xml .= str_pad("",8).";";//285
    $xml .= str_pad("",2).";";//286
    $xml .= str_pad("",2).";";//287
    $xml .= str_pad("",20).";";//288
    $xml .= str_pad("",20).";";//289
    $xml .= str_pad("",20).";";//290
    $xml .= str_pad("",8).";";//291
    $xml .= str_pad("",8).";";//292
    $xml .= str_pad("",20).";";//293
    $xml .= str_pad("",8).";";//294
    $xml .= str_pad("",20).";";//295
    $xml .= str_pad("",8).";";//296
    $xml .= str_pad("",120).";";//297
    $xml .= str_pad("",2).";";//298
    $xml .= str_pad("",2).";";//299
    $xml .= str_pad("",255).";";//300
    $xml .= str_pad("",8).";";//1
    $xml .= str_pad("",50).";";//2
    $xml .= str_pad("",4).";";//3/
    $xml .= str_pad("",50).";";//4
    $xml .= str_pad("",20).";";//5
    $xml .= str_pad("",2).";";//6
    $xml .= str_pad("",8).";";//7
    $xml .= str_pad("",4).";";//8
    $xml .= str_pad("",60).";";//9/
    $xml .= str_pad("",4).";";//10
    $xml .= str_pad("",9).";";//11
    $xml .= str_pad("",15).";";//12
    $xml .= str_pad("",4).";";//13
    $xml .= str_pad("",3).";";//14
    $xml .= str_pad("",16).";";//15
    $xml .= str_pad("",10).";";//16
    $xml .= str_pad("",8).";";//17
    $xml .= str_pad("",10).";";//18//
    $xml .= str_pad("",10).";";//19
    $xml .= str_pad("",10).";";//20/
    $xml .= str_pad("",8).";";//21
    $xml .= str_pad("",2).";";//22
    $xml .= str_pad("",10).";";//23
    $xml .= str_pad("",2).";";//24
    $xml .= str_pad("",2).";";//25
    $xml .= str_pad("",1).";";//26
    $xml .= str_pad("",2).";";//27
    $xml .= str_pad("",2).";";//28
    $xml .= str_pad("",2).";";//29
    $xml .= str_pad("",25).";";//30
    $xml .= str_pad("",999).";";//31
    $xml .= str_pad("",2).";";//32
    $xml .= str_pad("",20).";";//33
    $xml .= str_pad("",999).";";//34
    $xml .= str_pad("",8).";";//35
    $xml .= str_pad("",8).";";//36
    $xml .= str_pad("",1).";";//37
    $xml .= str_pad("",11).";";//38
    $xml .= str_pad("",1).";";//39
    $xml .= str_pad("",20).";";//40
    $xml .= str_pad("",1).";";//41
    $xml .= str_pad("101",5).";";//42
    $xml .= str_pad("",1).";";//43
    $xml .= str_pad("",8).";";//44
    $xml .= str_pad("01",2).";";//45
    $xml .= str_replace('/','',str_pad( date("d/m/Y", strtotime($meus_links[$i]['DTADMISSAO'])),8).";"); //46
    $xml .= str_pad("01",2).";";//47
    $xml .= str_replace('/','',str_pad( date("d/m/Y", strtotime($meus_links[$i]['DTADMISSAO'])),8).";"); //48
    $xml .= str_pad("01",10).";";//49
    $xml .= str_replace('/','',str_pad( date("d/m/Y", strtotime($meus_links[$i]['DTADMISSAO'])),8).";"); //50
    $xml .= str_pad("01",2).";";//51
    $xml .= str_pad("",8).";";//52
    $xml .= str_pad("",8).";";//53

    $xml .= str_pad("",8).";";//54
    $xml .= str_pad("",8).";";//55
    $xml .= str_pad("",8).";";//56
    $xml .= str_pad("",2).";";//57
    $xml .= str_pad("",10).";";//58
    $xml .= str_pad("1",1).";";//59
    $xml .= str_pad("",8).";";//60
    $xml .= str_pad("",1).";";//61

    $xml .= str_pad("",30).";";//62
    $xml .= str_pad("",8).";";//63
    $xml .= str_pad("",1).";";//64
    $xml .= str_pad("",255).";";//65//
    $xml .= str_pad("",1).";";//66
    $xml .= str_pad("",1).";";//67
    $xml .= str_pad("",8).";";//68
    $xml .= str_pad("",8).";";//69
    $xml .= str_pad("",6).";";//70
    $xml .= str_pad("",2).";";//71
    $xml .= str_pad("",6).";";//72
    /*$xml .= str_pad("",8).";";//73
    $xml .= str_pad("",8).";";//74
    $xml .= str_pad("",2).";";//75*/
    

    




    
    



    
}

/*$xml .= "</links>\n";*/

// Escreve o arquivo
$fp = fopen('integracao.txt', 'w+');
fwrite($fp, $xml);
fclose($fp);

/*
require_once 'conexao.php';
require_once 'email/PHPMailer.php';
require_once 'email/SMTP.php';
require_once 'email/Exception.php';

$CODCOLIGADA = $_SESSION['coligada'];


$query = "SELECT * FROM email WHERE codcoligada = '$CODCOLIGADA'";
$result = mysqli_query($conexao, $query);
$dadosemail = mysqli_fetch_array($result);

$query2 = "SELECT * FROM gcoligada WHERE codcoligada = '$CODCOLIGADA'";
$result2 = mysqli_query($conexao, $query2);

$dadoscoligada = mysqli_fetch_array($result2);

$query3 = "SELECT * FROM PPESSOA WHERE ID='$ID' and codcoligada = '$CODCOLIGADA'";
$result3 = mysqli_query($conexao, $query3);
$dados_pes = mysqli_fetch_array($result3);



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $dadosemail['HOST'];//'smtp-mail.outlook.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;              // Enable SMTP authentication
    $mail->Username   = $dadosemail['EMAIL'];//'brendo_mark@hotmail.com'; // SMTP username
    $mail->Password   = $dadosemail['SENHA'];//'01000010B';     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $dadosemail['PORTA'];//587;             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    

    //Recipients
    $mail->setFrom($dadosemail['EMAIL'], $dadoscoligada['NOMECOLIGADA']);
    
	$mail->addAddress($dados_pes['EMAIL']);
	$fp='integracao.xml';
	$mail->AddAttachment($fp);

    $MENSAGEM = "<b>Arquivo de integração enviado com sucesso!</b>";

    $ASSUNTO = 'Integração RM';

    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = utf8_decode($ASSUNTO);
    $mail->Body    = utf8_decode($MENSAGEM) ;
    $mail->AltBody = utf8_decode(Strip_tags($MENSAGEM));

	$mail->send();

	unlink($fp);
	
    $_SESSION['mensagem'] = 'integração realizada!';
    header('location: lista_func_rh.php');
    
} catch (Exception $e) {
    $_SESSION['mensagem'] = "erro ao realizar a integração:  {$mail->ErrorInfo}";
    header('location: lista_func_rh.php');
}
*/
?>